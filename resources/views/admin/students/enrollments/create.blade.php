@extends('admin.layouts.app')

@section('title', 'New Student Enrollment')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <div class="flex items-center gap-2 text-sm text-slate-500">
                <a
                    href="{{ route('admin.students.enrollments.index') }}"
                    class="hover:text-blue-600"
                >
                    Enrollments
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    New Enrollment
                </span>
            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                New Student Enrollment
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Enroll an existing student into a branch, session and class.
            </p>
        </div>

        <a
            href="{{ route('admin.students.enrollments.index') }}"
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

            Back
        </a>

    </div>


    {{-- =========================================================
        ERRORS
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
        FORM
    ========================================================== --}}
    <form
        method="POST"
        action="{{ route('admin.students.enrollments.store') }}"
        class="space-y-6"
    >

        @csrf


        {{-- =====================================================
            ACADEMIC INFORMATION
        ====================================================== --}}
        <div class="overflow-hidden rounded-2xl border border-slate-200
                    bg-white shadow-sm">

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
                                d="M12 14l9-5-9-5-9 5 9 5z"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 12v5c0 1.5 3.134 3 7 3s7-1.5 7-3v-5"
                            />
                        </svg>
                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Academic Information
                        </h2>

                        <p class="text-xs text-slate-500">
                            Select branch, student and academic class information.
                        </p>

                    </div>

                </div>

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
                            Branch
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


                    {{-- =================================================
                        STUDENT
                    ================================================== --}}
                    <div>

                        <label
                            for="student_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Student
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="student_id"
                            name="student_id"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option value="">
                                Select Student
                            </option>

                            @foreach($students as $student)

                                <option
                                    value="{{ $student->id }}"
                                    @selected(old('student_id') == $student->id)
                                >
                                    {{ $student->name }}
                                    @if($student->student_id)
                                        — {{ $student->student_id }}
                                    @endif
                                </option>

                            @endforeach

                        </select>

                        @error('student_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                        <p class="mt-1.5 text-xs text-slate-500">
                            Select an existing student. Do not create a duplicate student.
                        </p>

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


                    {{-- =================================================
                        CLASS
                    ================================================== --}}
                    <div>

                        <label
                            for="class_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Class
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


                    {{-- =================================================
                        SECTION
                    ================================================== --}}
                    <div>

                        <label
                            for="section_id"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Section
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


                    {{-- =================================================
                        ROLL
                    ================================================== --}}
                    <div>

                        <label
                            for="roll_no"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Roll Number
                        </label>

                        <input
                            type="number"
                            id="roll_no"
                            name="roll_no"
                            value="{{ old('roll_no') }}"
                            min="1"
                            placeholder="Enter roll number"
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


                    {{-- =================================================
                        STATUS
                    ================================================== --}}
                    <div>

                        <label
                            for="status"
                            class="mb-1.5 block text-sm font-semibold text-slate-700"
                        >
                            Enrollment Status
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="status"
                            name="status"
                            required
                            class="w-full rounded-xl border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-700
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option
                                value="active"
                                @selected(old('status', 'active') === 'active')
                            >
                                Active
                            </option>

                            <option
                                value="inactive"
                                @selected(old('status') === 'inactive')
                            >
                                Inactive
                            </option>

                            <option
                                value="completed"
                                @selected(old('status') === 'completed')
                            >
                                Completed
                            </option>

                            <option
                                value="transferred"
                                @selected(old('status') === 'transferred')
                            >
                                Transferred
                            </option>

                        </select>

                        @error('status')

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
                        placeholder="Optional enrollment remarks..."
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
            PAYMENT INFORMATION NOTE
        ========================================================== --}}
        <div
            class="rounded-2xl border border-amber-200
                   bg-amber-50 p-5"
        >

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
                        Payment is handled separately
                    </h3>

                    <p class="mt-1 text-sm leading-6 text-amber-700">
                        Enrollment only creates the student's academic enrollment.
                        Fees and payments will be managed from the Fees/Payment module,
                        where you can receive any amount as needed.
                    </p>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FORM ACTIONS
        ========================================================== --}}
        <div
            class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end"
        >

            <a
                href="{{ route('admin.students.enrollments.index') }}"
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

                Save Enrollment

            </button>

        </div>

    </form>

</div>

@endsection