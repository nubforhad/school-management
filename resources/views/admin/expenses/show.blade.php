@extends('admin.layouts.app')

@section('title', 'Expense Details')


@section('content')

<div class="p-4 sm:p-6">
 
{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center
            sm:justify-between gap-4 mb-6">

    <div class="flex items-center gap-3">

        <a href="{{ route('admin.expenses.index') }}"
           class="inline-flex items-center justify-center w-9 h-9
                  rounded-lg bg-slate-100 hover:bg-slate-200
                  text-slate-600">
            <i class="bi bi-arrow-left"></i>
        </a>

        <div>
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Expense Details
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View complete expense information.
            </p>
        </div>

    </div>

    <a href="{{ route('admin.expenses.edit', $expense) }}"
       class="inline-flex items-center justify-center gap-2
              px-4 py-2.5 bg-blue-600 hover:bg-blue-700
              text-white text-sm font-medium rounded-lg">
        <i class="bi bi-pencil-square"></i>
        Edit Expense
    </a>

</div>

{{-- Main Card --}}
<div class="max-w-4xl bg-white border border-slate-200 rounded-xl overflow-hidden">

    {{-- Card Header --}}
    <div class="px-5 sm:px-6 py-5 bg-slate-50 border-b border-slate-200">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div class="flex items-center gap-3">

                <div class="w-11 h-11 rounded-lg bg-blue-50
                            flex items-center justify-center">
                    <i class="bi bi-cash-stack text-blue-600 text-xl"></i>
                </div>

                <div>
                    <h2 class="font-semibold text-slate-800">
                        {{ $expense->category?->name ?? 'Expense' }}
                    </h2>

                    <p class="text-xs text-slate-500 mt-1">
                        {{ $expense->expense_date?->format('d M Y') }}
                    </p>
                </div>

            </div>

            <div class="text-left sm:text-right">

                <p class="text-xs text-slate-500">
                    Expense Amount
                </p>

                <p class="text-xl font-bold text-slate-800 mt-1">
                    ৳ {{ number_format((float) $expense->amount, 2) }}
                </p>

            </div>

        </div>

    </div>

    {{-- Details --}}
    <div class="divide-y divide-slate-100">

        {{-- Category --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Expense Category
            </div>

            <div class="sm:col-span-2 text-sm font-medium text-slate-800">
                {{ $expense->category?->name ?? '—' }}
            </div>

        </div>

        {{-- Date --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Expense Date
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expense->expense_date?->format('d M Y') ?? '—' }}
            </div>

        </div>

        {{-- Amount --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Amount
            </div>

            <div class="sm:col-span-2 text-sm font-bold text-slate-800">
                ৳ {{ number_format((float) $expense->amount, 2) }}
            </div>

        </div>

        {{-- Payment --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Payment Method
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">

                @php
                    $paymentMethods = [
                        'cash' => 'Cash',
                        'bank' => 'Bank',
                        'mobile_banking' => 'Mobile Banking',
                        'cheque' => 'Cheque',
                        'other' => 'Other',
                    ];
                @endphp

                {{ $paymentMethods[$expense->payment_method]
                    ?? ucfirst($expense->payment_method) }}

            </div>

        </div>

        {{-- Reference --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Reference / Invoice No.
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expense->reference_no ?: '—' }}
            </div>

        </div>

        {{-- Description --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Description
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700 whitespace-pre-line">
                {{ $expense->description ?: 'No description available.' }}
            </div>

        </div>

        {{-- Status --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Status
            </div>

            <div class="sm:col-span-2">

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

            </div>

        </div>

        {{-- Created By --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Created By
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expense->creator?->name ?? '—' }}
            </div>

        </div>

        {{-- Created At --}}
        <div class="px-5 sm:px-6 py-4 grid grid-cols-1 sm:grid-cols-3 gap-2">

            <div class="text-sm font-medium text-slate-500">
                Created At
            </div>

            <div class="sm:col-span-2 text-sm text-slate-700">
                {{ $expense->created_at?->format('d M Y, h:i A') ?? '—' }}
            </div>

        </div>

    </div>

    {{-- Footer --}}
    <div class="px-5 sm:px-6 py-4 bg-slate-50 border-t border-slate-200
                flex flex-col sm:flex-row sm:justify-between gap-3">

        <form action="{{ route('admin.expenses.destroy', $expense) }}"
              method="POST"
              class="delete-form">

            @csrf
            @method('DELETE')

            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-4 py-2.5 rounded-lg
                           bg-red-50 hover:bg-red-100
                           text-red-600 text-sm font-medium">
                <i class="bi bi-trash"></i>
                Delete Expense
            </button>

        </form>

        <a href="{{ route('admin.expenses.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg bg-white
                  border border-slate-300
                  text-slate-700 text-sm font-medium hover:bg-slate-50">
            <i class="bi bi-arrow-left"></i>
            Back to Expenses
        </a>

    </div>

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
