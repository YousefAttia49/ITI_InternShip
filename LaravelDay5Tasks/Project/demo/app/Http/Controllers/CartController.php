<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display the user's cart items.
     */
    public function index()
    {
        if (!\Illuminate\Support\Facades\Schema::hasTable('cart_items')) {
            $cartItems = collect();
            $totalPrice = 0;
            session()->now('error', 'The cart_items table does not exist in the database yet. Please run "php artisan migrate" in your terminal.');
            return view('cart.index', compact('cartItems', 'totalPrice'));
        }

        $user = Auth::user();
        $cartItems = CartItem::with('product.category')
            ->where('user_id', $user->id)
            ->get();

        $totalPrice = $cartItems->sum(function ($item) {
            return $item->quantity * ($item->product->price ?? 0);
        });

        return view('cart.index', compact('cartItems', 'totalPrice'));
    }

    /**
     * Add a product to the authenticated user's cart.
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $productId = $request->input('product_id');
        $addQuantity = $request->input('quantity', 1);

        $product = Product::findOrFail($productId);

        if ($product->quantity !== null && $product->quantity <= 0) {
            return back()->with('error', 'Product is currently out of stock.');
        }

        $userId = Auth::id();
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $newQuantity = $cartItem->quantity + $addQuantity;
            if ($product->quantity !== null && $newQuantity > $product->quantity) {
                $newQuantity = $product->quantity;
            }
            $cartItem->update(['quantity' => $newQuantity]);
        } else {
            $quantityToSet = ($product->quantity !== null && $addQuantity > $product->quantity)
                ? $product->quantity
                : $addQuantity;

            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantityToSet,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart successfully!');
    }

    /**
     * Update quantity of a cart item.
     */
    public function update(Request $request, string $id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $action = $request->input('action');

        if ($action === 'increase') {
            if ($cartItem->product->quantity === null || $cartItem->quantity < $cartItem->product->quantity) {
                $cartItem->increment('quantity');
            } else {
                return back()->with('error', 'Cannot exceed available stock.');
            }
        } elseif ($action === 'decrease') {
            if ($cartItem->quantity > 1) {
                $cartItem->decrement('quantity');
            } else {
                $cartItem->delete();
                return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
            }
        } elseif ($request->has('quantity')) {
            $request->validate([
                'quantity' => 'required|integer|min:1',
            ]);
            $requestedQty = (int) $request->input('quantity');
            if ($cartItem->product->quantity !== null && $requestedQty > $cartItem->product->quantity) {
                $requestedQty = $cartItem->product->quantity;
            }
            $cartItem->update(['quantity' => $requestedQty]);
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove a single item from the cart.
     */
    public function destroy(string $id)
    {
        $cartItem = CartItem::where('user_id', Auth::id())->findOrFail($id);
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    /**
     * Clear all cart items for the user.
     */
    public function clear()
    {
        CartItem::where('user_id', Auth::id())->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully.');
    }
}
