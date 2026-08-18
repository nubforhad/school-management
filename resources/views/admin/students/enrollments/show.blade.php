@extends('admin.layouts.app')

@section('title', 'Enrollment Details')

@section('content')

<div class="mx-auto max-w-5xl space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Enrollment Details
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Academic enrollment information.
            </p>

        </div>


        <a
            href="{{ route('admin.students.enrollments.index', $student) }}"
            class="rounded-xl border border-slate-200 bg-white px-4 py-2.5
                   text-sm font-semibold text-slate-700 hover:bg-slate-50"
        >
            Back
        </a>

    </div>


    {{-- Student --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Student
            </h2>

        </div>


        <div class="grid grid-cols-2 gap-4 p-5 md:grid-cols-3">

            <div>
                <p class="text-xs text-slate-500">
                    Name
                </p>

                <p class="mt-1 font-semibold">
                    {{ $student->name }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Student ID
                </p>

                <p class="mt-1 font-semibold">
                    {{ $student->student_id }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Admission No
                </p>

                <p class="mt-1 font-semibold">
                    {{ $student->admission_no }}
                </p>
            </div>

        </div>

    </div>


    {{-- Enrollment --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Enrollment Information
            </h2>

        </div>


        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2">

            <div>
                <p class="text-xs text-slate-500">
                    Branch
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->branch?->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Academic Session
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->academicSession?->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Class
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->schoolClass?->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Section
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->section?->name ?? '-' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Roll Number
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->roll_no ?? '-' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Enrollment Date
                </p>

                <p class="mt-1 font-semibold">
                    {{ $enrollment->enrollment_date?->format('d M Y') ?? '-' }}
                </p>
            </div>


            <div>

                <p class="text-xs text-slate-500">
                    Status
                </p>

                <p class="mt-1 font-semibold">
                    {{ ucfirst($enrollment->status) }}
                </p>

            </div>


            <div class="sm:col-span-2">

                <p class="text-xs text-slate-500">
                    Remarks
                </p>

                <p class="mt-1 text-sm leading-6 text-slate-700">
                    {{ $enrollment->remarks ?? 'No remarks.' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Actions --}}
    <div class="flex justify-end gap-3">

        <a
            href="{{ route(
                'admin.students.enrollments.edit',
                [$student, $enrollment]
            ) }}"
            class="rounded-xl bg-blue-600 px-5 py-2.5
                   text-sm font-semibold text-white hover:bg-blue-700"
        >
            Edit Enrollment
        </a>

    </div>

</div>

@endsection