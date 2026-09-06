@extends('admin.layouts.app')

@section('title', 'Assign Exam Subject')

@section('page-title', 'Assign Exam Subject')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Assign Exam Subject
                </h1>

                <p class="text-sm text-slate-500 mt-1">
                    Assign a subject to an examination for a specific class.
                </p>
            </div>

            <a href="{{ route('admin.exam-subjects.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5 bg-slate-100 hover:bg-slate-200
                      text-slate-700 rounded-lg text-sm font-semibold
                      transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

                </svg>

                Back
            </a>

        </div>

    </div>


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="mb-6">

        <nav class="flex items-center flex-wrap
                    text-sm text-slate-500 gap-2">

            <a href="{{ route('admin.exams.index') }}"
               class="hover:text-blue-600 transition">
                Exams
            </a>

            <span>/</span>

            <a href="{{ route('admin.exam-subjects.index') }}"
               class="hover:text-blue-600 transition">
                Exam Subjects
            </a>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                Assign Subject
            </span>

        </nav>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 rounded-xl border border-red-200
                    bg-red-50 px-4 py-4">

            <div class="flex items-start gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-red-600 mt-0.5 shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 9v4m0 4h.01M10.29 3.86l-7.5 13
                             A2 2 0 004.52 20h14.96a2 2 0 001.73-3.14l-7.5-13
                             a2 2 0 00-3.42 0z"/>

                </svg>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc pl-5
                               text-sm text-red-700 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        FORM CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-5 py-4 sm:px-6
                    border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M12 6.253v13m0-13C10.832 5.477
                                 9.246 5 7.5 5S4.168 5.477 3 6.253v13
                                 C4.168 18.477 5.754 18 7.5 18
                                 s3.332.477 4.5 1.253m0-13
                                 C13.168 5.477 14.754 5 16.5 5
                                 c1.746 0 3.332.477 4.5 1.253v13
                                 C19.832 18.477 18.246 18 16.5 18
                                 c-1.746 0-3.332.477-4.5 1.253"/>

                    </svg>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Subject Assignment
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Select examination, class and subject details.
                    </p>

                </div>

            </div>

        </div>


        {{-- Form --}}
        <form method="POST"
              action="{{ route('admin.exam-subjects.store') }}">

            @csrf

            <div class="p-5 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            gap-5">

                    {{-- =================================================
                        EXAM
                    ================================================== --}}
                    <div>

                        <label for="exam_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Exam
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="exam_id"
                                id="exam_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}"
                                    {{ old('exam_id') == $exam->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $exam->name }}

                                    @if($exam->code)
                                        — {{ $exam->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('exam_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        ACADEMIC SESSION
                    ================================================== --}}
                    <div>

                        <label for="academic_session_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="academic_session_id"
                                id="academic_session_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old('academic_session_id') == $session->id
                                        ? 'selected'
                                        : '' }}>

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

                        <label for="school_class_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Class
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Class
                            </option>

                            @foreach($schoolClasses as $class)

                                <option value="{{ $class->id }}"
                                    {{ old('school_class_id') == $class->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $class->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('school_class_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        SECTION
                    ================================================== --}}
                    <div>

                        <label for="section_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Section

                        </label>

                        <select name="section_id"
                                id="section_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                All Sections
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $section->name }}

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1 text-xs text-slate-500">
                            Leave blank if this subject applies to all
                            sections of the selected class.
                        </p>

                        @error('section_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        SUBJECT
                    ================================================== --}}
                    <div class="md:col-span-2">

                        <label for="subject_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Subject
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="subject_id"
                                id="subject_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500
                                       focus:ring-blue-500 text-sm">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id
                                        ? 'selected'
                                        : '' }}>

                                    {{ $subject->name }}

                                    @if(isset($subject->code) && $subject->code)
                                        — {{ $subject->code }}
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('subject_id')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        FULL MARKS
                    ================================================== --}}
                    <div>

                        <label for="full_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Full Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               name="full_marks"
                               id="full_marks"
                               value="{{ old('full_marks', 100) }}"
                               min="0"
                               step="0.01"
                               required
                               placeholder="e.g. 100"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('full_marks')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        PASS MARKS
                    ================================================== --}}
                    <div>

                        <label for="pass_marks"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Pass Marks

                        </label>

                        <input type="number"
                               name="pass_marks"
                               id="pass_marks"
                               value="{{ old('pass_marks') }}"
                               min="0"
                               step="0.01"
                               placeholder="e.g. 33"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500
                                      focus:ring-blue-500 text-sm">

                        @error('pass_marks')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- =================================================
                        STATUS
                    ================================================== --}}
                    <div class="md:col-span-2">

                        <div class="rounded-lg border border-slate-200
                                    bg-slate-50 p-4">

                            <label class="flex items-center gap-3 cursor-pointer">

                                <input type="checkbox"
                                       name="status"
                                       value="1"
                                       {{ old('status', true)
                                            ? 'checked'
                                            : '' }}
                                       class="rounded border-slate-300
                                              text-blue-600
                                              focus:ring-blue-500">

                                <div>

                                    <div class="text-sm font-semibold
                                                text-slate-700">

                                        Active

                                    </div>

                                    <div class="text-xs text-slate-500">

                                        This subject will be available
                                        for marks entry and result processing.

                                    </div>

                                </div>

                            </label>

                        </div>

                        @error('status')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>

                </div>


                {{-- =================================================
                    INFORMATION BOX
                ================================================== --}}
                <div class="mt-6 rounded-lg border border-blue-200
                            bg-blue-50 px-4 py-4">

                    <div class="flex items-start gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600 mt-0.5 shrink-0"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  stroke-width="2"
                                  d="M13 16h-1v-4h-1m1-4h.01
                                     M12 20a8 8 0 100-16 8 8 0 000 16z"/>

                        </svg>

                        <div>

                            <h3 class="text-sm font-semibold text-blue-800">

                                Subject Assignment

                            </h3>

                            <p class="text-xs text-blue-700 mt-1 leading-5">

                                A subject can only be assigned once to the
                                same exam, class and section. If Section is
                                left blank, the subject will apply to all
                                sections of the selected class.

                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================================================
                FOOTER ACTIONS
            ========================================================== --}}
            <div class="px-5 sm:px-6 py-4 bg-slate-50
                        border-t border-slate-200
                        flex flex-col-reverse sm:flex-row
                        sm:items-center sm:justify-end gap-3">

                <a href="{{ route('admin.exam-subjects.index') }}"
                   class="inline-flex items-center justify-center
                          px-5 py-2.5 rounded-lg
                          bg-white border border-slate-300
                          text-slate-700 hover:bg-slate-100
                          text-sm font-semibold transition">

                    Cancel

                </a>


                <button type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 px-5 py-2.5 rounded-lg
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-semibold
                               shadow-sm transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    Assign Subject

                </button>

            </div>

        </form>

    </div>

</div>

@endsection