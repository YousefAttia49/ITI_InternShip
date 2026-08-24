@extends('layout')

@section('title', 'Products Management')

@section('content')
<div class="space-y-6">
    <!-- Page Title & Stats -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-800/60 p-6 rounded-2xl border border-slate-700/50 backdrop-blur-sm">
        <div>
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <i class="fa-solid fa-box text-indigo-400"></i>
                Products List
            </h1>
            <p class="text-sm text-slate-400 mt-1">Manage store products and inventory</p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 rounded-xl text-indigo-300 font-semibold text-sm w-fit">
            <span>Total Products:</span>
            <span class="bg-indigo-600 text-white px-2.5 py-0.5 rounded-lg text-xs">{{ count($products) }}</span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-slate-800/40 rounded-2xl border border-slate-700/50 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-800/80 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/50">
                    <tr>
                        <th class="px-6 py-4"># ID</th>
                        <th class="px-6 py-4">Product Name</th>
                        <th class="px-6 py-4">Category</th>
                        <th class="px-6 py-4">Price</th>
                        <th class="px-6 py-4">Stock Quantity</th>
                        <th class="px-6 py-4">Description</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/40">
                    @forelse($products as $product)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $product->id }}</td>
                            <td class="px-6 py-4 font-semibold text-white">
                                {{ $product->name }}
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-purple-500/10 text-purple-400 border border-purple-500/20">
                                    <i class="fa-solid fa-tag mr-1.5"></i> {{ $product->category->name ?? 'Uncategorized' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 font-semibold text-emerald-400">
                                ${{ number_format($product->price, 2) }}
                            </td>
                            <td class="px-6 py-4">
                                @if($product->quantity > 10)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-500/10 text-emerald-400 border border-emerald-500/20">
                                        {{ $product->quantity }} in stock
                                    </span>
                                @elseif($product->quantity > 0)
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-500/10 text-amber-400 border border-amber-500/20">
                                        {{ $product->quantity }} low stock
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        Out of stock
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs max-w-xs truncate">
                                {{ $product->description ?? 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('products.show', $product->id) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white border border-indigo-500/20 transition-all text-xs font-medium inline-flex items-center gap-1.5 group">
                                        <i class="fa-regular fa-eye group-hover:scale-110 transition-transform"></i>
                                        <span>Show</span>
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1.5 rounded-lg bg-rose-600/10 hover:bg-rose-600 text-rose-400 hover:text-white border border-rose-500/20 transition-all text-xs font-medium inline-flex items-center gap-1.5 group">
                                            <i class="fa-regular fa-trash-can group-hover:scale-110 transition-transform"></i>
                                            <span>Delete</span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-box-open text-4xl text-slate-600"></i>
                                    <p class="text-base font-medium">No Products Found</p>
                                    <p class="text-xs text-slate-500">No products exist in the database yet.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
