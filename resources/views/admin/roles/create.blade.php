
@extends('admin.layouts.app')

@section('content')
<div class="space-y-5 p-4 md:p-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">Create Role</h1>
        <p class="mt-1 text-sm text-slate-500">
            Create a role and select its permissions.
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

    <form action="{{ route('admin.roles.store') }}" method="POST"
          class="space-y-5">
        @csrf

        <div class="rounded-xl border border-slate-200 bg-white p-5">
            <label for="name" class="mb-2 block text-sm font-medium text-slate-700">
                Role Name <span class="text-red-500">*</span>
            </label>

            <input type="text" id="name" name="name"
                   value="{{ old('name') }}"
                   placeholder="Example: Library Manager"
                   maxlength="100" required
                   class="w-full rounded-lg border border-slate-300 px-3 py-2 focus:border-blue-500 focus:outline-none">

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="rounded-xl border border-slate-200 bg-white">
            <div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-200 bg-slate-50 p-4">
                <div>
                    <h2 class="font-semibold text-slate-800">Assign Permissions</h2>
                    <p class="text-sm text-slate-500">
                        Select the required permissions for this role.
                    </p>
                </div>

                <div class="flex gap-2">
                    <button type="button"
                            onclick="document.querySelectorAll('.permission-checkbox').forEach(el => el.checked = true)"
                            class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                        Select All
                    </button>

                    <button type="button"
                            onclick="document.querySelectorAll('.permission-checkbox').forEach(el => el.checked = false)"
                            class="rounded-md border border-slate-300 bg-white px-3 py-2 text-sm">
                        Clear All
                    </button>
                </div>
            </div>

            <div class="space-y-4 p-4">
                @forelse($permissions as $module => $modulePermissions)
                    <div class="overflow-hidden rounded-lg border border-slate-200">
                        <div class="flex items-center justify-between bg-slate-50 px-4 py-3">
                            <h3 class="font-semibold capitalize text-slate-800">
                                {{ str_replace('-', ' ', $module) }}
                            </h3>

                            <button type="button"
                                    onclick="this.closest('.module-box').querySelectorAll('.permission-checkbox').forEach(el => el.checked = true)"
                                    class="text-sm text-blue-600 hover:underline">
                                Select Module
                            </button>
                        </div>

                        <div class="module-box grid grid-cols-2 gap-3 p-4 sm:grid-cols-3 lg:grid-cols-4">
                            @foreach($modulePermissions as $permission)
                                <label class="flex items-center gap-2 text-sm text-slate-700">
                                    <input type="checkbox"
                                           name="permissions[]"
                                           value="{{ $permission->id }}"
                                           class="permission-checkbox rounded border-slate-300 text-blue-600"
                                           @checked(in_array(
                                               $permission->id,
                                               old('permissions', [])
                                           ))>

                                    {{ \Illuminate\Support\Str::after($permission->name, '.') }}
                                </label>
                            @endforeach
                        </div>
                    </div>
                @empty
                    <p class="text-sm text-slate-500">
                        No permissions found. Check your permission records.
                    </p>
                @endforelse
            </div>
        </div>

        <div class="flex flex-wrap gap-3">
            <button type="submit"
                    class="rounded-lg bg-blue-600 px-5 py-2.5 text-white hover:bg-blue-700">
                Save Role
            </button>

            <a href="{{ route('admin.roles.index') }}"
               class="rounded-lg border border-slate-300 px-5 py-2.5 text-slate-700">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
