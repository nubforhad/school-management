@extends('admin.layouts.app')

@section('title', 'Create User')

@section('content')
<div class="mx-auto max-w-3xl space-y-6">

    <div>
        <a href="{{ route('admin.users.index') }}"
           class="text-sm font-medium text-blue-600 hover:underline">
            ← Back to Users
        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-800">Create User</h1>
        <p class="mt-1 text-sm text-slate-500">
            Create a new account and assign a role.
        </p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-7">
        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf
            <div>
            <label for="branch_id"
                class="mb-1.5 block text-sm font-medium text-slate-700">
                Branch <span class="text-red-500">*</span>
            </label>

            <select name="branch_id" id="branch_id" required
                    class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm">
                <option value="">Select Branch</option>

                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}"
                        @selected((string) old('branch_id', $user->branch_id ?? '') === (string) $branch->id)>
                        {{ $branch->name }}
                    </option>
                @endforeach
            </select>

            @error('branch_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

            <div>
                <label for="name" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Full Name <span class="text-red-500">*</span>
                </label>

                <input type="text" id="name" name="name"
                       value="{{ old('name') }}"
                       required maxlength="255"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                       placeholder="Enter full name">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="email" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Email Address <span class="text-red-500">*</span>
                </label>

                <input type="email" id="email" name="email"
                       value="{{ old('email') }}"
                       required maxlength="255"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                       placeholder="example@email.com">

                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Password <span class="text-red-500">*</span>
                </label>

                <input type="password" id="password" name="password"
                       required minlength="8" autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                       placeholder="Minimum 8 characters">

                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="password_confirmation" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Confirm Password <span class="text-red-500">*</span>
                </label>

                <input type="password" id="password_confirmation"
                       name="password_confirmation" required minlength="8"
                       autocomplete="new-password"
                       class="w-full rounded-lg border border-slate-200 px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                       placeholder="Enter password again">
            </div>

            <div>
                <label for="role" class="mb-1.5 block text-sm font-medium text-slate-700">
                    Assign Role <span class="text-red-500">*</span>
                </label>

                <select id="role" name="role" required
                        class="w-full rounded-lg border border-slate-200 bg-white px-3 py-2.5 text-sm outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">
                    <option value="">Select a role</option>

                    @foreach($roles as $role)
                        <option value="{{ $role->name }}"
                            @selected(old('role') === $role->name)>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>

                @error('role')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">
                <a href="{{ route('admin.users.index') }}"
                   class="rounded-lg border border-slate-200 px-5 py-2.5 text-center text-sm font-semibold text-slate-600 hover:bg-slate-50">
                    Cancel
                </a>

                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    Create User
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
