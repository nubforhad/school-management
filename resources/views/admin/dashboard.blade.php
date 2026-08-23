@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')

<div class="w-full space-y-6">


    {{-- ============================================================
         HEADER
    ============================================================= --}}

    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>

            <p class="text-sm font-medium text-blue-600">
                {{ now()->format('l, d F Y') }}
            </p>

            <h1 class="mt-1 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Dashboard
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Welcome back. Here's what's happening today.
            </p>

        </div>


        {{-- Branch --}}
        @if($branch)

            <div class="flex items-center gap-3 rounded-2xl border
                        border-slate-200 bg-white px-4 py-3 shadow-sm">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-xl bg-blue-50 text-blue-600">

                    🏫

                </div>

                <div>

                    <p class="text-[11px] font-medium uppercase tracking-wide text-slate-400">
                        Current Branch
                    </p>

                    <p class="text-sm font-bold text-slate-900">
                        {{ $branch->name }}
                    </p>

                </div>

            </div>

        @endif

    </div>



    {{-- ============================================================
         MAIN STAT CARDS
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">


        {{-- Students --}}
        <div class="rounded-2xl border border-slate-200 bg-white
                    p-5 shadow-sm transition hover:-translate-y-0.5
                    hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Total Students
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalStudents) }}
                    </h2>

                    <p class="mt-2 text-xs text-green-600">
                        {{ number_format($activeStudents) }} Active
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-blue-50 text-2xl">

                    👨‍🎓

                </div>

            </div>

        </div>


        {{-- Teachers --}}
        <div class="rounded-2xl border border-slate-200 bg-white
                    p-5 shadow-sm transition hover:-translate-y-0.5
                    hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Teachers / Staff
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalTeachers) }}
                    </h2>

                    <p class="mt-2 text-xs text-green-600">
                        {{ number_format($activeTeachers) }} Active
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-purple-50 text-2xl">

                    👨‍🏫

                </div>

            </div>

        </div>


        {{-- Classes --}}
        <div class="rounded-2xl border border-slate-200 bg-white
                    p-5 shadow-sm transition hover:-translate-y-0.5
                    hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Classes
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalClasses) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-500">
                        {{ number_format($totalSections) }} Sections
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-amber-50 text-2xl">

                    📚

                </div>

            </div>

        </div>


        {{-- Subjects --}}
        <div class="rounded-2xl border border-slate-200 bg-white
                    p-5 shadow-sm transition hover:-translate-y-0.5
                    hover:shadow-md">

            <div class="flex items-start justify-between">

                <div>

                    <p class="text-sm font-medium text-slate-500">
                        Subjects
                    </p>

                    <h2 class="mt-2 text-3xl font-bold text-slate-900">
                        {{ number_format($totalSubjects) }}
                    </h2>

                    <p class="mt-2 text-xs text-slate-500">
                        Active subjects
                    </p>

                </div>

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-green-50 text-2xl">

                    📖

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
         ATTENDANCE
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">


        {{-- Student Attendance --}}
        <div class="rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <div class="flex items-center justify-between
                        border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="font-bold text-slate-900">
                        Student Attendance
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Today's attendance summary
                    </p>

                </div>

                <span class="rounded-lg bg-blue-50 px-3 py-1.5
                             text-xs font-semibold text-blue-700">

                    Today

                </span>

            </div>


            <div class="grid grid-cols-2 gap-4 p-5 sm:grid-cols-4">

                {{-- Present --}}
                <div class="rounded-xl bg-green-50 p-4 text-center">

                    <p class="text-2xl font-bold text-green-700">
                        {{ number_format($todayStudentAttendance['present']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-green-600">
                        Present
                    </p>

                </div>


                {{-- Absent --}}
                <div class="rounded-xl bg-red-50 p-4 text-center">

                    <p class="text-2xl font-bold text-red-700">
                        {{ number_format($todayStudentAttendance['absent']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-red-600">
                        Absent
                    </p>

                </div>


                {{-- Late --}}
                <div class="rounded-xl bg-amber-50 p-4 text-center">

                    <p class="text-2xl font-bold text-amber-700">
                        {{ number_format($todayStudentAttendance['late']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-amber-600">
                        Late
                    </p>

                </div>


                {{-- Leave --}}
                <div class="rounded-xl bg-purple-50 p-4 text-center">

                    <p class="text-2xl font-bold text-purple-700">
                        {{ number_format($todayStudentAttendance['leave']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-purple-600">
                        Leave
                    </p>

                </div>

            </div>

        </div>



        {{-- Teacher Attendance --}}
        <div class="rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <div class="flex items-center justify-between
                        border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="font-bold text-slate-900">
                        Teacher Attendance
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Today's attendance summary
                    </p>

                </div>

                <span class="rounded-lg bg-purple-50 px-3 py-1.5
                             text-xs font-semibold text-purple-700">

                    Today

                </span>

            </div>


            <div class="grid grid-cols-2 gap-4 p-5 sm:grid-cols-4">

                <div class="rounded-xl bg-green-50 p-4 text-center">

                    <p class="text-2xl font-bold text-green-700">
                        {{ number_format($todayTeacherAttendance['present']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-green-600">
                        Present
                    </p>

                </div>


                <div class="rounded-xl bg-red-50 p-4 text-center">

                    <p class="text-2xl font-bold text-red-700">
                        {{ number_format($todayTeacherAttendance['absent']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-red-600">
                        Absent
                    </p>

                </div>


                <div class="rounded-xl bg-amber-50 p-4 text-center">

                    <p class="text-2xl font-bold text-amber-700">
                        {{ number_format($todayTeacherAttendance['late']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-amber-600">
                        Late
                    </p>

                </div>


                <div class="rounded-xl bg-purple-50 p-4 text-center">

                    <p class="text-2xl font-bold text-purple-700">
                        {{ number_format($todayTeacherAttendance['leave']) }}
                    </p>

                    <p class="mt-1 text-xs font-semibold text-purple-600">
                        Leave
                    </p>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
         FINANCE
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">


        {{-- Today's Collection --}}
        <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-green-50 text-2xl">

                    💰

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Today's Collection
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-slate-900">

                        ৳ {{ number_format($todayCollection, 2) }}

                    </h2>

                </div>

            </div>

        </div>


        {{-- Total Collection --}}
        <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-blue-50 text-2xl">

                    💳

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Total Collection
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-slate-900">

                        ৳ {{ number_format($totalCollection, 2) }}

                    </h2>

                </div>

            </div>

        </div>


        {{-- Due --}}
        <div class="rounded-2xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-12 w-12 items-center justify-center
                            rounded-xl bg-red-50 text-2xl">

                    ⚠️

                </div>

                <div>

                    <p class="text-sm text-slate-500">
                        Total Due
                    </p>

                    <h2 class="mt-1 text-2xl font-bold text-red-600">

                        ৳ {{ number_format($totalDue, 2) }}

                    </h2>

                </div>

            </div>

        </div>

    </div>



    {{-- ============================================================
         RECENT DATA
    ============================================================= --}}

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-2">


        {{-- Recent Students --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <div class="flex items-center justify-between
                        border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="font-bold text-slate-900">
                        Recent Students
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Recently added students
                    </p>

                </div>

                <a
                    href=""
                    class="text-xs font-semibold text-blue-600 hover:text-blue-700">

                    View All →

                </a>

            </div>


            <div class="divide-y divide-slate-100">

                @forelse($recentStudents as $student)

                    <div class="flex items-center gap-3 px-5 py-4">

                        <div class="flex h-10 w-10 shrink-0 items-center
                                    justify-center rounded-full bg-blue-50
                                    font-bold text-blue-600">

                            {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="truncate text-sm font-semibold text-slate-900">

                                {{ $student->name ?? 'Student' }}

                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">

                                ID:
                                {{ $student->student_id ?? $student->id }}

                            </p>

                        </div>


                        <span class="text-xs text-slate-400">

                            {{ $student->created_at?->format('d M') }}

                        </span>

                    </div>

                @empty

                    <div class="px-5 py-10 text-center">

                        <p class="text-sm text-slate-500">
                            No students found.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>



        {{-- Recent Payments --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

            <div class="flex items-center justify-between
                        border-b border-slate-100 px-5 py-4">

                <div>

                    <h2 class="font-bold text-slate-900">
                        Recent Payments
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Latest fee collections
                    </p>

                </div>

                <a
                    href=""
                    class="text-xs font-semibold text-blue-600 hover:text-blue-700">

                    View All →

                </a>

            </div>


            <div class="divide-y divide-slate-100">

                @forelse($recentPayments as $payment)

                    <div class="flex items-center gap-3 px-5 py-4">

                        <div class="flex h-10 w-10 shrink-0 items-center
                                    justify-center rounded-xl bg-green-50
                                    text-green-600">

                            ৳

                        </div>


                        <div class="min-w-0 flex-1">

                            <p class="text-sm font-semibold text-slate-900">

                                Payment

                            </p>

                            <p class="mt-0.5 text-xs text-slate-500">

                                {{ $payment->payment_date
                                    ? \Carbon\Carbon::parse($payment->payment_date)->format('d M Y')
                                    : $payment->created_at?->format('d M Y') }}

                            </p>

                        </div>


                        <p class="text-sm font-bold text-green-600">

                            ৳ {{ number_format($payment->amount ?? 0, 2) }}

                        </p>

                    </div>

                @empty

                    <div class="px-5 py-10 text-center">

                        <p class="text-sm text-slate-500">
                            No payments found.
                        </p>

                    </div>

                @endforelse

            </div>

        </div>

    </div>



    {{-- ============================================================
         QUICK ACTIONS
    ============================================================= --}}

    <div class="rounded-2xl border border-slate-200 bg-white
                p-5 shadow-sm sm:p-6">

        <div class="mb-5">

            <h2 class="font-bold text-slate-900">
                Quick Actions
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                Frequently used modules
            </p>

        </div>


        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">


            <a
                href=""
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    👨‍🎓
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Add Student

                </p>

            </a>


            <a
                href="{{ route('admin.academic.class-subjects.create') }}"
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    📚
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Assign Subject

                </p>

            </a>


            <a
                href="{{ route('admin.academic.subjects.create') }}"
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    📖
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Add Subject

                </p>

            </a>


            <a
                href="{{ route('admin.academic.classes.create') }}"
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    🏫
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Add Class

                </p>

            </a>


            <a
                href="{{ route('admin.academic.sections.create') }}"
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    🧑‍🤝‍🧑
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Add Section

                </p>

            </a>


            <a
                href=""
                class="group rounded-xl border border-slate-200
                       p-4 text-center transition hover:border-blue-300
                       hover:bg-blue-50">

                <div class="text-2xl">
                    📊
                </div>

                <p class="mt-2 text-xs font-semibold text-slate-700
                          group-hover:text-blue-700">

                    Dashboard

                </p>

            </a>

        </div>

    </div>

</div>

@endsection