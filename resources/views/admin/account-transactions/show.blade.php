@extends('admin.layouts.app')

@section('title', 'Transaction Details')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Transaction Details
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View complete account transaction information
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('account-transactions.index') }}"
                class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
            >
                ← Back
            </a>

            <a
                href="{{ route('accounts.ledger', $accountTransaction->account_id) }}"
                class="inline-flex items-center justify-center rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900"
            >
                View Ledger
            </a>

        </div>

    </div>


    {{-- Transaction Status Header --}}
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm sm:p-6">

        <div class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Transaction Type
                </p>

                <div class="mt-2 flex flex-wrap items-center gap-2">

                    @if($accountTransaction->transaction_type === 'income')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-sm font-semibold text-green-700">
                            Income
                        </span>

                    @elseif($accountTransaction->transaction_type === 'expense')

                        <span class="rounded-full bg-red-100 px-3 py-1 text-sm font-semibold text-red-700">
                            Expense
                        </span>

                    @else

                        <span class="rounded-full bg-purple-100 px-3 py-1 text-sm font-semibold text-purple-700">
                            Transfer
                        </span>

                    @endif


                    @if($accountTransaction->direction === 'credit')

                        <span class="rounded-full bg-green-50 px-3 py-1 text-sm font-semibold text-green-700">
                            Credit
                        </span>

                    @else

                        <span class="rounded-full bg-red-50 px-3 py-1 text-sm font-semibold text-red-700">
                            Debit
                        </span>

                    @endif

                </div>

            </div>


            {{-- Amount --}}
            <div class="sm:text-right">

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Amount
                </p>

                <p class="mt-1 text-3xl font-bold
                    {{ $accountTransaction->direction === 'credit'
                        ? 'text-green-600'
                        : 'text-red-600' }}">

                    {{ $accountTransaction->direction === 'credit' ? '+' : '-' }}
                    ৳ {{ number_format($accountTransaction->amount, 2) }}

                </p>

            </div>

        </div>

    </div>


    {{-- Main Information --}}
    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        {{-- Transaction Info --}}
        <div class="lg:col-span-2 rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Transaction Information
                </h2>

            </div>


            <div class="grid grid-cols-1 gap-x-8 gap-y-5 p-5 sm:grid-cols-2">

                {{-- Date --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Transaction Date
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $accountTransaction->transaction_date?->format('d M Y') ?? 'N/A' }}
                    </p>

                </div>


                {{-- Account --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $accountTransaction->account->name ?? 'N/A' }}
                    </p>

                    @if($accountTransaction->account?->account_number)

                        <p class="mt-1 text-xs text-slate-500">
                            {{ $accountTransaction->account->account_number }}
                        </p>

                    @endif

                </div>


                {{-- Transaction Type --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Transaction Type
                    </p>

                    <p class="mt-1 text-sm font-semibold capitalize text-slate-800">
                        {{ $accountTransaction->transaction_type }}
                    </p>

                </div>


                {{-- Direction --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Direction
                    </p>

                    <p class="mt-1 text-sm font-semibold capitalize text-slate-800">
                        {{ $accountTransaction->direction }}
                    </p>

                </div>


                {{-- Reference Type --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Reference Type
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $accountTransaction->reference_type ?: 'Manual Transaction' }}
                    </p>

                </div>


                {{-- Reference ID --}}
                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Reference ID
                    </p>

                    <p class="mt-1 text-sm text-slate-700">
                        {{ $accountTransaction->reference_id ?: '—' }}
                    </p>

                </div>


                {{-- Transfer Reference --}}
                <div class="sm:col-span-2">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Transfer Reference
                    </p>

                    <p class="mt-1 break-all text-sm font-semibold text-slate-700">
                        {{ $accountTransaction->transfer_reference ?: '—' }}
                    </p>

                </div>


                {{-- Description --}}
                <div class="sm:col-span-2">

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Description
                    </p>

                    <div class="mt-2 rounded-lg bg-slate-50 p-4">

                        <p class="whitespace-pre-line text-sm leading-6 text-slate-700">
                            {{ $accountTransaction->description ?: 'No description provided.' }}
                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- Account Summary --}}
        <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="text-base font-bold text-slate-800">
                    Account
                </h2>

            </div>


            <div class="space-y-5 p-5">

                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Name
                    </p>

                    <p class="mt-1 text-sm font-bold text-slate-800">
                        {{ $accountTransaction->account->name ?? 'N/A' }}
                    </p>

                </div>


                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Account Type
                    </p>

                    <p class="mt-1 text-sm capitalize text-slate-700">
                        {{ str_replace('_', ' ', $accountTransaction->account->type ?? 'N/A') }}
                    </p>

                </div>


                @if($accountTransaction->account?->account_number)

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Account Number
                        </p>

                        <p class="mt-1 break-all text-sm text-slate-700">
                            {{ $accountTransaction->account->account_number }}
                        </p>

                    </div>

                @endif


                @if($accountTransaction->account?->bank_name)

                    <div>

                        <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                            Bank / Provider
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $accountTransaction->account->bank_name }}
                        </p>

                    </div>

                @endif


                <div>

                    <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                        Opening Balance
                    </p>

                    <p class="mt-1 text-sm font-bold text-slate-800">
                        ৳ {{ number_format($accountTransaction->account->opening_balance ?? 0, 2) }}
                    </p>

                </div>


                <a
                    href="{{ route('accounts.ledger', $accountTransaction->account_id) }}"
                    class="block rounded-lg bg-blue-50 px-4 py-3 text-center text-sm font-semibold text-blue-700 transition hover:bg-blue-100"
                >
                    View Account Ledger
                </a>

            </div>

        </div>

    </div>


    {{-- Created Information --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="text-base font-bold text-slate-800">
                System Information
            </h2>

        </div>


        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-3">

            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Created By
                </p>

                <p class="mt-1 text-sm font-semibold text-slate-700">
                    {{ $accountTransaction->creator->name ?? 'System' }}
                </p>

            </div>


            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Created At
                </p>

                <p class="mt-1 text-sm text-slate-700">
                    {{ $accountTransaction->created_at?->format('d M Y h:i A') }}
                </p>

            </div>


            <div>

                <p class="text-xs font-semibold uppercase tracking-wider text-slate-400">
                    Last Updated
                </p>

                <p class="mt-1 text-sm text-slate-700">
                    {{ $accountTransaction->updated_at?->format('d M Y h:i A') }}
                </p>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex flex-col gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('account-transactions.index') }}"
            class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
        >
            Back to Transactions
        </a>


        @if(!$accountTransaction->reference_type)

            <form
                method="POST"
                action="{{ route('account-transactions.destroy', $accountTransaction) }}"
                onsubmit="return confirm('Are you sure you want to delete this transaction?')"
            >

                @csrf
                @method('DELETE')

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-lg bg-red-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-red-700 sm:w-auto"
                >
                    Delete Transaction
                </button>

            </form>

        @endif

    </div>

</div>

@endsection