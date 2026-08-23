@extends('admin.layouts.app')

@section('title', 'Enroll / Promote Student')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

    {{-- Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Enroll / Promote Student
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create a new academic enrollment for this student.
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


    {{-- Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <p class="font-semibold text-red-700">
                Please fix the following:
            </p>

            <ul class="mt-2 list-disc pl-5 text-sm text-red-600">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- Student --}}
    <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

        <div class="border-b border-slate-100 px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Student Information
            </h2>

        </div>


        <div class="grid grid-cols-2 gap-4 p-5 md:grid-cols-4">

            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Name
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
                    Current Class
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->schoolClass?->name ?? 'Not Assigned' }}
                </p>

            </div>


            <div class="rounded-xl bg-slate-50 p-4">

                <p class="text-xs text-slate-500">
                    Current Section / Roll
                </p>

                <p class="mt-1 font-semibold text-slate-800">
                    {{ $student->section?->name ?? '-' }}
                    /
                    {{ $student->roll_no ?? '-' }}
                </p>

            </div>

        </div>

    </div>


    {{-- Form --}}
    <form
        method="POST"
        action="{{ route('admin.students.enrollments.store', $student) }}"
        class="space-y-6"
    >

        @csrf


        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="border-b border-slate-100 px-5 py-4">

                <h2 class="font-semibold text-slate-800">
                    New Enrollment
                </h2>

            </div>


            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">


                {{-- Branch --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Branch <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="branch_id"
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm focus:border-blue-500
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


                {{-- Session --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Academic Session <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="academic_session_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Session
                        </option>

                        @foreach($academicSessions as $session)

                            <option
                                value="{{ $session->id }}"
                                @selected(
                                    old(
                                        'academic_session_id',
                                        $student->academic_session_id
                                    ) == $session->id
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


                {{-- Class --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Class <span class="text-red-500">*</span>
                    </label>

                    <select
                        id="class_id"
                        name="class_id"
                        required
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                        <option value="">
                            Select Class
                        </option>

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                data-branch="{{ $class->branch_id }}"
                                @selected(
                                    old(
                                        'class_id',
                                        $currentEnrollment?->class_id
                                    ) == $class->id
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


                {{-- Section --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Section
                    </label>

                    <select
                        id="section_id"
                        name="section_id"
                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-2.5 text-sm focus:border-blue-500
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
                                @selected(
                                    old(
                                        'section_id',
                                        $currentEnrollment?->section_id
                                    ) == $section->id
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


                {{-- Roll --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Roll Number
                    </label>

                    <input
                        type="number"
                        name="roll_no"
                        min="1"
                        value="{{ old('roll_no') }}"
                        placeholder="Enter roll number"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('roll_no')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Enrollment Date --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Enrollment Date <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="date"
                        name="enrollment_date"
                        required
                        value="{{ old('enrollment_date', now()->format('Y-m-d')) }}"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm focus:border-blue-500
                               focus:ring-2 focus:ring-blue-500/20"
                    >

                    @error('enrollment_date')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Remarks --}}
                <div class="md:col-span-2">

                    <label class="mb-1.5 block text-sm font-semibold text-slate-700">
                        Remarks
                    </label>

                    <textarea
                        name="remarks"
                        rows="4"
                        placeholder="Example: Promoted from Class Five to Class Six."
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm focus:border-blue-500
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


        {{-- Warning --}}
        @if($currentEnrollment)

            <div class="rounded-2xl border border-blue-200 bg-blue-50 p-5">

                <p class="font-semibold text-blue-800">
                    Current Enrollment
                </p>

                <p class="mt-1 text-sm text-blue-700">

                    Currently:

                    <strong>
                        {{ $currentEnrollment->schoolClass?->name }}
                    </strong>

                    @if($currentEnrollment->section)
                        / {{ $currentEnrollment->section->name }}
                    @endif

                    @if($currentEnrollment->roll_no)
                        / Roll {{ $currentEnrollment->roll_no }}
                    @endif

                </p>

                <p class="mt-2 text-sm text-blue-700">

                    After creating the new enrollment, this active enrollment
                    will automatically become completed or transferred.

                </p>

            </div>

        @endif


        {{-- Buttons --}}
        <div class="flex flex-col-reverse gap-3 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.students.enrollments.index', $student) }}"
                class="rounded-xl border border-slate-200 bg-white
                       px-5 py-2.5 text-center text-sm font-semibold
                       text-slate-700 hover:bg-slate-50"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white hover:bg-blue-700"
            >
                Confirm Enrollment
            </button>

        </div>

    </form>

</div>


{{-- Dynamic Class / Section --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const branchSelect = document.getElementById('branch_id');
    const classSelect = document.getElementById('class_id');
    const sectionSelect = document.getElementById('section_id');


    function filterClasses() {

        const branchId = branchSelect.value;

        Array.from(classSelect.options).forEach(option => {

            if (!option.value) {
                return;
            }

            option.hidden =
                option.dataset.branch != branchId;

        });


        if (
            classSelect.selectedOptions[0] &&
            classSelect.selectedOptions[0].hidden
        ) {

            classSelect.value = '';

        }


        filterSections();

    }


    function filterSections() {

        const branchId = branchSelect.value;
        const classId = classSelect.value;

        Array.from(sectionSelect.options).forEach(option => {

            if (!option.value) {
                return;
            }

            option.hidden =
                option.dataset.branch != branchId ||
                option.dataset.class != classId;

        });


        if (
            sectionSelect.selectedOptions[0] &&
            sectionSelect.selectedOptions[0].hidden
        ) {

            sectionSelect.value = '';

        }

    }


    branchSelect.addEventListener(
        'change',
        filterClasses
    );


    classSelect.addEventListener(
        'change',
        filterSections
    );


    filterClasses();

});

</script>

@endsection