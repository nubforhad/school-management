@extends('admin.layouts.app')

@section('title', 'Add Branch')
@section('page-title', 'Add Branch')

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-6">

        <a
            href="{{ route('admin.branches.index') }}"
            class="text-sm text-blue-600 hover:text-blue-700">

            ← Back to Branches

        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900">
            Add New Branch
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create a new branch for your institution.
        </p>

    </div>


    <form
        action="{{ route('admin.branches.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-xl border border-slate-200 bg-white shadow-sm">

        @csrf


        <div class="border-b border-slate-200 p-5 sm:p-6">

            <h2 class="font-semibold text-slate-800">
                Branch Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Enter the basic information of the branch.
            </p>

        </div>


        <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">


            {{-- Name --}}

            <div class="sm:col-span-2">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Branch Name <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    required
                    placeholder="Enter branch name"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm outline-none
                           focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

            </div>


            {{-- Code --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Branch Code <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ old('code') }}"
                    required
                    placeholder="e.g. BR-001"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm uppercase outline-none
                           focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

                @error('code')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror

            </div>


            {{-- Phone --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone') }}"
                    placeholder="01XXXXXXXXX"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm outline-none
                           focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

            </div>


            {{-- Email --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    placeholder="branch@example.com"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm outline-none
                           focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">

            </div>


            {{-- Logo --}}

            <div>

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Branch Logo
                </label>

                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    class="block w-full rounded-lg border border-slate-300
                           bg-white text-sm text-slate-600
                           file:mr-4 file:border-0 file:bg-slate-100
                           file:px-4 file:py-2.5 file:text-sm">

                <p class="mt-1 text-xs text-slate-500">
                    JPG, PNG, WEBP — Maximum 2MB
                </p>

            </div>


            {{-- Address --}}

            <div class="sm:col-span-2">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    placeholder="Enter branch address"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm outline-none
                           focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10">{{ old('address') }}</textarea>

            </div>


            {{-- Status --}}

            <div class="sm:col-span-2">

                <label class="inline-flex cursor-pointer items-center gap-3">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        checked
                        class="h-4 w-4 rounded border-slate-300 text-blue-600">

                    <span class="text-sm font-medium text-slate-700">
                        Active Branch
                    </span>

                </label>

            </div>

        </div>


        <div class="flex flex-col-reverse gap-3 border-t border-slate-200
                    bg-slate-50 p-5 sm:flex-row sm:justify-end sm:p-6">

            <a
                href="{{ route('admin.branches.index') }}"
                class="rounded-lg border border-slate-300 bg-white px-5 py-2.5
                       text-center text-sm font-medium text-slate-700
                       hover:bg-slate-50">

                Cancel

            </a>


            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5
                       text-sm font-medium text-white
                       hover:bg-blue-700">

                Create Branch

            </button>

        </div>

    </form>

</div>

@endsection