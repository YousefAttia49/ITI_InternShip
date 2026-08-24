@extends('layout')

@section('title', 'Category Details - ' . $category->name)

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('categories.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl border border-slate-700 transition-all text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Categories</span>
        </a>

        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this category?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-rose-600/10 hover:bg-rose-600 text-rose-400 hover:text-white rounded-xl border border-rose-500/20 transition-all text-sm font-medium inline-flex items-center gap-2">
                <i class="fa-regular fa-trash-can"></i>
                <span>Delete Category</span>
            </button>
        </form>
    </div>

    <!-- Category Profile Card -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 md:p-8 backdrop-blur-sm shadow-xl space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-700/50 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-purple-600 to-indigo-600 flex items-center justify-center font-bold text-2xl text-white shadow-lg shadow-purple-500/20">
                    <i class="fa-solid fa-layer-group"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $category->name }}</h1>
                    <p class="text-sm text-slate-400 mt-0.5">{{ $category->description ?? 'No description available' }}</p>
                </div>
            </div>
            <div>
                <span class="px-4 py-1.5 rounded-xl text-sm font-semibold bg-emerald-500/10 text-emerald-400 border border-emerald-500/20 inline-flex items-center gap-2">
                    <i class="fa-solid fa-boxes-stacked"></i> {{ $category->products->count() }} Products
                </span>
            </div>
        </div>

        <!-- Products in Category -->
        <div>
            <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-box text-indigo-400"></i>
                Products in {{ $category->name }}
            </h2>
            @if($category->products->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($category->products as $product)
                        <div class="p-4 bg-slate-900/60 rounded-xl border border-slate-800 flex items-center justify-between">
                            <div>
                                <h3 class="font-bold text-white text-base">{{ $product->name }}</h3>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-1">{{ $product->description }}</p>
                                <span class="text-sm font-semibold text-emerald-400 mt-2 block">${{ number_format($product->price, 2) }}</span>
                            </div>
                            <a href="{{ route('products.show', $product->id) }}" class="px-3 py-1.5 bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs rounded-lg border border-slate-700 transition-colors">
                                View
                            </a>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-slate-500 italic bg-slate-900/30 p-4 rounded-xl border border-slate-800/50">No products found under this category.</p>
            @endif
        </div>
    </div>
</div>
@endsection
