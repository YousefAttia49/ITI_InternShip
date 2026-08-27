<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\Product;
use App\Models\Category;
use App\Models\CartItem;

class ChatbotController extends Controller
{
    /**
     * Gemini Interactions API endpoint (no key in URL).
     */
    private const GEMINI_ENDPOINT = 'https://generativelanguage.googleapis.com/v1beta/interactions';

    /**
     * Display the chatbot interface.
     */
    public function index()
    {
        return view('chatbot.index');
    }

    /**
     * Process an incoming message via Google Gemini Interactions API.
     */
    public function message(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:500',
        ]);

        $rawMessage = trim($request->input('message'));
        $user = Auth::user();
        $apiKey = config('services.gemini.key');

        if (empty($apiKey) || $apiKey === 'your_gemini_api_key_here' || str_starts_with($apiKey, 'your_')) {
            return response()->json([
                'success' => false,
                'message' => "Gemini API key is not configured. Please set GEMINI_API_KEY in your .env file."
            ]);
        }

        try {
            $result = $this->processGeminiChat($rawMessage, $user, $apiKey);
            return response()->json($result);
        } catch (\Throwable $e) {
            Log::error('Gemini Interactions API Exception', [
                'user_id' => $user->id,
                'error' => $e->getMessage(),
            ]);

            // Sanitize error message: never expose API key
            $safeError = preg_replace('/key=[^&\s]+/', 'key=***REDACTED***', $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => "Gemini API Error: " . $safeError
            ]);
        }
    }

    /**
     * Two-phase Gemini Interactions API flow.
     */
    protected function processGeminiChat(string $message, $user, string $apiKey): array
    {
        $model = config('services.gemini.model', 'gemini-3.6-flash');

        // Phase 1: Ask Gemini to parse intent
        $intentPrompt = "You are an AI assistant and intent parser for an e-commerce platform. " .
            "Analyze the user query and output strictly a raw JSON object (NO markdown, NO code block markers) with this exact schema:\n" .
            "{\"intent\": \"get_products\" | \"get_products_by_price\" | \"get_product_by_name\" | \"get_my_cart\" | \"get_my_cart_total\" | \"get_users\" | \"get_categories\" | \"get_dashboard_summary\" | \"general_chat\", " .
            "\"parameters\": {\"max_price\": number_or_null, \"min_price\": number_or_null, \"search\": string_or_null}, " .
            "\"direct_response\": string_or_null}\n" .
            "Use 'general_chat' for general questions (greetings, 'who are you', 'which version you are', etc.) and provide a friendly conversational answer in 'direct_response'.\n\n" .
            "User query: \"{$message}\"";

        $response = $this->callGemini($apiKey, $model, $intentPrompt);

        if (!$response->successful()) {
            $safeBody = preg_replace('/key=[^&\s"]+/', 'key=***REDACTED***', $response->body());
            return [
                'success' => false,
                'message' => "Gemini API Error (HTTP {$response->status()}):\n{$safeBody}"
            ];
        }

        $rawText = $this->extractText($response->json());

        // Try to parse structured JSON intent
        $cleanedJson = trim(preg_replace('/^```(?:json)?|```$/m', '', trim($rawText)));
        $parsedIntent = json_decode($cleanedJson, true);

        if (!is_array($parsedIntent) || empty($parsedIntent['intent'])) {
            return [
                'success' => true,
                'message' => !empty($rawText) ? trim($rawText) : 'Sorry, I could not process your request.'
            ];
        }

        $intent = $parsedIntent['intent'];
        $params = $parsedIntent['parameters'] ?? [];
        $directResponse = $parsedIntent['direct_response'] ?? null;

        // General chat: return Gemini's direct AI response
        if ($intent === 'general_chat') {
            if (!empty($directResponse)) {
                return ['success' => true, 'message' => $directResponse];
            }
            return $this->askGeminiDirect($message, $user, $apiKey, $model);
        }

        // Execute capability with strict Laravel authorization
        $capResult = $this->executeCapability($intent, $params, $user);

        if (isset($capResult['error']) && $capResult['error'] === 'unauthorized') {
            return [
                'success' => false,
                'message' => 'You are not authorized to access this information.'
            ];
        }

        if (isset($capResult['error'])) {
            return $this->askGeminiDirect($message, $user, $apiKey, $model);
        }

        // Phase 2: Send DB results back to Gemini for natural language formatting
        $formatPrompt = "You are a helpful e-commerce assistant for user '{$user->name}'.\n" .
            "The user asked: \"{$message}\"\n\n" .
            "Here is the database output:\n" . json_encode($capResult, JSON_PRETTY_PRINT) . "\n\n" .
            "Generate a friendly, clear, natural language response based on the above data.";

        $secondResponse = $this->callGemini($apiKey, $model, $formatPrompt);

        if ($secondResponse->successful()) {
            $naturalText = $this->extractText($secondResponse->json());
            if (!empty($naturalText)) {
                return ['success' => true, 'message' => trim($naturalText)];
            }
        }

        $safeBody = preg_replace('/key=[^&\s"]+/', 'key=***REDACTED***', $secondResponse->body());
        return [
            'success' => false,
            'message' => "Gemini Synthesis Error (HTTP {$secondResponse->status()}):\n{$safeBody}"
        ];
    }

    /**
     * Call the Gemini Interactions API.
     * Auth: x-goog-api-key header (NEVER in URL).
     */
    protected function callGemini(string $apiKey, string $model, string $prompt)
    {
        Log::debug('Gemini Interactions API Request', [
            'endpoint' => self::GEMINI_ENDPOINT,
            'model' => $model,
            'prompt_length' => strlen($prompt),
        ]);

        return Http::withHeaders([
            'Content-Type' => 'application/json',
            'x-goog-api-key' => $apiKey,
        ])->timeout(30)->post(self::GEMINI_ENDPOINT, [
            'model' => $model,
            'input' => $prompt,
        ]);
    }

    /**
     * Direct conversational Gemini response.
     */
    protected function askGeminiDirect(string $message, $user, string $apiKey, string $model): array
    {
        $prompt = "You are a friendly e-commerce AI chatbot. Answer this question naturally.\n\nUser ('{$user->name}'): \"{$message}\"";

        $res = $this->callGemini($apiKey, $model, $prompt);

        if ($res->successful()) {
            $text = $this->extractText($res->json());
            return [
                'success' => true,
                'message' => trim($text) ?: 'I am an AI assistant powered by Google Gemini.'
            ];
        }

        $safeBody = preg_replace('/key=[^&\s"]+/', 'key=***REDACTED***', $res->body());
        return [
            'success' => false,
            'message' => "Gemini API Error (HTTP {$res->status()}):\n{$safeBody}"
        ];
    }

    /**
     * Extract text from Gemini Interactions API response.
     * Format: { "steps": [{ "type": "model_output", "content": [{ "type": "text", "text": "..." }] }] }
     */
    protected function extractText(array $data): string
    {
        if (isset($data['steps']) && is_array($data['steps'])) {
            foreach ($data['steps'] as $step) {
                if (isset($step['content']) && is_array($step['content'])) {
                    foreach ($step['content'] as $content) {
                        if (isset($content['type']) && $content['type'] === 'text' && !empty($content['text'])) {
                            return $content['text'];
                        }
                    }
                }
            }
        }
        if (isset($data['output']['text'])) {
            return $data['output']['text'];
        }
        if (isset($data['text']) && is_string($data['text'])) {
            return $data['text'];
        }
        return '';
    }

    /**
     * Execute structured Laravel capability with strict role verification.
     */
    protected function executeCapability(string $capability, array $args, $user): array
    {
        $isAdmin = ($user->role === 'admin');

        switch ($capability) {
            case 'get_products':
            case 'get_products_by_price':
            case 'get_product_by_name':
                $query = Product::with('category');
                if (isset($args['max_price']) && is_numeric($args['max_price'])) {
                    $query->where('price', '<=', $args['max_price']);
                }
                if (isset($args['min_price']) && is_numeric($args['min_price'])) {
                    $query->where('price', '>=', $args['min_price']);
                }
                if (!empty($args['search'])) {
                    $query->where('name', 'like', '%' . $args['search'] . '%');
                }
                $products = $query->limit(15)->get();
                return [
                    'count' => $products->count(),
                    'products' => $products->map(fn($p) => [
                        'name' => $p->name,
                        'price' => $p->price,
                        'category' => $p->category->name ?? 'Uncategorized',
                        'quantity' => $p->quantity,
                    ])->toArray()
                ];

            case 'get_my_cart':
            case 'get_my_cart_total':
                if (!Schema::hasTable('cart_items')) {
                    return ['count' => 0, 'items' => [], 'grand_total' => 0];
                }
                $cartItems = CartItem::where('user_id', $user->id)->with('product')->get();
                $total = 0;
                $items = [];
                foreach ($cartItems as $item) {
                    $pName = $item->product->name ?? 'Product #' . $item->product_id;
                    $price = $item->product->price ?? 0;
                    $subtotal = $item->quantity * $price;
                    $total += $subtotal;
                    $items[] = [
                        'product' => $pName,
                        'quantity' => $item->quantity,
                        'unit_price' => $price,
                        'subtotal' => $subtotal
                    ];
                }
                return [
                    'count' => $cartItems->sum('quantity'),
                    'items' => $items,
                    'grand_total' => $total
                ];

            case 'get_users':
                if (!$isAdmin) {
                    return ['error' => 'unauthorized'];
                }
                $uQuery = User::select('id', 'name', 'email', 'role');
                if (!empty($args['search'])) {
                    $uQuery->where('name', 'like', '%' . $args['search'] . '%')
                           ->orWhere('email', 'like', '%' . $args['search'] . '%');
                }
                $users = $uQuery->limit(15)->get();
                return [
                    'total_users' => User::count(),
                    'users' => $users->toArray()
                ];

            case 'get_categories':
                if (!$isAdmin) {
                    return ['error' => 'unauthorized'];
                }
                return [
                    'total_categories' => Category::count(),
                    'categories' => Category::pluck('name')->toArray()
                ];

            case 'get_dashboard_summary':
                if (!$isAdmin) {
                    return ['error' => 'unauthorized'];
                }
                return [
                    'total_users' => User::count(),
                    'total_products' => Product::count(),
                    'total_categories' => Category::count(),
                ];

            default:
                return ['error' => 'unknown_capability'];
        }
    }
}
