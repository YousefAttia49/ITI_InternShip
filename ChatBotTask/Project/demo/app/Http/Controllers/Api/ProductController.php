<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of products.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return response()->json([
            'status' => 'success',
            'data'   => $products,
        ], 200);
    }

    /**
     * Store a newly created product.
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $product = Product::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product created successfully',
            'data'    => $product,
        ], 201);
    }

    /**
     * Display the specified product.
     */
    public function show(string $id)
    {
        $product = Product::with('category')->findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data'   => $product,
        ], 200);
    }

    /**
     * Update the specified product.
     */
    public function update(ProductRequest $request, string $id)
    {
        $product = Product::findOrFail($id);
        $data = $request->validated();
        $product->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Product updated successfully',
            'data'    => $product,
        ], 200);
    }

    /**
     * Remove the specified product.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Product deleted successfully',
        ], 200);
    }
}
