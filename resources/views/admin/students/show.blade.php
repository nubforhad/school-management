@extends('admin.layouts.app')

@section('title', 'Student Profile')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Student Profile
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                View complete student information.
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.students.index') }}"
                class="inline-flex items-center gap-2 rounded-xl border border-slate-300
                       bg-white px-4 py-2.5 text-sm font-semibold text-slate-700
                       transition hover:bg-slate-50"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"
                    />
                </svg>

                Back
            </a>

            <a
                href="{{ route('admin.students.edit', $student) }}"
                class="inline-flex items-center gap-2 rounded-xl bg-blue-600
                       px-4 py-2.5 text-sm font-semibold text-white
                       transition hover:bg-blue-700"
            >
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                    />
                </svg>

                Edit Student
            </a>

        </div>

    </div>


    {{-- =========================================================
        STUDENT HERO CARD
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        {{-- Blue Header --}}
        <div class="bg-gradient-to-r from-blue-600 via-blue-700 to-indigo-700 px-5 py-7 sm:px-8">

            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">

                {{-- Student Photo --}}
                <div class="h-28 w-28 shrink-0 overflow-hidden rounded-2xl
                            border-4 border-white/30 bg-white shadow-lg">

                    @if(!empty($student->photo))

                        <img
                            src="{{ asset('storage/' . $student->photo) }}"
                            alt="{{ $student->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full w-full items-center justify-center
                                    bg-blue-50 text-4xl font-bold text-blue-600">

                            {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}

                        </div>

                    @endif

                </div>


                {{-- Student Main Info --}}
                <div class="min-w-0 flex-1 text-white">

                    <div class="flex flex-col gap-2 sm:flex-row sm:items-center">

                        <h2 class="truncate text-2xl font-bold">
                            {{ $student->name }}
                        </h2>

                        @if($student->status)

                            <span class="w-fit rounded-full bg-emerald-400/20
                                         px-3 py-1 text-xs font-semibold text-emerald-100">
                                Active
                            </span>

                        @else

                            <span class="w-fit rounded-full bg-red-400/20
                                         px-3 py-1 text-xs font-semibold text-red-100">
                                Inactive
                            </span>

                        @endif

                    </div>


                    @if(!empty($student->name_bn))

                        <p class="mt-1 text-sm text-blue-100">
                            {{ $student->name_bn }}
                        </p>

                    @endif


                    <div class="mt-4 flex flex-wrap gap-2">

                        <span class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium">
                            Student ID:
                            <strong>{{ $student->student_id }}</strong>
                        </span>

                        <span class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium">
                            Admission:
                            <strong>{{ $student->admission_no }}</strong>
                        </span>

                        <span class="rounded-lg bg-white/10 px-3 py-1.5 text-xs font-medium">
                            Roll:
                            <strong>{{ $student->roll_no ?? 'N/A' }}</strong>
                        </span>

                    </div>

                </div>

            </div>

        </div>


        {{-- Quick Information --}}
        <div class="grid grid-cols-2 divide-x divide-y border-t border-slate-200
                    sm:grid-cols-4 sm:divide-y-0">

            <div class="p-5">

                <p class="text-xs font-medium text-slate-500">
                    Branch
                </p>

                <p class="mt-1 truncate font-semibold text-slate-800">
                    {{ $student->branch->name ?? 'N/A' }}
                </p>

            </div>


            <div class="p-5">

                <p class="text-xs font-medium text-slate-500">
                    Class
                </p>

                <p class="mt-1 truncate font-semibold text-slate-800">
                    {{ $student->schoolClass->name ?? 'N/A' }}
                </p>

            </div>


            <div class="p-5">

                <p class="text-xs font-medium text-slate-500">
                    Section
                </p>

                <p class="mt-1 truncate font-semibold text-slate-800">
                    {{ $student->section->name ?? 'N/A' }}
                </p>

            </div>


            <div class="p-5">

                <p class="text-xs font-medium text-slate-500">
                    Session
                </p>

                <p class="mt-1 truncate font-semibold text-slate-800">
                    {{ $student->academicSession->name ?? 'N/A' }}
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        ACADEMIC INFORMATION
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">

                    <svg
                        class="h-5 w-5 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 14l9-5-9-5-9 5 9 5z"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M5 12v5c3 2 9 2 14 0v-5"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Academic Information
                    </h2>

                    <p class="text-xs text-slate-500">
                        Student academic and admission information
                    </p>

                </div>

            </div>

        </div>


        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 lg:grid-cols-4">

            <div>
                <p class="text-xs text-slate-500">
                    Branch
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->branch->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Academic Session
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->academicSession->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Class
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->schoolClass->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Section
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->section->name ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Admission No
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->admission_no }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Student ID
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->student_id }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Roll No
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->roll_no ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Admission Date
                </p>

                <p class="mt-1 font-semibold text-slate-800">

                    @if($student->admission_date)

                        {{ \Illuminate\Support\Carbon::parse($student->admission_date)->format('d M Y') }}

                    @else

                        N/A

                    @endif

                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        PERSONAL INFORMATION
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Personal Information
            </h2>

        </div>


        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 lg:grid-cols-3">

            <div>
                <p class="text-xs text-slate-500">
                    Full Name
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $student->name }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Bangla Name
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $student->name_bn ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Gender
                </p>

                <p class="mt-1 font-medium capitalize text-slate-800">
                    {{ $student->gender ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Date of Birth
                </p>

                <p class="mt-1 font-medium text-slate-800">

                    @if($student->date_of_birth)

                        {{ \Illuminate\Support\Carbon::parse($student->date_of_birth)->format('d M Y') }}

                    @else

                        N/A

                    @endif

                </p>

            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Blood Group
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $student->blood_group ?? 'N/A' }}
                </p>
            </div>


            <div>
                <p class="text-xs text-slate-500">
                    Religion
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $student->religion ?? 'N/A' }}
                </p>
            </div>

        </div>

    </div>


    {{-- =========================================================
        GUARDIAN INFORMATION
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100">

                    <svg
                        class="h-5 w-5 text-emerald-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 005.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Guardian Information
                    </h2>

                    <p class="text-xs text-slate-500">
                        Parent or guardian contact details
                    </p>

                </div>

            </div>

        </div>


        <div class="grid grid-cols-1 gap-5 p-5 sm:grid-cols-2 lg:grid-cols-3">

            <div>

                <p class="text-xs text-slate-500">
                    Guardian Name
                </p>

                <p class="mt-1 font-medium text-slate-800">
                    {{ $student->guardian_name ?? 'N/A' }}
                </p>

            </div>


            <div>

                <p class="text-xs text-slate-500">
                    Guardian Phone
                </p>

                @if(!empty($student->guardian_phone))

                    <a
                        href="tel:{{ $student->guardian_phone }}"
                        class="mt-1 inline-block font-medium text-blue-600 hover:underline"
                    >
                        {{ $student->guardian_phone }}
                    </a>

                @else

                    <p class="mt-1 font-medium text-slate-800">
                        N/A
                    </p>

                @endif

            </div>


            <div>

                <p class="text-xs text-slate-500">
                    Guardian Email
                </p>

                @if(!empty($student->guardian_email))

                    <a
                        href="mailto:{{ $student->guardian_email }}"
                        class="mt-1 inline-block break-all font-medium text-blue-600 hover:underline"
                    >
                        {{ $student->guardian_email }}
                    </a>

                @else

                    <p class="mt-1 font-medium text-slate-800">
                        N/A
                    </p>

                @endif

            </div>

        </div>

    </div>


    {{-- =========================================================
        ADDRESS
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Address
            </h2>

        </div>


        <div class="p-5">

            @if(!empty($student->address))

                <p class="whitespace-pre-line text-sm leading-7 text-slate-700">
                    {{ $student->address }}
                </p>

            @else

                <p class="text-sm text-slate-400">
                    No address available.
                </p>

            @endif

        </div>

    </div>


    {{-- =========================================================
        QUICK ACTIONS
    ========================================================== --}}
    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Quick Actions
            </h2>

        </div>


        <div class="grid grid-cols-2 gap-3 p-5 sm:grid-cols-4">

            <a
                href="{{ route('admin.students.edit', $student) }}"
                class="rounded-xl border border-slate-200 p-4 text-center
                       transition hover:border-blue-300 hover:bg-blue-50"
            >

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-blue-100">

                    <svg
                        class="h-5 w-5 text-blue-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.5-9.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 8.5-8.5z"
                        />
                    </svg>

                </div>

                <p class="mt-2 text-sm font-semibold text-slate-700">
                    Edit
                </p>

            </a>


            <a
                href="{{ route('admin.students.id-card', $student) }}"
                class="rounded-xl border border-slate-200 p-4 text-center
                       transition hover:border-purple-300 hover:bg-purple-50"
            >

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-purple-100">

                    <svg
                        class="h-5 w-5 text-purple-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 14l6-6m2.5-2.5a2.121 2.121 0 013 3L9 20H4v-5L15.5 3.5z"
                        />
                    </svg>

                </div>

                <p class="mt-2 text-sm font-semibold text-slate-700">
                    ID Card
                </p>

            </a>


            <a
                href="#"
                class="rounded-xl border border-slate-200 p-4 text-center
                       transition hover:border-emerald-300 hover:bg-emerald-50"
            >

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-100">

                    <svg
                        class="h-5 w-5 text-emerald-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 3c-2.755 0-5.29.93-7.31 2.493M5.31 5.493A11.955 11.955 0 004 12c0 1.657.337 3.236.949 4.659M18.69 18.507A11.955 11.955 0 0020 12c0-1.657-.337-3.236-.949-4.659"
                        />
                    </svg>

                </div>

                <p class="mt-2 text-sm font-semibold text-slate-700">
                    Attendance
                </p>

            </a>


            <a
                href="#"
                class="rounded-xl border border-slate-200 p-4 text-center
                       transition hover:border-amber-300 hover:bg-amber-50"
            >

                <div class="mx-auto flex h-10 w-10 items-center justify-center rounded-xl bg-amber-100">

                    <svg
                        class="h-5 w-5 text-amber-600"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"
                        />
                    </svg>

                </div>

                <p class="mt-2 text-sm font-semibold text-slate-700">
                    Fees
                </p>

            </a>

        </div>

    </div>


    {{-- Bottom Actions --}}
    <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

        <a
            href="{{ route('admin.students.index') }}"
            class="inline-flex items-center justify-center rounded-xl
                   border border-slate-300 bg-white px-6 py-3
                   text-sm font-semibold text-slate-700
                   hover:bg-slate-50"
        >
            Back to Students
        </a>

        <a
            href="{{ route('admin.students.edit', $student) }}"
            class="inline-flex items-center justify-center rounded-xl
                   bg-blue-600 px-6 py-3 text-sm font-semibold
                   text-white hover:bg-blue-700"
        >
            Edit Student
        </a>

    </div>

</div>

@endsection