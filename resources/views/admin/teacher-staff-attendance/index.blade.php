@extends('admin.layouts.app')

@section('title', 'Teacher & Staff Attendance')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Teacher & Staff Attendance
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Manage daily attendance of teachers and staff.
            </p>
        </div>

        <a href="{{ route('admin.teacher-staff-attendance.create') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

            <i class="bi bi-plus-lg"></i>

            Mark Attendance

        </a>

    </div>


    {{-- Success Message --}}
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


    {{-- Error Message --}}
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


    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-5">

        {{-- Total --}}
        <div class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Total
                    </p>

                    <p class="mt-2 text-2xl font-bold text-slate-800">
                        {{ $summary['total'] ?? 0 }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-slate-100 text-slate-600">
                    <i class="bi bi-people text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Present --}}
        <div class="rounded-xl border border-green-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Present
                    </p>

                    <p class="mt-2 text-2xl font-bold text-green-600">
                        {{ $summary['present'] ?? 0 }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-green-50 text-green-600">
                    <i class="bi bi-check-circle text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Late --}}
        <div class="rounded-xl border border-yellow-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Late
                    </p>

                    <p class="mt-2 text-2xl font-bold text-yellow-600">
                        {{ $summary['late'] ?? 0 }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-yellow-50 text-yellow-600">
                    <i class="bi bi-clock text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Absent --}}
        <div class="rounded-xl border border-red-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Absent
                    </p>

                    <p class="mt-2 text-2xl font-bold text-red-600">
                        {{ $summary['absent'] ?? 0 }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-red-50 text-red-600">
                    <i class="bi bi-x-circle text-xl"></i>
                </div>

            </div>

        </div>


        {{-- Leave --}}
        <div class="rounded-xl border border-blue-200 bg-white p-5 shadow-sm">

            <div class="flex items-center justify-between">

                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-slate-500">
                        Leave
                    </p>

                    <p class="mt-2 text-2xl font-bold text-blue-600">
                        {{ $summary['leave'] ?? 0 }}
                    </p>
                </div>

                <div class="flex h-11 w-11 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-calendar-x text-xl"></i>
                </div>

            </div>

        </div>

    </div>


    {{-- Filter Card --}}
    <div class="rounded-xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-9 w-9 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-funnel"></i>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Filter Attendance
                    </h2>

                    <p class="text-xs text-slate-500">
                        Search and filter attendance records.
                    </p>
                </div>

            </div>

        </div>


        <form method="GET" class="p-5">

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6">

                {{-- Search --}}
                <div class="xl:col-span-2">

                    <label for="search"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Search

                    </label>

                    <div class="relative">

                        <i class="bi bi-search absolute left-3 top-1/2 -translate-y-1/2 text-slate-400"></i>

                        <input
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Name or Employee ID"
                            class="w-full rounded-lg border border-slate-300 bg-white py-2.5 pl-10 pr-3 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    </div>

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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            All Employees
                        </option>

                        @foreach($teacherStaff as $staff)

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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

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
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                </div>

            </div>


            {{-- Filter Buttons --}}
            <div class="mt-5 flex flex-col gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.teacher-staff-attendance.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-arrow-counterclockwise"></i>

                    Reset

                </a>

                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="bi bi-funnel"></i>

                    Apply Filter

                </button>

            </div>

        </form>

    </div>


    {{-- Attendance Table --}}
    <div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-sm font-semibold text-slate-800">
                        Attendance Records
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Showing {{ $attendances->firstItem() ?? 0 }}
                        to {{ $attendances->lastItem() ?? 0 }}
                        of {{ $attendances->total() }} records
                    </p>

                </div>

                <div class="text-xs text-slate-500">

                    <i class="bi bi-calendar3 mr-1"></i>

                    Attendance History

                </div>

            </div>

        </div>


        @if($attendances->count())

            {{-- Responsive Table --}}
            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                #
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Teacher / Staff
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Date
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Status
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                In Time
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Out Time
                            </th>

                            <th class="whitespace-nowrap px-5 py-3 text-right text-xs font-semibold uppercase tracking-wider text-slate-500">
                                Actions
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-200 bg-white">

                        @foreach($attendances as $attendance)

                            <tr class="transition hover:bg-slate-50">

                                {{-- Serial --}}
                                <td class="whitespace-nowrap px-5 py-4 text-sm text-slate-500">

                                    {{ $attendances->firstItem() + $loop->index }}

                                </td>


                                {{-- Teacher Staff --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="flex items-center gap-3">

                                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-blue-50 text-blue-600">

                                            <i class="bi bi-person"></i>

                                        </div>

                                        <div>

                                            <p class="text-sm font-semibold text-slate-800">

                                                {{ $attendance->teacherStaff?->name ?? 'N/A' }}

                                            </p>

                                            @if($attendance->teacherStaff?->employee_id)

                                                <p class="mt-0.5 text-xs text-slate-500">

                                                    ID:
                                                    {{ $attendance->teacherStaff->employee_id }}

                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Date --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <p class="text-sm font-medium text-slate-700">

                                        {{ $attendance->date?->format('d M Y') }}

                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-400">

                                        {{ $attendance->date?->format('l') }}

                                    </p>

                                </td>


                                {{-- Status --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    @if($attendance->status === 'present')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-green-50 px-2.5 py-1 text-xs font-semibold text-green-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                            Present

                                        </span>

                                    @elseif($attendance->status === 'late')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-yellow-50 px-2.5 py-1 text-xs font-semibold text-yellow-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-yellow-500"></span>

                                            Late

                                        </span>

                                    @elseif($attendance->status === 'absent')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>

                                            Absent

                                        </span>

                                    @elseif($attendance->status === 'leave')

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-blue-50 px-2.5 py-1 text-xs font-semibold text-blue-700">

                                            <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                            Leave

                                        </span>

                                    @else

                                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">

                                            {{ ucfirst($attendance->status) }}

                                        </span>

                                    @endif

                                </td>


                                {{-- In Time --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    @if($attendance->in_time)

                                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-700">

                                            <i class="bi bi-box-arrow-in-right text-green-500"></i>

                                            {{ \Carbon\Carbon::parse($attendance->in_time)->format('h:i A') }}

                                        </span>

                                    @else

                                        <span class="text-sm text-slate-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Out Time --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    @if($attendance->out_time)

                                        <span class="inline-flex items-center gap-1.5 text-sm text-slate-700">

                                            <i class="bi bi-box-arrow-right text-red-500"></i>

                                            {{ \Carbon\Carbon::parse($attendance->out_time)->format('h:i A') }}

                                        </span>

                                    @else

                                        <span class="text-sm text-slate-400">
                                            —
                                        </span>

                                    @endif

                                </td>


                                {{-- Actions --}}
                                <td class="whitespace-nowrap px-5 py-4">

                                    <div class="flex items-center justify-end gap-2">

                                        {{-- View --}}
                                        <a
                                            href="{{ route('admin.teacher-staff-attendance.show', $attendance) }}"
                                            title="View"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-blue-200 hover:bg-blue-50 hover:text-blue-600">

                                            <i class="bi bi-eye"></i>

                                        </a>


                                        {{-- Edit --}}
                                        <a
                                            href="{{ route('admin.teacher-staff-attendance.edit', $attendance) }}"
                                            title="Edit"
                                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-green-200 hover:bg-green-50 hover:text-green-600">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>


                                        {{-- Delete --}}
                                        <form
                                            method="POST"
                                            action="{{ route('admin.teacher-staff-attendance.destroy', $attendance) }}"
                                            onsubmit="return confirm('Are you sure you want to delete this attendance record?');">

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Delete"
                                                class="inline-flex h-9 w-9 items-center justify-center rounded-lg border border-slate-200 bg-white text-slate-600 transition hover:border-red-200 hover:bg-red-50 hover:text-red-600">

                                                <i class="bi bi-trash3"></i>

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
            @if($attendances->hasPages())

                <div class="border-t border-slate-200 px-5 py-4">

                    {{ $attendances->links() }}

                </div>

            @endif

        @else

            {{-- Empty State --}}
            <div class="px-5 py-16 text-center">

                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-slate-100 text-slate-400">

                    <i class="bi bi-calendar-x text-2xl"></i>

                </div>

                <h3 class="mt-4 text-sm font-semibold text-slate-800">
                    No attendance records found
                </h3>

                <p class="mx-auto mt-1 max-w-md text-sm text-slate-500">
                    No attendance records match your current filters.
                    Try changing the filters or mark a new attendance.
                </p>

                <a
                    href="{{ route('admin.teacher-staff-attendance.create') }}"
                    class="mt-5 inline-flex items-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-blue-700">

                    <i class="bi bi-plus-lg"></i>

                    Mark Attendance

                </a>

            </div>

        @endif

    </div>

</div>

@endsection