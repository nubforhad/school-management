@extends('admin.layouts.app')

@section('title', 'Accounts / Cash & Bank')

@section('content')

<div class="mx-auto max-w-7xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Accounts / Cash & Bank
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage branch-wise cash, bank and mobile banking accounts.
            </p>
        </div>

        <a href="{{ route('accounts.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="h-5 w-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Add Account
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>

    @endif


    {{-- Validation Error --}}
    @if($errors->any())

        <div class="rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">

            <ul class="list-inside list-disc space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>

    @endif


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

        {{-- Total Accounts --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Total Accounts
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $accounts->total() }}
                    </p>
                </div>

                <div class="rounded-lg bg-blue-50 p-3 text-blue-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 10h18M5 6h14a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V8a2 2 0 012-2z"/>
                    </svg>

                </div>

            </div>

        </div>


        {{-- Cash --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Cash Accounts
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $accounts->where('type', 'cash')->count() }}
                    </p>
                </div>

                <div class="rounded-lg bg-green-50 p-3 text-green-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 8c-2.21 0-4 1.343-4 3s1.79 3 4 3 4 1.343 4 3-1.79 3-4 3m0-12V5m0 14v-3"/>
                    </svg>

                </div>

            </div>

        </div>


        {{-- Bank --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Bank Accounts
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $accounts->where('type', 'bank')->count() }}
                    </p>
                </div>

                <div class="rounded-lg bg-purple-50 p-3 text-purple-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M3 10h18M5 10V7l7-4 7 4v3M6 10v8m4-8v8m4-8v8m4-8v8M3 21h18"/>
                    </svg>

                </div>

            </div>

        </div>


        {{-- Mobile Banking --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-sm font-medium text-slate-500">
                        Mobile Banking
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $accounts->where('type', 'mobile_banking')->count() }}
                    </p>
                </div>

                <div class="rounded-lg bg-orange-50 p-3 text-orange-600">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="h-6 w-6"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M7 4h10a2 2 0 012 2v12a2 2 0 01-2 2H7a2 2 0 01-2-2V6a2 2 0 012-2zm3 14h4"/>
                    </svg>

                </div>

            </div>

        </div>

    </div>


    {{-- Filters --}}
    <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">

        <form method="GET"
              action="{{ route('accounts.index') }}"
              class="grid grid-cols-1 gap-4 md:grid-cols-4">

            {{-- Search --}}
            <div class="md:col-span-2">

                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Search
                </label>

                <input
                    type="text"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Account name, account number, bank name..."
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                >

            </div>


            {{-- Type --}}
            <div>

                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Account Type
                </label>

                <select
                    name="type"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    <option value="">All Types</option>

                    <option value="cash" @selected(request('type') === 'cash')}>
                        Cash
                    </option>

                    <option value="bank" @selected(request('type') === 'bank')}>
                        Bank
                    </option>

                    <option value="mobile_banking" @selected(request('type') === 'mobile_banking')}>
                        Mobile Banking
                    </option>

                </select>

            </div>


            {{-- Status --}}
            <div>

                <label class="mb-1.5 block text-sm font-medium text-slate-700">
                    Status
                </label>

                <select
                    name="status"
                    class="w-full rounded-lg border border-slate-300 px-3 py-2.5 text-sm outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    <option value="">All Status</option>

                    <option value="1" @selected(request('status') === '1')}>
                        Active
                    </option>

                    <option value="0" @selected(request('status') === '0')}>
                        Inactive
                    </option>

                </select>

            </div>


            {{-- Buttons --}}
            <div class="flex items-end gap-2 md:col-span-4">

                <button
                    type="submit"
                    class="inline-flex items-center justify-center rounded-lg bg-slate-800 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-900">

                    Filter
                </button>

                <a
                    href="{{ route('accounts.index') }}"
                    class="inline-flex items-center justify-center rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    Reset
                </a>

            </div>

        </form>

    </div>


    {{-- Accounts Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 px-5 py-4">

            <h2 class="text-base font-semibold text-slate-800">
                Account List
            </h2>

        </div>


        {{-- Desktop Table --}}
        <div class="hidden overflow-x-auto md:block">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            #
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Account
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Type
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Account Number
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Opening Balance
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-200 bg-white">

                    @forelse($accounts as $account)

                        <tr class="transition hover:bg-slate-50">

                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">
                                {{ $accounts->firstItem() + $loop->index }}
                            </td>


                            <td class="px-5 py-4">

                                <div class="font-semibold text-slate-800">
                                    {{ $account->name }}
                                </div>

                                @if($account->bank_name)
                                    <div class="mt-1 text-xs text-slate-500">
                                        {{ $account->bank_name }}
                                    </div>
                                @endif

                            </td>


                            <td class="whitespace-nowrap px-5 py-4">

                                @if($account->type === 'cash')

                                    <span class="inline-flex rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Cash
                                    </span>

                                @elseif($account->type === 'bank')

                                    <span class="inline-flex rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">
                                        Bank
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-orange-50 px-2.5 py-1 text-xs font-semibold text-orange-700">
                                        Mobile Banking
                                    </span>

                                @endif

                            </td>


                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">

                                {{ $account->account_number ?: '—' }}

                            </td>


                            <td class="whitespace-nowrap px-5 py-4 text-right text-sm font-semibold text-slate-800">

                                ৳ {{ number_format((float) $account->opening_balance, 2) }}

                            </td>


                            <td class="whitespace-nowrap px-5 py-4 text-center">

                                @if($account->is_active)

                                    <span class="inline-flex rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                        Active
                                    </span>

                                @else

                                    <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                        Inactive
                                    </span>

                                @endif

                            </td>


                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    <a
                                        href="{{ route('accounts.show', $account) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600 transition hover:bg-slate-50">
                                        View
                                    </a>

                                    <a
                                        href="{{ route('accounts.edit', $account) }}"
                                        class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700 transition hover:bg-blue-100">
                                        Edit
                                    </a>

                                    <form
                                        action="{{ route('accounts.destroy', $account) }}"
                                        method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this account?');">

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                            Delete
                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-5 py-12 text-center">

                                <div class="text-sm font-medium text-slate-600">
                                    No accounts found.
                                </div>

                                <div class="mt-1 text-xs text-slate-400">
                                    Create your first cash, bank or mobile banking account.
                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Mobile Cards --}}
        <div class="divide-y divide-slate-200 md:hidden">

            @forelse($accounts as $account)

                <div class="space-y-4 p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div>

                            <h3 class="font-semibold text-slate-800">
                                {{ $account->name }}
                            </h3>

                            @if($account->bank_name)

                                <p class="mt-1 text-xs text-slate-500">
                                    {{ $account->bank_name }}
                                </p>

                            @endif

                        </div>


                        @if($account->is_active)

                            <span class="shrink-0 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">
                                Active
                            </span>

                        @else

                            <span class="shrink-0 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">
                                Inactive
                            </span>

                        @endif

                    </div>


                    <div class="grid grid-cols-2 gap-3 text-sm">

                        <div>
                            <p class="text-xs text-slate-400">
                                Type
                            </p>

                            <p class="mt-1 font-medium text-slate-700">

                                @if($account->type === 'cash')
                                    Cash
                                @elseif($account->type === 'bank')
                                    Bank
                                @else
                                    Mobile Banking
                                @endif

                            </p>
                        </div>


                        <div>
                            <p class="text-xs text-slate-400">
                                Account Number
                            </p>

                            <p class="mt-1 font-medium text-slate-700">
                                {{ $account->account_number ?: '—' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs text-slate-400">
                                Opening Balance
                            </p>

                            <p class="mt-1 font-semibold text-slate-800">
                                ৳ {{ number_format((float) $account->opening_balance, 2) }}
                            </p>
                        </div>

                    </div>


                    <div class="flex flex-wrap gap-2">

                        <a
                            href="{{ route('accounts.show', $account) }}"
                            class="rounded-lg border border-slate-200 px-3 py-1.5 text-xs font-semibold text-slate-600">
                            View
                        </a>

                        <a
                            href="{{ route('accounts.edit', $account) }}"
                            class="rounded-lg border border-blue-200 bg-blue-50 px-3 py-1.5 text-xs font-semibold text-blue-700">
                            Edit
                        </a>

                        <form
                            action="{{ route('accounts.destroy', $account) }}"
                            method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this account?');">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="rounded-lg border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700">
                                Delete
                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="px-5 py-12 text-center">

                    <p class="text-sm font-medium text-slate-600">
                        No accounts found.
                    </p>

                    <p class="mt-1 text-xs text-slate-400">
                        Create your first account.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Pagination --}}
        @if($accounts->hasPages())

            <div class="border-t border-slate-200 px-5 py-4">
                {{ $accounts->links() }}
            </div>

        @endif

    </div>

</div>

@endsection