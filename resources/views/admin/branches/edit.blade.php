@extends('admin.layouts.app')

@section('title', 'Edit Branch')
@section('page-title', 'Edit Branch')

@section('content')

<div class="mx-auto max-w-4xl">

    <div class="mb-6">

        <a
            href="{{ route('admin.branches.index') }}"
            class="text-sm text-blue-600 hover:text-blue-700">

            ← Back to Branches

        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900">
            Edit Branch
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Update branch information.
        </p>

    </div>


    <form
        action="{{ route('admin.branches.update', $branch) }}"
        method="POST"
        enctype="multipart/form-data"
        class="rounded-xl border border-slate-200 bg-white shadow-sm">

        @csrf
        @method('PUT')


        <div class="grid gap-5 p-5 sm:grid-cols-2 sm:p-6">


            <div class="sm:col-span-2">

                <label class="mb-2 block text-sm font-medium">
                    Branch Name <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="name"
                    value="{{ old('name', $branch->name) }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm focus:border-blue-500 focus:ring-4
                           focus:ring-blue-500/10">

            </div>


            <div>

                <label class="mb-2 block text-sm font-medium">
                    Branch Code <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    name="code"
                    value="{{ old('code', $branch->code) }}"
                    required
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm uppercase focus:border-blue-500
                           focus:ring-4 focus:ring-blue-500/10">

            </div>


            <div>

                <label class="mb-2 block text-sm font-medium">
                    Phone
                </label>

                <input
                    type="text"
                    name="phone"
                    value="{{ old('phone', $branch->phone) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm focus:border-blue-500 focus:ring-4
                           focus:ring-blue-500/10">

            </div>


            <div>

                <label class="mb-2 block text-sm font-medium">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    value="{{ old('email', $branch->email) }}"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm focus:border-blue-500 focus:ring-4
                           focus:ring-blue-500/10">

            </div>


            <div>

                <label class="mb-2 block text-sm font-medium">
                    Logo
                </label>

                <input
                    type="file"
                    name="logo"
                    accept="image/*"
                    class="block w-full rounded-lg border border-slate-300
                           text-sm">

                @if($branch->logo)

                    <img
                        src="{{ asset('storage/'.$branch->logo) }}"
                        class="mt-3 h-16 w-16 rounded-lg object-cover">

                @endif

            </div>


            <div class="sm:col-span-2">

                <label class="mb-2 block text-sm font-medium">
                    Address
                </label>

                <textarea
                    name="address"
                    rows="3"
                    class="w-full rounded-lg border border-slate-300 px-4 py-2.5
                           text-sm focus:border-blue-500 focus:ring-4
                           focus:ring-blue-500/10">{{ old('address', $branch->address) }}</textarea>

            </div>


            <div class="sm:col-span-2">

                <label class="inline-flex items-center gap-3">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        {{ $branch->status ? 'checked' : '' }}
                        class="h-4 w-4 rounded border-slate-300 text-blue-600">

                    <span class="text-sm font-medium">
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
                       text-center text-sm font-medium">

                Cancel

            </a>


            <button
                type="submit"
                class="rounded-lg bg-blue-600 px-5 py-2.5
                       text-sm font-medium text-white hover:bg-blue-700">

                Update Branch

            </button>

        </div>

    </form>

</div>

@endsection