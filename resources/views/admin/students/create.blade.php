@extends('admin.layouts.app')

@section('title', 'Add Student')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Add Student
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create a new student admission record.
            </p>
        </div>

        <a
            href="{{ route('admin.students.index') }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   border border-slate-300 bg-white px-5 py-2.5
                   text-sm font-semibold text-slate-700
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

            Back to Students
        </a>

    </div>


    {{-- =========================================================
        ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

            <div class="flex items-start gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-red-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.82 13a2 2 0 001.71 3h15.64a2 2 0 001.71-3l-7.82-13a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>

                    <h3 class="font-semibold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form
        method="POST"
        action="{{ route('admin.students.store') }}"
        enctype="multipart/form-data"
        class="space-y-6"
    >

        @csrf


        {{-- =====================================================
            ACADEMIC INFORMATION
        ====================================================== --}}
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
                            Branch, session, class and admission details
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2 lg:grid-cols-3">


                {{-- Branch --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Branch <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                @selected(old('branch_id') == $branch->id)
                            >
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Academic Session --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Academic Session <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="academic_session_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Session
                        </option>

                        @foreach($academicSessions as $session)

                            <option
                                value="{{ $session->id }}"
                                @selected(old('academic_session_id') == $session->id)
                            >
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('academic_session_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Class --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Class <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="class_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                @selected(old('class_id') == $class->id)
                            >
                                {{ $class->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('class_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Section --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Section
                    </label>

                    <select
                        name="section_id"
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                @selected(old('section_id') == $section->id)
                            >
                                {{ $section->name }}
                            </option>

                        @endforeach

                    </select>

                    @error('section_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Admission Number --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Admission No <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="admission_no"
                        value="{{ old('admission_no') }}"
                        required
                        placeholder="e.g. ADM-2026-001"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('admission_no')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Student ID --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Student ID <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="student_id"
                        value="{{ old('student_id') }}"
                        required
                        placeholder="e.g. STD-0001"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('student_id')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Roll --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Roll No
                    </label>

                    <input
                        type="text"
                        name="roll_no"
                        value="{{ old('roll_no') }}"
                        placeholder="e.g. 01"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('roll_no')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Admission Date --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Admission Date
                    </label>

                    <input
                        type="date"
                        name="admission_date"
                        value="{{ old('admission_date', date('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm text-slate-800
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('admission_date')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            PERSONAL INFORMATION
        ====================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-violet-100">

                        <svg
                            class="h-5 w-5 text-violet-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Personal Information
                        </h2>

                        <p class="text-xs text-slate-500">
                            Student's personal and basic information
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2 lg:grid-cols-3">


                {{-- Name --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Student Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        placeholder="Enter student name"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('name')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Bangla Name --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Student Name (Bangla)
                    </label>

                    <input
                        type="text"
                        name="name_bn"
                        value="{{ old('name_bn') }}"
                        placeholder="শিক্ষার্থীর নাম"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('name_bn')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Father's Name
                    </label>

                    <input
                        type="text"
                        name="father_name"
                        value="{{ old('father_name', $student->father_name ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm"
                        placeholder="Father's Name"
                    >
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Father's Name (Bangla)  
                    </label>

                    <input
                        type="text"
                        name="father_name_bn"
                        value="{{ old('father_name_bn', $student->father_name_bn ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm"
                        placeholder="পিতার নাম"
                    >
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Mother's Name
                    </label>

                    <input
                        type="text"
                        name="mother_name"
                        value="{{ old('mother_name', $student->mother_name ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm"
                        placeholder="Mother's Name"
                    >
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Mother's Name (Bangla)
                    </label>

                    <input
                        type="text"
                        name="mother_name_bn"
                        value="{{ old('mother_name_bn', $student->mother_name_bn ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm"
                        placeholder="মাতার নাম"
                    >
                </div>

                <div>
                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Birth Registration No.
                    </label>

                    <input
                        type="text"
                        name="birth_reg_no"
                        value="{{ old('birth_reg_no', $student->birth_reg_no ?? '') }}"
                        class="w-full rounded-xl border border-slate-300 bg-white px-4 py-2.5 text-sm"
                        placeholder="Birth Registration Number"
                    >
                </div>


                {{-- Gender --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Gender
                    </label>

                    <select
                        name="gender"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Gender
                        </option>

                        <option
                            value="male"
                            @selected(old('gender') === 'male')
                        >
                            Male
                        </option>

                        <option
                            value="female"
                            @selected(old('gender') === 'female')
                        >
                            Female
                        </option>

                        <option
                            value="other"
                            @selected(old('gender') === 'other')
                        >
                            Other
                        </option>

                    </select>

                </div>


                {{-- DOB --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Date of Birth
                    </label>

                    <input
                        type="date"
                        name="date_of_birth"
                        value="{{ old('date_of_birth') }}"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>


                {{-- Blood Group --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Blood Group
                    </label>

                    <select
                        name="blood_group"
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Blood Group
                        </option>

                        @foreach(['A+','A-','B+','B-','AB+','AB-','O+','O-'] as $blood)

                            <option
                                value="{{ $blood }}"
                                @selected(old('blood_group') === $blood)
                            >
                                {{ $blood }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Religion --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Religion
                    </label>

                    <input
                        type="text"
                        name="religion"
                        value="{{ old('religion') }}"
                        placeholder="Religion"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>


                {{-- Photo --}}
                <div class="md:col-span-2 lg:col-span-3">

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Student Photo
                    </label>

                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center">

                        <div
                            id="photoPreview"
                            class="hidden h-24 w-24 overflow-hidden rounded-xl
                                   border border-slate-200 bg-slate-50"
                        >
                            <img
                                id="previewImage"
                                src=""
                                alt="Preview"
                                class="h-full w-full object-cover"
                            >
                        </div>


                        <div class="flex-1">

                            <input
                                type="file"
                                name="photo"
                                id="photo"
                                accept="image/jpeg,image/png,image/webp"
                                class="block w-full rounded-xl border border-slate-300
                                       bg-white text-sm text-slate-600
                                       file:mr-4 file:border-0
                                       file:bg-slate-100
                                       file:px-4 file:py-2.5
                                       file:text-sm file:font-semibold
                                       file:text-slate-700
                                       hover:file:bg-slate-200"
                            >

                            <p class="mt-1 text-xs text-slate-500">
                                JPG, PNG or WEBP. Maximum size 2MB.
                            </p>

                        </div>

                    </div>

                    @error('photo')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            GUARDIAN INFORMATION
        ====================================================== --}}
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
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"
                            />
                        </svg>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Guardian Information
                        </h2>

                        <p class="text-xs text-slate-500">
                            Parent or guardian contact information
                        </p>

                    </div>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2 lg:grid-cols-3">


                {{-- Guardian Name --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Guardian Name
                    </label>

                    <input
                        type="text"
                        name="guardian_name"
                        value="{{ old('guardian_name') }}"
                        placeholder="Father / Mother / Guardian"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>


                {{-- Phone --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Guardian Phone
                    </label>

                    <input
                        type="text"
                        name="guardian_phone"
                        value="{{ old('guardian_phone') }}"
                        placeholder="01XXXXXXXXX"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>


                {{-- Email --}}
                <div>

                    <label class="mb-2 block text-sm font-medium text-slate-700">
                        Guardian Email
                    </label>

                    <input
                        type="email"
                        name="guardian_email"
                        value="{{ old('guardian_email') }}"
                        placeholder="guardian@example.com"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>

            </div>

        </div>


        {{-- =====================================================
            ADDRESS
        ====================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">

                <h2 class="font-semibold text-slate-800">
                    Address
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Student's current address
                </p>

            </div>


            <div class="p-5">

                <label class="mb-2 block text-sm font-medium text-slate-700">
                    Full Address
                </label>

                <textarea
                    name="address"
                    rows="4"
                    placeholder="Enter student's full address..."
                    class="w-full rounded-xl border border-slate-300
                           px-4 py-3 text-sm
                           outline-none transition
                           focus:border-blue-500
                           focus:ring-2 focus:ring-blue-500/20"
                >{{ old('address') }}</textarea>

            </div>

        </div>


        {{-- =====================================================
            STATUS
        ====================================================== --}}
        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="flex items-center justify-between gap-4 p-5">

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Student Status
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        Set whether this student is currently active.
                    </p>

                </div>


                <label class="relative inline-flex cursor-pointer items-center">

                    <input
                        type="checkbox"
                        name="status"
                        value="1"
                        class="peer sr-only"
                        @checked(old('status', true))
                    >

                    <div
                        class="h-6 w-11 rounded-full bg-slate-300
                               after:absolute after:left-[2px] after:top-[2px]
                               after:h-5 after:w-5 after:rounded-full
                               after:border after:border-slate-300
                               after:bg-white after:transition-all
                               peer-checked:bg-blue-600
                               peer-checked:after:translate-x-full
                               peer-checked:after:border-white"
                    ></div>

                </label>

            </div>

        </div>


        {{-- =====================================================
            FORM ACTIONS
        ====================================================== --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.students.index') }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-slate-300 bg-white px-6 py-3
                       text-sm font-semibold text-slate-700
                       transition hover:bg-slate-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-7 py-3
                       text-sm font-semibold text-white
                       shadow-sm transition hover:bg-blue-700
                       focus:outline-none focus:ring-2
                       focus:ring-blue-500 focus:ring-offset-2"
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
                        d="M5 13l4 4L19 7"
                    />
                </svg>

                Save Student

            </button>

        </div>

    </form>

</div>


{{-- =========================================================
    PHOTO PREVIEW
========================================================= --}}
@push('scripts')

<script>
document.addEventListener('DOMContentLoaded', function () {

    const photoInput = document.getElementById('photo');
    const previewBox = document.getElementById('photoPreview');
    const previewImage = document.getElementById('previewImage');

    if (!photoInput) {
        return;
    }

    photoInput.addEventListener('change', function (event) {

        const file = event.target.files[0];

        if (!file) {
            previewBox.classList.add('hidden');
            previewImage.src = '';
            return;
        }

        if (!file.type.startsWith('image/')) {
            previewBox.classList.add('hidden');
            previewImage.src = '';
            return;
        }

        const reader = new FileReader();

        reader.onload = function (e) {

            previewImage.src = e.target.result;

            previewBox.classList.remove('hidden');
        };

        reader.readAsDataURL(file);

    });

});
</script>

@endpush

@endsection