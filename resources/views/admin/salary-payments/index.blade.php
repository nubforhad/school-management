@extends('admin.layouts.app')

@section('title', 'Salary Payments')

@section('page-title', 'Salary Payments')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Salary Payments
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage monthly salary payments for teachers and staff
                </p>
            </div>

            <a href="{{ route('admin.salary-payments.create') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>

                Add Salary Payment
            </a>

        </div>
    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200 bg-green-50
                    px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-green-100 text-green-600">

                    <i class="bi bi-check-circle"></i>

                </div>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200 bg-red-50
                    px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-red-100 text-red-600">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-1 list-disc list-inside
                               text-xs text-red-700 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm mb-5 overflow-hidden">

        <div class="px-4 sm:px-6 py-4 border-b border-slate-200
                    bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Filter Salary Payments
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Search salary payments by employee, month or status
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.salary-payments.index') }}">

            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 sm:grid-cols-2
                            lg:grid-cols-5 gap-4">


                    {{-- Teacher --}}
                    <div class="lg:col-span-2">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Teacher / Staff

                        </label>

                        <select name="teacher_staff_id"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                All Teachers / Staff
                            </option>

                            @foreach($teachers as $teacher)

                                <option value="{{ $teacher->id }}"
                                    {{ request('teacher_staff_id') == $teacher->id ? 'selected' : '' }}>

                                    {{ $teacher->name }}

                                    @if($teacher->employee_id)
                                        — {{ $teacher->employee_id }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Month --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Month

                        </label>

                        <select name="salary_month"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                All Months
                            </option>

                            @foreach(range(1, 12) as $month)

                                <option value="{{ $month }}"
                                    {{ request('salary_month') == $month ? 'selected' : '' }}>

                                    {{ \Carbon\Carbon::create()->month($month)->format('F') }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Year --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Year

                        </label>

                        <select name="salary_year"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                All Years
                            </option>

                            @foreach(range(now()->year + 1, 2020) as $year)

                                <option value="{{ $year }}"
                                    {{ request('salary_year') == $year ? 'selected' : '' }}>

                                    {{ $year }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Status

                        </label>

                        <select name="status"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm
                                       text-slate-700 outline-none
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                All Status
                            </option>

                            <option value="Pending"
                                {{ request('status') == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Partial"
                                {{ request('status') == 'Partial' ? 'selected' : '' }}>
                                Partial
                            </option>

                            <option value="Paid"
                                {{ request('status') == 'Paid' ? 'selected' : '' }}>
                                Paid
                            </option>

                            <option value="Cancelled"
                                {{ request('status') == 'Cancelled' ? 'selected' : '' }}>
                                Cancelled
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Filter Buttons --}}
                <div class="mt-4 flex flex-col sm:flex-row
                            items-stretch sm:items-center
                            justify-end gap-2">

                    <a href="{{ route('admin.salary-payments.index') }}"
                       class="inline-flex items-center justify-center gap-2
                              rounded-lg border border-slate-300 bg-white
                              px-4 py-2.5 text-sm font-medium
                              text-slate-600 hover:bg-slate-100 transition">

                        <i class="bi bi-arrow-counterclockwise"></i>

                        Reset

                    </a>

                    <button type="submit"
                            class="inline-flex items-center justify-center gap-2
                                   rounded-lg bg-blue-600 px-4 py-2.5
                                   text-sm font-semibold text-white
                                   hover:bg-blue-700 transition">

                        <i class="bi bi-search"></i>

                        Apply Filter

                    </button>

                </div>

            </div>

        </form>

    </div>


    {{-- Summary --}}
    @php

        $totalPayments = $salaryPayments->total();

        $paidCount = $salaryPayments->where('status', 'Paid')->count();

        $partialCount = $salaryPayments->where('status', 'Partial')->count();

        $pendingCount = $salaryPayments->where('status', 'Pending')->count();

    @endphp


    <div class="grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-4 mb-5">

        {{-- Total --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Total Payments
                    </p>

                    <p class="mt-1 text-xl font-bold text-slate-800">
                        {{ $totalPayments }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-wallet2"></i>

                </div>

            </div>

        </div>


        {{-- Paid --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Paid
                    </p>

                    <p class="mt-1 text-xl font-bold text-green-600">
                        {{ $paidCount }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-green-50 text-green-600">

                    <i class="bi bi-check-circle"></i>

                </div>

            </div>

        </div>


        {{-- Partial --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Partial
                    </p>

                    <p class="mt-1 text-xl font-bold text-amber-600">
                        {{ $partialCount }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-amber-50 text-amber-600">

                    <i class="bi bi-hourglass-split"></i>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="bg-white rounded-xl border border-slate-200
                    shadow-sm p-4">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Pending
                    </p>

                    <p class="mt-1 text-xl font-bold text-red-600">
                        {{ $pendingCount }}
                    </p>

                </div>

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-red-50 text-red-600">

                    <i class="bi bi-clock-history"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Salary Payment Table --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-4 sm:px-6 py-4 border-b border-slate-200
                    bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-cash-stack"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Salary Payment List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Monthly salary payment records
                    </p>

                </div>

            </div>

        </div>


        @if($salaryPayments->count())

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-4 sm:px-6 py-3 text-left
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Employee
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-left
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Salary Month
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Gross
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Deduction
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Net Salary
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Paid
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-center
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Status
                            </th>

                            <th class="px-4 sm:px-6 py-3 text-right
                                       text-xs font-semibold text-slate-500
                                       uppercase tracking-wider">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($salaryPayments as $payment)

                            <tr class="hover:bg-slate-50 transition">

                                {{-- Employee --}}
                                <td class="px-4 sm:px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9 shrink-0
                                                    items-center justify-center
                                                    rounded-full bg-blue-50
                                                    text-blue-600">

                                            <i class="bi bi-person"></i>

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold
                                                      text-slate-800">

                                                {{ $payment->teacherStaff?->name ?? 'N/A' }}

                                            </p>

                                            @if($payment->teacherStaff?->employee_id)

                                                <p class="text-xs text-slate-500">
                                                    ID:
                                                    {{ $payment->teacherStaff->employee_id }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Month --}}
                                <td class="px-4 sm:px-6 py-4">

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ \Carbon\Carbon::create()
                                            ->month($payment->salary_month)
                                            ->format('F') }}

                                    </p>

                                    <p class="text-xs text-slate-500">
                                        {{ $payment->salary_year }}
                                    </p>

                                </td>


                                {{-- Gross --}}
                                <td class="px-4 sm:px-6 py-4 text-right">

                                    <span class="text-sm font-medium
                                                 text-slate-700">

                                        ৳{{ number_format($payment->gross_salary, 2) }}

                                    </span>

                                </td>


                                {{-- Deduction --}}
                                <td class="px-4 sm:px-6 py-4 text-right">

                                    <span class="text-sm font-medium
                                                 text-red-600">

                                        ৳{{ number_format($payment->total_deduction, 2) }}

                                    </span>

                                </td>


                                {{-- Net --}}
                                <td class="px-4 sm:px-6 py-4 text-right">

                                    <span class="text-sm font-bold
                                                 text-green-600">

                                        ৳{{ number_format($payment->net_salary, 2) }}

                                    </span>

                                </td>


                                {{-- Paid --}}
                                <td class="px-4 sm:px-6 py-4 text-right">

                                    <span class="text-sm font-semibold
                                                 text-blue-600">

                                        ৳{{ number_format($payment->paid_amount, 2) }}

                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-4 sm:px-6 py-4 text-center">

                                    @if($payment->status === 'Paid')

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-green-50
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-green-700">

                                            <i class="bi bi-check-circle"></i>
                                            Paid

                                        </span>

                                    @elseif($payment->status === 'Partial')

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-amber-50
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-amber-700">

                                            <i class="bi bi-hourglass-split"></i>
                                            Partial

                                        </span>

                                    @elseif($payment->status === 'Cancelled')

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-slate-100
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-slate-600">

                                            <i class="bi bi-x-circle"></i>
                                            Cancelled

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1
                                                     rounded-full bg-red-50
                                                     px-2.5 py-1 text-xs
                                                     font-semibold text-red-700">

                                            <i class="bi bi-clock"></i>
                                            Pending

                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="px-4 sm:px-6 py-4">

                                    <div class="flex items-center
                                                justify-end gap-1.5">

                                        {{-- View --}}
                                        <a href="{{ route(
                                                'admin.salary-payments.show',
                                                $payment
                                            ) }}"
                                           title="View"
                                           class="inline-flex h-9 w-9
                                                  items-center justify-center
                                                  rounded-lg bg-blue-50
                                                  text-blue-600
                                                  hover:bg-blue-100 transition">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a href="{{ route(
                                                'admin.salary-payments.edit',
                                                $payment
                                            ) }}"
                                           title="Edit"
                                           class="inline-flex h-9 w-9
                                                  items-center justify-center
                                                  rounded-lg bg-amber-50
                                                  text-amber-600
                                                  hover:bg-amber-100 transition">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form action="{{ route(
                                                    'admin.salary-payments.destroy',
                                                    $payment
                                                ) }}"
                                              method="POST"
                                              onsubmit="return confirm(
                                                  'Are you sure you want to delete this salary payment?'
                                              )">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    title="Delete"
                                                    class="inline-flex h-9 w-9
                                                           items-center justify-center
                                                           rounded-lg bg-red-50
                                                           text-red-600
                                                           hover:bg-red-100
                                                           transition">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if($salaryPayments->hasPages())

                <div class="px-4 sm:px-6 py-4 border-t border-slate-200">

                    {{ $salaryPayments->links() }}

                </div>

            @endif

        @else

            {{-- Empty State --}}
            <div class="px-4 sm:px-6 py-12 text-center">

                <div class="mx-auto flex h-14 w-14 items-center
                            justify-center rounded-full bg-slate-100
                            text-slate-400">

                    <i class="bi bi-cash-stack text-2xl"></i>

                </div>

                <h3 class="mt-4 text-sm font-semibold text-slate-800">
                    No salary payments found
                </h3>

                <p class="mt-1 text-xs text-slate-500">
                    Create a salary payment to see it here.
                </p>

                <a href="{{ route('admin.salary-payments.create') }}"
                   class="mt-4 inline-flex items-center gap-2
                          rounded-lg bg-blue-600 px-4 py-2.5
                          text-sm font-semibold text-white
                          hover:bg-blue-700 transition">

                    <i class="bi bi-plus-lg"></i>

                    Add Salary Payment

                </a>

            </div>

        @endif

    </div>

</div>

@endsection