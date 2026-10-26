@extends('admin.layouts.app')

@section('content')
<div class="mx-auto max-w-3xl space-y-5 p-4 md:p-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">Assign User Roles</h1>
        <p class="mt-1 text-sm text-slate-500">
            {{ $user->name }} — {{ $user->email }}
        </p>
        <p class="text-sm text-slate-500">
            Branch: {{ $user->branch?->name ?? '—' }}
        </p>
    </div>

    @if($errors->any())
        <div class="rounded-lg border border-red-200 bg-red-50 p-3 text-red-700">
            <ul class="list-inside list-disc">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.user-roles.update', $user) }}"
          method="POST" class="space-y-5">
        @csrf
        @method('PUT')

        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <h2 class="mb-4 font-semibold text-slate-800">Select Roles</h2>

            <div class="space-y-3">
                @forelse($roles as $role)
                    <label class="flex cursor-pointer items-start gap-3 rounded-lg border border-slate-200 p-3 hover:bg-slate-50">
                        <input type="checkbox"
                               name="roles[]"
                               value="{{ $role->id }}"
                               class="mt-1 rounded border-slate-300 text-blue-600"
                               @checked(in_array(
                                   $role->id,
                                   old('roles', $selectedRoles)
                               ))>

                        <span>
                            <span class="block font-medium text-slate-800">
                                {{ $role->name }}
                            </span>
                            <span class="text-xs text-slate-500">
                                {{ $role->permissions_count ?? $role->permissions()->count() }}
                                permissions
                            </span>
                        </span>
                    </label>
                @empty
                    <p class="text-sm text-slate-500">No roles available.</p>
                @endforelse
            </div>

            @error('roles')
                <p class="mt-3 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="flex gap-3">
            <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700">
                Save Roles
            </button>

            <a href="{{ route('admin.user-roles.index') }}"
               class="rounded-lg border border-slate-300 px-5 py-2.5 text-slate-700">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection