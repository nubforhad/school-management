@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        Header
    ========================================================== --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Attendance Report
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Attendance summary and detailed attendance report
                </p>

            </div>

            <div class="flex flex-col xs:flex-row gap-2">

                <a href="{{ route('admin.attendance.index') }}"
                   class="w-full xs:w-auto
                          inline-flex items-center justify-center gap-2
                          px-4 py-2.5 rounded-lg
                          bg-slate-100 text-slate-700
                          text-sm font-medium
                          hover:bg-slate-200 transition">

                    <i class="bi bi-arrow-left"></i>

                    Back

                </a>

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

        <div class="flex items-center gap-2 mb-4">

            <div class="w-8 h-8 rounded-lg bg-blue-50
                        flex items-center justify-center">

                <i class="bi bi-funnel text-blue-600"></i>

            </div>

            <div>

                <h2 class="text-sm sm:text-base
                           font-semibold text-slate-800">

                    Attendance Filter

                </h2>

                <p class="text-xs text-slate-500">
                    Filter attendance records by date, branch and student
                </p>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.attendances.report') }}">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4
                        gap-3 sm:gap-4">


                {{-- Date --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Date

                    </label>

                    <input type="date"
                           name="date"
                           value="{{ request('date') }}"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2 sm:py-2.5
                                  text-xs sm:text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- From Date --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        From Date

                    </label>

                    <input type="date"
                           name="from_date"
                           value="{{ request('from_date') }}"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2 sm:py-2.5
                                  text-xs sm:text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- To Date --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        To Date

                    </label>

                    <input type="date"
                           name="to_date"
                           value="{{ request('to_date') }}"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2 sm:py-2.5
                                  text-xs sm:text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none">

                </div>


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
                                   px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

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


                {{-- Student --}}

                <div class="lg:col-span-2">

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Student

                    </label>

                    <select name="student_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

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

            </div>


            {{-- Buttons --}}

            <div class="flex flex-col xs:flex-row
                        gap-2.5 sm:gap-3 mt-4 sm:mt-5">

                <button type="submit"
                        class="w-full xs:w-auto
                               inline-flex items-center
                               justify-center gap-2
                               px-5 py-2.5 rounded-lg
                               bg-blue-600 text-white
                               text-sm font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-search"></i>

                    Search

                </button>


                <a href="{{ route('admin.attendances.report') }}"
                   class="w-full xs:w-auto
                          inline-flex items-center
                          justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-slate-100 text-slate-700
                          text-sm font-medium
                          hover:bg-slate-200 transition">

                    <i class="bi bi-arrow-clockwise"></i>

                    Reset

                </a>

            </div>

        </form>

    </div>


    {{-- =========================================================
        Summary Cards
    ========================================================== --}}

    <div class="grid grid-cols-2
                lg:grid-cols-4
                gap-3 sm:gap-4
                mb-4 sm:mb-6">


        {{-- Total --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center
                        justify-between gap-3">

                <div>

                    <p class="text-xs text-slate-500">
                        Total Attendance
                    </p>

                    <h3 class="text-2xl sm:text-3xl
                               font-bold text-slate-800 mt-1">

                        {{ $total }}

                    </h3>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-blue-50
                            flex items-center justify-center
                            flex-shrink-0">

                    <i class="bi bi-calendar-check
                              text-xl text-blue-600"></i>

                </div>

            </div>

        </div>


        {{-- Present --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center
                        justify-between gap-3">

                <div>

                    <p class="text-xs text-slate-500">
                        Present
                    </p>

                    <h3 class="text-2xl sm:text-3xl
                               font-bold text-green-600 mt-1">

                        {{ $present }}

                    </h3>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-green-50
                            flex items-center justify-center
                            flex-shrink-0">

                    <i class="bi bi-check-circle
                              text-xl text-green-600"></i>

                </div>

            </div>

        </div>


        {{-- Late --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center
                        justify-between gap-3">

                <div>

                    <p class="text-xs text-slate-500">
                        Late
                    </p>

                    <h3 class="text-2xl sm:text-3xl
                               font-bold text-yellow-600 mt-1">

                        {{ $late }}

                    </h3>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-yellow-50
                            flex items-center justify-center
                            flex-shrink-0">

                    <i class="bi bi-clock
                              text-xl text-yellow-600"></i>

                </div>

            </div>

        </div>


        {{-- Absent --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 p-4 sm:p-5">

            <div class="flex items-center
                        justify-between gap-3">

                <div>

                    <p class="text-xs text-slate-500">
                        Absent
                    </p>

                    <h3 class="text-2xl sm:text-3xl
                               font-bold text-red-600 mt-1">

                        {{ $absent }}

                    </h3>

                </div>

                <div class="w-10 h-10 sm:w-11 sm:h-11
                            rounded-lg bg-red-50
                            flex items-center justify-center
                            flex-shrink-0">

                    <i class="bi bi-x-circle
                              text-xl text-red-600"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        Attendance Details
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 overflow-hidden">


        {{-- Table Header --}}

        <div class="p-3 sm:p-5
                    border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-2">

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Attendance Details

                    </h2>

                    <p class="text-xs sm:text-sm
                              text-slate-500 mt-1">

                        Detailed date-wise attendance records

                    </p>

                </div>


                <div class="inline-flex items-center
                            w-fit
                            px-2.5 py-1 rounded-full
                            bg-slate-100
                            text-slate-600
                            text-xs font-medium">

                    {{ $attendances->count() }} Records

                </div>

            </div>

        </div>


        {{-- Table --}}

        <div class="overflow-x-auto">

            <table class="w-full text-xs sm:text-sm
                          min-w-[1050px]">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Date
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Student
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Class
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Section
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            In Time
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Out Time
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-3 sm:px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Remarks
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($attendances as $attendance)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Serial --}}

                            <td class="px-3 sm:px-4 py-3
                                       text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Date --}}

                            <td class="px-3 sm:px-4 py-3
                                       font-medium text-slate-700">

                                {{ $attendance->date?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Student --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($attendance->student)

                                    <div class="font-semibold text-slate-800">

                                        {{ $attendance->student->name }}

                                    </div>

                                    @if($attendance->student->student_id)

                                        <div class="text-xs text-slate-500 mt-0.5">

                                            ID:
                                            {{ $attendance->student->student_id }}

                                        </div>

                                    @endif

                                @else

                                    <span class="text-slate-400">
                                        N/A
                                    </span>

                                @endif

                            </td>


                            {{-- Branch --}}

                            <td class="px-3 sm:px-4 py-3">

                                {{ $attendance->branch->name
                                    ?? $attendance->student->branch->name
                                    ?? 'N/A'
                                }}

                            </td>


                            {{-- Class --}}

                            <td class="px-3 sm:px-4 py-3">

                                {{ $attendance->schoolClass->name ?? 'N/A' }}

                            </td>


                            {{-- Section --}}

                            <td class="px-3 sm:px-4 py-3">

                                {{ $attendance->section->name ?? 'N/A' }}

                            </td>


                            {{-- In Time --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($attendance->in_time)

                                    {{ \Carbon\Carbon::parse(
                                        $attendance->in_time
                                    )->format('h:i A') }}

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Out Time --}}

                            <td class="px-3 sm:px-4 py-3">

                                @if($attendance->out_time)

                                    {{ \Carbon\Carbon::parse(
                                        $attendance->out_time
                                    )->format('h:i A') }}

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}

                            <td class="px-3 sm:px-4 py-3">

                                @php
                                    $status = strtolower(
                                        trim($attendance->status ?? '')
                                    );
                                @endphp


                                @if($status === 'present')

                                    <span class="inline-flex
                                                 items-center
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-green-50
                                                 text-green-700
                                                 border border-green-200
                                                 text-xs font-medium">

                                        <i class="bi bi-check-circle me-1"></i>

                                        Present

                                    </span>


                                @elseif($status === 'late')

                                    <span class="inline-flex
                                                 items-center
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-yellow-50
                                                 text-yellow-700
                                                 border border-yellow-200
                                                 text-xs font-medium">

                                        <i class="bi bi-clock me-1"></i>

                                        Late

                                    </span>


                                @elseif($status === 'absent')

                                    <span class="inline-flex
                                                 items-center
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50
                                                 text-red-700
                                                 border border-red-200
                                                 text-xs font-medium">

                                        <i class="bi bi-x-circle me-1"></i>

                                        Absent

                                    </span>


                                @elseif($status === 'leave')

                                    <span class="inline-flex
                                                 items-center
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-purple-50
                                                 text-purple-700
                                                 border border-purple-200
                                                 text-xs font-medium">

                                        <i class="bi bi-calendar-x me-1"></i>

                                        Leave

                                    </span>


                                @else

                                    <span class="inline-flex
                                                 items-center
                                                 px-2.5 py-1
                                                 rounded-full
                                                 bg-slate-100
                                                 text-slate-700
                                                 text-xs font-medium">

                                        {{ $attendance->status
                                            ? ucfirst($attendance->status)
                                            : 'N/A'
                                        }}

                                    </span>

                                @endif

                            </td>


                            {{-- Remarks --}}

                            <td class="px-3 sm:px-4 py-3
                                       text-slate-500 max-w-xs">

                                @if($attendance->remarks)

                                    <span title="{{ $attendance->remarks }}">

                                        {{ \Illuminate\Support\Str::limit(
                                            $attendance->remarks,
                                            40
                                        ) }}

                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="10"
                                class="px-4 py-12 text-center">

                                <div class="flex flex-col
                                            items-center">

                                    <div class="w-14 h-14
                                                rounded-full
                                                bg-slate-100
                                                flex items-center
                                                justify-center mb-3">

                                        <i class="bi bi-calendar-x
                                                  text-2xl
                                                  text-slate-400"></i>

                                    </div>

                                    <h3 class="text-sm font-semibold
                                               text-slate-700">

                                        No Attendance Records

                                    </h3>

                                    <p class="text-xs sm:text-sm
                                              text-slate-500 mt-1">

                                        No attendance data found
                                        for the selected filters.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>


{{-- =============================================================
    Print CSS
============================================================= --}}

<style>

@media print {

    @page {
        size: landscape;
        margin: 10mm;
    }

    body {
        background: white !important;
    }

    /*
     * Hide common admin layout elements.
     * This keeps the report itself clean when printing.
     */

    aside,
    nav,
    .sidebar,
    .navbar {
        display: none !important;
    }

    /*
     * Hide buttons and filter section.
     */

    button,
    a,
    form {
        display: none !important;
    }

    /*
     * Keep report container full width.
     */

    .max-w-screen-2xl {
        max-width: 100% !important;
        width: 100% !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    /*
     * Remove card shadows.
     */

    .shadow-sm {
        box-shadow: none !important;
    }

    /*
     * Keep white background.
     */

    .bg-white {
        background: white !important;
    }

    /*
     * Table should fit landscape page.
     */

    table {
        width: 100% !important;
        min-width: 0 !important;
        font-size: 9px !important;
    }

    th,
    td {
        padding: 5px 6px !important;
    }

    /*
     * Prevent rows from breaking.
     */

    tr {
        page-break-inside: avoid;
    }

}

</style>

@endsection