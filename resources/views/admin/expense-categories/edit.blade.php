@extends('admin.layouts.app')

@section('title', 'Edit Expense Category')

@section('content')

<div class="p-4 sm:p-6">
 
{{-- Header --}}
<div class="mb-6">
    <div class="flex items-center gap-3">

        <a href="{{ route('admin.expense-categories.index') }}"
           class="inline-flex items-center justify-center w-9 h-9
                  rounded-lg bg-slate-100 hover:bg-slate-200
                  text-slate-600 transition">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Edit Expense Category
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update expense category information.
            </p>
        </div>

    </div>
</div>

{{-- Validation Errors --}}
@if($errors->any())
    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 p-4">

        <div class="flex gap-3">
            <i class="bi bi-exclamation-triangle-fill text-red-600"></i>

            <div>
                <h3 class="text-sm font-semibold text-red-700">
                    Please fix the following errors:
                </h3>

                <ul class="mt-2 list-disc list-inside text-sm text-red-600">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>

    </div>
@endif

{{-- Form --}}
<div class="max-w-3xl bg-white border border-slate-200 rounded-xl">

    <form action="{{ route('admin.expense-categories.update', $expenseCategory) }}"
          method="POST">

        @csrf
        @method('PUT')

        <div class="p-5 sm:p-6 space-y-5">

            {{-- Name --}}
            <div>
                <label for="name"
                       class="block text-sm font-medium text-slate-700 mb-1.5">
                    Category Name <span class="text-red-500">*</span>
                </label>

                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $expenseCategory->name) }}"
                    required
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring-blue-500
                           @error('name') border-red-500 @enderror"
                >

                @error('name')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label for="description"
                       class="block text-sm font-medium text-slate-700 mb-1.5">
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring-blue-500
                           @error('description') border-red-500 @enderror"
                >{{ old('description', $expenseCategory->description) }}</textarea>

                @error('description')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

            {{-- Status --}}
            <div>
                <label for="status"
                       class="block text-sm font-medium text-slate-700 mb-1.5">
                    Status <span class="text-red-500">*</span>
                </label>

                <select
                    id="status"
                    name="status"
                    required
                    class="w-full rounded-lg border border-slate-300
                           px-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring-blue-500
                           @error('status') border-red-500 @enderror"
                >
                    <option value="1"
                        {{ old('status', $expenseCategory->status ? '1' : '0') == '1' ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0"
                        {{ old('status', $expenseCategory->status ? '1' : '0') == '0' ? 'selected' : '' }}>
                        Inactive
                    </option>
                </select>

                @error('status')
                    <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                @enderror
            </div>

        </div>

        {{-- Footer --}}
        <div class="px-5 sm:px-6 py-4 bg-slate-50 border-t border-slate-200
                    flex flex-col sm:flex-row sm:justify-end gap-3">

            <a href="{{ route('admin.expense-categories.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-2.5 rounded-lg bg-white border border-slate-300
                      text-slate-700 text-sm font-medium hover:bg-slate-50">
                Cancel
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg bg-blue-600
                           hover:bg-blue-700 text-white
                           text-sm font-medium transition">
                <i class="bi bi-check-lg"></i>
                Update Category
            </button>

        </div>

    </form>

</div> 

</div>
@endsection
