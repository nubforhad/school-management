@extends('admin.layouts.app')

@section('title', 'Add Income Category')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Add Income Category
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create a new income category.
        </p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="POST" action="{{ route('admin.income-categories.store') }}" class="space-y-5">
            @csrf
            {{-- Branch --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Branch
                </label>
                <input type="text" value="{{ $branch->name }}" readonly class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-600">
            </div>
            {{-- Name --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Name <span class="text-red-500">*</span>
                </label>
                <input type="text" name="name" value="{{ old('name') }}" placeholder="Example: Admission Fee" class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            {{-- Title --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title') }}" placeholder="Example: Admission Fee" class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500" required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Description
                </label>
                <textarea name="description" rows="4" placeholder="Optional description..." class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description') }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>

                <select name="status" class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>
                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Buttons --}}
            <div class="flex flex-col gap-3 pt-3 sm:flex-row">
                <button type="submit" class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    Save Category
                </button>
                <a href="{{ route('admin.income-categories.index') }}" class="rounded-lg border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection