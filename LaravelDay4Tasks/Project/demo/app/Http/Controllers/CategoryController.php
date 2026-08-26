<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Requests\CategoryRequest;

use Error;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        //
        // // $requestedData = $request->except("_token");
        // $requestedData = $request->validate(
        //     [
        //         "name" => "required|min:3|max:20|string|unique:categories,name",
        //         "descripyion" => "min:12|max:100|required|string"
        //     ],[
        //         "name.required"=>"name is required",
        //         "name.min"=>"name must be at least 3 characters ",
        //         "name.unique"=>"name is already exist",
        //         "descripyion.required"=>"descripyion is required",
        //         "descripyion.min"=>"descripyion must be at least 12 characters ",
        //     ]
        // );

        $requestedData =$request->validated();

        Category::create($requestedData);
        return to_route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $category = Category::findorfail($id);
        return view('categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findorfail($id);
        //
        return view('categories.update', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id)
    {
        // dump($request->all());
        // $requestedData=$request->all();
        try {
            $validatedRequst=$request->validated();  // array
            // dump($validatedRequst);
            // $requestedData = $request->except("_token");
            $category = Category::findorfail($id);
            $category->update($validatedRequst);
            return view("categories.show", compact('category'));
            //code...
        } catch (Error $e) {
            //throw $th;
            $e->getMessage();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $category = Category::findorfail($id);
        $category->delete();
        return to_route('categories.index');
    }
}
