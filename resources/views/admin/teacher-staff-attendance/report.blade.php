@extends('admin.layouts.app')

@section('title', 'Teacher & Staff Attendance Report')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Teacher & Staff Attendance Report
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View and filter teacher and staff attendance records.
            </p>
        </div>

        <a href="{{ route('admin.teacher-staff-attendance.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

            <i class="bi bi-calendar-check"></i>
            Daily Attendance

        </a>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="rounded-xl border border-green-200 bg-green-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <i class="bi bi-check-circle-fill text-green-600"></i>

                <p class="text-sm font-medium text-green-800">
                    {{ session('success') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Error --}}
    @if(session('error'))

        <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <i class="bi bi-exclamation-circle-fill text-red-600"></i>

                <p class="text-sm font-medium text-red-800">
                    {{ session('error') }}
                </p>

            </div>

        </div>

    @endif


    {{-- Filter Card --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-funnel text-lg"></i>

                </div>

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Attendance Filters
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Filter attendance by employee, date and status.
                    </p>

                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.teacher-staff-attendance.report') }}"
              class="p-5">

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5">

                {{-- Date --}}
                <div>

                    <label for="date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Date

                    </label>

                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="{{ request('date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>


                {{-- From Date --}}
                <div>

                    <label for="from_date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        From Date

                    </label>

                    <input
                        type="date"
                        id="from_date"
                        name="from_date"
                        value="{{ request('from_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>


                {{-- To Date --}}
                <div>

                    <label for="to_date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        To Date

                    </label>

                    <input
                        type="date"
                        id="to_date"
                        name="to_date"
                        value="{{ request('to_date') }}"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>


                {{-- Teacher / Staff --}}
                <div>

                    <label for="teacher_staff_id"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Teacher / Staff

                    </label>

                    <select
                        id="teacher_staff_id"
                        name="teacher_staff_id"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            All Teacher / Staff
                        </option>

                        @foreach($teacherStaff ?? [] as $staff)

                            <option
                                value="{{ $staff->id }}"
                                {{ request('teacher_staff_id') == $staff->id ? 'selected' : '' }}>

                                {{ $staff->name }}

                                @if($staff->employee_id)
                                    — {{ $staff->employee_id }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label for="status"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Status

                    </label>

                    <select
                        id="status"
                        name="status"
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            All Status
                        </option>

                        <option value="present"
                            {{ request('status') === 'present' ? 'selected' : '' }}>
                            Present
                        </option>

                        <option value="late"
                            {{ request('status') === 'late' ? 'selected' : '' }}>
                            Late
                        </option>

                        <option value="absent"
                            {{ request('status') === 'absent' ? 'selected' : '' }}>
                            Absent
                        </option>

                        <option value="leave"
                            {{ request('status') === 'leave' ? 'selected' : '' }}>
                            Leave
                        </option>

                    </select>

                </div>

            </div>


            {{-- Buttons --}}
            <div class="mt-5 flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

                <a href="{{ route('admin.teacher-staff-attendance.report') }}"
                   class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-arrow-counterclockwise"></i>
                    Reset

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    <i class="bi bi-search"></i>
                    Apply Filter

                </button>

            </div>

        </form>

    </div>


    {{-- Summary --}}
    <div class="grid grid-cols-2 gap-4 lg:grid-cols-4">

        {{-- Total --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Total
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $totalAttendance }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-slate-100 text-slate-600">

                    <i class="bi bi-calendar-check text-lg"></i>

                </div>

            </div>

        </div>


        {{-- Present --}}
        <div class="rounded-xl border border-green-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-green-600">
                        Present
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-700">
                        {{ $presentCount }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-green-50 text-green-600">

                    <i class="bi bi-check-circle text-lg"></i>

                </div>

            </div>

        </div>


        {{-- Late --}}
        <div class="rounded-xl border border-yellow-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-yellow-600">
                        Late
                    </p>

                    <p class="mt-2 text-2xl font-bold text-yellow-700">
                        {{ $lateCount }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-yellow-50 text-yellow-600">

                    <i class="bi bi-clock-history text-lg"></i>

                </div>

            </div>

        </div>


        {{-- Absent --}}
        <div class="rounded-xl border border-red-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>

                    <p class="text-xs font-medium uppercase tracking-wide text-red-600">
                        Absent
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-700">
                        {{ $absentCount }}
                    </p>

                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-red-50 text-red-600">

                    <i class="bi bi-x-circle text-lg"></i>

                </div>

            </div>

        </div>

    </div>


    {{-- Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Teacher & Staff Attendance
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Detailed attendance records.
                    </p>

                </div>

                <span class="text-xs font-medium text-slate-500">

                    {{ $attendances->total() }} Records

                </span>

            </div>

        </div>


        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            #
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Teacher / Staff
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Employee ID
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Branch
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Date
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Status
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                            In Time
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-center text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Out Time
                        </th>

                        <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wide text-slate-500">
                            Remarks
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100 bg-white">

                    @forelse($attendances as $attendance)

                        <tr class="transition hover:bg-slate-50">

                            {{-- # --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">

                                {{ $attendances->firstItem() + $loop->index }}

                            </td>


                            {{-- Name --}}
                            <td class="whitespace-nowrap px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-blue-50 text-sm font-bold text-blue-600">

                                        {{ strtoupper(substr($attendance->teacherStaff?->name ?? 'N', 0, 1)) }}

                                    </div>

                                    <div>

                                        <p class="text-sm font-semibold text-slate-800">

                                            {{ $attendance->teacherStaff?->name ?? 'N/A' }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Employee ID --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">

                                {{ $attendance->teacherStaff?->employee_id ?? '—' }}

                            </td>


                            {{-- Branch --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-600">

                                {{ $attendance->branch?->name ?? '—' }}

                            </td>


                            {{-- Date --}}
                            <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-700">

                                {{ $attendance->date?->format('d M Y') ?? '—' }}

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-5 py-4 text-center">

                                @php
                                    $status = strtolower($attendance->status);
                                @endphp

                                @if($status === 'present')

                                    <span class="inline-flex items-center gap-1 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">

                                        <i class="bi bi-check-circle-fill"></i>
                                        Present

                                    </span>

                                @elseif($status === 'late')

                                    <span class="inline-flex items-center gap-1 rounded-full bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-700">

                                        <i class="bi bi-clock-fill"></i>
                                        Late

                                    </span>

                                @elseif($status === 'absent')

                                    <span class="inline-flex items-center gap-1 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">

                                        <i class="bi bi-x-circle-fill"></i>
                                        Absent

                                    </span>

                                @elseif($status === 'leave')

                                    <span class="inline-flex items-center gap-1 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">

                                        <i class="bi bi-calendar-minus-fill"></i>
                                        Leave

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">

                                        {{ ucfirst($attendance->status) }}

                                    </span>

                                @endif

                            </td>


                            {{-- In --}}
                            <td class="whitespace-nowrap px-5 py-4 text-center text-sm text-slate-700">

                                {{ $attendance->in_time
                                    ? \Carbon\Carbon::parse($attendance->in_time)->format('h:i A')
                                    : '—' }}

                            </td>


                            {{-- Out --}}
                            <td class="whitespace-nowrap px-5 py-4 text-center text-sm text-slate-700">

                                {{ $attendance->out_time
                                    ? \Carbon\Carbon::parse($attendance->out_time)->format('h:i A')
                                    : '—' }}

                            </td>


                            {{-- Remarks --}}
                            <td class="max-w-xs px-5 py-4 text-sm text-slate-600">

                                {{ $attendance->remarks ?: '—' }}

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="9" class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center justify-center">

                                    <div class="flex h-14 w-14 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                                        <i class="bi bi-calendar-x text-2xl"></i>

                                    </div>

                                    <h3 class="mt-4 text-sm font-semibold text-slate-700">

                                        No attendance records found

                                    </h3>

                                    <p class="mt-1 text-xs text-slate-500">

                                        Try changing your filters.

                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($attendances->hasPages())

            <div class="border-t border-slate-200 px-5 py-4">

                {{ $attendances->withQueryString()->links() }}

            </div>

        @endif

    </div>

</div>

@endsection