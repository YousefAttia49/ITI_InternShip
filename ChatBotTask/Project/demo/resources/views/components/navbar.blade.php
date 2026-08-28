<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="{{ route('home') }}">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
        </li>
        @auth
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('products.index') }}">Products</a>
          </li>
          @if(Auth::user()->role === 'admin')
            <li class="nav-item">
              <a class="nav-link active fw-bold text-danger" aria-current="page" href="{{ route('admin.dashboard') }}">Admin Dashboard</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('users.index') }}">Users</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="{{ route('categories.index') }}">Categories</a>
            </li>
          @endif
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('orders.index') }}">Orders</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="{{ route('cart.index') }}">
              Cart
              @php
                $cartCount = 0;
                if (Auth::check()) {
                    try {
                        if (\Illuminate\Support\Facades\Schema::hasTable('cart_items')) {
                            $cartCount = \App\Models\CartItem::where('user_id', Auth::id())->sum('quantity');
                        }
                    } catch (\Throwable $e) {
                        $cartCount = 0;
                    }
                }
              @endphp
              @if($cartCount > 0)
                <span class="badge bg-danger rounded-pill">{{ $cartCount }}</span>
              @endif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link active fw-bold text-primary" aria-current="page" href="{{ route('chatbot.index') }}">🤖 Chatbot</a>
          </li>
        @endauth
      </ul>
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        @auth
        <li class="nav-item">
          <span class="nav-link">{{ Auth::user()->name }}</span>
        </li>
        <li class="nav-item">
          <form action="{{ route('logout') }}" method="post" class="d-inline">
            @csrf
            <button class="btn btn-outline-danger btn-sm" type="submit">Logout</button>
          </form>
        </li>
        @else
        <li class="nav-item">
          <a class="nav-link" href="{{ route('login') }}">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{ route('register') }}">Register</a>
        </li>
        @endauth
      </ul>
    </div>
  </div>
</nav>
