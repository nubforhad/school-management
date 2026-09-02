@extends('admin.layouts.app')

@section('title', 'Attendance Details')

@section('content')

<div class="space-y-6">
 
{{-- Header --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

    <div>

        <h1 class="text-2xl font-bold text-slate-800">
            Attendance Details
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            View complete attendance information.
        </p>

    </div>


    <div class="flex flex-col gap-2 sm:flex-row">

        <a href="{{ route('admin.teacher-staff-attendance.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

            <i class="bi bi-arrow-left"></i>
            Back

        </a>


        <a href="{{ route('admin.teacher-staff-attendance.edit', $attendance) }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

            <i class="bi bi-pencil-square"></i>
            Edit

        </a>

    </div>

</div>


{{-- Main Card --}}
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">


    {{-- Card Header --}}
    <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

        <div class="flex items-center gap-3">

            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                <i class="bi bi-calendar-check text-lg"></i>

            </div>

            <div>

                <h2 class="text-sm font-semibold text-slate-800">
                    Attendance Information
                </h2>

                <p class="mt-0.5 text-xs text-slate-500">
                    Attendance record details.
                </p>

            </div>

        </div>

    </div>


    <div class="p-5">


        {{-- Employee --}}
        <div class="mb-6">

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-person-badge"></i>

                </div>

                <h3 class="text-sm font-semibold text-slate-800">
                    Teacher / Staff Information
                </h3>

            </div>


            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">


                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Name
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $attendance->teacherStaff?->name ?? 'N/A' }}
                    </p>

                </div>


                <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Employee ID
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $attendance->teacherStaff?->employee_id ?? 'N/A' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Attendance --}}
        <div class="mb-6">

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-calendar3"></i>

                </div>

                <h3 class="text-sm font-semibold text-slate-800">
                    Attendance Information
                </h3>

            </div>


            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">


                {{-- Date --}}
                <div class="rounded-lg border border-slate-200 bg-white p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Date
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $attendance->date?->format('d M Y') ?? 'N/A' }}

                    </p>

                </div>


                {{-- Status --}}
                <div class="rounded-lg border border-slate-200 bg-white p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Status
                    </p>


                    @php

                        $statusClasses = [

                            'present' =>
                                'bg-green-50 text-green-700 border-green-200',

                            'late' =>
                                'bg-yellow-50 text-yellow-700 border-yellow-200',

                            'absent' =>
                                'bg-red-50 text-red-700 border-red-200',

                            'leave' =>
                                'bg-blue-50 text-blue-700 border-blue-200',

                        ];

                        $class =
                            $statusClasses[$attendance->status]
                            ?? 'bg-slate-50 text-slate-700 border-slate-200';

                    @endphp


                    <span class="mt-2 inline-flex items-center rounded-full border px-2.5 py-1 text-xs font-semibold capitalize {{ $class }}">

                        {{ $attendance->status }}

                    </span>

                </div>


                {{-- In Time --}}
                <div class="rounded-lg border border-slate-200 bg-white p-4">

                    <p class="text-xs font-medium text-slate-500">
                        In Time
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $attendance->in_time
                            ? \Carbon\Carbon::parse($attendance->in_time)->format('h:i A')
                            : '—' }}

                    </p>

                </div>


                {{-- Out Time --}}
                <div class="rounded-lg border border-slate-200 bg-white p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Out Time
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $attendance->out_time
                            ? \Carbon\Carbon::parse($attendance->out_time)->format('h:i A')
                            : '—' }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Remarks --}}
        <div>

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-chat-left-text"></i>

                </div>

                <h3 class="text-sm font-semibold text-slate-800">
                    Remarks
                </h3>

            </div>


            <div class="rounded-lg border border-slate-200 bg-slate-50 p-4">

                <p class="whitespace-pre-line text-sm text-slate-700">

                    {{ $attendance->remarks ?: 'No remarks added.' }}

                </p>

            </div>

        </div>


    </div>

</div> 

</div>

@endsection
