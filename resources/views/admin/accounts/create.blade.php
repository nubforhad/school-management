@extends('admin.layouts.app')

@section('title', 'Create Account')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Create Account
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Add a new cash, bank or mobile banking account.
            </p>
        </div>

        <a href="{{ route('accounts.index') }}"
           class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
            Back to Accounts
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <div class="mb-2 text-sm font-semibold text-red-700">
                Please fix the following errors:
            </div>

            <ul class="list-inside list-disc space-y-1 text-sm text-red-600">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <form action="{{ route('accounts.store') }}"
          method="POST"
          class="space-y-6">

        @csrf


        {{-- Basic Information --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="text-base font-semibold text-slate-800">
                    Basic Information
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Select the company and branch for this account.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

                {{-- Company --}}
                <!-- <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Company <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="company_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            Select Company
                        </option>

                        @foreach($companies as $company)

                            <option
                                value="{{ $company->id }}"
                                @selected(old('company_id', auth()->user()->company_id) == $company->id)>
                                {{ $company->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('company_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div> -->


                {{-- Branch --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Branch <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="branch_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                @selected(old('branch_id', auth()->user()->branch_id) == $branch->id)>
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Account Name --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Account Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="255"
                        placeholder="e.g. Main Cash, DBBL Current Account"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    @error('name')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Account Type --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Account Type <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="account_type"
                        name="type"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            Select Type
                        </option>

                        <option value="cash" @selected(old('type') === 'cash')}>
                            Cash
                        </option>

                        <option value="bank" @selected(old('type') === 'bank')}>
                            Bank
                        </option>

                        <option value="mobile_banking" @selected(old('type') === 'mobile_banking')}>
                            Mobile Banking
                        </option>

                    </select>

                    @error('type')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Bank / Account Details --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="text-base font-semibold text-slate-800">
                    Account Details
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    These fields are mainly required for bank and mobile banking accounts.
                </p>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">

                {{-- Account Number --}}
                <div id="account_number_wrapper">

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Account Number
                    </label>

                    <input
                        type="text"
                        name="account_number"
                        value="{{ old('account_number') }}"
                        maxlength="100"
                        placeholder="Account / Wallet Number"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    @error('account_number')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Bank Name --}}
                <div id="bank_name_wrapper">

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Bank / Provider Name
                    </label>

                    <input
                        type="text"
                        name="bank_name"
                        value="{{ old('bank_name') }}"
                        maxlength="255"
                        placeholder="e.g. Dutch-Bangla Bank / bKash"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    @error('bank_name')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Opening Balance --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Opening Balance
                    </label>

                    <div class="relative">

                        <span class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-sm text-slate-500">
                            ৳
                        </span>

                        <input
                            type="number"
                            name="opening_balance"
                            value="{{ old('opening_balance', 0) }}"
                            min="0"
                            step="0.01"
                            class="w-full rounded-lg border border-slate-300 py-2.5 pl-8 pr-3 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

                    @error('opening_balance')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Opening Balance Date --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Opening Balance Date
                    </label>

                    <input
                        type="date"
                        name="opening_balance_date"
                        value="{{ old('opening_balance_date', now()->format('Y-m-d')) }}"
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    @error('opening_balance_date')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- Additional Information --}}
        <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="text-base font-semibold text-slate-800">
                    Additional Information
                </h2>

            </div>


            <div class="space-y-5 p-5">

                {{-- Description --}}
                <div>

                    <label class="mb-1.5 block text-sm font-medium text-slate-700">
                        Description
                    </label>

                    <textarea
                        name="description"
                        rows="4"
                        placeholder="Write any additional information..."
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('description') }}</textarea>

                    @error('description')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>

                    <label class="inline-flex cursor-pointer items-center gap-3">

                        <input
                            type="checkbox"
                            name="is_active"
                            value="1"
                            @checked(old('is_active', true))
                            class="h-4 w-4 rounded border-slate-300 text-blue-600 focus:ring-blue-500">

                        <span>
                            <span class="block text-sm font-medium text-slate-700">
                                Active Account
                            </span>

                            <span class="block text-xs text-slate-500">
                                Allow this account to be used for future transactions.
                            </span>
                        </span>

                    </label>

                </div>

            </div>

        </div>


        {{-- Actions --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('accounts.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                Cancel
            </a>

            <button
                type="submit"
                class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                Save Account

            </button>

        </div>

    </form>

</div>


{{-- Account Type Script --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const typeSelect = document.getElementById('account_type');

        const accountNumberWrapper =
            document.getElementById('account_number_wrapper');

        const bankNameWrapper =
            document.getElementById('bank_name_wrapper');


        function updateFields() {

            const type = typeSelect.value;

            if (type === 'cash') {

                accountNumberWrapper.classList.add('hidden');
                bankNameWrapper.classList.add('hidden');

            } else {

                accountNumberWrapper.classList.remove('hidden');
                bankNameWrapper.classList.remove('hidden');

            }
        }


        typeSelect.addEventListener('change', updateFields);

        updateFields();

    });
</script>

@endsection