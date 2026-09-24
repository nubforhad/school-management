@extends('admin.layouts.app')

@section('title', 'Add Expense')
 

@section('content')

<div class="p-4 sm:p-6">
 
{{-- Header --}}
<div class="mb-6">

    <div class="flex items-center gap-3">

        <a href="{{ route('admin.expenses.index') }}"
           class="inline-flex items-center justify-center w-9 h-9
                  rounded-lg bg-slate-100 hover:bg-slate-200
                  text-slate-600">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Add Expense
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Record a new branch expense.
            </p>
        </div>

    </div>

</div>

{{-- Errors --}}
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

<div class="max-w-4xl bg-white border border-slate-200 rounded-xl">

    <form action="{{ route('admin.expenses.store') }}"
          method="POST">

        @csrf

        <div class="p-5 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Category --}}
                <div>
                    <label for="expense_category_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Expense Category <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="expense_category_id"
                        name="expense_category_id"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               @error('expense_category_id') border-red-500 @enderror">

                        <option value="">Select Category</option>

                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('expense_category_id') == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('expense_category_id')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Date --}}
                <div>
                    <label for="expense_date"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Expense Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        id="expense_date"
                        name="expense_date"
                        value="{{ old('expense_date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               @error('expense_date') border-red-500 @enderror">

                    @error('expense_date')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Amount --}}
                <div>
                    <label for="amount"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Amount <span class="text-red-500">*</span>
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-1/2 -translate-y-1/2
                                     text-slate-500 text-sm">
                            ৳
                        </span>

                        <input
                            type="number"
                            step="0.01"
                            min="0.01"
                            id="amount"
                            name="amount"
                            value="{{ old('amount') }}"
                            required
                            placeholder="0.00"
                            class="w-full rounded-lg border border-slate-300
                                   pl-8 pr-4 py-2.5 text-sm
                                   focus:border-blue-500 focus:ring-blue-500
                                   @error('amount') border-red-500 @enderror">
                    </div>

                    @error('amount')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Payment Method --}}
                <div>
                    <label for="payment_method"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Payment Method <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="payment_method"
                        name="payment_method"
                        required
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               @error('payment_method') border-red-500 @enderror">

                        <option value="">Select Method</option>

                        <option value="cash" {{ old('payment_method') == 'cash' ? 'selected' : '' }}>
                            Cash
                        </option>

                        <option value="bank" {{ old('payment_method') == 'bank' ? 'selected' : '' }}>
                            Bank
                        </option>

                        <option value="mobile_banking" {{ old('payment_method') == 'mobile_banking' ? 'selected' : '' }}>
                            Mobile Banking
                        </option>

                        <option value="cheque" {{ old('payment_method') == 'cheque' ? 'selected' : '' }}>
                            Cheque
                        </option>

                        <option value="other" {{ old('payment_method') == 'other' ? 'selected' : '' }}>
                            Other
                        </option>

                    </select>

                    @error('payment_method')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Reference --}}
                <div class="md:col-span-2">
                    <label for="reference_no"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Reference / Invoice No.
                    </label>

                    <input
                        type="text"
                        id="reference_no"
                        name="reference_no"
                        value="{{ old('reference_no') }}"
                        placeholder="e.g. INV-1001"
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               @error('reference_no') border-red-500 @enderror">

                    @error('reference_no')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="md:col-span-2">
                    <label for="description"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Description
                    </label>

                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        placeholder="Enter expense details..."
                        class="w-full rounded-lg border border-slate-300
                               px-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500
                               @error('description') border-red-500 @enderror"
                    >{{ old('description') }}</textarea>

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
                               focus:border-blue-500 focus:ring-blue-500">

                        <option value="1" {{ old('status', '1') == '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0" {{ old('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

            </div>

        </div>

        {{-- Footer --}}
        <div class="px-5 sm:px-6 py-4 bg-slate-50 border-t border-slate-200
                    flex flex-col sm:flex-row sm:justify-end gap-3">

            <a href="{{ route('admin.expenses.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-2.5 rounded-lg bg-white border border-slate-300
                      text-slate-700 text-sm font-medium hover:bg-slate-50">
                Cancel
            </a>

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg bg-blue-600
                           hover:bg-blue-700 text-white
                           text-sm font-medium">
                <i class="bi bi-check-lg"></i>
                Save Expense
            </button>

        </div>

    </form>

</div> 

</div>
@endsection
