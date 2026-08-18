@extends('admin.layouts.app')

@section('title', 'Enrollment History')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm text-slate-500">

                <a
                    href="{{ route('admin.students.show', $student) }}"
                    class="hover:text-blue-600"
                >
                    Student
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Enrollment History
                </span>

            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                Enrollment History
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View {{ $student->name }}'s complete academic enrollment history.
            </p>

        </div>


        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.students.show', $student) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       border border-slate-200 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-700 hover:bg-slate-50"
            >
                Back to Student
            </a>


            <a
                href="{{ route('admin.students.enrollments.create', $student) }}"
                class="inline-flex items-center justify-center gap-2 rounded-xl
                       bg-blue-600 px-4 py-2.5 text-sm font-semibold
                       text-white hover:bg-blue-700"
            >

                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 4v16m8-8H4"
                    />
                </svg>

                Enroll / Promote

            </a>

        </div>

    </div>


    {{-- Success --}}
    @if(session('success'))

        <div class="rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700">
            {{ session('success') }}
        </div>

    @endif


    {{-- Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <p class="font-semibold text-red-700">
                Please check the following:
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Student Current Information --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Current Academic Information
            </h2>

        </div>


        <div class="grid grid-cols-2 gap-4 p-5 md:grid-cols-5">

            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Student
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->name }}
                </p>

            </div>


            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Student ID
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->student_id }}
                </p>

            </div>


            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Branch
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->branch?->name ?? 'N/A' }}
                </p>

            </div>


            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Class
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->schoolClass?->name ?? 'N/A' }}
                </p>

            </div>


            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Section / Roll
                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    {{ $student->section?->name ?? '-' }}

                    /

                    {{ $student->roll_no ?? '-' }}

                </p>

            </div>

        </div>

    </div>


    {{-- Desktop --}}
    <div class="hidden overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm lg:block">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-slate-50">

                    <tr>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Session
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Branch
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Class
                        </th>

                        <th class="px-5 py-3 text-left text-xs font-semibold uppercase text-slate-500">
                            Section
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase text-slate-500">
                            Roll
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase text-slate-500">
                            Date
                        </th>

                        <th class="px-5 py-3 text-center text-xs font-semibold uppercase text-slate-500">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right text-xs font-semibold uppercase text-slate-500">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($enrollments as $enrollment)

                        <tr class="hover:bg-slate-50">

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $enrollment->academicSession?->name ?? 'N/A' }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $enrollment->branch?->name ?? 'N/A' }}
                            </td>

                            <td class="px-5 py-4 text-sm font-semibold text-slate-700">
                                {{ $enrollment->schoolClass?->name ?? 'N/A' }}
                            </td>

                            <td class="px-5 py-4 text-sm text-slate-700">
                                {{ $enrollment->section?->name ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-center text-sm font-semibold">
                                {{ $enrollment->roll_no ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-center text-sm text-slate-600">
                                {{ $enrollment->enrollment_date?->format('d M Y') ?? '-' }}
                            </td>

                            <td class="px-5 py-4 text-center">

                                @php

                                    $statusClasses = [

                                        'active' =>
                                            'bg-emerald-50 text-emerald-700 border-emerald-200',

                                        'completed' =>
                                            'bg-blue-50 text-blue-700 border-blue-200',

                                        'transferred' =>
                                            'bg-amber-50 text-amber-700 border-amber-200',

                                        'inactive' =>
                                            'bg-slate-50 text-slate-600 border-slate-200',

                                    ];

                                @endphp

                                <span
                                    class="inline-flex rounded-full border px-2.5 py-1
                                           text-xs font-semibold
                                           {{ $statusClasses[$enrollment->status] ?? '' }}"
                                >
                                    {{ ucfirst($enrollment->status) }}
                                </span>

                            </td>


                            <td class="px-5 py-4">

                                <div class="flex justify-end gap-2">

                                    <a
                                        href="{{ route(
                                            'admin.students.enrollments.show',
                                            [$student, $enrollment]
                                        ) }}"
                                        class="rounded-lg border border-slate-200 px-3 py-2
                                               text-xs font-semibold text-slate-700 hover:bg-slate-50"
                                    >
                                        View
                                    </a>


                                    <a
                                        href="{{ route(
                                            'admin.students.enrollments.edit',
                                            [$student, $enrollment]
                                        ) }}"
                                        class="rounded-lg bg-blue-600 px-3 py-2
                                               text-xs font-semibold text-white hover:bg-blue-700"
                                    >
                                        Edit
                                    </a>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="px-5 py-14 text-center">

                                <p class="font-semibold text-slate-700">
                                    No enrollment history found.
                                </p>

                                <p class="mt-1 text-sm text-slate-500">
                                    Create the student's first enrollment.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>


    {{-- Mobile --}}
    <div class="space-y-4 lg:hidden">

        @forelse($enrollments as $enrollment)

            <div class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm">

                <div class="flex items-start justify-between">

                    <div>

                        <p class="font-semibold text-slate-800">
                            {{ $enrollment->schoolClass?->name ?? 'N/A' }}
                        </p>

                        <p class="text-sm text-slate-500">
                            {{ $enrollment->academicSession?->name ?? 'N/A' }}
                        </p>

                    </div>


                    <span class="rounded-full border px-2.5 py-1 text-xs font-semibold">

                        {{ ucfirst($enrollment->status) }}

                    </span>

                </div>


                <div class="mt-4 grid grid-cols-2 gap-3">

                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Branch
                        </p>

                        <p class="mt-1 text-sm font-semibold">
                            {{ $enrollment->branch?->name ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Section
                        </p>

                        <p class="mt-1 text-sm font-semibold">
                            {{ $enrollment->section?->name ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Roll
                        </p>

                        <p class="mt-1 text-sm font-semibold">
                            {{ $enrollment->roll_no ?? '-' }}
                        </p>

                    </div>


                    <div class="rounded-xl bg-slate-50 p-3">

                        <p class="text-xs text-slate-500">
                            Enrollment Date
                        </p>

                        <p class="mt-1 text-sm font-semibold">
                            {{ $enrollment->enrollment_date?->format('d M Y') ?? '-' }}
                        </p>

                    </div>

                </div>


                <div class="mt-4 flex gap-2 border-t border-slate-100 pt-4">

                    <a
                        href="{{ route(
                            'admin.students.enrollments.show',
                            [$student, $enrollment]
                        ) }}"
                        class="flex-1 rounded-xl border border-slate-200
                               px-3 py-2.5 text-center text-sm font-semibold"
                    >
                        View
                    </a>


                    <a
                        href="{{ route(
                            'admin.students.enrollments.edit',
                            [$student, $enrollment]
                        ) }}"
                        class="flex-1 rounded-xl bg-blue-600
                               px-3 py-2.5 text-center text-sm font-semibold text-white"
                    >
                        Edit
                    </a>

                </div>

            </div>

        @empty

            <div class="rounded-2xl border border-slate-200 bg-white p-10 text-center">

                <p class="font-semibold text-slate-700">
                    No enrollment history found.
                </p>

            </div>

        @endforelse

    </div>

</div>

@endsection