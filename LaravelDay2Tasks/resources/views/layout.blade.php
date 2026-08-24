<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Laravel App')</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #0f172a;
            color: #f8fafc;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col bg-slate-900 text-slate-100">

    <!-- Header Navigation -->
    <header class="bg-slate-800/80 backdrop-blur-md border-b border-slate-700/60 sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-xl bg-gradient-to-tr from-indigo-500 to-purple-500 flex items-center justify-center shadow-lg shadow-indigo-500/20">
                        <i class="fa-solid fa-database text-white text-lg"></i>
                    </div>
                    <span class="font-bold text-xl tracking-tight text-white">task_managment</span>
                </div>

                <nav class="flex space-x-2">
                    <a href="{{ route('users.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('users.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                        <i class="fa-solid fa-users"></i>
                        <span>Users</span>
                    </a>
                    <a href="{{ route('categories.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('categories.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                        <i class="fa-solid fa-layer-group"></i>
                        <span>Categories</span>
                    </a>
                    <a href="{{ route('products.index') }}" 
                       class="px-4 py-2 rounded-lg text-sm font-medium transition-all duration-200 flex items-center space-x-2 {{ request()->routeIs('products.*') ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30' : 'text-slate-300 hover:bg-slate-700/60 hover:text-white' }}">
                        <i class="fa-solid fa-box"></i>
                        <span>Products</span>
                    </a>
                </nav>
            </div>
        </div>
    </header>

    <!-- Main Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <!-- Flash Alert -->
        @if(session('success'))
            <div class="mb-6 p-4 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-between shadow-lg shadow-emerald-500/5 transition-all">
                <div class="flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <span class="font-medium text-sm">{{ session('success') }}</span>
                </div>
                <button onclick="this.parentElement.remove()" class="text-emerald-400/60 hover:text-emerald-400 transition-colors">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
        @endif

        @yield('content')

    </main>

    <!-- Footer -->
    <footer class="border-t border-slate-800 bg-slate-900/50 py-6 text-center text-xs text-slate-500">
        <p>&copy; {{ date('Y') }} Laravel Management System. All rights reserved.</p>
    </footer>

</body>
</html>
