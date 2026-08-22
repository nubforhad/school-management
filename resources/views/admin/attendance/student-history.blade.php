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
                    Student Attendance History
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    View individual student attendance history
                </p>

            </div>

            <a href="{{ route('admin.attendance.analytics') }}"
               class="w-full sm:w-auto inline-flex
                      items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-slate-100 text-slate-700
                      text-sm font-medium
                      hover:bg-slate-200 transition">

                <i class="bi bi-bar-chart"></i>

                Attendance Analytics

            </a>

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
                    Select a student and filter attendance records
                </p>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.attendance.student-history') }}">

            <div class="grid grid-cols-1 xs:grid-cols-2
                        md:grid-cols-3 lg:grid-cols-4
                        gap-3 sm:gap-4">


                {{-- Student --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Student

                    </label>

                    <select name="student_id"
                            required
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
                            Select Student
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
                                   px-3 py-2 sm:py-2.5
                                   text-xs sm:text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none">

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

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Class

                    </label>

                    <select name="school_class_id"
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

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Section

                    </label>

                    <select name="section_id"
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

                    View History

                </button>


                <a href="{{ route('admin.attendance.student-history') }}"
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


    @if($selectedStudent)


        {{-- =====================================================
            Student Information
        ====================================================== --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200
                    p-4 sm:p-5 mb-4 sm:mb-6">

            <div class="flex flex-col sm:flex-row
                        sm:items-center gap-4">

                <div class="w-14 h-14 rounded-full
                            bg-blue-50
                            flex items-center justify-center
                            flex-shrink-0">

                    <i class="bi bi-person text-2xl text-blue-600"></i>

                </div>


                <div class="flex-1">

                    <h2 class="text-lg sm:text-xl
                               font-bold text-slate-800">

                        {{ $selectedStudent->name }}

                    </h2>

                    <div class="flex flex-wrap gap-x-4 gap-y-1
                                mt-1 text-xs sm:text-sm
                                text-slate-500">

                        @if($selectedStudent->student_id)

                            <span>
                                ID: {{ $selectedStudent->student_id }}
                            </span>

                        @endif

                        <span>
                            Branch:
                            {{ $selectedStudent->branch->name ?? 'N/A' }}
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            Summary
        ====================================================== --}}

        <div class="grid grid-cols-2
                    lg:grid-cols-6
                    gap-3 sm:gap-4
                    mb-4 sm:mb-6">


            {{-- Total --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Total Days
                </p>

                <h3 class="text-2xl font-bold text-slate-800 mt-1">
                    {{ $totalDays }}
                </h3>

            </div>


            {{-- Present --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Present
                </p>

                <h3 class="text-2xl font-bold text-green-600 mt-1">
                    {{ $present }}
                </h3>

            </div>


            {{-- Absent --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Absent
                </p>

                <h3 class="text-2xl font-bold text-red-600 mt-1">
                    {{ $absent }}
                </h3>

            </div>


            {{-- Late --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Late
                </p>

                <h3 class="text-2xl font-bold text-yellow-600 mt-1">
                    {{ $late }}
                </h3>

            </div>


            {{-- Leave --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Leave
                </p>

                <h3 class="text-2xl font-bold text-purple-600 mt-1">
                    {{ $leave }}
                </h3>

            </div>


            {{-- Percentage --}}

            <div class="bg-white rounded-xl shadow-sm
                        border border-slate-200 p-4">

                <p class="text-xs text-slate-500">
                    Attendance
                </p>

                <h3 class="text-2xl font-bold text-blue-600 mt-1">
                    {{ number_format($attendancePercentage, 2) }}%
                </h3>

            </div>

        </div>


        {{-- =====================================================
            Attendance Table
        ====================================================== --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200 overflow-hidden">

            <div class="p-3 sm:p-5
                        border-b border-slate-200">

                <h2 class="text-base sm:text-lg
                           font-semibold text-slate-800">

                    Attendance History

                </h2>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">

                    Date-wise attendance records

                </p>

            </div>


            <div class="overflow-x-auto">

                <table class="w-full text-xs sm:text-sm
                              min-w-[850px]">

                    <thead class="bg-slate-50
                                  border-b border-slate-200">

                        <tr>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                #
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Date
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Branch
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Class
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Section
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Status
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                In Time
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Out Time
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Remarks
                            </th>

                            <th class="px-3 sm:px-4 py-3 text-left">
                                Action
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @forelse($attendances as $attendance)

                            <tr class="hover:bg-slate-50 transition">

                                <td class="px-3 sm:px-4 py-3">

                                    {{ $loop->iteration }}

                                </td>


                                <td class="px-3 sm:px-4 py-3
                                           font-medium text-slate-700">

                                    {{ $attendance->date?->format('d M Y') }}

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    {{ $attendance->branch->name ?? 'N/A' }}

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    {{ $attendance->schoolClass->name ?? 'N/A' }}

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    {{ $attendance->section->name ?? 'N/A' }}

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    @if($attendance->status === 'present')

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-green-50
                                                     text-green-700
                                                     border border-green-200">

                                            Present

                                        </span>

                                    @elseif($attendance->status === 'absent')

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-red-50
                                                     text-red-700
                                                     border border-red-200">

                                            Absent

                                        </span>

                                    @elseif($attendance->status === 'late')

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-yellow-50
                                                     text-yellow-700
                                                     border border-yellow-200">

                                            Late

                                        </span>

                                    @elseif($attendance->status === 'leave')

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-purple-50
                                                     text-purple-700
                                                     border border-purple-200">

                                            Leave

                                        </span>

                                    @else

                                        <span class="inline-flex
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-slate-100
                                                     text-slate-700">

                                            {{ ucfirst($attendance->status) }}

                                        </span>

                                    @endif

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    {{ $attendance->in_time
                                        ? \Carbon\Carbon::parse($attendance->in_time)->format('h:i A')
                                        : '—'
                                    }}

                                </td>


                                <td class="px-3 sm:px-4 py-3">

                                    {{ $attendance->out_time
                                        ? \Carbon\Carbon::parse($attendance->out_time)->format('h:i A')
                                        : '—'
                                    }}

                                </td>


                                <td class="px-3 sm:px-4 py-3
                                           text-slate-500">

                                    {{ $attendance->remarks ?: '—' }}

                                </td>
                                <td class="px-3 sm:px-4 py-3">

                                    <a href="{{ route(
                                        'admin.attendance.edit',
                                        $attendance->id
                                    ) }}"
                                    class="inline-flex items-center justify-center
                                            w-9 h-9 rounded-lg
                                            bg-blue-50 text-blue-600
                                            hover:bg-blue-100 transition"
                                    title="Edit Attendance">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9"
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

    @else

        {{-- =====================================================
            Empty Initial State
        ====================================================== --}}

        <div class="bg-white rounded-xl shadow-sm
                    border border-slate-200
                    p-8 sm:p-12">

            <div class="flex flex-col items-center text-center">

                <div class="w-16 h-16 rounded-full
                            bg-blue-50
                            flex items-center justify-center mb-4">

                    <i class="bi bi-person-lines-fill
                              text-3xl text-blue-600"></i>

                </div>

                <h2 class="text-base sm:text-lg
                           font-semibold text-slate-800">

                    Select a Student

                </h2>

                <p class="text-xs sm:text-sm
                          text-slate-500 mt-1 max-w-md">

                    Select a student from the filter above
                    to view their complete attendance history.

                </p>

            </div>

        </div>

    @endif

</div>

@endsection