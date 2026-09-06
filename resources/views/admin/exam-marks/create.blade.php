@extends('admin.layouts.app')

@section('title', 'Enter Exam Marks')

@section('page-title', 'Enter Exam Marks')

@section('content')

<div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl sm:text-3xl font-bold text-slate-800">
                Enter Exam Marks
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Enter marks for a student in a specific examination subject.
            </p>
        </div>

        <a href="{{ route('admin.exam-marks.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg
                  bg-slate-100 hover:bg-slate-200
                  text-slate-700 text-sm font-semibold transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-4 h-4"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

            </svg>

            Back to Marks
        </a>

    </div>


    {{-- =========================================================
        BREADCRUMB
    ========================================================== --}}
    <div class="mb-6">

        <nav class="flex items-center gap-2 text-sm text-slate-500">

            <a href="{{ route('dashboard') }}"
               class="hover:text-blue-600 transition">
                Dashboard
            </a>

            <span>/</span>

            <a href="{{ route('admin.exam-marks.index') }}"
               class="hover:text-blue-600 transition">
                Exam Marks
            </a>

            <span>/</span>

            <span class="text-slate-700 font-medium">
                Enter Marks
            </span>

        </nav>

    </div>


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">

            <div class="flex items-start gap-3">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-red-600 mt-0.5 flex-shrink-0"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M12 8v4m0 4h.01M10.29 3.86l-7.82 13.5A1 1 0 003.34 19h17.32a1 1 0 00.87-1.64l-7.82-13.5a1 1 0 00-1.74 0z"/>

                </svg>

                <div>

                    <h3 class="font-semibold text-red-700 text-sm">
                        Please fix the following errors:
                    </h3>

                    <ul class="mt-2 list-disc list-inside text-sm text-red-600 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        INFO BOX
    ========================================================== --}}
    <div class="mb-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">

        <div class="flex items-start gap-3">

            <div class="w-9 h-9 rounded-lg bg-blue-100
                        flex items-center justify-center flex-shrink-0">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5 text-blue-600"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20 10 10 0 000-20z"/>

                </svg>

            </div>

            <div>

                <h3 class="font-semibold text-blue-800 text-sm">
                    Marks Entry Information
                </h3>

                <p class="text-sm text-blue-700 mt-1">
                    Select an exam subject and student carefully.
                    Full marks and pass marks can be taken from the assigned exam subject.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form method="POST"
          action="{{ route('admin.exam-marks.store') }}"
          id="exam-mark-form">

        @csrf


        {{-- =====================================================
            EXAMINATION INFORMATION
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-4 sm:px-5 py-4 border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800">
                    Examination Information
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Select the examination and academic information.
                </p>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Exam --}}
                    <div>

                        <label for="exam_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Exam
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="exam_id"
                                id="exam_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Exam
                            </option>

                            @foreach($exams as $exam)

                                <option value="{{ $exam->id }}"
                                    {{ old('exam_id') == $exam->id ? 'selected' : '' }}>

                                    {{ $exam->name }}

                                    @if($exam->code)
                                        ({{ $exam->code }})
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


                    {{-- Academic Session --}}
                    <div>

                        <label for="academic_session_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="academic_session_id"
                                id="academic_session_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}"
                                    {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>

                                    {{ $session->name ?? 'Session #' . $session->id }}

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

                        <label for="school_class_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Class
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="school_class_id"
                                id="school_class_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Class
                            </option>

                            @foreach($schoolClasses as $class)

                                <option value="{{ $class->id }}"
                                    {{ old('school_class_id') == $class->id ? 'selected' : '' }}>

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


                    {{-- Section --}}
                    <div>

                        <label for="section_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Section

                        </label>

                        <select name="section_id"
                                id="section_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                All / No Section
                            </option>

                            @foreach($sections as $section)

                                <option value="{{ $section->id }}"
                                    {{ old('section_id') == $section->id ? 'selected' : '' }}>

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

                </div>

            </div>

        </div>


        {{-- =====================================================
            SUBJECT & STUDENT
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-4 sm:px-5 py-4 border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800">
                    Subject & Student
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Select the subject and student for marks entry.
                </p>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Subject --}}
                    <div>

                        <label for="subject_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Subject
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="subject_id"
                                id="subject_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Subject
                            </option>

                            @foreach($subjects as $subject)

                                <option value="{{ $subject->id }}"
                                    {{ old('subject_id') == $subject->id ? 'selected' : '' }}>

                                    {{ $subject->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('subject_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Student --}}
                    <div>

                        <label for="student_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Student
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="student_id"
                                id="student_id"
                                required
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Student
                            </option>

                            @foreach($students as $student)

                                <option value="{{ $student->id }}"
                                    {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                    {{ $student->name
                                        ?? $student->student_name
                                        ?? 'Student #' . $student->id }}

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

                    </div>


                    {{-- Exam Subject --}}
                    <div class="md:col-span-2">

                        <label for="exam_subject_id"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Exam Subject Assignment

                        </label>

                        <select name="exam_subject_id"
                                id="exam_subject_id"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Exam Subject Assignment
                            </option>

                            @foreach($examSubjects as $examSubject)

                                <option value="{{ $examSubject->id }}"
                                    data-exam="{{ $examSubject->exam_id }}"
                                    data-class="{{ $examSubject->school_class_id }}"
                                    data-section="{{ $examSubject->section_id }}"
                                    data-subject="{{ $examSubject->subject_id }}"
                                    data-full-marks="{{ $examSubject->full_marks }}"
                                    data-pass-marks="{{ $examSubject->pass_marks }}"
                                    {{ old('exam_subject_id') == $examSubject->id ? 'selected' : '' }}>

                                    {{ $examSubject->exam?->name ?? 'Exam' }}
                                    -
                                    {{ $examSubject->schoolClass?->name ?? 'Class' }}

                                    @if($examSubject->section)
                                        / {{ $examSubject->section->name }}
                                    @endif

                                    -
                                    {{ $examSubject->subject?->name ?? 'Subject' }}

                                </option>

                            @endforeach

                        </select>

                        <p class="mt-1.5 text-xs text-slate-500">
                            Optional. Selecting an assignment will automatically fill
                            full marks and pass marks.
                        </p>

                        @error('exam_subject_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>

        </div>


        {{-- =====================================================
            MARKS INFORMATION
        ====================================================== --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm overflow-hidden mb-6">

            <div class="px-4 sm:px-5 py-4 border-b border-slate-200">

                <h2 class="text-base font-semibold text-slate-800">
                    Marks Information
                </h2>

                <p class="text-xs text-slate-500 mt-1">
                    Enter obtained marks and result information.
                </p>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-5">


                    {{-- Full Marks --}}
                    <div>

                        <label for="full_marks"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Full Marks
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               name="full_marks"
                               id="full_marks"
                               value="{{ old('full_marks', '100') }}"
                               min="0"
                               step="0.01"
                               required
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      text-sm">

                        @error('full_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Pass Marks --}}
                    <div>

                        <label for="pass_marks"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Pass Marks

                        </label>

                        <input type="number"
                               name="pass_marks"
                               id="pass_marks"
                               value="{{ old('pass_marks') }}"
                               min="0"
                               step="0.01"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      text-sm">

                        @error('pass_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Obtained Marks --}}
                    <div>

                        <label for="obtained_marks"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Obtained Marks

                        </label>

                        <input type="number"
                               name="obtained_marks"
                               id="obtained_marks"
                               value="{{ old('obtained_marks') }}"
                               min="0"
                               step="0.01"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      text-sm">

                        @error('obtained_marks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Grade --}}
                    <div>

                        <label for="grade"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Grade

                        </label>

                        <select name="grade"
                                id="grade"
                                class="w-full rounded-lg border-slate-300
                                       focus:border-blue-500 focus:ring-blue-500
                                       text-sm">

                            <option value="">
                                Select Grade
                            </option>

                            <option value="A+"
                                {{ old('grade') === 'A+' ? 'selected' : '' }}>
                                A+
                            </option>

                            <option value="A"
                                {{ old('grade') === 'A' ? 'selected' : '' }}>
                                A
                            </option>

                            <option value="A-"
                                {{ old('grade') === 'A-' ? 'selected' : '' }}>
                                A-
                            </option>

                            <option value="B"
                                {{ old('grade') === 'B' ? 'selected' : '' }}>
                                B
                            </option>

                            <option value="C"
                                {{ old('grade') === 'C' ? 'selected' : '' }}>
                                C
                            </option>

                            <option value="D"
                                {{ old('grade') === 'D' ? 'selected' : '' }}>
                                D
                            </option>

                            <option value="F"
                                {{ old('grade') === 'F' ? 'selected' : '' }}>
                                F
                            </option>

                        </select>

                        @error('grade')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Grade Point --}}
                    <div>

                        <label for="grade_point"
                               class="block text-sm font-medium text-slate-700 mb-1.5">

                            Grade Point

                        </label>

                        <input type="number"
                               name="grade_point"
                               id="grade_point"
                               value="{{ old('grade_point') }}"
                               min="0"
                               max="10"
                               step="0.01"
                               class="w-full rounded-lg border-slate-300
                                      focus:border-blue-500 focus:ring-blue-500
                                      text-sm">

                        @error('grade_point')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Status
                        </label>

                        <label class="flex items-center gap-3
                                      px-3 py-2.5 rounded-lg
                                      border border-slate-200
                                      bg-slate-50 cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old('status', true) ? 'checked' : '' }}
                                   class="rounded border-slate-300
                                          text-blue-600
                                          focus:ring-blue-500">

                            <span class="text-sm text-slate-700">
                                Active
                            </span>

                        </label>

                    </div>

                </div>


                {{-- Remarks --}}
                <div class="mt-5">

                    <label for="remarks"
                           class="block text-sm font-medium text-slate-700 mb-1.5">

                        Remarks

                    </label>

                    <textarea name="remarks"
                              id="remarks"
                              rows="4"
                              placeholder="Enter any remarks about the student's performance..."
                              class="w-full rounded-lg border-slate-300
                                     focus:border-blue-500 focus:ring-blue-500
                                     text-sm">{{ old('remarks') }}</textarea>

                    @error('remarks')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>

        </div>


        {{-- =====================================================
            RESULT PREVIEW
        ====================================================== --}}
        <div id="result-preview"
             class="hidden mb-6 bg-slate-50
                    border border-slate-200 rounded-xl p-4">

            <div class="flex items-center justify-between gap-4">

                <div>

                    <p class="text-xs text-slate-500">
                        Result Preview
                    </p>

                    <p id="result-text"
                       class="text-lg font-bold text-slate-800 mt-1">
                        —
                    </p>

                </div>

                <div class="text-right">

                    <p class="text-xs text-slate-500">
                        Percentage
                    </p>

                    <p id="percentage-text"
                       class="text-lg font-bold text-slate-800 mt-1">
                        —
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            FOOTER ACTIONS
        ====================================================== --}}
        <div class="flex flex-col-reverse sm:flex-row
                    sm:items-center sm:justify-end gap-3">

            <a href="{{ route('admin.exam-marks.index') }}"
               class="inline-flex items-center justify-center
                      px-5 py-2.5 rounded-lg
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700 text-sm font-semibold transition">

                Cancel

            </a>


            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-semibold
                           shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          stroke-width="2"
                          d="M5 13l4 4L19 7"/>

                </svg>

                Save Marks

            </button>

        </div>

    </form>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const examSubjectSelect = document.getElementById('exam_subject_id');

    const fullMarksInput = document.getElementById('full_marks');
    const passMarksInput = document.getElementById('pass_marks');
    const obtainedMarksInput = document.getElementById('obtained_marks');

    const gradeSelect = document.getElementById('grade');
    const gradePointInput = document.getElementById('grade_point');

    const resultPreview = document.getElementById('result-preview');
    const resultText = document.getElementById('result-text');
    const percentageText = document.getElementById('percentage-text');


    /*
    |--------------------------------------------------------------------------
    | Exam Subject Selection
    |--------------------------------------------------------------------------
    */

    if (examSubjectSelect) {

        examSubjectSelect.addEventListener('change', function () {

            const selected =
                this.options[this.selectedIndex];

            if (!selected || !selected.value) {
                return;
            }

            const fullMarks =
                selected.dataset.fullMarks;

            const passMarks =
                selected.dataset.passMarks;

            const examId =
                selected.dataset.exam;

            const classId =
                selected.dataset.class;

            const sectionId =
                selected.dataset.section;

            const subjectId =
                selected.dataset.subject;


            if (fullMarks !== undefined && fullMarks !== '') {

                fullMarksInput.value = fullMarks;

            }


            if (passMarks !== undefined && passMarks !== '') {

                passMarksInput.value = passMarks;

            }


            /*
            |--------------------------------------------------------------------------
            | Automatically select related fields
            |--------------------------------------------------------------------------
            */

            const examSelect =
                document.getElementById('exam_id');

            const classSelect =
                document.getElementById('school_class_id');

            const sectionSelect =
                document.getElementById('section_id');

            const subjectSelect =
                document.getElementById('subject_id');


            if (examSelect && examId) {
                examSelect.value = examId;
            }

            if (classSelect && classId) {
                classSelect.value = classId;
            }

            if (sectionSelect && sectionId) {
                sectionSelect.value = sectionId;
            }

            if (subjectSelect && subjectId) {
                subjectSelect.value = subjectId;
            }


            calculateResult();

        });

    }


    /*
    |--------------------------------------------------------------------------
    | Calculate Result
    |--------------------------------------------------------------------------
    */

    function calculateResult() {

        const fullMarks =
            parseFloat(fullMarksInput.value);

        const passMarks =
            parseFloat(passMarksInput.value);

        const obtainedMarks =
            parseFloat(obtainedMarksInput.value);


        if (
            isNaN(fullMarks) ||
            fullMarks <= 0 ||
            isNaN(obtainedMarks)
        ) {

            resultPreview.classList.add('hidden');

            return;

        }


        const percentage =
            (obtainedMarks / fullMarks) * 100;


        percentageText.textContent =
            percentage.toFixed(2) + '%';


        if (
            !isNaN(passMarks) &&
            obtainedMarks < passMarks
        ) {

            resultText.textContent = 'Failed';

        } else {

            resultText.textContent = 'Passed';

        }


        resultPreview.classList.remove('hidden');


        /*
        |--------------------------------------------------------------------------
        | Automatic Grade
        |--------------------------------------------------------------------------
        */

        let grade = '';
        let gradePoint = '';


        if (percentage >= 80) {

            grade = 'A+';
            gradePoint = '5.00';

        } else if (percentage >= 70) {

            grade = 'A';
            gradePoint = '4.00';

        } else if (percentage >= 60) {

            grade = 'A-';
            gradePoint = '3.50';

        } else if (percentage >= 50) {

            grade = 'B';
            gradePoint = '3.00';

        } else if (percentage >= 40) {

            grade = 'C';
            gradePoint = '2.00';

        } else if (percentage >= 33) {

            grade = 'D';
            gradePoint = '1.00';

        } else {

            grade = 'F';
            gradePoint = '0.00';

        }


        /*
        |--------------------------------------------------------------------------
        | Only auto-fill if fields are empty
        |--------------------------------------------------------------------------
        */

        if (!gradeSelect.value) {

            gradeSelect.value = grade;

        }

        if (!gradePointInput.value) {

            gradePointInput.value = gradePoint;

        }

    }


    if (obtainedMarksInput) {

        obtainedMarksInput.addEventListener(
            'input',
            calculateResult
        );

    }


    if (fullMarksInput) {

        fullMarksInput.addEventListener(
            'input',
            calculateResult
        );

    }


    if (passMarksInput) {

        passMarksInput.addEventListener(
            'input',
            calculateResult
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculateResult();

});

</script>

@endsection