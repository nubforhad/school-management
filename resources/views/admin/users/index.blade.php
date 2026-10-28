@extends('admin.layouts.app')

@section('title', 'User Management')

@section('content')
<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">User Management</h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage system users and their assigned roles.
            </p>
        </div>

        <a href="{{ route('admin.users.create') }}"
           class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
            + Create User
        </a>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Message --}}
    @if(session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    {{-- Users Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50">
                    <tr>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">#</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">User</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Email</th>
                        <th class="px-5 py-3 text-left font-semibold text-slate-600">Role</th>
                        <th class="px-5 py-3 text-center font-semibold text-slate-600">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y divide-slate-100">
                    @forelse($users as $user)
                        <tr class="hover:bg-slate-50">
                            <td class="whitespace-nowrap px-5 py-4 text-slate-500">
                                {{ $users->firstItem() + $loop->index }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 font-medium text-slate-800">
                                {{ $user->name }}
                            </td>

                            <td class="whitespace-nowrap px-5 py-4 text-slate-600">
                                {{ $user->email }}
                            </td>

                            <td class="px-5 py-4">
                                <div class="flex flex-wrap gap-1">
                                    @forelse($user->getRoleNames() as $role)
                                        <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs font-medium text-blue-700">
                                            {{ $role }}
                                        </span>
                                    @empty
                                        <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-500">
                                            No role assigned
                                        </span>
                                    @endforelse
                                </div>
                            </td>

                            <td class="whitespace-nowrap px-5 py-4">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}"
                                       class="rounded-lg border border-slate-200 px-3 py-1.5 font-medium text-blue-600 hover:bg-blue-50">
                                        Edit
                                    </a>

                                    @if($user->id !== auth()->id())
                                        <form action="{{ route('admin.users.destroy', $user) }}"
                                              method="POST"
                                              onsubmit="return confirm('Are you sure you want to delete this user?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-lg border border-red-200 px-3 py-1.5 font-medium text-red-600 hover:bg-red-50">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-slate-500">
                                No users found.
                                <a href="{{ route('admin.users.create') }}"
                                   class="font-semibold text-blue-600 hover:underline">
                                    Create your first user
                                </a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($users->hasPages())
            <div class="border-t border-slate-200 px-5 py-4">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
