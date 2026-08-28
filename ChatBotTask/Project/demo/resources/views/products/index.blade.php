<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-bootstrap-Css></x-bootstrap-Css>

    <title>ALL Products</title>
</head>

<body>
<x-navbar></x-navbar>

    <div class="container my-4">
        <h1 class="text-center text-danger mb-4">All Products Page</h1>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(Auth::check() && Auth::user()->role === 'admin')
            <div class="mb-3">
                <a href="{{ route('products.create') }}">
                    <x-button class="info" content="Add Products"></x-button>
                </a>
            </div>
        @endif

        <table class="table table-striped w-100 m-auto align-middle">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Category</th>
                    <th class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product["id"] }}</td>
                    <td><strong>{{ $product["name"] }}</strong></td>
                    <td>{{ $product["description"] }}</td>
                    <td>${{ number_format($product["price"], 2) }}</td>
                    <td>
                        @if($product["quantity"] > 0)
                            <span class="badge bg-success">{{ $product["quantity"] }} in stock</span>
                        @else
                            <span class="badge bg-danger">Out of Stock</span>
                        @endif
                    </td>
                    <td>
                        @if($product->category)
                            <a href="{{ route('categories.show', $product->category->id) }}">{{ $product->category->name }}</a>
                        @else
                            N/A
                        @endif
                    </td>
                    <td>
                        <div class="d-flex justify-content-center align-items-center gap-2">
                            <a href="{{ route('products.show', $product["id"]) }}" class="btn btn-warning btn-sm" style="text-decoration:none">View</a>

                            @auth
                                @if($product["quantity"] > 0)
                                    <form action="{{ route('cart.add') }}" method="post" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                                        <button type="submit" class="btn btn-success btn-sm">Add to Cart</button>
                                    </form>
                                @else
                                    <button class="btn btn-secondary btn-sm" disabled>Out of Stock</button>
                                @endif

                                @if(Auth::user()->role === 'admin')
                                    <a href="{{ route('products.edit', $product["id"]) }}" class="btn btn-primary btn-sm">Edit</a>

                                    <form action="{{ route('products.destroy', $product["id"]) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete product?')">Delete</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <x-bootstrap-js></x-bootstrap-js>
</body>

</html>
