<?php
/**
 * Standalone PHP cURL test for Gemini Interactions API.
 * Tests native PHP curl (bypassing Guzzle) to isolate timeout.
 *
 * Usage: php test_gemini_curl.php
 *
 * API key is read from .env file, never printed.
 */

// Load API key from .env
$envFile = __DIR__ . '/.env';
$apiKey = '';
if (file_exists($envFile)) {
    foreach (file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) as $line) {
        if (str_starts_with($line, 'GEMINI_API_KEY=')) {
            $apiKey = trim(substr($line, strlen('GEMINI_API_KEY=')));
        }
    }
}

if (empty($apiKey)) {
    echo "ERROR: GEMINI_API_KEY not found in .env\n";
    exit(1);
}

echo "API Key loaded: YES (" . strlen($apiKey) . " chars)\n";
echo "PHP cURL version: " . curl_version()['version'] . "\n";
echo "SSL version: " . curl_version()['ssl_version'] . "\n\n";

$endpoint = 'https://generativelanguage.googleapis.com/v1beta/interactions';
$model = 'gemini-3.6-flash';

// Test body: simple string input
$body = json_encode([
    'model' => $model,
    'input' => 'which version you are',
]);

echo "=== TEST 1: Native PHP cURL with x-goog-api-key header ===\n";
echo "URL: {$endpoint}\n";
echo "Method: POST\n";
echo "Body: {$body}\n\n";

$ch = curl_init();
curl_setopt_array($ch, [
    CURLOPT_URL => $endpoint,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $body,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'x-goog-api-key: ' . $apiKey,
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
    CURLOPT_VERBOSE => true,
    CURLOPT_STDERR => fopen('php://stdout', 'w'),
]);

$startTime = microtime(true);
$result = curl_exec($ch);
$duration = round(microtime(true) - $startTime, 2);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$curlError = curl_error($ch);
$curlErrno = curl_errno($ch);
curl_close($ch);

echo "\n--- Result ---\n";
echo "HTTP Status: {$httpCode}\n";
echo "cURL Error Code: {$curlErrno}\n";
echo "cURL Error: {$curlError}\n";
echo "Duration: {$duration}s\n";
echo "Response (first 500 chars): " . substr($result, 0, 500) . "\n\n";

// Test 2: Try with input as array of Content objects (per docs)
echo "=== TEST 2: input as Content array [{type:text, text:...}] ===\n";
$body2 = json_encode([
    'model' => $model,
    'input' => [
        ['type' => 'text', 'text' => 'which version you are'],
    ],
]);
echo "Body: {$body2}\n\n";

$ch2 = curl_init();
curl_setopt_array($ch2, [
    CURLOPT_URL => $endpoint,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $body2,
    CURLOPT_HTTPHEADER => [
        'Content-Type: application/json',
        'x-goog-api-key: ' . $apiKey,
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_CONNECTTIMEOUT => 10,
]);

$startTime2 = microtime(true);
$result2 = curl_exec($ch2);
$duration2 = round(microtime(true) - $startTime2, 2);
$httpCode2 = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
$curlError2 = curl_error($ch2);
$curlErrno2 = curl_errno($ch2);
curl_close($ch2);

echo "HTTP Status: {$httpCode2}\n";
echo "cURL Error Code: {$curlErrno2}\n";
echo "cURL Error: {$curlError2}\n";
echo "Duration: {$duration2}s\n";
echo "Response (first 500 chars): " . substr($result2, 0, 500) . "\n\n";

// Test 3: Simple GET to /v1beta/models to verify API key & connectivity
echo "=== TEST 3: GET /v1beta/models (verify key + connectivity) ===\n";
$ch3 = curl_init();
curl_setopt_array($ch3, [
    CURLOPT_URL => 'https://generativelanguage.googleapis.com/v1beta/models',
    CURLOPT_HTTPHEADER => [
        'x-goog-api-key: ' . $apiKey,
    ],
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_TIMEOUT => 15,
    CURLOPT_CONNECTTIMEOUT => 10,
]);

$startTime3 = microtime(true);
$result3 = curl_exec($ch3);
$duration3 = round(microtime(true) - $startTime3, 2);
$httpCode3 = curl_getinfo($ch3, CURLINFO_HTTP_CODE);
$curlError3 = curl_error($ch3);
curl_close($ch3);

echo "HTTP Status: {$httpCode3}\n";
echo "cURL Error: {$curlError3}\n";
echo "Duration: {$duration3}s\n";
echo "Response (first 500 chars): " . substr($result3, 0, 500) . "\n";
