@extends('admin.layouts.app')

@section('title', 'Expense')

@section('content')

<div class="p-4 sm:p-6">

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Expenses
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Manage branch expenses and payments.
        </p>
    </div>

    <a href="{{ route('admin.expenses.create') }}"
       class="inline-flex items-center justify-center gap-2 px-4 py-2.5
              bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
              rounded-lg transition">
        <i class="bi bi-plus-lg"></i>
        Add Expense
    </a>
</div>

{{-- Success --}}
@if(session('success'))
    <div class="mb-5 flex items-center gap-3 rounded-lg border border-green-200
                bg-green-50 px-4 py-3 text-sm text-green-700">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{-- Filters --}}
<div class="bg-white border border-slate-200 rounded-xl p-4 mb-5">

    <form method="GET" action="{{ route('admin.expenses.index') }}">

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-6 gap-3">

            {{-- Search --}}
            <div class="lg:col-span-2">
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Search
                </label>

                <div class="relative">
                    <i class="bi bi-search absolute left-3 top-1/2
                              -translate-y-1/2 text-slate-400"></i>

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Category, reference..."
                        class="w-full rounded-lg border border-slate-300
                               pl-10 pr-4 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500">
                </div>
            </div>

            {{-- Category --}}
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Category
                </label>

                <select name="category_id"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Categories</option>

                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach

                </select>
            </div>

            {{-- Payment Method --}}
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Payment Method
                </label>

                <select name="payment_method"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Methods</option>
                    <option value="cash" {{ request('payment_method') == 'cash' ? 'selected' : '' }}>
                        Cash
                    </option>
                    <option value="bank" {{ request('payment_method') == 'bank' ? 'selected' : '' }}>
                        Bank
                    </option>
                    <option value="mobile_banking" {{ request('payment_method') == 'mobile_banking' ? 'selected' : '' }}>
                        Mobile Banking
                    </option>
                    <option value="cheque" {{ request('payment_method') == 'cheque' ? 'selected' : '' }}>
                        Cheque
                    </option>
                    <option value="other" {{ request('payment_method') == 'other' ? 'selected' : '' }}>
                        Other
                    </option>

                </select>
            </div>

            {{-- Status --}}
            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Status
                </label>

                <select name="status"
                        class="w-full rounded-lg border border-slate-300
                               px-3 py-2.5 text-sm
                               focus:border-blue-500 focus:ring-blue-500">

                    <option value="">All Status</option>
                    <option value="1" {{ request('status') === '1' ? 'selected' : '' }}>
                        Active
                    </option>
                    <option value="0" {{ request('status') === '0' ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            {{-- Search button --}}
            <div class="flex items-end gap-2">

                <button type="submit"
                        class="flex-1 inline-flex items-center justify-center gap-2
                               px-4 py-2.5 bg-slate-800 hover:bg-slate-900
                               text-white text-sm font-medium rounded-lg transition">
                    <i class="bi bi-funnel"></i>
                    Filter
                </button>

                @if(request()->hasAny([
                    'search',
                    'category_id',
                    'payment_method',
                    'status',
                    'date_from',
                    'date_to'
                ]))
                    <a href="{{ route('admin.expenses.index') }}"
                       class="inline-flex items-center justify-center w-11 h-10
                              rounded-lg bg-slate-100 hover:bg-slate-200
                              text-slate-600"
                       title="Clear Filters">
                        <i class="bi bi-x-lg"></i>
                    </a>
                @endif

            </div>

        </div>

        {{-- Date Filters --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3 mt-3 max-w-md">

            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Date From
                </label>

                <input type="date"
                       name="date_from"
                       value="{{ request('date_from') }}"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm
                              focus:border-blue-500 focus:ring-blue-500">
            </div>

            <div>
                <label class="block text-xs font-medium text-slate-600 mb-1.5">
                    Date To
                </label>

                <input type="date"
                       name="date_to"
                       value="{{ request('date_to') }}"
                       class="w-full rounded-lg border border-slate-300
                              px-3 py-2.5 text-sm
                              focus:border-blue-500 focus:ring-blue-500">
            </div>

        </div>

    </form>
</div>

{{-- Table --}}
<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">

    <div class="overflow-x-auto">

        <table class="w-full text-sm text-left">

            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3 font-semibold text-slate-600">#</th>
                    <th class="px-5 py-3 font-semibold text-slate-600">Date</th>
                    <th class="px-5 py-3 font-semibold text-slate-600">Category</th>
                    <th class="px-5 py-3 font-semibold text-slate-600">Amount</th>
                    <th class="px-5 py-3 font-semibold text-slate-600">Payment</th>
                    <th class="px-5 py-3 font-semibold text-slate-600">Status</th>
                    <th class="px-5 py-3 font-semibold text-slate-600 text-right">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($expenses as $expense)

                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-5 py-4 text-slate-500">
                            {{ $expenses->firstItem() + $loop->index }}
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="font-medium text-slate-700">
                                {{ $expense->expense_date?->format('d M Y') }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            <div class="font-medium text-slate-800">
                                {{ $expense->category?->name ?? '—' }}
                            </div>

                            @if($expense->reference_no)
                                <div class="text-xs text-slate-400 mt-1">
                                    Ref: {{ $expense->reference_no }}
                                </div>
                            @endif
                        </td>

                        <td class="px-5 py-4 whitespace-nowrap">
                            <span class="font-semibold text-slate-800">
                                ৳ {{ number_format((float) $expense->amount, 2) }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            @php
                                $paymentMethods = [
                                    'cash' => 'Cash',
                                    'bank' => 'Bank',
                                    'mobile_banking' => 'Mobile Banking',
                                    'cheque' => 'Cheque',
                                    'other' => 'Other',
                                ];
                            @endphp

                            <span class="text-slate-600">
                                {{ $paymentMethods[$expense->payment_method] ?? ucfirst($expense->payment_method) }}
                            </span>
                        </td>

                        <td class="px-5 py-4">
                            @if($expense->status)
                                <span class="inline-flex items-center gap-1.5
                                             px-2.5 py-1 rounded-full
                                             text-xs font-medium bg-green-50 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5
                                             px-2.5 py-1 rounded-full
                                             text-xs font-medium bg-red-50 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">

                                <a href="{{ route('admin.expenses.show', $expense) }}"
                                   title="View"
                                   class="inline-flex items-center justify-center
                                          w-9 h-9 rounded-lg bg-blue-50
                                          text-blue-600 hover:bg-blue-100">
                                    <i class="bi bi-eye"></i>
                                </a>

                                <a href="{{ route('admin.expenses.edit', $expense) }}"
                                   title="Edit"
                                   class="inline-flex items-center justify-center
                                          w-9 h-9 rounded-lg bg-amber-50
                                          text-amber-600 hover:bg-amber-100">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                <form action="{{ route('admin.expenses.destroy', $expense) }}"
                                      method="POST"
                                      class="delete-form">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            title="Delete"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9 rounded-lg bg-red-50
                                                   text-red-600 hover:bg-red-100">
                                        <i class="bi bi-trash"></i>
                                    </button>

                                </form>

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">

                                <div class="w-12 h-12 rounded-full bg-slate-100
                                            flex items-center justify-center mb-3">
                                    <i class="bi bi-cash-stack text-xl text-slate-400"></i>
                                </div>

                                <h3 class="text-sm font-semibold text-slate-700">
                                    No Expenses Found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    No expense records match your filters.
                                </p>

                                <a href="{{ route('admin.expenses.create') }}"
                                   class="mt-4 inline-flex items-center gap-2
                                          px-4 py-2 bg-blue-600 hover:bg-blue-700
                                          text-white text-sm font-medium rounded-lg">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Expense
                                </a>

                            </div>

                        </td>
                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($expenses->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $expenses->links() }}
        </div>
    @endif

</div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Delete Expense?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        });

    });

});
</script>

@endsection
