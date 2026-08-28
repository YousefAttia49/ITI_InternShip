<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of categories.
     */
    public function index()
    {
        $categories = Category::all();
        return response()->json([
            'status' => 'success',
            'data'   => $categories,
        ], 200);
    }

    /**
     * Store a newly created category.
     */
    public function store(CategoryRequest $request)
    {
        $data = $request->validated();
        $category = Category::create($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Category created successfully',
            'data'    => $category,
        ], 201);
    }

    /**
     * Display the specified category.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return response()->json([
            'status' => 'success',
            'data'   => $category,
        ], 200);
    }

    /**
     * Update the specified category.
     */
    public function update(CategoryRequest $request, string $id)
    {
        $category = Category::findOrFail($id);
        $data = $request->validated();
        $category->update($data);

        return response()->json([
            'status'  => 'success',
            'message' => 'Category updated successfully',
            'data'    => $category,
        ], 200);
    }

    /**
     * Remove the specified category.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return response()->json([
            'status'  => 'success',
            'message' => 'Category deleted successfully',
        ], 200);
    }
}
