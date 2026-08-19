@extends('admin.layouts.app')

@section('title', 'Bulk Student Enrollment')

@section('content')

<div class="space-y-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <div class="flex items-center gap-2 text-sm text-slate-500">

                <a
                    href="{{ route('admin.students.index') }}"
                    class="transition hover:text-blue-600"
                >
                    Students
                </a>

                <span>/</span>

                <span class="text-slate-700">
                    Bulk Enrollment
                </span>

            </div>

            <h1 class="mt-2 text-2xl font-bold text-slate-800">
                Bulk Student Enrollment
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Enroll multiple students into a class at once.
            </p>

        </div>


        <a
            href="{{ route('admin.students.index') }}"
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

            Back to Students

        </a>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div
            class="flex items-center gap-3 rounded-2xl border
                   border-emerald-200 bg-emerald-50 px-5 py-4
                   text-sm text-emerald-700"
        >

            <svg
                class="h-5 w-5 shrink-0"
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

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if($errors->any())

        <div class="rounded-2xl border border-red-200 bg-red-50 p-5">

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
        STEP 1
        ENROLLMENT INFORMATION
    ========================================================== --}}

    <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <div class="flex items-center gap-3">

                <div
                    class="flex h-10 w-10 items-center justify-center
                           rounded-xl bg-blue-50 font-bold text-blue-600"
                >
                    1
                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        New Enrollment Information
                    </h2>

                    <p class="text-xs text-slate-500">
                        Select the academic placement for the students.
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

                            <option value="{{ $branch->id }}">
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                    <p
                        id="branch_error"
                        class="mt-1 hidden text-xs text-red-600"
                    ></p>

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

                            <option value="{{ $session->id }}">
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                    CLASS
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

                            <option value="{{ $class->id }}">
                                {{ $class->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- =================================================
                    SECTION
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
                            Select Section
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                data-branch="{{ $section->branch_id }}"
                                data-class="{{ $section->class_id }}"
                            >
                                {{ $section->name }}
                            </option>

                        @endforeach

                    </select>

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
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-2.5 text-sm text-slate-700
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                </div>

            </div>


            {{-- =====================================================
                LOAD STUDENTS BUTTON
            ====================================================== --}}

            <div class="mt-6 flex flex-col gap-3 sm:flex-row sm:items-center">

                <button
                    type="button"
                    id="loadStudentsBtn"
                    class="inline-flex items-center justify-center gap-2
                           rounded-xl bg-blue-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           shadow-sm transition
                           hover:bg-blue-700
                           disabled:cursor-not-allowed
                           disabled:opacity-50"
                >

                    <svg
                        id="loadIcon"
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"
                        />
                    </svg>

                    <svg
                        id="loadingIcon"
                        class="hidden h-5 w-5 animate-spin"
                        fill="none"
                        viewBox="0 0 24 24"
                    >
                        <circle
                            class="opacity-25"
                            cx="12"
                            cy="12"
                            r="10"
                            stroke="currentColor"
                            stroke-width="4"
                        />

                        <path
                            class="opacity-75"
                            fill="currentColor"
                            d="M4 12a8 8 0 018-8v4a4 4 0 00-4 4H4z"
                        />
                    </svg>

                    <span id="loadButtonText">
                        Load Students
                    </span>

                </button>


                <p class="text-xs text-slate-500">
                    Select Branch, Academic Session and Class first.
                </p>

            </div>

        </div>

    </div>


    {{-- =========================================================
        STEP 2
        STUDENT LIST
    ========================================================== --}}

    <div
        id="studentSection"
        class="hidden overflow-hidden rounded-2xl border
               border-slate-200 bg-white shadow-sm"
    >

        <div class="border-b border-slate-100 px-5 py-4">

            <div class="flex flex-col gap-4 sm:flex-row
                        sm:items-center sm:justify-between">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-xl bg-emerald-50 font-bold
                               text-emerald-600"
                    >
                        2
                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Select Students
                        </h2>

                        <p class="text-xs text-slate-500">
                            Select the students you want to enroll.
                        </p>

                    </div>

                </div>


                {{-- Selected Counter --}}

                <div
                    class="rounded-xl bg-blue-50 px-4 py-2
                           text-sm font-semibold text-blue-700"
                >

                    Selected:
                    <span id="selectedCount">
                        0
                    </span>

                </div>

            </div>

        </div>


        {{-- =====================================================
            TABLE TOOLBAR
        ====================================================== --}}

        <div class="border-b border-slate-100 bg-slate-50 px-5 py-3">

            <div class="flex flex-col gap-3 sm:flex-row
                        sm:items-center sm:justify-between">

                <label class="flex items-center gap-3">

                    <input
                        type="checkbox"
                        id="selectAll"
                        class="h-4 w-4 rounded border-slate-300
                               text-blue-600 focus:ring-blue-500"
                    >

                    <span class="text-sm font-semibold text-slate-700">
                        Select All Students
                    </span>

                </label>


                <div class="text-xs text-slate-500">

                    <span id="studentTotal">
                        0
                    </span>

                    students found

                </div>

            </div>

        </div>


        {{-- =====================================================
            DESKTOP STUDENT TABLE
        ====================================================== --}}

        <div class="hidden overflow-x-auto lg:block">

            <table class="min-w-full divide-y divide-slate-200">

                <thead class="bg-white">

                    <tr>

                        <th class="w-12 px-5 py-3 text-center">
                            #
                        </th>

                        <th class="px-5 py-3 text-left text-xs
                                   font-semibold uppercase
                                   tracking-wider text-slate-500">
                            Student
                        </th>

                        <th class="px-5 py-3 text-left text-xs
                                   font-semibold uppercase
                                   tracking-wider text-slate-500">
                            Student ID
                        </th>

                        <th class="px-5 py-3 text-left text-xs
                                   font-semibold uppercase
                                   tracking-wider text-slate-500">
                            Current Class
                        </th>

                        <th class="px-5 py-3 text-left text-xs
                                   font-semibold uppercase
                                   tracking-wider text-slate-500">
                            Current Section
                        </th>

                        <th class="w-36 px-5 py-3 text-left text-xs
                                   font-semibold uppercase
                                   tracking-wider text-slate-500">
                            New Roll
                        </th>

                    </tr>

                </thead>


                <tbody
                    id="studentTableBody"
                    class="divide-y divide-slate-100"
                >

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            MOBILE STUDENT LIST
        ====================================================== --}}

        <div
            id="mobileStudentList"
            class="space-y-3 p-4 lg:hidden"
        >

        </div>


        {{-- =====================================================
            NO STUDENT
        ====================================================== --}}

        <div
            id="noStudents"
            class="hidden px-5 py-14 text-center"
        >

            <div
                class="mx-auto flex h-14 w-14 items-center
                       justify-center rounded-full bg-slate-100"
            >

                <svg
                    class="h-7 w-7 text-slate-400"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M12 6v12m6-6H6"
                    />
                </svg>

            </div>

            <h3 class="mt-4 font-semibold text-slate-700">
                No students found
            </h3>

            <p class="mt-1 text-sm text-slate-500">
                No active students were found for the selected
                branch, session and class.
            </p>

        </div>

    </div>


    {{-- =========================================================
        STEP 3
        REMARKS + SUBMIT
    ========================================================== --}}

    <form
        id="bulkEnrollmentForm"
        method="POST"
        action="{{ route('admin.students.enrollments.bulk.store') }}"
        class="hidden space-y-6"
    >

        @csrf

        {{-- Hidden enrollment data --}}

        <input
            type="hidden"
            name="branch_id"
            id="form_branch_id"
        >

        <input
            type="hidden"
            name="academic_session_id"
            id="form_academic_session_id"
        >

        <input
            type="hidden"
            name="class_id"
            id="form_class_id"
        >

        <input
            type="hidden"
            name="section_id"
            id="form_section_id"
        >

        <input
            type="hidden"
            name="enrollment_date"
            id="form_enrollment_date"
        >


        {{-- =====================================================
            REMARKS
        ====================================================== --}}

        <div class="overflow-hidden rounded-2xl border
                    border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <div class="flex items-center gap-3">

                    <div
                        class="flex h-10 w-10 items-center justify-center
                               rounded-xl bg-purple-50 font-bold
                               text-purple-600"
                    >
                        3
                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Finalize Enrollment
                        </h2>

                        <p class="text-xs text-slate-500">
                            Add optional remarks before saving.
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-5">

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

            </div>

        </div>


        {{-- =====================================================
            WARNING
        ====================================================== --}}

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

                        Selected students will receive a new enrollment
                        record.

                        If a student already has an active enrollment,
                        the previous enrollment will be marked as
                        <strong>completed</strong>.

                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
            ACTION BUTTONS
        ====================================================== --}}

        <div class="flex flex-col-reverse gap-3 sm:flex-row
                    sm:justify-end">

            <a
                href="{{ route('admin.students.index') }}"
                class="inline-flex items-center justify-center
                       rounded-xl border border-slate-200 bg-white
                       px-5 py-2.5 text-sm font-semibold
                       text-slate-700 transition hover:bg-slate-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                id="submitBulkBtn"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-emerald-600 px-6 py-2.5
                       text-sm font-semibold text-white shadow-sm
                       transition hover:bg-emerald-700
                       disabled:cursor-not-allowed
                       disabled:opacity-50"
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

                Confirm Bulk Enrollment

            </button>

        </div>

    </form>

</div>


{{-- =============================================================
    JAVASCRIPT
============================================================= --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const branchSelect =
        document.getElementById('branch_id');

    const sessionSelect =
        document.getElementById('academic_session_id');

    const classSelect =
        document.getElementById('class_id');

    const sectionSelect =
        document.getElementById('section_id');

    const enrollmentDate =
        document.getElementById('enrollment_date');

    const loadStudentsBtn =
        document.getElementById('loadStudentsBtn');

    const loadIcon =
        document.getElementById('loadIcon');

    const loadingIcon =
        document.getElementById('loadingIcon');

    const loadButtonText =
        document.getElementById('loadButtonText');

    const studentSection =
        document.getElementById('studentSection');

    const studentTableBody =
        document.getElementById('studentTableBody');

    const mobileStudentList =
        document.getElementById('mobileStudentList');

    const noStudents =
        document.getElementById('noStudents');

    const studentTotal =
        document.getElementById('studentTotal');

    const selectAll =
        document.getElementById('selectAll');

    const selectedCount =
        document.getElementById('selectedCount');

    const bulkForm =
        document.getElementById('bulkEnrollmentForm');


    /*
    |--------------------------------------------------------------------------
    | Filter Sections
    |--------------------------------------------------------------------------
    */

    function filterSections() {

        const branchId = branchSelect.value;
        const classId = classSelect.value;

        [...sectionSelect.options].forEach(option => {

            if (!option.value) {
                option.hidden = false;
                return;
            }

            const optionBranch =
                option.dataset.branch;

            const optionClass =
                option.dataset.class;

            option.hidden =
                optionBranch != branchId ||
                optionClass != classId;

        });

        sectionSelect.value = '';

    }


    branchSelect.addEventListener(
        'change',
        filterSections
    );

    classSelect.addEventListener(
        'change',
        filterSections
    );


    /*
    |--------------------------------------------------------------------------
    | Update Selected Counter
    |--------------------------------------------------------------------------
    */

    function updateSelectedCount() {

        const checked =
            document.querySelectorAll(
                '.student-checkbox:checked'
            );

        selectedCount.textContent =
            checked.length;

        selectAll.checked =
            checked.length > 0 &&
            checked.length ===
            document.querySelectorAll(
                '.student-checkbox'
            ).length;

        if (checked.length > 0) {

            bulkForm.classList.remove('hidden');

        } else {

            bulkForm.classList.add('hidden');

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Load Students
    |--------------------------------------------------------------------------
    */

    loadStudentsBtn.addEventListener(
        'click',
        async function () {

            const branchId =
                branchSelect.value;

            const sessionId =
                sessionSelect.value;

            const classId =
                classSelect.value;


            if (!branchId) {

                alert('Please select a branch.');

                branchSelect.focus();

                return;
            }


            if (!sessionId) {

                alert('Please select an academic session.');

                sessionSelect.focus();

                return;
            }


            if (!classId) {

                alert('Please select a class.');

                classSelect.focus();

                return;
            }


            loadStudentsBtn.disabled = true;

            loadIcon.classList.add('hidden');

            loadingIcon.classList.remove('hidden');

            loadButtonText.textContent =
                'Loading Students...';


            try {

                const params =
                    new URLSearchParams({
                        branch_id: branchId,
                        academic_session_id: sessionId,
                        class_id: classId
                    });


                const response =
                    await fetch(
                        "{{ route('admin.students.enrollments.bulk.students') }}?" +
                        params.toString(),
                        {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }
                    );


                if (!response.ok) {

                    throw new Error(
                        'Failed to load students.'
                    );

                }


                const data =
                    await response.json();


                renderStudents(
                    data.students || []
                );


            } catch (error) {

                console.error(error);

                alert(
                    'Unable to load students. Please try again.'
                );

            } finally {

                loadStudentsBtn.disabled = false;

                loadIcon.classList.remove('hidden');

                loadingIcon.classList.add('hidden');

                loadButtonText.textContent =
                    'Load Students';

            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Render Students
    |--------------------------------------------------------------------------
    */

    function renderStudents(students) {

        studentTableBody.innerHTML = '';

        mobileStudentList.innerHTML = '';

        selectAll.checked = false;

        selectedCount.textContent = '0';

        studentTotal.textContent =
            students.length;


        studentSection.classList.remove('hidden');


        if (!students.length) {

            noStudents.classList.remove('hidden');

            bulkForm.classList.add('hidden');

            return;

        }


        noStudents.classList.add('hidden');


        students.forEach(
            function (student, index) {

                /*
                |--------------------------------------------------------------------------
                | Desktop Row
                |--------------------------------------------------------------------------
                */

                const row =
                    document.createElement('tr');

                row.className =
                    'transition hover:bg-slate-50';


                row.innerHTML = `

                    <td class="px-5 py-4 text-center">

                        <input
                            type="checkbox"
                            name="students[]"
                            value="${student.id}"
                            class="student-checkbox h-4 w-4
                                   rounded border-slate-300
                                   text-blue-600
                                   focus:ring-blue-500"
                        >

                    </td>


                    <td class="px-5 py-4">

                        <div class="flex items-center gap-3">

                            ${
                                student.photo
                                ?
                                `<img
                                    src="/storage/${student.photo}"
                                    class="h-10 w-10 rounded-full object-cover"
                                    alt="${student.name}"
                                >`
                                :
                                `<div
                                    class="flex h-10 w-10 items-center
                                           justify-center rounded-full
                                           bg-blue-100 font-semibold
                                           text-blue-700"
                                >
                                    ${student.name
                                        ? student.name.charAt(0).toUpperCase()
                                        : 'S'}
                                </div>`
                            }

                            <div>

                                <p class="font-semibold text-slate-800">
                                    ${student.name ?? 'N/A'}
                                </p>

                                ${
                                    student.name_bn
                                    ?
                                    `<p class="text-xs text-slate-500">
                                        ${student.name_bn}
                                    </p>`
                                    :
                                    ''
                                }

                            </div>

                        </div>

                    </td>


                    <td class="px-5 py-4 text-sm text-slate-600">

                        ${student.student_id ?? 'N/A'}

                    </td>


                    <td class="px-5 py-4 text-sm text-slate-700">

                        ${
                            student.school_class
                            ? student.school_class.name
                            : 'N/A'
                        }

                    </td>


                    <td class="px-5 py-4 text-sm text-slate-600">

                        ${
                            student.section
                            ? student.section.name
                            : 'N/A'
                        }

                    </td>


                    <td class="px-5 py-4">

                        <input
                            type="number"
                            name="roll_nos[${student.id}]"
                            min="1"
                            placeholder="Roll"
                            class="w-28 rounded-lg border border-slate-300
                                   px-3 py-2 text-sm outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-500/20"
                        >

                    </td>

                `;


                studentTableBody.appendChild(row);


                /*
                |--------------------------------------------------------------------------
                | Mobile Card
                |--------------------------------------------------------------------------
                */

                const card =
                    document.createElement('div');

                card.className =
                    'rounded-xl border border-slate-200 bg-white p-4';


                card.innerHTML = `

                    <div class="flex items-start gap-3">

                        <input
                            type="checkbox"
                            name="students[]"
                            value="${student.id}"
                            class="student-checkbox mt-1 h-4 w-4
                                   rounded border-slate-300
                                   text-blue-600
                                   focus:ring-blue-500"
                        >


                        <div class="flex min-w-0 flex-1 items-center gap-3">

                            ${
                                student.photo
                                ?
                                `<img
                                    src="/storage/${student.photo}"
                                    class="h-11 w-11 shrink-0
                                           rounded-full object-cover"
                                    alt="${student.name}"
                                >`
                                :
                                `<div
                                    class="flex h-11 w-11 shrink-0
                                           items-center justify-center
                                           rounded-full bg-blue-100
                                           font-semibold text-blue-700"
                                >
                                    ${student.name
                                        ? student.name.charAt(0).toUpperCase()
                                        : 'S'}
                                </div>`
                            }


                            <div class="min-w-0">

                                <p class="truncate font-semibold text-slate-800">
                                    ${student.name ?? 'N/A'}
                                </p>

                                <p class="text-xs text-slate-500">
                                    ID: ${student.student_id ?? 'N/A'}
                                </p>

                            </div>

                        </div>

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-3">

                        <div class="rounded-lg bg-slate-50 p-3">

                            <p class="text-xs text-slate-500">
                                Current Class
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">

                                ${
                                    student.school_class
                                    ? student.school_class.name
                                    : 'N/A'
                                }

                            </p>

                        </div>


                        <div class="rounded-lg bg-slate-50 p-3">

                            <p class="text-xs text-slate-500">
                                Section
                            </p>

                            <p class="mt-1 text-sm font-semibold text-slate-700">

                                ${
                                    student.section
                                    ? student.section.name
                                    : 'N/A'
                                }

                            </p>

                        </div>

                    </div>


                    <div class="mt-3">

                        <label
                            class="mb-1 block text-xs font-medium
                                   text-slate-500"
                        >
                            New Roll Number
                        </label>

                        <input
                            type="number"
                            name="roll_nos[${student.id}]"
                            min="1"
                            placeholder="Enter roll number"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2 text-sm outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-500/20"
                        >

                    </div>

                `;


                mobileStudentList.appendChild(card);

            }
        );


        /*
        |--------------------------------------------------------------------------
        | Checkbox Events
        |--------------------------------------------------------------------------
        */

        document
            .querySelectorAll('.student-checkbox')
            .forEach(
                checkbox => {

                    checkbox.addEventListener(
                        'change',
                        updateSelectedCount
                    );

                }
            );


        updateSelectedCount();

    }


    /*
    |--------------------------------------------------------------------------
    | Select All
    |--------------------------------------------------------------------------
    */

    selectAll.addEventListener(
        'change',
        function () {

            document
                .querySelectorAll('.student-checkbox')
                .forEach(
                    checkbox => {

                        checkbox.checked =
                            selectAll.checked;

                    }
                );

            updateSelectedCount();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Submit Preparation
    |--------------------------------------------------------------------------
    */

    bulkForm.addEventListener(
        'submit',
        function (event) {

            const selected =
                document.querySelectorAll(
                    '.student-checkbox:checked'
                );


            if (!selected.length) {

                event.preventDefault();

                alert(
                    'Please select at least one student.'
                );

                return;

            }


            /*
            |--------------------------------------------------------------------------
            | Copy Enrollment Information
            |--------------------------------------------------------------------------
            */

            document.getElementById(
                'form_branch_id'
            ).value =
                branchSelect.value;


            document.getElementById(
                'form_academic_session_id'
            ).value =
                sessionSelect.value;


            document.getElementById(
                'form_class_id'
            ).value =
                classSelect.value;


            document.getElementById(
                'form_section_id'
            ).value =
                sectionSelect.value;


            document.getElementById(
                'form_enrollment_date'
            ).value =
                enrollmentDate.value;


            /*
            |--------------------------------------------------------------------------
            | Confirm
            |--------------------------------------------------------------------------
            */

            const confirmed =
                confirm(
                    `Are you sure you want to enroll ${selected.length} selected student(s)?`
                );


            if (!confirmed) {

                event.preventDefault();

                return;

            }

        }
    );

});

</script>

@endsection