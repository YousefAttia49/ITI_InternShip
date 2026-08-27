<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <x-bootstrap-Css></x-bootstrap-Css>
    <title>My Shopping Cart</title>
</head>

<body>
    <x-navbar></x-navbar>

    <div class="container my-4">
        <h1 class="text-center text-primary mb-4">My Shopping Cart</h1>

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

        @if($cartItems->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped table-bordered align-middle w-100">
                    <thead class="table-dark text-center">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $index => $item)
                            <tr>
                                <td class="text-center">{{ $index + 1 }}</td>
                                <td>
                                    <strong>{{ $item->product->name }}</strong>
                                    <br>
                                    <small class="text-muted">{{ Str::limit($item->product->description, 50) }}</small>
                                </td>
                                <td>{{ $item->product->category->name ?? 'N/A' }}</td>
                                <td class="text-end">${{ number_format($item->product->price, 2) }}</td>
                                <td>
                                    <div class="d-flex justify-content-center align-items-center gap-2">
                                        <form action="{{ route('cart.update', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="action" value="decrease">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" {{ $item->quantity <= 1 ? 'disabled' : '' }}>-</button>
                                        </form>

                                        <span class="fw-bold px-2">{{ $item->quantity }}</span>

                                        <form action="{{ route('cart.update', $item->id) }}" method="post" class="d-inline">
                                            @csrf
                                            @method('patch')
                                            <input type="hidden" name="action" value="increase">
                                            <button type="submit" class="btn btn-outline-secondary btn-sm" {{ ($item->product->quantity !== null && $item->quantity >= $item->product->quantity) ? 'disabled' : '' }}>+</button>
                                        </form>
                                    </div>
                                </td>
                                <td class="text-end fw-bold">${{ number_format($item->quantity * $item->product->price, 2) }}</td>
                                <td class="text-center">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="post" class="d-inline">
                                        @csrf
                                        @method('delete')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Remove this product from cart?')">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr class="table-light">
                            <td colspan="5" class="text-end fw-bold fs-5">Grand Total:</td>
                            <td class="text-end fw-bold fs-5 text-success">${{ number_format($totalPrice, 2) }}</td>
                            <td></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    &larr; Continue Shopping
                </a>

                <form action="{{ route('cart.clear') }}" method="post" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to clear your entire cart?')">
                        Clear Cart
                    </button>
                </form>
            </div>
        @else
            <div class="text-center py-5">
                <p class="fs-4 text-muted">Your shopping cart is empty.</p>
                <a href="{{ route('products.index') }}" class="btn btn-primary btn-lg mt-2">
                    Browse Products
                </a>
            </div>
        @endif
    </div>

    <x-bootstrap-js></x-bootstrap-js>
</body>

</html>
