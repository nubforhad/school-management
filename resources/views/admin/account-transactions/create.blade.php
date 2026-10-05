@extends('admin.layouts.app')

@section('title', 'Add Account Transaction')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Add Account Transaction
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Record income or expense for the selected account
            </p>
        </div>

        <a
            href="{{ route('account-transactions.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            ← Back
        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <form
            action="{{ route('account-transactions.store') }}"
            method="POST"
            class="space-y-6 p-5 sm:p-6"
        >

            @csrf


            {{-- Account --}}
            <div>

                <label
                    for="account_id"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Account <span class="text-red-500">*</span>
                </label>

                <select
                    id="account_id"
                    name="account_id"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        Select Account
                    </option>

                    @foreach($accounts as $account)

                        <option
                            value="{{ $account->id }}"
                            @selected(old('account_id') == $account->id)
                        >
                            {{ $account->name }}

                            @if($account->account_number)
                                — {{ $account->account_number }}
                            @endif

                        </option>

                    @endforeach

                </select>

                <p class="mt-1 text-xs text-slate-500">
                    Select the cash, bank or mobile banking account.
                </p>

            </div>


            {{-- Date + Transaction Type --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Date --}}
                <div>

                    <label
                        for="transaction_date"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Transaction Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        id="transaction_date"
                        name="transaction_date"
                        value="{{ old('transaction_date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                    >

                </div>


                {{-- Transaction Type --}}
                <div>

                    <label
                        for="transaction_type"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Transaction Type <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="transaction_type"
                        name="transaction_type"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                    >

                        <option value="">
                            Select Type
                        </option>

                        <option
                            value="income"
                            @selected(old('transaction_type') === 'income')
                        >
                            Income
                        </option>

                        <option
                            value="expense"
                            @selected(old('transaction_type') === 'expense')
                        >
                            Expense
                        </option>

                    </select>

                </div>

            </div>


            {{-- Amount --}}
            <div>

                <label
                    for="amount"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Amount <span class="text-red-500">*</span>
                </label>

                <div class="relative">

                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-sm font-semibold text-slate-500">
                        ৳
                    </span>

                    <input
                        type="number"
                        id="amount"
                        name="amount"
                        value="{{ old('amount') }}"
                        min="0.01"
                        step="0.01"
                        required
                        placeholder="0.00"
                        class="w-full rounded-lg border border-slate-300 py-2.5 pl-8 pr-3 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                    >

                </div>

            </div>


            {{-- Description --}}
            <div>

                <label
                    for="description"
                    class="mb-2 block text-sm font-semibold text-slate-700"
                >
                    Description
                </label>

                <textarea
                    id="description"
                    name="description"
                    rows="4"
                    maxlength="5000"
                    placeholder="Write transaction details..."
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                >{{ old('description') }}</textarea>

            </div>


            {{-- Information --}}
            <div class="rounded-lg border border-blue-200 bg-blue-50 p-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 text-blue-600">
                        ℹ
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-blue-800">
                            Transaction Information
                        </p>

                        <p class="mt-1 text-xs leading-5 text-blue-700">
                            Income will increase the selected account balance.
                            Expense will decrease the selected account balance.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-100 pt-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('account-transactions.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700"
                >
                    Save Transaction
                </button>

            </div>

        </form>

    </div>

</div>

@endsection