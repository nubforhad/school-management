@extends('admin.layouts.app')

@section('title', 'Fee Due Report')

@section('page-title', 'Fee Due Report')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6 print:hidden">

        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between gap-3">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Fee Due Report
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    View student-wise outstanding fee details
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-2">

                <a href="{{ route('admin.fee-collection.index') }}"
                   class="inline-flex items-center justify-center gap-2
                          rounded-lg border border-slate-300
                          bg-white px-4 py-2.5
                          text-sm font-medium text-slate-700
                          hover:bg-slate-50 transition">

                    <i class="bi bi-arrow-left"></i>
                    Back
                </a>

                <button type="button"
                        onclick="window.print()"
                        class="inline-flex items-center justify-center gap-2
                               rounded-lg bg-blue-600
                               px-4 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-blue-700 transition">

                    <i class="bi bi-printer"></i>
                    Print Report
                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}

    <div class="bg-white rounded-xl
                border border-slate-200
                shadow-sm mb-5
                print:hidden">

        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-5 py-4">

            <div class="flex items-center gap-2">

                <div class="flex h-9 w-9
                            items-center justify-center
                            rounded-lg
                            bg-blue-50
                            text-blue-600">

                    <i class="bi bi-funnel"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Report Filters
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Filter outstanding fees by date, student, class or fee type
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.fee-collection.due-report') }}">

            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1
                            sm:grid-cols-2
                            lg:grid-cols-3
                            xl:grid-cols-6 gap-4">


                    {{-- From Date --}}

                    <div>

                        <label for="from_date"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            From Date

                        </label>

                        <input type="date"
                               name="from_date"
                               id="from_date"
                               value="{{ request('from_date') }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- To Date --}}

                    <div>

                        <label for="to_date"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            To Date

                        </label>

                        <input type="date"
                               name="to_date"
                               id="to_date"
                               value="{{ request('to_date') }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-800
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Student --}}

                    <div>

                        <label for="student_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Student

                        </label>

                        <select name="student_id"
                                id="student_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Students
                            </option>

                            @foreach($students as $student)

                                <option value="{{ $student->id }}"
                                    {{ request('student_id') == $student->id ? 'selected' : '' }}>

                                    {{ $student->name }}

                                    @if($student->student_id)
                                        — {{ $student->student_id }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Class --}}

                    <div>

                        <label for="school_class_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Class

                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Classes
                            </option>

                            @foreach($classes as $class)

                                <option value="{{ $class->id }}"
                                    {{ request('school_class_id') == $class->id ? 'selected' : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Section --}}

                    <div>

                        <label for="section_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Section

                        </label>

                        <select name="section_id"
                                id="section_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Sections
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ request('section_id') == $section->id ? 'selected' : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Fee Type --}}

                    <div>

                        <label for="fee_type_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Fee Type

                        </label>

                        <select name="fee_type_id"
                                id="fee_type_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-800
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                All Fee Types
                            </option>

                            @foreach($feeTypes as $feeType)

                                <option value="{{ $feeType->id }}"
                                    {{ request('fee_type_id') == $feeType->id ? 'selected' : '' }}>

                                    {{ $feeType->name }}

                                    @if($feeType->code)
                                        — {{ $feeType->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                    </div>

                </div>


                {{-- Buttons --}}

                <div class="flex flex-col sm:flex-row gap-2 mt-5">

                    <button type="submit"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   rounded-lg
                                   bg-blue-600
                                   px-5 py-2.5
                                   text-sm font-semibold
                                   text-white
                                   hover:bg-blue-700
                                   transition">

                        <i class="bi bi-search"></i>
                        Generate Report

                    </button>


                    <a href="{{ route('admin.fee-collection.due-report') }}"
                       class="inline-flex items-center
                              justify-center gap-2
                              rounded-lg
                              border border-slate-300
                              bg-white
                              px-5 py-2.5
                              text-sm font-medium
                              text-slate-700
                              hover:bg-slate-50
                              transition">

                        <i class="bi bi-arrow-counterclockwise"></i>
                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        PRINT AREA
    ========================================================== --}}

    <div id="print-area">


        {{-- =====================================================
            PRINT HEADER
        ====================================================== --}}

        <div class="hidden print:block mb-5">

            <div class="text-center">

                <h1 class="text-2xl font-bold text-slate-800">
                    School Management System
                </h1>

                <h2 class="text-lg font-semibold text-slate-700 mt-1">
                    Fee Due Report
                </h2>


                @if(request('from_date') || request('to_date'))

                    <p class="text-sm text-slate-500 mt-1">

                        Period:

                        {{
                            request('from_date')
                                ? \Carbon\Carbon::parse(request('from_date'))->format('d M Y')
                                : 'Beginning'
                        }}

                        -

                        {{
                            request('to_date')
                                ? \Carbon\Carbon::parse(request('to_date'))->format('d M Y')
                                : 'Today'
                        }}

                    </p>

                @endif


                @if(request('student_id'))

                    @php
                        $selectedStudent = $students->firstWhere(
                            'id',
                            request('student_id')
                        );
                    @endphp

                    @if($selectedStudent)

                        <p class="text-sm text-slate-600 mt-1">

                            Student:
                            <strong>
                                {{ $selectedStudent->name }}
                            </strong>

                        </p>

                    @endif

                @endif

            </div>

            <div class="border-b border-slate-300 mt-4"></div>

        </div>


        {{-- =====================================================
            SUMMARY CARDS
        ====================================================== --}}

        <div class="grid grid-cols-1
                    sm:grid-cols-2
                    lg:grid-cols-4 gap-4 mb-5">


            {{-- Total Students --}}

            <div class="rounded-xl
                        border border-blue-200
                        bg-blue-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-blue-600">

                        <i class="bi bi-people text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-blue-600">
                            Students
                        </p>

                        <p class="mt-1 text-xl font-bold text-blue-800">
                            {{ number_format($totalStudents) }}
                        </p>

                    </div>

                </div>

            </div>


            {{-- Total Fee --}}

            <div class="rounded-xl
                        border border-slate-200
                        bg-slate-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-slate-600">

                        <i class="bi bi-receipt text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-slate-500">
                            Total Fee
                        </p>

                        <p class="mt-1 text-xl font-bold text-slate-800">

                            ৳ {{ number_format($totalFee, 2) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- Paid --}}

            <div class="rounded-xl
                        border border-green-200
                        bg-green-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-green-600">

                        <i class="bi bi-check-circle text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-green-600">
                            Paid Amount
                        </p>

                        <p class="mt-1 text-xl font-bold text-green-700">

                            ৳ {{ number_format($totalPaid, 2) }}

                        </p>

                    </div>

                </div>

            </div>


            {{-- Due --}}

            <div class="rounded-xl
                        border border-red-200
                        bg-red-50
                        p-5">

                <div class="flex items-center gap-3">

                    <div class="flex h-11 w-11
                                items-center justify-center
                                rounded-xl
                                bg-white
                                text-red-600">

                        <i class="bi bi-exclamation-circle text-xl"></i>

                    </div>

                    <div>

                        <p class="text-xs text-red-600">
                            Outstanding Due
                        </p>

                        <p class="mt-1 text-xl font-bold text-red-700">

                            ৳ {{ number_format($totalDue, 2) }}

                        </p>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            REPORT TABLE
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm overflow-hidden">


            {{-- Table Header --}}

            <div class="p-4 sm:p-5
                        border-b border-slate-200">

                <div class="flex flex-col sm:flex-row
                            sm:items-center
                            sm:justify-between gap-2">

                    <div>

                        <h2 class="text-base sm:text-lg
                                   font-semibold text-slate-800">

                            Student Due Details

                        </h2>

                        <p class="text-xs sm:text-sm
                                  text-slate-500 mt-1">

                            Student-wise outstanding fee summary

                        </p>

                    </div>


                    <div class="text-xs sm:text-sm text-slate-500">

                        Students:

                        <span class="font-semibold text-slate-700">
                            {{ $studentDue->count() }}
                        </span>

                    </div>

                </div>

            </div>


            {{-- Table --}}

            <div class="overflow-x-auto">

                <table class="w-full min-w-[950px]
                              text-xs sm:text-sm">

                    <thead class="bg-slate-50
                                  border-b border-slate-200">

                        <tr>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                #
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Student
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Student ID
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Class
                            </th>

                            <th class="px-4 py-3 text-left
                                       font-semibold text-slate-600">
                                Section
                            </th>

                            <th class="px-4 py-3 text-right
                                       font-semibold text-slate-600">
                                Total Fee
                            </th>

                            <th class="px-4 py-3 text-right
                                       font-semibold text-slate-600">
                                Paid
                            </th>

                            <th class="px-4 py-3 text-right
                                       font-semibold text-slate-600">
                                Due
                            </th>

                            <th class="px-4 py-3 text-center
                                       font-semibold text-slate-600">
                                Status
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">


                        @forelse($studentDue as $item)

                            @php
                                $student = $item['student'];

                                $totalFee = $item['total_fee'];
                                $paidAmount = $item['paid_amount'];
                                $dueAmount = $item['due_amount'];
                            @endphp


                            <tr class="hover:bg-slate-50 transition">


                                {{-- # --}}

                                <td class="px-4 py-3 text-slate-500">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- Student --}}

                                <td class="px-4 py-3">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-9 w-9
                                                    shrink-0
                                                    items-center justify-center
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600
                                                    font-semibold">

                                            {{
                                                strtoupper(
                                                    substr(
                                                        $student->name ?? 'S',
                                                        0,
                                                        1
                                                    )
                                                )
                                            }}

                                        </div>


                                        <div>

                                            <p class="font-semibold text-slate-800">

                                                {{ $student->name ?? 'N/A' }}

                                            </p>

                                            @if($student->branch)

                                                <p class="text-xs text-slate-400">

                                                    {{ $student->branch->name }}

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Student ID --}}

                                <td class="px-4 py-3 text-slate-600">

                                    {{ $student->student_id ?? $student->id }}

                                </td>


                                {{-- Class --}}

                                <td class="px-4 py-3">

                                    <span class="font-medium text-slate-700">

                                        {{ $student->schoolClass->name ?? 'N/A' }}

                                    </span>

                                </td>


                                {{-- Section --}}

                                <td class="px-4 py-3">

                                    <span class="text-slate-600">

                                        {{ $student->section->name ?? 'N/A' }}

                                    </span>

                                </td>


                                {{-- Total Fee --}}

                                <td class="px-4 py-3 text-right">

                                    <span class="font-semibold text-slate-700">

                                        ৳ {{ number_format($totalFee, 2) }}

                                    </span>

                                </td>


                                {{-- Paid --}}

                                <td class="px-4 py-3 text-right">

                                    <span class="font-semibold text-green-600">

                                        ৳ {{ number_format($paidAmount, 2) }}

                                    </span>

                                </td>


                                {{-- Due --}}

                                <td class="px-4 py-3 text-right">

                                    <span class="font-bold
                                                 {{ $dueAmount > 0
                                                    ? 'text-red-600'
                                                    : 'text-green-600' }}">

                                        ৳ {{ number_format($dueAmount, 2) }}

                                    </span>

                                </td>


                                {{-- Status --}}

                                <td class="px-4 py-3 text-center">

                                    @if($dueAmount > 0)

                                        <span class="inline-flex
                                                     items-center
                                                     rounded-full
                                                     border
                                                     border-red-200
                                                     bg-red-50
                                                     px-2.5 py-1
                                                     text-xs font-medium
                                                     text-red-700">

                                            Due

                                        </span>

                                    @else

                                        <span class="inline-flex
                                                     items-center
                                                     rounded-full
                                                     border
                                                     border-green-200
                                                     bg-green-50
                                                     px-2.5 py-1
                                                     text-xs font-medium
                                                     text-green-700">

                                            Paid

                                        </span>

                                    @endif

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="9"
                                    class="px-4 py-14 text-center">

                                    <div class="flex flex-col
                                                items-center">

                                        <div class="flex h-16 w-16
                                                    items-center justify-center
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600">

                                            <i class="bi bi-receipt
                                                      text-3xl"></i>

                                        </div>


                                        <h3 class="mt-4
                                                   text-sm sm:text-base
                                                   font-semibold
                                                   text-slate-700">

                                            No Due Records Found

                                        </h3>


                                        <p class="mt-1
                                                  text-xs sm:text-sm
                                                  text-slate-500">

                                            No students match the selected filters.

                                        </p>

                                    </div>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>


                    {{-- =================================================
                        TOTAL
                    ================================================== --}}

                    @if($studentDue->count() > 0)

                        <tfoot>

                            <tr class="bg-slate-50
                                       border-t-2 border-slate-200">


                                <td colspan="5"
                                    class="px-4 py-4 text-right
                                           font-bold text-slate-700">

                                    Grand Total

                                </td>


                                <td class="px-4 py-4 text-right">

                                    <span class="font-bold text-slate-800">

                                        ৳ {{ number_format($totalFee, 2) }}

                                    </span>

                                </td>


                                <td class="px-4 py-4 text-right">

                                    <span class="font-bold text-green-600">

                                        ৳ {{ number_format($totalPaid, 2) }}

                                    </span>

                                </td>


                                <td class="px-4 py-4 text-right">

                                    <span class="text-lg font-bold text-red-600">

                                        ৳ {{ number_format($totalDue, 2) }}

                                    </span>

                                </td>


                                <td></td>

                            </tr>

                        </tfoot>

                    @endif

                </table>

            </div>

        </div>


        {{-- =====================================================
            PRINT FOOTER
        ====================================================== --}}

        <div class="hidden print:flex
                    items-center justify-between
                    mt-8 pt-4
                    border-t border-slate-300
                    text-xs text-slate-500">

            <span>
                Generated on {{ now()->format('d M Y h:i A') }}
            </span>

            <span>
                School Management System
            </span>

        </div>

    </div>

</div>


{{-- =============================================================
    PRINT CSS
============================================================= --}}

<style>

@media print {

    body {
        background: #ffffff !important;
    }

    body * {
        visibility: hidden;
    }

    #print-area,
    #print-area * {
        visibility: visible;
    }

    #print-area {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
        margin: 0;
        padding: 0;
        border: none !important;
        box-shadow: none !important;
        border-radius: 0 !important;
    }

    #print-area .bg-white {
        background: #ffffff !important;
    }

    #print-area table {
        width: 100%;
    }

    #print-area tr {
        page-break-inside: avoid;
    }

    #print-area thead {
        display: table-header-group;
    }

    #print-area tfoot {
        display: table-row-group;
    }

    @page {
        size: A4 landscape;
        margin: 10mm;
    }

}

</style>

@endsection