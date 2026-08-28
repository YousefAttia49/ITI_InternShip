<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-bootstrap-Css></x-bootstrap-Css>
    <title>Admin Dashboard</title>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="container my-4">
        <h1 class="text-center text-danger mb-4">Admin Dashboard</h1>

        <!-- Stats Overview Cards -->
        <div class="row mb-5">
            <div class="col-md-4 mb-3">
                <div class="card text-white bg-primary h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Categories</h5>
                        <h2 class="display-4 fw-bold">{{ $categoriesCount }}</h2>
                        <div class="mt-3">
                            <a href="{{ route('categories.index') }}" class="btn btn-light btn-sm me-1">Manage Categories</a>
                            <a href="{{ route('categories.create') }}" class="btn btn-outline-light btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-success h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Registered Users</h5>
                        <h2 class="display-4 fw-bold">{{ $usersCount }}</h2>
                        <div class="mt-3">
                            <a href="{{ route('users.index') }}" class="btn btn-light btn-sm me-1">Manage Users</a>
                            <a href="{{ route('users.create') }}" class="btn btn-outline-light btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-3">
                <div class="card text-white bg-warning text-dark h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title">Products</h5>
                        <h2 class="display-4 fw-bold">{{ $productsCount }}</h2>
                        <div class="mt-3">
                            <a href="{{ route('products.index') }}" class="btn btn-dark btn-sm me-1">Manage Products</a>
                            <a href="{{ route('products.create') }}" class="btn btn-outline-dark btn-sm">Add New</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Categories Overview</h5>
                <div>
                    <a href="{{ route('categories.create') }}" class="btn btn-light btn-sm me-2">Add Category</a>
                    <a href="{{ route('categories.index') }}" class="btn btn-outline-light btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td><strong>{{ $category->name }}</strong></td>
                                <td>{{ Str::limit($category->description, 60) }}</td>
                                <td class="text-center">
                                    <a href="{{ route('categories.show', $category->id) }}" class="btn btn-warning btn-sm">View</a>
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete category?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted">No categories available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Users Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-success text-white d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Users Overview</h5>
                <div>
                    <a href="{{ route('users.create') }}" class="btn btn-light btn-sm me-2">Add User</a>
                    <a href="{{ route('users.index') }}" class="btn btn-outline-light btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td><strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge {{ $user->role === 'admin' ? 'bg-danger' : 'bg-secondary' }}">
                                        {{ ucfirst($user->role) }}
                                    </span>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">View</a>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete user?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="5" class="text-center text-muted">No users available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Products Section -->
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-warning text-dark d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Products Overview</h5>
                <div>
                    <a href="{{ route('products.create') }}" class="btn btn-dark btn-sm me-2">Add Product</a>
                    <a href="{{ route('products.index') }}" class="btn btn-outline-dark btn-sm">View All</a>
                </div>
            </div>
            <div class="card-body p-0">
                <table class="table table-striped mb-0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Stock / Quantity</th>
                            <th>Category</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><strong>{{ $product->name }}</strong></td>
                                <td>${{ number_format($product->price, 2) }}</td>
                                <td>{{ $product->quantity }}</td>
                                <td>{{ $product->category->name ?? 'N/A' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('products.show', $product->id) }}" class="btn btn-warning btn-sm">View</a>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Delete product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr><td colspan="6" class="text-center text-muted">No products available.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>

    <x-bootstrap-js></x-bootstrap-js>
</body>

</html>
