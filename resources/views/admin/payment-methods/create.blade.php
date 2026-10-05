@extends('admin.layouts.app')

@section('title', 'Add Payment Method')

@section('content')

<div class="mx-auto max-w-3xl">

    <div class="mb-6">
        <h1 class="text-2xl font-bold text-slate-800">
            Add Payment Method
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create a payment method for your branch.
        </p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="POST"
              action="{{ route('admin.payment-methods.store') }}"
              class="space-y-5">

            @csrf

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Branch
                </label>

                <input type="text"
                       value="{{ $branch->name }}"
                       readonly
                       class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm">
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Payment Method Name <span class="text-red-500">*</span>
                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="Example: Cash"
                       required
                       class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm">

                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Description
                </label>

                <textarea name="description"
                          rows="4"
                          class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm">{{ old('description') }}</textarea>
            </div>

            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>

                <select name="status"
                        class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm">

                    <option value="1">Active</option>
                    <option value="0">Inactive</option>

                </select>
            </div>

            <div class="flex flex-col gap-3 sm:flex-row">

                <button type="submit"
                        class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    Save Payment Method
                </button>

                <a href="{{ route('admin.payment-methods.index') }}"
                   class="rounded-lg border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-700">
                    Cancel
                </a>

            </div>

        </form>

    </div>

</div>

@endsection