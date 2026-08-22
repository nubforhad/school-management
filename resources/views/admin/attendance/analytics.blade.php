 @extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        Header
    ========================================================== --}}
    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Attendance Analytics
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Student attendance performance overview
                </p>
            </div>

            <div class="flex flex-col xs:flex-row gap-2">

                <a href="{{ route('admin.attendances.report') }}"
                   class="w-full xs:w-auto inline-flex items-center justify-center gap-2
                          px-4 py-2.5 rounded-lg
                          bg-slate-100 text-slate-700
                          text-sm font-medium
                          hover:bg-slate-200 transition">

                    <i class="bi bi-arrow-left"></i>

                    Attendance Report

                </a>

                <button type="button"
                        onclick="window.print()"
                        class="w-full xs:w-auto inline-flex items-center justify-center gap-2
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
    <div class="bg-white rounded-xl shadow-sm border border-slate-200
                p-3 sm:p-5 mb-4 sm:mb-6">

        <div class="flex items-center gap-2 mb-4">

            <div class="w-8 h-8 rounded-lg bg-blue-50
                        flex items-center justify-center">

                <i class="bi bi-funnel text-blue-600"></i>

            </div>

            <div>

                <h2 class="text-sm sm:text-base font-semibold text-slate-800">
                    Attendance Filters
                </h2>

                <p class="text-xs text-slate-500">
                    Filter attendance performance by academic information
                </p>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.attendance.analytics') }}">

            <div class="grid grid-cols-1 xs:grid-cols-2 md:grid-cols-3 lg:grid-cols-6
                        gap-3 sm:gap-4">

                {{-- Branch --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Branch
                    </label>

                    <select name="branch_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none">

                        <option value="">
                            All Branches
                        </option>

                        @foreach($branches as $branch)

                            <option value="{{ $branch->id }}"
                                {{ request('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Academic Session --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Academic Session
                    </label>

                    <select name="academic_session_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none">

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>

                                {{ $session->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Class
                    </label>

                    <select name="school_class_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none">

                        <option value="">
                            All Classes
                        </option>

                        @foreach($schoolClasses as $class)

                            <option value="{{ $class->id }}"
                                {{ request('school_class_id') == $class->id ? 'selected' : '' }}>

                                {{ $class->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        Section
                    </label>

                    <select name="section_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm text-slate-700
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none">

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


                {{-- From Date --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        From Date
                    </label>

                    <input type="date"
                           name="from_date"
                           value="{{ request('from_date') }}"
                           class="w-full rounded-lg border border-slate-300
                                  bg-white px-3 py-2 sm:py-2.5
                                  text-xs sm:text-sm
                                  focus:border-blue-500 focus:ring-2
                                  focus:ring-blue-100 outline-none">

                </div>


                {{-- To Date --}}
                <div>

                    <label class="block text-xs sm:text-sm font-medium text-slate-700 mb-1">
                        To Date
                    </label>

                    <input type="date"
                           name="to_date"
                           value="{{ request('to_date') }}"
                           class="w-full rounded-lg border border-slate-300
                                  bg-white px-3 py-2 sm:py-2.5
                                  text-xs sm:text-sm
                                  focus:border-blue-500 focus:ring-2
                                  focus:ring-blue-100 outline-none">

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="flex flex-col xs:flex-row flex-wrap
                        gap-2.5 sm:gap-3 mt-4 sm:mt-5">

                <button type="submit"
                        class="w-full xs:w-auto inline-flex items-center
                               justify-center gap-2
                               px-5 py-2.5 rounded-lg
                               bg-blue-600 text-sm text-white font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-search"></i>

                    Apply Filter

                </button>


                <a href="{{ route('admin.attendance.analytics') }}"
                   class="w-full xs:w-auto inline-flex items-center
                          justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-slate-100 text-sm text-slate-700 font-medium
                          hover:bg-slate-200 transition">

                    <i class="bi bi-arrow-clockwise"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        Main Summary Cards
    ========================================================== --}}
    <div class="grid grid-cols-1 xs:grid-cols-2 lg:grid-cols-4
                gap-3 sm:gap-4 mb-4 sm:mb-6">


        {{-- Total Students --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Total Students
                    </p>

                    <h3 class="text-2xl sm:text-3xl font-bold text-slate-800 mt-1">
                        {{ $totalStudents }}
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Students in report
                    </p>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <i class="bi bi-people text-xl text-blue-600"></i>

                </div>

            </div>

        </div>


        {{-- Present --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Total Present
                    </p>

                    <h3 class="text-2xl sm:text-3xl font-bold text-green-600 mt-1">
                        {{ $totalPresent }}
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Present records
                    </p>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-green-50
                            flex items-center justify-center">

                    <i class="bi bi-check-circle text-xl text-green-600"></i>

                </div>

            </div>

        </div>


        {{-- Absent --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Total Absent
                    </p>

                    <h3 class="text-2xl sm:text-3xl font-bold text-red-600 mt-1">
                        {{ $totalAbsent }}
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Absent records
                    </p>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-red-50
                            flex items-center justify-center">

                    <i class="bi bi-x-circle text-xl text-red-600"></i>

                </div>

            </div>

        </div>


        {{-- Average --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Average Attendance
                    </p>

                    <h3 class="text-2xl sm:text-3xl font-bold text-purple-600 mt-1">
                        {{ $averagePercentage }}%
                    </h3>

                    <p class="text-xs text-slate-400 mt-1">
                        Overall attendance
                    </p>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-purple-50
                            flex items-center justify-center">

                    <i class="bi bi-bar-chart-line text-xl text-purple-600"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        Performance Summary
    ========================================================== --}}
    <div class="grid grid-cols-1 md:grid-cols-3
                gap-3 sm:gap-4 mb-4 sm:mb-6">


        {{-- Excellent --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-green-50 flex items-center justify-center">

                    <i class="bi bi-graph-up-arrow text-green-600"></i>

                </div>

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Excellent Attendance
                    </p>

                    <h3 class="text-xl sm:text-2xl font-bold text-green-600">
                        {{ $above90 }}
                    </h3>

                    <p class="text-xs text-slate-400">
                        90% or above
                    </p>

                </div>

            </div>

        </div>


        {{-- Average --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-yellow-50 flex items-center justify-center">

                    <i class="bi bi-graph-up text-yellow-600"></i>

                </div>

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Average Attendance
                    </p>

                    <h3 class="text-xl sm:text-2xl font-bold text-yellow-600">
                        {{ $between75And89 }}
                    </h3>

                    <p class="text-xs text-slate-400">
                        75% - 89%
                    </p>

                </div>

            </div>

        </div>


        {{-- Low --}}
        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-red-50 flex items-center justify-center">

                    <i class="bi bi-graph-down-arrow text-red-600"></i>

                </div>

                <div>

                    <p class="text-xs sm:text-sm text-slate-500">
                        Low Attendance
                    </p>

                    <h3 class="text-xl sm:text-2xl font-bold text-red-600">
                        {{ $below75 }}
                    </h3>

                    <p class="text-xs text-slate-400">
                        Below 75%
                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        Student Performance Table
    ========================================================== --}}
    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 overflow-hidden">

        {{-- Table Header --}}
        <div class="p-3 sm:p-5 border-b border-slate-200
                    flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-2">

            <div>

                <h2 class="text-base sm:text-lg font-semibold text-slate-800">
                    Student Attendance Performance
                </h2>

                <p class="text-xs sm:text-sm text-slate-500 mt-0.5">
                    Attendance percentage and performance details
                </p>

            </div>

            <div class="text-xs sm:text-sm text-slate-500">

                {{ $studentAnalytics->count() }} Students

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-xs sm:text-sm min-w-[850px]">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            #
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Student
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Branch
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-center
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Total Days
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-center
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Present
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-center
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Absent
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-center
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Late
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600 whitespace-nowrap">
                            Attendance
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($studentAnalytics as $data)

                        @php
                            $percentage = (float) $data['percentage'];

                            if ($percentage >= 90) {
                                $percentageText = 'text-green-600';
                                $percentageBg = 'bg-green-500';
                                $percentageBadge = 'bg-green-50 text-green-700 border-green-200';
                            } elseif ($percentage >= 75) {
                                $percentageText = 'text-yellow-600';
                                $percentageBg = 'bg-yellow-500';
                                $percentageBadge = 'bg-yellow-50 text-yellow-700 border-yellow-200';
                            } else {
                                $percentageText = 'text-red-600';
                                $percentageBg = 'bg-red-500';
                                $percentageBadge = 'bg-red-50 text-red-700 border-red-200';
                            }
                        @endphp

                        <tr class="hover:bg-slate-50 transition">

                            {{-- # --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-slate-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- Student --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5">

                                <div class="font-medium text-slate-800">
                                    {{ $data['student']->name ?? 'N/A' }}
                                </div>

                                @if(isset($data['student']->student_id))
                                    <div class="text-xs text-slate-500 mt-0.5">
                                        ID: {{ $data['student']->student_id }}
                                    </div>
                                @endif

                            </td>


                            {{-- Branch --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-slate-600">

                                {{ $data['student']->branch->name ?? 'N/A' }}

                            </td>


                            {{-- Total --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-center">

                                <span class="inline-flex items-center justify-center
                                             min-w-[34px] px-2 py-1
                                             rounded-md bg-slate-100
                                             text-slate-700 font-medium">

                                    {{ $data['total_days'] }}

                                </span>

                            </td>


                            {{-- Present --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-center">

                                <span class="inline-flex items-center justify-center
                                             min-w-[34px] px-2 py-1
                                             rounded-md bg-green-50
                                             text-green-700 font-medium">

                                    {{ $data['present'] }}

                                </span>

                            </td>


                            {{-- Absent --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-center">

                                <span class="inline-flex items-center justify-center
                                             min-w-[34px] px-2 py-1
                                             rounded-md bg-red-50
                                             text-red-700 font-medium">

                                    {{ $data['absent'] }}

                                </span>

                            </td>


                            {{-- Late --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5 text-center">

                                <span class="inline-flex items-center justify-center
                                             min-w-[34px] px-2 py-1
                                             rounded-md bg-yellow-50
                                             text-yellow-700 font-medium">

                                    {{ $data['late'] }}

                                </span>

                            </td>


                            {{-- Percentage --}}
                            <td class="px-3 sm:px-4 py-3 sm:py-3.5">

                                <div class="w-full min-w-[170px]">

                                    <div class="flex items-center
                                                justify-between gap-2 mb-1.5">

                                        <span class="text-xs font-medium {{ $percentageText }}">
                                            {{ number_format($percentage, 2) }}%
                                        </span>

                                        <span class="text-[11px] px-2 py-0.5
                                                     rounded-full border
                                                     {{ $percentageBadge }}">

                                            @if($percentage >= 90)
                                                Excellent
                                            @elseif($percentage >= 75)
                                                Average
                                            @else
                                                Low
                                            @endif

                                        </span>

                                    </div>


                                    <div class="w-full h-2 rounded-full bg-slate-100 overflow-hidden">

                                        <div class="h-full rounded-full {{ $percentageBg }}"
                                             style="width: {{ min($percentage, 100) }}%;">

                                        </div>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="px-4 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 rounded-full
                                                bg-slate-100
                                                flex items-center justify-center mb-3">

                                        <i class="bi bi-bar-chart-line
                                                  text-2xl text-slate-400"></i>

                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">
                                        No Attendance Data
                                    </h3>

                                    <p class="text-xs sm:text-sm text-slate-500 mt-1">
                                        No attendance records found for the selected filters.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Table Footer --}}
        @if($studentAnalytics->count())

            <div class="px-3 sm:px-5 py-3
                        border-t border-slate-200
                        bg-slate-50">

                <div class="flex flex-col sm:flex-row
                            sm:items-center sm:justify-between gap-2">

                    <p class="text-xs text-slate-500">
                        Showing {{ $studentAnalytics->count() }} students
                    </p>

                    <p class="text-xs text-slate-500">
                        Total attendance records:
                        <span class="font-semibold text-slate-700">
                            {{ $totalAttendanceDays }}
                        </span>
                    </p>

                </div>

            </div>

        @endif

    </div>

</div>


{{-- =========================================================
    Print CSS
========================================================== --}}
<style>

@media print {

    body {
        background: #fff !important;
    }

    .sidebar,
    .navbar,
    nav,
    aside,
    .btn,
    button,
    form {
        display: none !important;
    }

    .max-w-screen-2xl {
        max-width: 100% !important;
        padding: 0 !important;
        margin: 0 !important;
    }

    .bg-white {
        background: #fff !important;
    }

    .shadow-sm {
        box-shadow: none !important;
    }

    .border {
        border: 1px solid #ddd !important;
    }

    .overflow-x-auto {
        overflow: visible !important;
    }

    table {
        width: 100% !important;
        min-width: 0 !important;
    }

    th,
    td {
        font-size: 11px !important;
        padding: 6px !important;
    }

}

</style>

@endsection