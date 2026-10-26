
@extends('admin.layouts.app')

@section('content')
<div class="space-y-5 p-4 md:p-6">

    <div class="flex flex-wrap items-center justify-between gap-3">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Role Management</h1>
            <p class="mt-1 text-sm text-slate-500">
                Manage system roles and permissions.
            </p>
        </div>

        @can('roles.create')
            <a href="{{ route('admin.roles.create') }}"
               class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">
                + Create Role
            </a>
        @endcan
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Role Name</th>
                    <th class="p-3">Permissions</th>
                    <th class="p-3">Users</th>
                    <th class="p-3 text-right">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($roles as $role)
                    <tr>
                        <td class="p-3">
                            {{ $roles->firstItem() + $loop->index }}
                        </td>

                        <td class="p-3 font-medium text-slate-800">
                            {{ $role->name }}
                        </td>

                        <td class="p-3">
                            <span class="rounded-full bg-blue-50 px-3 py-1 text-blue-700">
                                {{ $role->permissions_count }}
                            </span>
                        </td>

                        <td class="p-3">
                            {{ $role->users_count }}
                        </td>

                        <td class="p-3">
                            <div class="flex justify-end gap-2">
                                @can('roles.edit')
                                    <a href="{{ route('admin.roles.edit', $role) }}"
                                       class="rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">
                                        Edit
                                    </a>
                                @endcan

                                @can('roles.delete')
                                    @if($role->name !== 'Super Admin')
                                        <form action="{{ route('admin.roles.destroy', $role) }}"
                                              method="POST"
                                              onsubmit="return confirm('Delete this role?')">
                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="rounded-md bg-red-50 px-3 py-1.5 text-red-700 hover:bg-red-100">
                                                Delete
                                            </button>
                                        </form>
                                    @endif
                                @endcan
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="p-8 text-center text-slate-500">
                            No roles found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $roles->links() }}
</div>
@endsection
