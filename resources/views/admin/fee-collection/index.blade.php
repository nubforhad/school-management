@extends('admin.layouts.app')

@section('title', 'Fee Collection')
@section('page-title', 'Fee Collection')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Fee Collection
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Collect student fees and manage payments
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-4
                    flex items-center gap-3
                    rounded-lg
                    border border-green-200
                    bg-green-50
                    px-4 py-3
                    text-sm text-green-700">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="mb-4
                    flex items-center gap-3
                    rounded-lg
                    border border-red-200
                    bg-red-50
                    px-4 py-3
                    text-sm text-red-700">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    @if($errors->any())

        <div class="mb-4
                    rounded-lg
                    border border-red-200
                    bg-red-50
                    px-4 py-3
                    text-sm text-red-700">

            <p class="font-semibold mb-1">
                Please fix the following errors:
            </p>

            <ul class="list-disc pl-5 space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        SUMMARY
    ========================================================== --}}

    @php

        $totalAssigned = $assignments->sum('amount');

        $totalPaid = $assignments->sum('paid_amount');

        $totalDue = $assignments->sum('due_amount');

    @endphp


    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-5">

        {{-- Assigned --}}

        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl
                            bg-blue-50 text-blue-600">

                    <i class="bi bi-receipt text-xl"></i>

                </div>

                <div>

                    <p class="text-xs text-slate-500">
                        Total Assigned
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-slate-800">
                        ৳ {{ number_format($totalAssigned, 2) }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- Paid --}}

        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl
                            bg-green-50 text-green-600">

                    <i class="bi bi-check-circle text-xl"></i>

                </div>

                <div>

                    <p class="text-xs text-slate-500">
                        Total Collected
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-green-600">
                        ৳ {{ number_format($totalPaid, 2) }}
                    </h2>

                </div>

            </div>

        </div>


        {{-- Due --}}

        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center
                            justify-center rounded-xl
                            bg-red-50 text-red-600">

                    <i class="bi bi-exclamation-circle text-xl"></i>

                </div>

                <div>

                    <p class="text-xs text-slate-500">
                        Total Due
                    </p>

                    <h2 class="mt-1 text-xl font-bold text-red-600">
                        ৳ {{ number_format($totalDue, 2) }}
                    </h2>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        TABLE
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
        {{-- Table Header --}}
        <div class="p-4 sm:p-5  border-b border-slate-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                <div>
                    <h2 class="text-base sm:text-lg font-semibold text-slate-800">
                        Student Fee List
                    </h2>
                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                        Assigned fees available for collection
                    </p>
                </div>
                <div class="text-xs sm:text-sm text-slate-500">
                    Total Assignments:
                    <span class="font-semibold text-slate-700">
                        {{ $assignments->count() }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Responsive Table --}}
        <div class="overflow-x-auto">
            <table class="w-full min-w-[1050px]  text-xs sm:text-sm">
                <thead class="bg-slate-50  border-b border-slate-200">
                    <tr>
                        <th class="px-4 py-3 text-left  font-semibold text-slate-600">
                            #
                        </th>
                        <th class="px-4 py-3 text-left  font-semibold text-slate-600">
                            Student
                        </th>
                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            Fee Type
                        </th>
                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Assigned
                        </th>

                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Paid
                        </th>
                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Due
                        </th>
                        <th class="px-4 py-3 text-center font-semibold text-slate-600">
                            Status
                        </th>
                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($assignments as $assignment)
                        <tr class="hover:bg-slate-50 transition">
                            {{-- Serial --}}
                            <td class="px-4 py-3 text-slate-500">
                                {{ $loop->iteration }}
                            </td>

                            {{-- Student --}}
                            <td class="px-4 py-3">
                                <div class="flex items-center gap-3">
                                    <div class="flex h-9 w-9
                                               shrink-0
                                                items-center
                                                justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600
                                                font-semibold">

                                        {{
                                            strtoupper(
                                                substr(
                                                    $assignment->student->name ?? 'S',
                                                    0,
                                                    1
                                                )
                                            )
                                        }}

                                    </div>

                                    <div class="min-w-0">

                                        <p class="font-semibold
                                                  text-slate-800">

                                            {{ $assignment->student->name ?? 'N/A' }}

                                        </p>

                                        <p class="text-xs text-slate-400">

                                            ID:
                                            {{ $assignment->student->student_id
                                                ?? $assignment->student_id }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Fee Type --}}

                            <td class="px-4 py-3">

                                <div>

                                    <p class="font-medium text-slate-700">

                                        {{ $assignment->feeType->name ?? 'N/A' }}

                                    </p>

                                    @if($assignment->feeType?->code)

                                        <p class="text-xs text-slate-400">

                                            {{ $assignment->feeType->code }}

                                        </p>

                                    @endif

                                </div>

                            </td>


                            {{-- Assigned --}}

                            <td class="px-4 py-3 text-right">

                                <span class="font-semibold
                                             text-slate-700">

                                    ৳ {{ number_format(
                                        $assignment->payable_amount,
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- Paid --}}

                            <td class="px-4 py-3 text-right">

                                <span class="font-semibold
                                             text-green-600">

                                    ৳ {{ number_format(
                                        $assignment->paid_amount,
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- Due --}}

                            <td class="px-4 py-3 text-right">

                                <span class="font-semibold
                                    {{ $assignment->due_amount > 0
                                        ? 'text-red-600'
                                        : 'text-green-600'
                                    }}">

                                    ৳ {{ number_format(
                                        $assignment->due_amount,
                                        2
                                    ) }}

                                </span>

                            </td>


                            {{-- Status --}}

                            <td class="px-4 py-3 text-center">

                                @if($assignment->payment_status === 'paid')

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 rounded-full
                                                 border border-green-200
                                                 bg-green-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-green-700">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-green-500">
                                        </span>

                                        Paid

                                    </span>

                                @elseif($assignment->payment_status === 'partial')

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 rounded-full
                                                 border border-amber-200
                                                 bg-amber-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-amber-700">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-amber-500">
                                        </span>

                                        Partial

                                    </span>

                                @else

                                    <span class="inline-flex
                                                 items-center gap-1.5
                                                 rounded-full
                                                 border border-red-200
                                                 bg-red-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-red-700">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-red-500">
                                        </span>

                                        Unpaid

                                    </span>

                                @endif

                            </td>


                            {{-- Action --}}

                            <td class="px-4 py-3 text-right">

                                @if($assignment->due_amount > 0)

                                    <a href="{{ route(
                                        'admin.fee-collection.create',
                                        $assignment->id
                                    ) }}"
                                    class="inline-flex
                                           items-center gap-2
                                           rounded-lg
                                           bg-blue-600
                                           px-3 py-2
                                           text-xs font-semibold
                                           text-white
                                           hover:bg-blue-700
                                           transition">

                                        <i class="bi bi-cash-stack"></i>

                                        Collect

                                    </a>

                                @else

                                    <span class="inline-flex
                                                 items-center gap-2
                                                 rounded-lg
                                                 bg-slate-100
                                                 px-3 py-2
                                                 text-xs font-medium
                                                 text-slate-500">
                                        <i class="bi bi-check-circle"></i>
                                        Fully Paid
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8"  class="px-4 py-14 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="flex h-16 w-16
                                                items-center
                                                justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600">
                                        <i class="bi bi-cash-stack text-3xl"></i>
                                    </div>
                                    <h3 class="mt-4 text-sm sm:text-base font-semibold  text-slate-700">
                                        No Fee Assignments Found
                                    </h3>
                                    <p class="mt-1  text-xs sm:text-sm  text-slate-500">

                                        Assign fees to students first
                                        before collecting payments.

                                    </p>

                                    <a href="{{ route(
                                        'admin.student-fee-assignments.index'
                                    ) }}"
                                    class="mt-4 inline-flex
                                           items-center gap-2
                                           rounded-lg
                                           bg-blue-600
                                           px-4 py-2.5
                                           text-sm font-medium
                                           text-white
                                           hover:bg-blue-700">

                                        <i class="bi bi-receipt"></i>

                                        Student Fee Assignment
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection