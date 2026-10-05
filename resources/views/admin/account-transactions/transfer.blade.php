@extends('admin.layouts.app')

@section('title', 'Transfer Money')

@section('content')

<div class="mx-auto max-w-4xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Transfer Money
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Transfer money from one account to another account
            </p>
        </div>

        <a
            href="{{ route('account-transactions.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            ← Back
        </a>

    </div>


    {{-- Error Message --}}
    @if(session('error'))

        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>

    @endif


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
            action="{{ route('account-transactions.transfer') }}"
            method="POST"
            class="space-y-6 p-5 sm:p-6"
        >

            @csrf


            {{-- Account Selection --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- From Account --}}
                <div>

                    <label
                        for="from_account_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        From Account <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="from_account_id"
                        name="from_account_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-red-500 focus:ring-red-500"
                    >

                        <option value="">
                            Select Source Account
                        </option>

                        @foreach($accounts as $account)

                            <option
                                value="{{ $account->id }}"
                                @selected(old('from_account_id') == $account->id)
                            >
                                {{ $account->name }}

                                @if($account->account_number)
                                    — {{ $account->account_number }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    <p class="mt-1 text-xs text-slate-500">
                        Money will be deducted from this account.
                    </p>

                </div>


                {{-- To Account --}}
                <div>

                    <label
                        for="to_account_id"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        To Account <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="to_account_id"
                        name="to_account_id"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 focus:border-green-500 focus:ring-green-500"
                    >

                        <option value="">
                            Select Destination Account
                        </option>

                        @foreach($accounts as $account)

                            <option
                                value="{{ $account->id }}"
                                @selected(old('to_account_id') == $account->id)
                            >
                                {{ $account->name }}

                                @if($account->account_number)
                                    — {{ $account->account_number }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    <p class="mt-1 text-xs text-slate-500">
                        Money will be added to this account.
                    </p>

                </div>

            </div>


            {{-- Transfer Direction Visual --}}
            <div class="flex items-center justify-center">

                <div class="flex w-full max-w-md items-center justify-center gap-3 rounded-xl border border-slate-200 bg-slate-50 px-4 py-4">

                    <div class="rounded-lg bg-red-100 px-3 py-2 text-sm font-semibold text-red-700">
                        From
                    </div>

                    <div class="text-xl text-slate-400">
                        →
                    </div>

                    <div class="rounded-lg bg-green-100 px-3 py-2 text-sm font-semibold text-green-700">
                        To
                    </div>

                </div>

            </div>


            {{-- Date + Amount --}}
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                {{-- Date --}}
                <div>

                    <label
                        for="transaction_date"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Transfer Date <span class="text-red-500">*</span>
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


                {{-- Amount --}}
                <div>

                    <label
                        for="amount"
                        class="mb-2 block text-sm font-semibold text-slate-700"
                    >
                        Transfer Amount <span class="text-red-500">*</span>
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
                    placeholder="Example: Transfer money from bank to office cash..."
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm text-slate-700 focus:border-blue-500 focus:ring-blue-500"
                >{{ old('description') }}</textarea>

            </div>


            {{-- Important Information --}}
            <div class="rounded-xl border border-amber-200 bg-amber-50 p-4">

                <div class="flex gap-3">

                    <div class="mt-0.5 text-amber-600">
                        ⚠
                    </div>

                    <div>

                        <p class="text-sm font-semibold text-amber-800">
                            Transfer Information
                        </p>

                        <ul class="mt-2 space-y-1 text-xs leading-5 text-amber-700">

                            <li>
                                • Money will be deducted from the From Account.
                            </li>

                            <li>
                                • Money will be added to the To Account.
                            </li>

                            <li>
                                • Both transactions will use the same transfer reference.
                            </li>

                            <li>
                                • The source account must have sufficient balance.
                            </li>

                            <li>
                                • From and To accounts must be different.
                            </li>

                        </ul>

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
                    class="inline-flex items-center justify-center rounded-lg bg-purple-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700"
                >
                    Transfer Money
                </button>

            </div>

        </form>

    </div>

</div>

@endsection