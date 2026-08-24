@extends('layout')

@section('title', 'Product Details - ' . $product->name)

@section('content')
<div class="space-y-6 max-w-4xl mx-auto">
    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('products.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl border border-slate-700 transition-all text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Products</span>
        </a>

        <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-rose-600/10 hover:bg-rose-600 text-rose-400 hover:text-white rounded-xl border border-rose-500/20 transition-all text-sm font-medium inline-flex items-center gap-2">
                <i class="fa-regular fa-trash-can"></i>
                <span>Delete Product</span>
            </button>
        </form>
    </div>

    <!-- Product Profile Card -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 md:p-8 backdrop-blur-sm shadow-xl space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-700/50 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-emerald-600 to-teal-600 flex items-center justify-center font-bold text-2xl text-white shadow-lg shadow-emerald-500/20">
                    <i class="fa-solid fa-box-archive"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $product->name }}</h1>
                    <span class="inline-flex items-center px-2.5 py-0.5 mt-1 rounded-lg text-xs font-semibold bg-purple-500/10 text-purple-400 border border-purple-500/20">
                        <i class="fa-solid fa-tag mr-1.5"></i> {{ $product->category->name ?? 'Uncategorized' }}
                    </span>
                </div>
            </div>
            <div class="text-right">
                <span class="text-3xl font-extrabold text-emerald-400">${{ number_format($product->price, 2) }}</span>
                <span class="text-xs text-slate-400 block mt-0.5">Unit Price</span>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">Product ID</span>
                <span class="text-lg font-bold text-white font-mono mt-1 block">#{{ $product->id }}</span>
            </div>
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">Stock Quantity</span>
                <span class="text-lg font-bold text-white mt-1 block">
                    {{ $product->quantity }} units
                </span>
            </div>
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">Category</span>
                <span class="text-sm font-semibold text-indigo-400 mt-1 block">
                    {{ $product->category->name ?? 'N/A' }}
                </span>
            </div>
        </div>

        <!-- Description Section -->
        <div class="pt-2">
            <h2 class="text-sm font-semibold text-slate-400 uppercase tracking-wider mb-2">Description</h2>
            <p class="text-slate-300 text-sm leading-relaxed bg-slate-900/40 p-4 rounded-xl border border-slate-800">
                {{ $product->description ?? 'No description provided for this product.' }}
            </p>
        </div>
    </div>
</div>
@endsection
