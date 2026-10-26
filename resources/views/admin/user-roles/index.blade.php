@extends('admin.layouts.app')

@section('content')
<div class="space-y-5 p-4 md:p-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">User Role Assignment</h1>
        <p class="mt-1 text-sm text-slate-500">
            Assign roles to users.
        </p>
    </div>

    @if(session('success'))
        <div class="rounded-lg border border-green-200 bg-green-50 p-3 text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto rounded-xl border border-slate-200 bg-white">
        <table class="w-full text-left text-sm">
            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="p-3">#</th>
                    <th class="p-3">Name</th>
                    <th class="p-3">Email</th>
                    <th class="p-3">Branch</th>
                    <th class="p-3">Roles</th>
                    <th class="p-3 text-right">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">
                @forelse($users as $user)
                    <tr>
                        <td class="p-3">
                            {{ $users->firstItem() + $loop->index }}
                        </td>

                        <td class="p-3 font-medium text-slate-800">
                            {{ $user->name }}
                        </td>

                        <td class="p-3">{{ $user->email }}</td>

                        <td class="p-3">
                            {{ $user->branch?->name ?? '—' }}
                        </td>

                        <td class="p-3">
                            <div class="flex flex-wrap gap-1">
                                @forelse($user->roles as $role)
                                    <span class="rounded-full bg-blue-50 px-2.5 py-1 text-xs text-blue-700">
                                        {{ $role->name }}
                                    </span>
                                @empty
                                    <span class="text-slate-400">No role assigned</span>
                                @endforelse
                            </div>
                        </td>

                        <td class="p-3 text-right">
                            <a href="{{ route('admin.user-roles.edit', $user) }}"
                               class="inline-block rounded-md border border-slate-200 px-3 py-1.5 hover:bg-slate-50">
                                Assign Role
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="p-8 text-center text-slate-500">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{ $users->links() }}
</div>
@endsection