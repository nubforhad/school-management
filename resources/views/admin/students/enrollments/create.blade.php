@extends('admin.layouts.app')

@section('title', 'Enroll / Promote Student')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm text-slate-500">

                <a
                    href="{{ route('admin.students.enrollments.index', $student) }}"
                    class="transition hover:text-blue-600"
                >
                    Enrollment History
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Enroll / Promote
                </span>

            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                Enroll / Promote Student
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Assign this existing student to a new class, section or academic session.
            </p>

        </div>


        <a
            href="{{ route('admin.students.show', $student) }}"
            class="inline-flex items-center justify-center gap-2 rounded-xl
                   border border-slate-200 bg-white px-4 py-2.5
                   text-sm font-semibold text-slate-700
                   transition hover:bg-slate-50"
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
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                />
            </svg>

            Back to Student

        </a>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

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
                        d="M12 9v4m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.63 20h14.74a2 2 0 001.74-3.34l-7.4-12.8a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>

                    <p class="font-semibold text-red-700">
                        Please fix the following errors:
                    </p>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-600">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif



    {{-- =========================================================
        STUDENT INFORMATION
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center
                           rounded-xl bg-blue-50 text-blue-600"
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
                            d="M16 21v-2a4 4 0 00-4-4H6a4 4 0 00-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                            stroke-width="2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M22 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"
                        />
                    </svg>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Student Information
                    </h2>

                    <p class="text-xs text-slate-500">
                        Existing student selected for enrollment.
                    </p>

                </div>

            </div>

        </div>


        <div class="p-5">

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4">

                {{-- Student Name --}}

                <div class="rounded-xl bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Student Name
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $student->name }}
                    </p>

                </div>


                {{-- Student ID --}}

                <div class="rounded-xl bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Student ID
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">
                        {{ $student->student_id ?? 'N/A' }}
                    </p>

                </div>


                {{-- Current Branch --}}

                <div class="rounded-xl bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Current Branch
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">

                        {{ $currentEnrollment?->branch?->name ?? 'Not Assigned' }}

                    </p>

                </div>


                {{-- Current Class --}}

                <div class="rounded-xl bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Current Class
                    </p>

                    <p class="mt-1 font-semibold text-slate-800">

                        @if($currentEnrollment)

                            {{ $currentEnrollment->schoolClass?->name ?? 'N/A' }}

                            @if($currentEnrollment->section)

                                <span class="text-slate-500">
                                    / {{ $currentEnrollment->section->name }}
                                </span>

                            @endif

                        @else

                            Not Assigned

                        @endif

                    </p>

                </div>

            </div>


            {{-- Current Enrollment Alert --}}

            @if($currentEnrollment)

                <div class="mt-5 rounded-xl border border-blue-200 bg-blue-50 p-4">

                    <div class="flex gap-3">

                        <svg
                            class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M12 22a10 10 0 110-20 10 10 0 010 20z"
                            />
                        </svg>

                        <div>

                            <p class="font-semibold text-blue-800">
                                Current Enrollment
                            </p>

                            <p class="mt-1 text-sm leading-6 text-blue-700">

                                This student is currently enrolled in

                                <strong>
                                    {{ $currentEnrollment->schoolClass?->name }}
                                </strong>

                                @if($currentEnrollment->section)

                                    , Section
                                    <strong>
                                        {{ $currentEnrollment->section->name }}
                                    </strong>

                                @endif

                                @if($currentEnrollment->roll_no)

                                    , Roll
                                    <strong>
                                        {{ $currentEnrollment->roll_no }}
                                    </strong>

                                @endif

                                .

                                After saving the new enrollment, the current
                                enrollment will be marked as completed.

                            </p>

                        </div>

                    </div>

                </div>

            @endif

        </div>

    </div>



    {{-- =========================================================
        NEW ENROLLMENT FORM
    ========================================================== --}}

    <form
        method="POST"
        action="{{ route('admin.students.enrollments.store', $student) }}"
        class="space-y-6"
    >

        @csrf


        <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


            {{-- Header --}}

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="font-semibold text-slate-800">
                    New Enrollment Information
                </h2>

                <p class="mt-1 text-xs text-slate-500">
                    Select where you want to move/promote this student.
                </p>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                    {{-- =================================================
                        BRANCH
                    ================================================== --}}

                    <div>

                        <label
                            for="branch_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            New Branch
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="branch_id"
                            name="branch_id"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
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
                                    @selected(
                                        old(
                                            'branch_id',
                                            $currentEnrollment?->branch_id
                                        ) == $branch->id
                                    )
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



                    {{-- =================================================
                        ACADEMIC SESSION
                    ================================================== --}}

                    <div>

                        <label
                            for="academic_session_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Academic Session
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="academic_session_id"
                            name="academic_session_id"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option
                                    value="{{ $session->id }}"
                                    @selected(
                                        old('academic_session_id') == $session->id
                                    )
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



                    {{-- =================================================
                        NEW CLASS
                    ================================================== --}}

                    <div>

                        <label
                            for="class_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            New Class
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="class_id"
                            name="class_id"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option value="">
                                Select New Class
                            </option>

                            @foreach($classes as $class)

                                <option
                                    value="{{ $class->id }}"
                                    @selected(
                                        old('class_id') == $class->id
                                    )
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



                    {{-- =================================================
                        NEW SECTION
                    ================================================== --}}

                    <div>

                        <label
                            for="section_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            New Section
                        </label>

                        <select
                            id="section_id"
                            name="section_id"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option value="">
                                Select New Section
                            </option>

                            @foreach($sections as $section)

                                <option
                                    value="{{ $section->id }}"
                                    @selected(
                                        old('section_id') == $section->id
                                    )
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



                    {{-- =================================================
                        NEW ROLL
                    ================================================== --}}

                    <div>

                        <label
                            for="roll_no"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            New Roll Number
                        </label>

                        <input
                            type="number"
                            id="roll_no"
                            name="roll_no"
                            value="{{ old('roll_no') }}"
                            min="1"
                            placeholder="Enter new roll number"
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   placeholder:text-slate-400
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                        @error('roll_no')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>



                    {{-- =================================================
                        ENROLLMENT DATE
                    ================================================== --}}

                    <div>

                        <label
                            for="enrollment_date"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Enrollment Date
                            <span class="text-red-500">*</span>
                        </label>

                        <input
                            type="date"
                            id="enrollment_date"
                            name="enrollment_date"
                            value="{{ old('enrollment_date', now()->format('Y-m-d')) }}"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                        @error('enrollment_date')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>



                {{-- =====================================================
                    REMARKS
                ====================================================== --}}

                <div class="mt-5">

                    <label
                        for="remarks"
                        class="mb-1.5 block text-sm font-semibold text-slate-700"
                    >
                        Remarks
                    </label>

                    <textarea
                        id="remarks"
                        name="remarks"
                        rows="4"
                        placeholder="Example: Promoted from Class Five to Class Six..."
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm text-slate-700
                               outline-none transition
                               placeholder:text-slate-400
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >{{ old('remarks') }}</textarea>

                    @error('remarks')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>



        {{-- =========================================================
            IMPORTANT INFORMATION
        ========================================================== --}}

        <div class="rounded-2xl border border-amber-200 bg-amber-50 p-5">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-amber-600"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 9v2m0 4h.01M10.29 3.86l-7.4 12.8A2 2 0 004.63 20h14.74a2 2 0 001.74-3.34l-7.4-12.8a2 2 0 00-3.42 0z"
                    />
                </svg>

                <div>

                    <h3 class="font-semibold text-amber-800">
                        Important
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-amber-700">

                        This will create a new enrollment record for
                        <strong>{{ $student->name }}</strong>.

                        @if($currentEnrollment)

                            The student's current active enrollment will be
                            marked as completed.

                        @endif

                        Student information will not be duplicated.

                    </p>

                </div>

            </div>

        </div>



        {{-- =========================================================
            PAYMENT NOTE
        ========================================================== --}}

        <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5">

            <div class="flex gap-3">

                <svg
                    class="mt-0.5 h-5 w-5 shrink-0 text-blue-600"
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

                <div>

                    <h3 class="font-semibold text-blue-800">
                        Payment is handled separately
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-blue-700">
                        Enrollment only changes the student's academic
                        placement. Fees and payments will be handled
                        separately in the Payment module.
                    </p>

                </div>

            </div>

        </div>



        {{-- =========================================================
            ACTIONS
        ========================================================== --}}

        <div
            class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"
        >

            <a
                href="{{ route('admin.students.show', $student) }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-slate-200 bg-white px-5 py-2.5
                       text-sm font-semibold text-slate-700
                       transition hover:bg-slate-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white shadow-sm
                       transition hover:bg-blue-700
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

                Confirm Enrollment

            </button>

        </div>

    </form>

</div>

@endsection