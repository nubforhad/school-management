@extends('admin.layouts.app')

@section('title', 'Edit Income Category')

@section('content')

<div class="mx-auto max-w-3xl space-y-6">

    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Edit Income Category
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Update income category information.
        </p>
    </div>

    <div class="rounded-xl border border-slate-200 bg-white p-6 shadow-sm">

        <form method="POST"
              action="{{ route('admin.income-categories.update', $incomeCategory) }}"
              class="space-y-5">

            @csrf
            @method('PUT')

            {{-- Branch --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Branch
                </label>

                <input
                    type="text"
                    value="{{ $branch->name }}"
                    readonly
                    class="w-full rounded-lg border border-slate-300 bg-slate-50 px-4 py-2.5 text-sm text-slate-600"
                >
            </div>

            {{-- Name --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Name <span class="text-red-500">*</span>
                </label>

                <input type="text" name="name" value="{{ old('name', $incomeCategory->name) }}" class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"  required>
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Name --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Category Title <span class="text-red-500">*</span>
                </label>
                <input type="text" name="title" value="{{ old('title', $incomeCategory->title) }}" class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"  required>
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Description
                </label>
                <textarea name="description" rows="4"  class="w-full rounded-lg border border-slate-300 px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $incomeCategory->description) }}</textarea>
                @error('description')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label class="mb-2 block text-sm font-semibold text-slate-700">
                    Status
                </label>

                <select name="status" class="w-full rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500">
                    <option value="1" {{ old('status', $incomeCategory->status) == 1 ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ old('status', $incomeCategory->status) == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>

                @error('status')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            {{-- Buttons --}}
            <div class="flex flex-col gap-3 pt-3 sm:flex-row">
                <button type="submit"  class="rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white hover:bg-blue-700">
                    Update Category
                </button>

                <a href="{{ route('admin.income-categories.index') }}" class="rounded-lg border border-slate-300 px-5 py-2.5 text-center text-sm font-semibold text-slate-700 hover:bg-slate-50">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>

@endsection