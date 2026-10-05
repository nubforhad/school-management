@extends('admin.layouts.app')

@section('title', 'Account Transactions')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Account Transactions
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage income, expense and account transfers
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a href="{{ route('account-transactions.transfer.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-purple-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-purple-700">
                Transfer Money
            </a>

            <a href="{{ route('account-transactions.create') }}"
               class="inline-flex items-center justify-center rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">
                + Add Transaction
            </a>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>

    @endif


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


    {{-- Summary --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Income --}}
        <div class="rounded-xl border border-green-200 bg-green-50 p-5">

            <p class="text-sm font-medium text-green-700">
                Total Income
            </p>

            <p class="mt-2 text-2xl font-bold text-green-800">
                ৳ {{ number_format($totalIncome, 2) }}
            </p>

            <p class="mt-1 text-xs text-green-600">
                Total money received
            </p>

        </div>


        {{-- Expense --}}
        <div class="rounded-xl border border-red-200 bg-red-50 p-5">

            <p class="text-sm font-medium text-red-700">
                Total Expense
            </p>

            <p class="mt-2 text-2xl font-bold text-red-800">
                ৳ {{ number_format($totalExpense, 2) }}
            </p>

            <p class="mt-1 text-xs text-red-600">
                Total money paid
            </p>

        </div>


        {{-- Transfer In --}}
        <div class="rounded-xl border border-blue-200 bg-blue-50 p-5">

            <p class="text-sm font-medium text-blue-700">
                Transfer In
            </p>

            <p class="mt-2 text-2xl font-bold text-blue-800">
                ৳ {{ number_format($totalTransferIn, 2) }}
            </p>

            <p class="mt-1 text-xs text-blue-600">
                Money transferred in
            </p>

        </div>


        {{-- Transfer Out --}}
        <div class="rounded-xl border border-purple-200 bg-purple-50 p-5">

            <p class="text-sm font-medium text-purple-700">
                Transfer Out
            </p>

            <p class="mt-2 text-2xl font-bold text-purple-800">
                ৳ {{ number_format($totalTransferOut, 2) }}
            </p>

            <p class="mt-1 text-xs text-purple-600">
                Money transferred out
            </p>

        </div>

    </div>


    {{-- Filters --}}
    <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

        <form method="GET"
              action="{{ route('account-transactions.index') }}"
              class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-6">

            {{-- Search --}}
            <div class="lg:col-span-2">

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Description / reference..."
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Account --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Account
                </label>

                <select
                    name="account_id"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Accounts
                    </option>

                    @foreach($accounts as $account)

                        <option
                            value="{{ $account->id }}"
                            @selected(request('account_id') == $account->id)
                        >
                            {{ $account->name }}
                        </option>

                    @endforeach

                </select>

            </div>


            {{-- Transaction Type --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Type
                </label>

                <select
                    name="transaction_type"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All Types
                    </option>

                    <option value="income"
                        @selected(request('transaction_type') === 'income')>
                        Income
                    </option>

                    <option value="expense"
                        @selected(request('transaction_type') === 'expense')>
                        Expense
                    </option>

                    <option value="transfer"
                        @selected(request('transaction_type') === 'transfer')>
                        Transfer
                    </option>

                </select>

            </div>


            {{-- Direction --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    Direction
                </label>

                <select
                    name="direction"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

                    <option value="">
                        All
                    </option>

                    <option value="credit"
                        @selected(request('direction') === 'credit')>
                        Credit
                    </option>

                    <option value="debit"
                        @selected(request('direction') === 'debit')>
                        Debit
                    </option>

                </select>

            </div>


            {{-- From Date --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    From Date
                </label>

                <input
                    type="date"
                    name="from_date"
                    value="{{ request('from_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- To Date --}}
            <div>

                <label class="mb-1 block text-sm font-medium text-slate-700">
                    To Date
                </label>

                <input
                    type="date"
                    name="to_date"
                    value="{{ request('to_date') }}"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm focus:border-blue-500 focus:ring-blue-500"
                >

            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="flex-1 rounded-lg bg-slate-800 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900"
                >
                    Filter
                </button>

                <a
                    href="{{ route('account-transactions.index') }}"
                    class="rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Desktop Table --}}
    <div class="hidden overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm lg:block">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Date
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Account
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Type
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Description
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Amount
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Direction
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wider text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($transactions as $transaction)

                        <tr class="transition hover:bg-slate-50">

                            {{-- Date --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">

                                {{ $transaction->transaction_date?->format('d M Y') }}

                            </td>


                            {{-- Account --}}
                            <td class="px-5 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $transaction->account->name ?? 'N/A' }}
                                </div>

                                @if($transaction->account?->account_number)

                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $transaction->account->account_number }}
                                    </div>

                                @endif

                            </td>


                            {{-- Type --}}
                            <td class="px-5 py-4">

                                @if($transaction->transaction_type === 'income')

                                    <span class="inline-flex rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Income
                                    </span>

                                @elseif($transaction->transaction_type === 'expense')

                                    <span class="inline-flex rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Expense
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700">
                                        Transfer
                                    </span>

                                @endif

                            </td>


                            {{-- Description --}}
                            <td class="max-w-xs px-5 py-4">

                                <div class="truncate text-sm text-slate-700">
                                    {{ $transaction->description ?: '—' }}
                                </div>

                                @if($transaction->transfer_reference)

                                    <div class="mt-1 text-xs text-slate-400">
                                        {{ $transaction->transfer_reference }}
                                    </div>

                                @endif

                            </td>


                            {{-- Amount --}}
                            <td class="whitespace-nowrap px-5 py-4 text-right">

                                <span class="font-semibold
                                    {{ $transaction->direction === 'credit'
                                        ? 'text-green-600'
                                        : 'text-red-600' }}">

                                    {{ $transaction->direction === 'credit' ? '+' : '-' }}
                                    ৳ {{ number_format($transaction->amount, 2) }}

                                </span>

                            </td>


                            {{-- Direction --}}
                            <td class="px-5 py-4 text-center">

                                @if($transaction->direction === 'credit')

                                    <span class="inline-flex rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Credit
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Debit
                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-center gap-2">

                                    <a
                                        href="{{ route('account-transactions.show', $transaction) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-slate-50"
                                    >
                                        View
                                    </a>

                                    @if(!$transaction->reference_type)

                                        <form
                                            method="POST"
                                            action="{{ route('account-transactions.destroy', $transaction) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this transaction?')"
                                        >

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                class="rounded-lg border border-red-200 px-3 py-1.5 text-xs font-semibold text-red-600 transition hover:bg-red-50"
                                            >
                                                Delete
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7" class="px-5 py-12 text-center">

                                <div class="text-sm font-medium text-slate-500">
                                    No transactions found.
                                </div>

                                <div class="mt-1 text-xs text-slate-400">
                                    Add your first income or expense transaction.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile Cards --}}
    <div class="space-y-4 lg:hidden">

        @forelse($transactions as $transaction)

            <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between gap-3">

                    <div>

                        <div class="font-semibold text-slate-800">
                            {{ $transaction->account->name ?? 'N/A' }}
                        </div>

                        <div class="mt-1 text-xs text-slate-500">
                            {{ $transaction->transaction_date?->format('d M Y') }}
                        </div>

                    </div>


                    @if($transaction->transaction_type === 'income')

                        <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-semibold text-green-700">
                            Income
                        </span>

                    @elseif($transaction->transaction_type === 'expense')

                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-semibold text-red-700">
                            Expense
                        </span>

                    @else

                        <span class="rounded-full bg-purple-100 px-2.5 py-1 text-xs font-semibold text-purple-700">
                            Transfer
                        </span>

                    @endif

                </div>


                <div class="mt-4 border-t border-slate-100 pt-4">

                    <div class="flex items-center justify-between">

                        <span class="text-sm text-slate-500">
                            Amount
                        </span>

                        <span class="font-bold
                            {{ $transaction->direction === 'credit'
                                ? 'text-green-600'
                                : 'text-red-600' }}">

                            {{ $transaction->direction === 'credit' ? '+' : '-' }}
                            ৳ {{ number_format($transaction->amount, 2) }}

                        </span>

                    </div>


                    <div class="mt-3">

                        <p class="text-xs font-medium uppercase text-slate-400">
                            Description
                        </p>

                        <p class="mt-1 text-sm text-slate-700">
                            {{ $transaction->description ?: '—' }}
                        </p>

                    </div>


                    <div class="mt-4 flex items-center gap-2">

                        <a
                            href="{{ route('account-transactions.show', $transaction) }}"
                            class="flex-1 rounded-lg border border-slate-200 px-3 py-2 text-center text-xs font-semibold text-slate-700 hover:bg-slate-50"
                        >
                            View
                        </a>

                        @if(!$transaction->reference_type)

                            <form
                                method="POST"
                                action="{{ route('account-transactions.destroy', $transaction) }}"
                                class="flex-1"
                                onsubmit="return confirm('Are you sure you want to delete this transaction?')"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="w-full rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-50"
                                >
                                    Delete
                                </button>

                            </form>

                        @endif

                    </div>

                </div>

            </div>

        @empty

            <div class="rounded-xl border border-slate-200 bg-white px-5 py-12 text-center shadow-sm">

                <p class="text-sm font-medium text-slate-500">
                    No transactions found.
                </p>

            </div>

        @endforelse

    </div>


    {{-- Pagination --}}
    @if($transactions->hasPages())

        <div class="rounded-xl border border-slate-200 bg-white px-4 py-3 shadow-sm">

            {{ $transactions->links() }}

        </div>

    @endif

</div>

@endsection