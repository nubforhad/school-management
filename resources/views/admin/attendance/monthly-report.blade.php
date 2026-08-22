@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        Header
    ========================================================== --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col lg:flex-row
                    lg:items-center lg:justify-between gap-4">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Monthly Attendance Report
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Student-wise monthly attendance performance
                </p>

            </div>

            <div class="flex flex-col xs:flex-row gap-2">

                <button type="button"
                        onclick="window.print()"
                        class="w-full xs:w-auto
                               inline-flex items-center justify-center gap-2
                               px-4 py-2.5 rounded-lg
                               bg-slate-800 text-white
                               text-sm font-medium
                               hover:bg-slate-900 transition">

                    <i class="bi bi-printer"></i>

                    Print

                </button>

            </div>

        </div>

    </div>


    {{-- =========================================================
        Filter
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200
                p-3 sm:p-5 mb-4 sm:mb-6">

        <div class="mb-4">

            <h2 class="text-base sm:text-lg
                       font-semibold text-slate-800">

                <i class="bi bi-funnel mr-1"></i>

                Report Filter

            </h2>

            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Select the required month and academic information.
            </p>

        </div>


        <form method="GET"
              action="{{ route('admin.attendance.monthly-report') }}">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-5
                        gap-3 sm:gap-4">


                {{-- Branch --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Branch

                    </label>

                    <select name="branch_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

                        <option value="">
                            All Branches
                        </option>

                        @foreach($branches as $branch)

                            <option value="{{ $branch->id }}"
                                {{ request('branch_id') == $branch->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Academic Session

                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $session->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Class

                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

                        <option value="">
                            All Classes
                        </option>

                        @foreach($schoolClasses as $class)

                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Section

                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

                        <option value="">
                            All Sections
                        </option>

                        @foreach($sections as $section)

                            <option value="{{ $section->id }}"
                                {{ request('section_id') == $section->id
                                    ? 'selected'
                                    : '' }}>

                                {{ $section->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Month --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Month

                    </label>

                    <input type="month"
                           name="month"
                           value="{{ $month }}"
                           required
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2.5
                                  text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none">

                </div>

            </div>


            {{-- Buttons --}}

            <div class="flex flex-col xs:flex-row
                        flex-wrap gap-2.5 sm:gap-3 mt-4 sm:mt-5">

                <button type="submit"
                        class="w-full xs:w-auto
                               inline-flex items-center justify-center gap-2
                               px-5 py-2.5 rounded-lg
                               bg-blue-600
                               text-white
                               text-sm font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-search"></i>

                    Generate Report

                </button>


                <a href="{{ route('admin.attendance.monthly-report') }}"
                   class="w-full xs:w-auto
                          inline-flex items-center justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-slate-100
                          text-slate-700
                          text-sm font-medium
                          hover:bg-slate-200 transition">

                    <i class="bi bi-arrow-counterclockwise"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        Report Area
    ========================================================== --}}

    @if($studentAnalytics->count())


        {{-- =====================================================
            Report Title
        ====================================================== --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200
                    p-4 sm:p-5 mb-4">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-3">

                <div>

                    <h2 class="text-lg sm:text-xl
                               font-bold text-slate-800">

                        Monthly Attendance

                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500 mt-1">

                        {{ \Carbon\Carbon::createFromFormat(
                            'Y-m',
                            $month
                        )->format('F Y') }}

                    </p>

                </div>


                <div class="text-xs sm:text-sm text-slate-500">

                    Generated:
                    {{ now()->format('d M Y, h:i A') }}

                </div>

            </div>

        </div>


        {{-- =====================================================
            Summary Cards
        ====================================================== --}}

        <div class="grid grid-cols-2
                    lg:grid-cols-6
                    gap-3 sm:gap-4
                    mb-4 sm:mb-6">


            {{-- Students --}}

            <div class="bg-white rounded-xl
                        border border-slate-200
                        shadow-sm p-4">

                <p class="text-xs text-slate-500">
                    Total Students
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-slate-800 mt-1">

                    {{ $summary['total_students'] }}

                </h3>

            </div>


            {{-- Working Days --}}

            <div class="bg-white rounded-xl
                        border border-slate-200
                        shadow-sm p-4">

                <p class="text-xs text-slate-500">
                    Attendance Days
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-slate-800 mt-1">

                    {{ $summary['working_days'] }}

                </h3>

            </div>


            {{-- Present --}}

            <div class="bg-white rounded-xl
                        border border-green-200
                        shadow-sm p-4">

                <p class="text-xs text-green-600">
                    Present
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-green-600 mt-1">

                    {{ $summary['present'] }}

                </h3>

            </div>


            {{-- Absent --}}

            <div class="bg-white rounded-xl
                        border border-red-200
                        shadow-sm p-4">

                <p class="text-xs text-red-600">
                    Absent
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-red-600 mt-1">

                    {{ $summary['absent'] }}

                </h3>

            </div>


            {{-- Late --}}

            <div class="bg-white rounded-xl
                        border border-yellow-200
                        shadow-sm p-4">

                <p class="text-xs text-yellow-600">
                    Late
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-yellow-600 mt-1">

                    {{ $summary['late'] }}

                </h3>

            </div>


            {{-- Average --}}

            <div class="bg-white rounded-xl
                        border border-blue-200
                        shadow-sm p-4">

                <p class="text-xs text-blue-600">
                    Average
                </p>

                <h3 class="text-xl sm:text-2xl
                           font-bold text-blue-600 mt-1">

                    {{ $summary['average_percentage'] }}%

                </h3>

            </div>

        </div>


        {{-- =====================================================
            Legend
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm
                    p-3 sm:p-4 mb-4">

            <div class="flex flex-wrap items-center
                        gap-x-5 gap-y-2
                        text-xs sm:text-sm">

                <span class="font-medium text-slate-700">
                    Status:
                </span>

                <span class="text-green-600">
                    <strong>P</strong> = Present
                </span>

                <span class="text-red-600">
                    <strong>A</strong> = Absent
                </span>

                <span class="text-yellow-600">
                    <strong>L</strong> = Late
                </span>

                <span class="text-blue-600">
                    <strong>LV</strong> = Leave
                </span>

                <span class="text-slate-400">
                    <strong>-</strong> = No Record
                </span>

            </div>

        </div>


        {{-- =====================================================
            Student Monthly Attendance
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    shadow-sm
                    border border-slate-200
                    overflow-hidden">

            <div class="p-3 sm:p-5
                        border-b border-slate-200">

                <h2 class="text-base sm:text-lg
                           font-semibold text-slate-800">

                    Student Monthly Attendance

                </h2>

                <p class="text-xs sm:text-sm
                          text-slate-500 mt-1">

                    Daily attendance status for the selected month

                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-xs sm:text-sm
                              min-w-[1100px]">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-3 py-3 text-left
                                       whitespace-nowrap
                                       sticky left-0
                                       bg-slate-50 z-10">

                                #

                            </th>


                            <th class="px-3 py-3 text-left
                                       whitespace-nowrap
                                       sticky left-[35px]
                                       bg-slate-50 z-10">

                                Student

                            </th>


                            {{-- Days --}}

                            @php

                                $daysInMonth =
                                    \Carbon\Carbon::createFromFormat(
                                        'Y-m',
                                        $month
                                    )->daysInMonth;

                            @endphp


                            @for($day = 1; $day <= $daysInMonth; $day++)

                                <th class="px-2 py-3
                                           text-center
                                           whitespace-nowrap">

                                    {{ $day }}

                                </th>

                            @endfor


                            <th class="px-3 py-3 text-center
                                       whitespace-nowrap">

                                Present

                            </th>

                            <th class="px-3 py-3 text-center
                                       whitespace-nowrap">

                                Absent

                            </th>

                            <th class="px-3 py-3 text-center
                                       whitespace-nowrap">

                                Late

                            </th>

                            <th class="px-3 py-3 text-center
                                       whitespace-nowrap">

                                Leave

                            </th>

                            <th class="px-3 py-3 text-center
                                       whitespace-nowrap">

                                %

                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($studentAnalytics as $data)

                            <tr class="hover:bg-slate-50">

                                {{-- Number --}}

                                <td class="px-3 py-3
                                           text-slate-500
                                           sticky left-0
                                           bg-white z-10">

                                    {{ $loop->iteration }}

                                </td>


                                {{-- Student --}}

                                <td class="px-3 py-3
                                           sticky left-[35px]
                                           bg-white z-10">

                                    <div class="font-medium
                                                text-slate-800
                                                whitespace-nowrap">

                                        {{ $data['student']->name ?? 'N/A' }}

                                    </div>

                                    <div class="text-[11px]
                                                text-slate-500">

                                        ID:
                                        {{ $data['student']->student_id
                                            ?? $data['student']->id }}

                                    </div>

                                </td>


                                {{-- Daily Status --}}

                                @for($day = 1; $day <= $daysInMonth; $day++)

                                    @php

                                        $status =
                                            $data['daily'][$day]
                                            ?? null;

                                    @endphp

                                    <td class="px-2 py-3
                                               text-center">

                                        @if($status === 'present')

                                            <span class="inline-flex
                                                         items-center
                                                         justify-center
                                                         w-7 h-7
                                                         rounded-full
                                                         bg-green-100
                                                         text-green-700
                                                         font-semibold">

                                                P

                                            </span>

                                        @elseif($status === 'absent')

                                            <span class="inline-flex
                                                         items-center
                                                         justify-center
                                                         w-7 h-7
                                                         rounded-full
                                                         bg-red-100
                                                         text-red-700
                                                         font-semibold">

                                                A

                                            </span>

                                        @elseif($status === 'late')

                                            <span class="inline-flex
                                                         items-center
                                                         justify-center
                                                         w-7 h-7
                                                         rounded-full
                                                         bg-yellow-100
                                                         text-yellow-700
                                                         font-semibold">

                                                L

                                            </span>

                                        @elseif($status === 'leave')

                                            <span class="inline-flex
                                                         items-center
                                                         justify-center
                                                         w-7 h-7
                                                         rounded-full
                                                         bg-blue-100
                                                         text-blue-700
                                                         font-semibold">

                                                LV

                                            </span>

                                        @else

                                            <span class="text-slate-300">
                                                -
                                            </span>

                                        @endif

                                    </td>

                                @endfor


                                {{-- Present --}}

                                <td class="px-3 py-3 text-center">

                                    <span class="inline-flex
                                                 min-w-[32px]
                                                 justify-center
                                                 rounded-full
                                                 bg-green-100
                                                 text-green-700
                                                 px-2 py-1
                                                 font-semibold">

                                        {{ $data['present'] }}

                                    </span>

                                </td>


                                {{-- Absent --}}

                                <td class="px-3 py-3 text-center">

                                    <span class="inline-flex
                                                 min-w-[32px]
                                                 justify-center
                                                 rounded-full
                                                 bg-red-100
                                                 text-red-700
                                                 px-2 py-1
                                                 font-semibold">

                                        {{ $data['absent'] }}

                                    </span>

                                </td>


                                {{-- Late --}}

                                <td class="px-3 py-3 text-center">

                                    <span class="inline-flex
                                                 min-w-[32px]
                                                 justify-center
                                                 rounded-full
                                                 bg-yellow-100
                                                 text-yellow-700
                                                 px-2 py-1
                                                 font-semibold">

                                        {{ $data['late'] }}

                                    </span>

                                </td>


                                {{-- Leave --}}

                                <td class="px-3 py-3 text-center">

                                    <span class="inline-flex
                                                 min-w-[32px]
                                                 justify-center
                                                 rounded-full
                                                 bg-blue-100
                                                 text-blue-700
                                                 px-2 py-1
                                                 font-semibold">

                                        {{ $data['leave'] }}

                                    </span>

                                </td>


                                {{-- Percentage --}}

                                <td class="px-3 py-3 text-center">

                                    @php

                                        $percentage =
                                            $data['percentage'];

                                    @endphp


                                    <div class="font-semibold
                                                {{ $percentage >= 90
                                                    ? 'text-green-600'
                                                    : ($percentage >= 75
                                                        ? 'text-yellow-600'
                                                        : 'text-red-600') }}">

                                        {{ $percentage }}%

                                    </div>


                                    <div class="w-20
                                                bg-slate-100
                                                rounded-full
                                                h-1.5 mt-1
                                                mx-auto">

                                        <div class="h-1.5 rounded-full
                                            {{ $percentage >= 90
                                                ? 'bg-green-500'
                                                : ($percentage >= 75
                                                    ? 'bg-yellow-500'
                                                    : 'bg-red-500') }}"
                                             style="width:
                                             {{ min($percentage, 100) }}%">
                                        </div>

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- Bottom --}}

            <div class="p-3 sm:p-5
                        border-t border-slate-200
                        bg-slate-50">

                <div class="flex flex-col
                            sm:flex-row
                            sm:items-center
                            sm:justify-between gap-2">

                    <p class="text-xs sm:text-sm
                              text-slate-500">

                        Showing
                        <strong class="text-slate-700">
                            {{ $studentAnalytics->count() }}
                        </strong>
                        students.

                    </p>

                    <p class="text-xs sm:text-sm
                              text-slate-500">

                        Average Attendance:
                        <strong class="text-blue-600">
                            {{ $summary['average_percentage'] }}%
                        </strong>

                    </p>

                </div>

            </div>

        </div>


    @else


        {{-- =====================================================
            Empty State
        ====================================================== --}}

        <div class="bg-white rounded-xl
                    border border-slate-200
                    shadow-sm">

            <div class="py-12 sm:py-16
                        px-4 text-center">

                <div class="w-16 h-16
                            mx-auto
                            rounded-full
                            bg-slate-100
                            flex items-center justify-center">

                    <i class="bi bi-calendar3
                              text-2xl
                              text-slate-400"></i>

                </div>

                <h3 class="mt-4
                           text-base sm:text-lg
                           font-semibold
                           text-slate-800">

                    No Attendance Data Found

                </h3>

                <p class="mt-1
                          text-xs sm:text-sm
                          text-slate-500
                          max-w-md
                          mx-auto">

                    Select Branch, Academic Session,
                    Class, Section and Month to generate
                    the monthly attendance report.

                </p>

            </div>

        </div>

    @endif

</div>


{{-- =============================================================
    Print CSS
============================================================== --}}

<style>

@media print {

    .sidebar,
    .navbar,
    nav,
    form,
    button,
    a {
        display: none !important;
    }

    body {
        background: #fff !important;
    }

    .max-w-screen-2xl {
        max-width: 100% !important;
        padding: 0 !important;
    }

    .shadow-sm {
        box-shadow: none !important;
    }

    .border {
        border-color: #ddd !important;
    }

    table {
        font-size: 9px !important;
    }

    th,
    td {
        padding: 4px !important;
    }

    .sticky {
        position: static !important;
    }

}

</style>

@endsection