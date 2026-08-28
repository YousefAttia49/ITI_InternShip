<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>create</title>
    <x-bootstrap-css></x-bootstrap-css>

</head>

<body>
    <x-navbar></x-navbar>
    <h1 class="text-success text-center"> Create New Product</h1>
    <form class="w-75 m-auto border border-1 p-5" action="{{ route('products.store') }}" method="post">
        @csrf

        <div class="mb-3">
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_name" class="form-label">Product Name</label>
            <input type="text" class="form-control" name="name" id="product_name">
        </div>
        <div class="mb-3">
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_description" class="form-label">Product Description</label>
            <input type="text" class="form-control" name="description" id="product_description">
        </div>
        <div class="mb-3">
            @error('price')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_price" class="form-label">Product Price</label>
            <input type="number" step="0.01" class="form-control" name="price" id="product_price">
        </div>
        <div class="mb-3">
            @error('quantity')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_quantity" class="form-label">Product Quantity</label>
            <input type="number" class="form-control" name="quantity" id="product_quantity">
        </div>
        <div class="mb-3">
            @error('category_id')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <label for="product_category" class="form-label">Category</label>
            <select class="form-control" name="category_id" id="product_category">
                <option value="">-- Select Category --</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create</button>
    </form>


    <x-bootstrap-js></x-bootstrap-js>

</body>

</html>
