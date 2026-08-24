@extends('layout')

@section('title', 'Users Management')

@section('content')
<div class="space-y-6">
    <!-- Page Title & Stats -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 bg-slate-800/60 p-6 rounded-2xl border border-slate-700/50 backdrop-blur-sm">
        <div>
            <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                <i class="fa-solid fa-users text-indigo-400"></i>
                Users List
            </h1>
            <p class="text-sm text-slate-400 mt-1">Manage and view registered system users</p>
        </div>
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-500/10 border border-indigo-500/20 rounded-xl text-indigo-300 font-semibold text-sm w-fit">
            <span>Total Users:</span>
            <span class="bg-indigo-600 text-white px-2.5 py-0.5 rounded-lg text-xs">{{ count($users) }}</span>
        </div>
    </div>

    <!-- Table Card -->
    <div class="bg-slate-800/40 rounded-2xl border border-slate-700/50 overflow-hidden shadow-xl">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm text-slate-300">
                <thead class="bg-slate-800/80 text-xs uppercase tracking-wider text-slate-400 border-b border-slate-700/50">
                    <tr>
                        <th class="px-6 py-4"># ID</th>
                        <th class="px-6 py-4">Name</th>
                        <th class="px-6 py-4">Email</th>
                        <th class="px-6 py-4">Role</th>
                        <th class="px-6 py-4">Joined At</th>
                        <th class="px-6 py-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-700/40">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-700/30 transition-colors">
                            <td class="px-6 py-4 font-mono text-xs text-slate-400">#{{ $user->id }}</td>
                            <td class="px-6 py-4 font-medium text-white flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gradient-to-tr from-indigo-600 to-violet-600 flex items-center justify-center font-bold text-xs text-white uppercase">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                {{ $user->name }}
                            </td>
                            <td class="px-6 py-4 text-slate-300">{{ $user->email }}</td>
                            <td class="px-6 py-4">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-rose-500/10 text-rose-400 border border-rose-500/20">
                                        <i class="fa-solid fa-shield-halved mr-1.5"></i> Admin
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-semibold bg-sky-500/10 text-sky-400 border border-sky-500/20">
                                        <i class="fa-solid fa-user mr-1.5"></i> User
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-400 text-xs">
                                {{ $user->created_at ? $user->created_at->format('M d, Y H:i') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('users.show', $user->id) }}" class="px-3 py-1.5 rounded-lg bg-indigo-600/10 hover:bg-indigo-600 text-indigo-400 hover:text-white border border-indigo-500/20 transition-all text-xs font-medium inline-flex items-center gap-1.5 group">
                                        <i class="fa-regular fa-eye group-hover:scale-110 transition-transform"></i>
                                        <span>Show</span>
                                    </a>
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this user?');" class="inline">
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
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400">
                                <div class="flex flex-col items-center justify-center space-y-2">
                                    <i class="fa-solid fa-users-slash text-4xl text-slate-600"></i>
                                    <p class="text-base font-medium">No Users Found</p>
                                    <p class="text-xs text-slate-500">No users exist in the database yet.</p>
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
