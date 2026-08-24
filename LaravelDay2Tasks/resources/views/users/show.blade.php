@extends('layout')

@section('title', 'User Details - ' . $user->name)

@section('content')
<div class="space-y-6 max-w-5xl mx-auto">
    <!-- Top Action Bar -->
    <div class="flex items-center justify-between">
        <a href="{{ route('users.index') }}" class="px-4 py-2 bg-slate-800 hover:bg-slate-700 text-slate-300 hover:text-white rounded-xl border border-slate-700 transition-all text-sm inline-flex items-center gap-2">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Back to Users</span>
        </a>

        <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 bg-rose-600/10 hover:bg-rose-600 text-rose-400 hover:text-white rounded-xl border border-rose-500/20 transition-all text-sm font-medium inline-flex items-center gap-2">
                <i class="fa-regular fa-trash-can"></i>
                <span>Delete User</span>
            </button>
        </form>
    </div>

    <!-- User Profile Card -->
    <div class="bg-slate-800/50 rounded-2xl border border-slate-700/50 p-6 md:p-8 backdrop-blur-sm shadow-xl space-y-6">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 border-b border-slate-700/50 pb-6">
            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-tr from-indigo-600 to-purple-600 flex items-center justify-center font-bold text-2xl text-white shadow-lg shadow-indigo-500/20">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $user->name }}</h1>
                    <p class="text-sm text-slate-400 mt-0.5">{{ $user->email }}</p>
                </div>
            </div>
            <div>
                @if($user->role === 'admin')
                    <span class="px-4 py-1.5 rounded-xl text-sm font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20 inline-flex items-center gap-2">
                        <i class="fa-solid fa-shield-halved"></i> Admin Account
                    </span>
                @else
                    <span class="px-4 py-1.5 rounded-xl text-sm font-semibold bg-sky-500/10 text-sky-400 border border-sky-500/20 inline-flex items-center gap-2">
                        <i class="fa-solid fa-user"></i> Standard User
                    </span>
                @endif
            </div>
        </div>

        <!-- Details Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">User ID</span>
                <span class="text-lg font-bold text-white font-mono mt-1 block">#{{ $user->id }}</span>
            </div>
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">Account Created</span>
                <span class="text-sm font-semibold text-slate-200 mt-1 block">
                    {{ $user->created_at ? $user->created_at->format('F d, Y \a\t H:i') : 'N/A' }}
                </span>
            </div>
            <div class="bg-slate-900/60 p-4 rounded-xl border border-slate-800">
                <span class="text-xs text-slate-400 font-medium uppercase tracking-wider block">Total Orders</span>
                <span class="text-lg font-bold text-indigo-400 mt-1 block">{{ $user->orders->count() }} Orders</span>
            </div>
        </div>

        <!-- Orders Table Section -->
        <div class="pt-4">
            <h2 class="text-lg font-bold text-white mb-4 flex items-center gap-2">
                <i class="fa-solid fa-cart-shopping text-indigo-400"></i>
                User Orders
            </h2>
            @if($user->orders->count() > 0)
                <div class="bg-slate-900/40 rounded-xl border border-slate-800 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm text-slate-300">
                            <thead class="bg-slate-800/80 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/50">
                                <tr>
                                    <th class="px-6 py-3">Order ID</th>
                                    <th class="px-6 py-3">Date</th>
                                    <th class="px-6 py-3">Items</th>
                                    <th class="px-6 py-3">Total Price</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-700/40">
                                @foreach($user->orders as $order)
                                    <tr class="hover:bg-slate-700/20 transition-colors">
                                        <td class="px-6 py-3 font-mono text-xs text-slate-300 font-bold">#{{ $order->id }}</td>
                                        <td class="px-6 py-3 text-slate-400 text-xs">
                                            {{ $order->created_at ? $order->created_at->format('M d, Y H:i') : 'N/A' }}
                                        </td>
                                        <td class="px-6 py-3">
                                            <span class="px-2.5 py-1 bg-indigo-500/10 text-indigo-300 border border-indigo-500/20 text-xs rounded-lg font-medium">
                                                {{ $order->orderItems->count() }} Items
                                            </span>
                                        </td>
                                        <td class="px-6 py-3 font-semibold text-emerald-400">
                                            ${{ number_format($order->orderItems->sum(fn($item) => $item->price * $item->quantity), 2) }}
                                        </td>
                                    </tr>
                                    <!-- Order Items Sub-table -->
                                    @if($order->orderItems->count() > 0)
                                        <tr>
                                            <td colspan="4" class="px-6 py-0 pb-4">
                                                <div class="ml-6 bg-slate-800/60 rounded-lg border border-slate-700/40 overflow-hidden mt-1">
                                                    <table class="w-full text-left text-xs text-slate-400">
                                                        <thead class="bg-slate-800/50 text-[10px] uppercase tracking-wider text-slate-500">
                                                            <tr>
                                                                <th class="px-4 py-2">Product</th>
                                                                <th class="px-4 py-2">Qty</th>
                                                                <th class="px-4 py-2">Unit Price</th>
                                                                <th class="px-4 py-2">Subtotal</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="divide-y divide-slate-700/30">
                                                            @foreach($order->orderItems as $item)
                                                                <tr class="hover:bg-slate-700/20">
                                                                    <td class="px-4 py-2 text-slate-300 font-medium">
                                                                        {{ $item->product->name ?? 'Deleted Product' }}
                                                                    </td>
                                                                    <td class="px-4 py-2">{{ $item->quantity }}</td>
                                                                    <td class="px-4 py-2">${{ number_format($item->price, 2) }}</td>
                                                                    <td class="px-4 py-2 text-emerald-400 font-semibold">
                                                                        ${{ number_format($item->price * $item->quantity, 2) }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-sm text-slate-500 italic bg-slate-900/30 p-4 rounded-xl border border-slate-800/50">No orders placed by this user yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection
