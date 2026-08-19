@extends('admin.layouts.app')

@section('content')

<div class="min-h-screen bg-slate-50 px-4 py-6 sm:px-6 lg:px-8">

    <div class="mx-auto max-w-7xl">

        {{-- ========================================================= --}}
        {{-- HEADER --}}
        {{-- ========================================================= --}}

        <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-bold text-slate-900">
                    Bulk Student Enrollment
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Enroll multiple students at once.
                </p>
            </div>


            <a
                href="{{ route('admin.students.index') }}"
                class="inline-flex items-center justify-center rounded-lg
                       border border-slate-300 bg-white px-4 py-2.5
                       text-sm font-medium text-slate-700
                       transition hover:bg-slate-100"
            >
                ← Back
            </a>

        </div>


        {{-- ========================================================= --}}
        {{-- SUCCESS MESSAGE --}}
        {{-- ========================================================= --}}

        @if(session('success'))

            <div
                class="mb-6 rounded-xl border border-green-200
                       bg-green-50 px-4 py-3 text-sm text-green-700"
            >
                {{ session('success') }}
            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- ERROR MESSAGE --}}
        {{-- ========================================================= --}}

        @if($errors->any())

            <div
                class="mb-6 rounded-xl border border-red-200
                       bg-red-50 px-4 py-4"
            >

                <div class="font-semibold text-red-700">
                    Please fix the following errors:
                </div>

                <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

                    @foreach($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- ========================================================= --}}
        {{-- FILTER CARD --}}
        {{-- ========================================================= --}}

        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-200 px-5 py-4">

                <h2 class="text-lg font-semibold text-slate-900">
                    Enrollment Information
                </h2>

                <p class="mt-1 text-sm text-slate-500">
                    Select branch, academic session and class to load students.
                </p>

            </div>


            <div class="p-5">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 lg:grid-cols-4">


                    {{-- ================================================= --}}
                    {{-- BRANCH --}}
                    {{-- ================================================= --}}

                    <div>

                        <label
                            for="branch_id"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Branch
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="branch_id"
                            name="branch_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-900
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

                    </div>


                    {{-- ================================================= --}}
                    {{-- ACADEMIC SESSION --}}
                    {{-- ================================================= --}}

                    <div>

                        <label
                            for="academic_session_id"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Academic Session
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="academic_session_id"
                            name="academic_session_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-900
                                   outline-none transition
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-500/20"
                        >

                            <option value="">
                                Select Session
                            </option>

                            @foreach($academicSessions as $session)

                                <option value="{{ $session->id }}">
                                    {{ $session->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- ================================================= --}}
                    {{-- CLASS --}}
                    {{-- ================================================= --}}

                    <div>

                        <label
                            for="class_id"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Class
                            <span class="text-red-500">*</span>
                        </label>

                        <select
                            id="class_id"
                            name="class_id"
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-4 py-2.5 text-sm text-slate-900
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


                    {{-- ================================================= --}}
                    {{-- SECTION --}}
                    {{-- ================================================= --}}

                    <div>

                        <label
                            for="section_id"
                            class="mb-2 block text-sm font-medium text-slate-700"
                        >
                            Section
                        </label>

                        <select
                            id="section_id"
                            name="section_id"
                            disabled
                            class="w-full rounded-lg border border-slate-300
                                   bg-slate-100 px-4 py-2.5 text-sm
                                   text-slate-900 outline-none transition
                                   disabled:cursor-not-allowed"
                        >

                            <option value="">
                                Select Section
                            </option>

                        </select>

                    </div>

                </div>


                {{-- ===================================================== --}}
                {{-- LOAD STUDENTS BUTTON --}}
                {{-- ===================================================== --}}

                <div class="mt-6 flex justify-end">

                    <button
                        type="button"
                        id="loadStudentsBtn"
                        class="inline-flex items-center justify-center
                               rounded-lg bg-blue-600 px-5 py-2.5
                               text-sm font-semibold text-white
                               shadow-sm transition
                               hover:bg-blue-700
                               disabled:cursor-not-allowed
                               disabled:opacity-50"
                    >

                        <svg
                            id="loadIcon"
                            class="mr-2 h-4 w-4"
                            fill="none"
                            stroke="currentColor"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16"
                            />
                        </svg>

                        <span id="loadText">
                            Load Students
                        </span>

                    </button>

                </div>

            </div>

        </div>


        {{-- ========================================================= --}}
        {{-- STUDENTS SECTION --}}
        {{-- ========================================================= --}}

        <div
            id="studentsSection"
            class="mt-6 hidden"
        >

            <form
                id="bulkEnrollmentForm"
                method="POST"
                action="{{ route('admin.student-enrollments.bulk.store') }}"
            >

                @csrf


                {{-- Hidden values --}}

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


                {{-- ================================================= --}}
                {{-- STUDENT CARD --}}
                {{-- ================================================= --}}

                <div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">


                    {{-- ================================================= --}}
                    {{-- CARD HEADER --}}
                    {{-- ================================================= --}}

                    <div class="border-b border-slate-200 px-5 py-4">

                        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

                            <div>

                                <h2 class="text-lg font-semibold text-slate-900">
                                    Select Students
                                </h2>

                                <p class="mt-1 text-sm text-slate-500">

                                    Available Students:
                                    <span
                                        id="studentCount"
                                        class="font-semibold text-slate-900"
                                    >
                                        0
                                    </span>

                                </p>

                            </div>


                            <div class="flex items-center gap-3">

                                <span
                                    id="selectedCount"
                                    class="rounded-full bg-blue-50 px-3 py-1.5
                                           text-sm font-semibold text-blue-700"
                                >
                                    0 Selected
                                </span>

                            </div>

                        </div>

                    </div>


                    {{-- ================================================= --}}
                    {{-- TABLE --}}
                    {{-- ================================================= --}}

                    <div class="overflow-x-auto">

                        <table class="min-w-full divide-y divide-slate-200">

                            <thead class="bg-slate-50">

                                <tr>

                                    <th class="w-12 px-4 py-3 text-left">

                                        <input
                                            type="checkbox"
                                            id="selectAll"
                                            class="h-4 w-4 rounded border-slate-300
                                                   text-blue-600 focus:ring-blue-500"
                                        >

                                    </th>


                                    <th class="px-4 py-3 text-left text-xs
                                               font-semibold uppercase tracking-wider
                                               text-slate-500">
                                        Student
                                    </th>


                                    <th class="px-4 py-3 text-left text-xs
                                               font-semibold uppercase tracking-wider
                                               text-slate-500">
                                        Admission No
                                    </th>


                                    <th class="px-4 py-3 text-left text-xs
                                               font-semibold uppercase tracking-wider
                                               text-slate-500">
                                        Current Class
                                    </th>


                                    <th class="px-4 py-3 text-left text-xs
                                               font-semibold uppercase tracking-wider
                                               text-slate-500">
                                        Section
                                    </th>


                                    <th class="w-40 px-4 py-3 text-left text-xs
                                               font-semibold uppercase tracking-wider
                                               text-slate-500">
                                        Roll No
                                    </th>

                                </tr>

                            </thead>


                            <tbody
                                id="studentsTableBody"
                                class="divide-y divide-slate-200 bg-white"
                            >

                            </tbody>

                        </table>

                    </div>


                    {{-- ================================================= --}}
                    {{-- NO STUDENT --}}
                    {{-- ================================================= --}}

                    <div
                        id="noStudents"
                        class="hidden px-6 py-12 text-center"
                    >

                        <div class="text-4xl">
                            🎓
                        </div>

                        <h3 class="mt-3 text-base font-semibold text-slate-900">
                            No Students Found
                        </h3>

                        <p class="mt-1 text-sm text-slate-500">
                            No active students were found for the selected criteria.
                        </p>

                    </div>


                    {{-- ================================================= --}}
                    {{-- ENROLLMENT OPTIONS --}}
                    {{-- ================================================= --}}

                    <div
                        id="enrollmentOptions"
                        class="hidden border-t border-slate-200 bg-slate-50 p-5"
                    >

                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                            {{-- Enrollment Date --}}

                            <div>

                                <label
                                    for="enrollment_date"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Enrollment Date
                                    <span class="text-red-500">*</span>
                                </label>

                                <input
                                    type="date"
                                    name="enrollment_date"
                                    id="enrollment_date"
                                    value="{{ old('enrollment_date', date('Y-m-d')) }}"
                                    required
                                    class="w-full rounded-lg border border-slate-300
                                           bg-white px-4 py-2.5 text-sm
                                           outline-none transition
                                           focus:border-blue-500
                                           focus:ring-2 focus:ring-blue-500/20"
                                >

                            </div>


                            {{-- Section --}}

                            <div>

                                <label
                                    for="final_section_id"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Enrollment Section
                                </label>

                                <select
                                    name="section_id"
                                    id="final_section_id"
                                    class="w-full rounded-lg border border-slate-300
                                           bg-white px-4 py-2.5 text-sm
                                           outline-none transition
                                           focus:border-blue-500
                                           focus:ring-2 focus:ring-blue-500/20"
                                >

                                    <option value="">
                                        No Section
                                    </option>

                                </select>

                            </div>


                            {{-- Remarks --}}

                            <div class="md:col-span-2">

                                <label
                                    for="remarks"
                                    class="mb-2 block text-sm font-medium text-slate-700"
                                >
                                    Remarks
                                </label>

                                <textarea
                                    name="remarks"
                                    id="remarks"
                                    rows="3"
                                    maxlength="1000"
                                    placeholder="Optional remarks..."
                                    class="w-full rounded-lg border border-slate-300
                                           bg-white px-4 py-2.5 text-sm
                                           outline-none transition
                                           focus:border-blue-500
                                           focus:ring-2 focus:ring-blue-500/20"
                                ></textarea>

                            </div>

                        </div>


                        {{-- ================================================= --}}
                        {{-- SUBMIT --}}
                        {{-- ================================================= --}}

                        <div class="mt-6 flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

                            <a  
                                href="{{ route('admin.student-enrollments.bulk.create') }}"
                                class="inline-flex items-center justify-center
                                       rounded-lg border border-slate-300
                                       bg-white px-5 py-2.5 text-sm
                                       font-medium text-slate-700
                                       hover:bg-slate-100"
                            >
                                Cancel
                            </a>


                            <button
                                type="submit"
                                id="submitBtn"
                                disabled
                                class="inline-flex items-center justify-center
                                       rounded-lg bg-green-600 px-5 py-2.5
                                       text-sm font-semibold text-white
                                       shadow-sm transition
                                       hover:bg-green-700
                                       disabled:cursor-not-allowed
                                       disabled:opacity-50"
                            >

                                <svg
                                    class="mr-2 h-4 w-4"
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

                                Enroll Selected Students

                            </button>

                        </div>

                    </div>

                </div>

            </form>

        </div>

    </div>

</div>


{{-- ================================================================ --}}
{{-- JAVASCRIPT --}}
{{-- ================================================================ --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | Elements
    |--------------------------------------------------------------------------
    */

    const branchSelect =
        document.getElementById('branch_id');

    const sessionSelect =
        document.getElementById('academic_session_id');

    const classSelect =
        document.getElementById('class_id');

    const sectionSelect =
        document.getElementById('section_id');

    const finalSectionSelect =
        document.getElementById('final_section_id');

    const loadStudentsBtn =
        document.getElementById('loadStudentsBtn');

    const studentsSection =
        document.getElementById('studentsSection');

    const studentsTableBody =
        document.getElementById('studentsTableBody');

    const noStudents =
        document.getElementById('noStudents');

    const enrollmentOptions =
        document.getElementById('enrollmentOptions');

    const selectAll =
        document.getElementById('selectAll');

    const selectedCount =
        document.getElementById('selectedCount');

    const studentCount =
        document.getElementById('studentCount');

    const submitBtn =
        document.getElementById('submitBtn');

    const formBranchId =
        document.getElementById('form_branch_id');

    const formSessionId =
        document.getElementById('form_academic_session_id');

    const formClassId =
        document.getElementById('form_class_id');


    /*
    |--------------------------------------------------------------------------
    | Load Sections
    |--------------------------------------------------------------------------
    */

    async function loadSections() {

        const branchId =
            branchSelect.value;

        const classId =
            classSelect.value;


        sectionSelect.innerHTML =
            '<option value="">Select Section</option>';

        finalSectionSelect.innerHTML =
            '<option value="">No Section</option>';


        if (!branchId || !classId) {

            sectionSelect.disabled = true;

            return;
        }


        sectionSelect.disabled = true;


        sectionSelect.innerHTML =
            '<option value="">Loading...</option>';


        try {

            const url =
                "{{ route('admin.students.enrollments.sections') }}"
                + "?branch_id="
                + encodeURIComponent(branchId)
                + "&class_id="
                + encodeURIComponent(classId);


            const response =
                await fetch(url, {
                    headers: {
                        'Accept': 'application/json'
                    }
                });


            if (!response.ok) {

                throw new Error(
                    'Unable to load sections.'
                );
            }


            const sections =
                await response.json();


            sectionSelect.innerHTML =
                '<option value="">Select Section</option>';

            finalSectionSelect.innerHTML =
                '<option value="">No Section</option>';


            sections.forEach(function (section) {

                const option =
                    document.createElement('option');

                option.value =
                    section.id;

                option.textContent =
                    section.name;

                sectionSelect.appendChild(option);


                const finalOption =
                    document.createElement('option');

                finalOption.value =
                    section.id;

                finalOption.textContent =
                    section.name;

                finalSectionSelect.appendChild(
                    finalOption
                );

            });


            sectionSelect.disabled =
                false;


        } catch (error) {

            console.error(error);

            sectionSelect.innerHTML =
                '<option value="">Unable to load sections</option>';

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Branch / Class Change
    |--------------------------------------------------------------------------
    */

    branchSelect.addEventListener(
        'change',
        function () {

            loadSections();

            clearStudents();

        }
    );


    classSelect.addEventListener(
        'change',
        function () {

            loadSections();

            clearStudents();

        }
    );


    sessionSelect.addEventListener(
        'change',
        function () {

            clearStudents();

        }
    );


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

                alert(
                    'Please select a branch.'
                );

                return;
            }


            if (!sessionId) {

                alert(
                    'Please select an academic session.'
                );

                return;
            }


            if (!classId) {

                alert(
                    'Please select a class.'
                );

                return;
            }


            /*
            |--------------------------------------------------------------
            | Button Loading
            |--------------------------------------------------------------
            */

            loadStudentsBtn.disabled = true;

            document.getElementById('loadText').textContent =
                'Loading...';


            try {

                const url =
                    "{{ route('admin.student-enrollments.bulk.students') }}"
                    + "?branch_id="
                    + encodeURIComponent(branchId)
                    + "&academic_session_id="
                    + encodeURIComponent(sessionId)
                    + "&class_id="
                    + encodeURIComponent(classId);


                const response =
                    await fetch(url, {

                        method: 'GET',

                        headers: {
                            'Accept': 'application/json'
                        }

                    });


                if (!response.ok) {

                    throw new Error(
                        'Unable to load students.'
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
                    'Something went wrong while loading students.'
                );

            } finally {

                loadStudentsBtn.disabled =
                    false;

                document.getElementById('loadText').textContent =
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

        studentsTableBody.innerHTML = '';

        selectAll.checked = false;

        updateSelectedCount();


        studentsSection.classList.remove(
            'hidden'
        );


        studentCount.textContent =
            students.length;


        if (students.length === 0) {

            noStudents.classList.remove(
                'hidden'
            );

            enrollmentOptions.classList.add(
                'hidden'
            );

            return;
        }


        noStudents.classList.add(
            'hidden'
        );

        enrollmentOptions.classList.remove(
            'hidden'
        );


        /*
        |--------------------------------------------------------------
        | Hidden Form IDs
        |--------------------------------------------------------------
        */

        formBranchId.value =
            branchSelect.value;

        formSessionId.value =
            sessionSelect.value;

        formClassId.value =
            classSelect.value;


        /*
        |--------------------------------------------------------------
        | Students
        |--------------------------------------------------------------
        */

        students.forEach(function (student) {

            const row =
                document.createElement('tr');


            row.className =
                'hover:bg-slate-50 transition';


            const studentName =
                student.name ?? '-';


            const admissionNo =
                student.admission_no ?? '-';


            const className =
                student.school_class
                    ? student.school_class.name
                    : '-';


            const sectionName =
                student.section
                    ? student.section.name
                    : '-';


            row.innerHTML = `

                <td class="px-4 py-4">

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


                <td class="px-4 py-4">

                    <div class="font-medium text-slate-900">
                        ${escapeHtml(studentName)}
                    </div>

                    ${
                        student.name_bn
                        ?
                        `<div class="mt-0.5 text-xs text-slate-500">
                            ${escapeHtml(student.name_bn)}
                        </div>`
                        :
                        ''
                    }

                </td>


                <td class="px-4 py-4 text-sm text-slate-600">

                    ${escapeHtml(admissionNo)}

                </td>


                <td class="px-4 py-4 text-sm text-slate-600">

                    ${escapeHtml(className)}

                </td>


                <td class="px-4 py-4 text-sm text-slate-600">

                    ${escapeHtml(sectionName)}

                </td>


                <td class="px-4 py-4">

                    <input
                        type="number"
                        name="roll_nos[${student.id}]"
                        min="1"
                        placeholder="Roll"
                        class="roll-input w-28 rounded-lg
                               border border-slate-300
                               px-3 py-2 text-sm
                               outline-none transition
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-500/20"
                    >

                </td>

            `;


            studentsTableBody.appendChild(
                row
            );

        });


        updateCheckboxListeners();

    }


    /*
    |--------------------------------------------------------------------------
    | Checkbox Listeners
    |--------------------------------------------------------------------------
    */

    function updateCheckboxListeners() {

        const checkboxes =
            document.querySelectorAll(
                '.student-checkbox'
            );


        checkboxes.forEach(function (checkbox) {

            checkbox.addEventListener(
                'change',
                function () {

                    updateSelectedCount();

                }
            );

        });


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

            const checkboxes =
                document.querySelectorAll(
                    '.student-checkbox'
                );


            checkboxes.forEach(
                function (checkbox) {

                    checkbox.checked =
                        selectAll.checked;

                }
            );


            updateSelectedCount();

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Update Selected Count
    |--------------------------------------------------------------------------
    */

    function updateSelectedCount() {

        const checkboxes =
            document.querySelectorAll(
                '.student-checkbox'
            );


        const checked =
            document.querySelectorAll(
                '.student-checkbox:checked'
            );


        selectedCount.textContent =
            checked.length + ' Selected';


        submitBtn.disabled =
            checked.length === 0;


        if (
            checkboxes.length > 0 &&
            checked.length === checkboxes.length
        ) {

            selectAll.checked = true;

        } else {

            selectAll.checked = false;

        }

    }


    /*
    |--------------------------------------------------------------------------
    | Clear Students
    |--------------------------------------------------------------------------
    */

    function clearStudents() {

        studentsSection.classList.add(
            'hidden'
        );

        studentsTableBody.innerHTML = '';

        studentCount.textContent =
            '0';

        selectedCount.textContent =
            '0 Selected';

        submitBtn.disabled =
            true;

        selectAll.checked =
            false;

    }


    /*
    |--------------------------------------------------------------------------
    | Form Submit Confirmation
    |--------------------------------------------------------------------------
    */

    document
        .getElementById('bulkEnrollmentForm')
        .addEventListener(
            'submit',
            function (event) {

                const selected =
                    document.querySelectorAll(
                        '.student-checkbox:checked'
                    );


                if (selected.length === 0) {

                    event.preventDefault();

                    alert(
                        'Please select at least one student.'
                    );

                    return;
                }


                const confirmed =
                    confirm(
                        'Are you sure you want to enroll '
                        + selected.length
                        + ' selected student(s)?'
                    );


                if (!confirmed) {

                    event.preventDefault();

                }

            }
        );


    /*
    |--------------------------------------------------------------------------
    | HTML Escape
    |--------------------------------------------------------------------------
    */

    function escapeHtml(value) {

        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');

    }

});

</script>

@endsection