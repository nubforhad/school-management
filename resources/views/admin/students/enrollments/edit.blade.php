@extends('admin.layouts.app')

@section('title', 'Edit Enrollment')

@section('content')

<div class="mx-auto max-w-6xl space-y-6">

    <div class="flex items-center justify-between">

        <div>

            <h1 class="text-2xl font-bold text-slate-800">
                Edit Enrollment
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Update this student's enrollment information.
            </p>

        </div>


        <a
            href="{{ route(
                'admin.students.enrollments.index',
                $student
            ) }}"
            class="rounded-xl border border-slate-200 bg-white
                   px-4 py-2.5 text-sm font-semibold text-slate-700
                   hover:bg-slate-50"
        >
            Back
        </a>

    </div>


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


    <form
        method="POST"
        action="{{ route(
            'admin.students.enrollments.update',
            [$student, $enrollment]
        ) }}"
        class="space-y-6"
    >

        @csrf

        @method('PUT')


        <div class="rounded-2xl border border-slate-200 bg-white shadow-sm">

            <div class="grid grid-cols-1 gap-5 p-5 md:grid-cols-2">


                {{-- Branch --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Branch
                    </label>

                    <select
                        id="branch_id"
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                @selected(
                                    old(
                                        'branch_id',
                                        $enrollment->branch_id
                                    ) == $branch->id
                                )
                            >
                                {{ $branch->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Session --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Academic Session
                    </label>

                    <select
                        name="academic_session_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                        @foreach($academicSessions as $session)

                            <option
                                value="{{ $session->id }}"
                                @selected(
                                    old(
                                        'academic_session_id',
                                        $enrollment->academic_session_id
                                    ) == $session->id
                                )
                            >
                                {{ $session->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Class --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Class
                    </label>

                    <select
                        id="class_id"
                        name="class_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                        @foreach($classes as $class)

                            <option
                                value="{{ $class->id }}"
                                data-branch="{{ $class->branch_id }}"
                                @selected(
                                    old(
                                        'class_id',
                                        $enrollment->class_id
                                    ) == $class->id
                                )
                            >
                                {{ $class->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Section --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Section
                    </label>

                    <select
                        id="section_id"
                        name="section_id"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                        <option value="">
                            No Section
                        </option>

                        @foreach($sections as $section)

                            <option
                                value="{{ $section->id }}"
                                data-branch="{{ $section->branch_id }}"
                                data-class="{{ $section->class_id }}"
                                @selected(
                                    old(
                                        'section_id',
                                        $enrollment->section_id
                                    ) == $section->id
                                )
                            >
                                {{ $section->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Roll --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Roll Number
                    </label>

                    <input
                        type="number"
                        name="roll_no"
                        min="1"
                        value="{{ old(
                            'roll_no',
                            $enrollment->roll_no
                        ) }}"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                </div>


                {{-- Date --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Enrollment Date
                    </label>

                    <input
                        type="date"
                        name="enrollment_date"
                        required
                        value="{{ old(
                            'enrollment_date',
                            $enrollment->enrollment_date?->format('Y-m-d')
                        ) }}"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                </div>


                {{-- Status --}}
                <div>

                    <label class="mb-1.5 block text-sm font-semibold">
                        Status
                    </label>

                    <select
                        name="status"
                        required
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-2.5 text-sm"
                    >

                        @foreach([
                            'active',
                            'completed',
                            'transferred',
                            'inactive'
                        ] as $status)

                            <option
                                value="{{ $status }}"
                                @selected(
                                    old(
                                        'status',
                                        $enrollment->status
                                    ) === $status
                                )
                            >
                                {{ ucfirst($status) }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Remarks --}}
                <div class="md:col-span-2">

                    <label class="mb-1.5 block text-sm font-semibold">
                        Remarks
                    </label>

                    <textarea
                        name="remarks"
                        rows="4"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm"
                    >{{ old(
                        'remarks',
                        $enrollment->remarks
                    ) }}</textarea>

                </div>

            </div>

        </div>


        <div class="flex justify-end gap-3">

            <a
                href="{{ route(
                    'admin.students.enrollments.show',
                    [$student, $enrollment]
                ) }}"
                class="rounded-xl border border-slate-200 bg-white
                       px-5 py-2.5 text-sm font-semibold"
            >
                Cancel
            </a>


            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white hover:bg-blue-700"
            >
                Update Enrollment
            </button>

        </div>

    </form>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const branch = document.getElementById('branch_id');
    const classSelect = document.getElementById('class_id');
    const section = document.getElementById('section_id');


    function filterClasses() {

        const branchId = branch.value;

        Array.from(classSelect.options).forEach(option => {

            if (!option.value) return;

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

        const branchId = branch.value;
        const classId = classSelect.value;

        Array.from(section.options).forEach(option => {

            if (!option.value) return;

            option.hidden =
                option.dataset.branch != branchId ||
                option.dataset.class != classId;

        });


        if (
            section.selectedOptions[0] &&
            section.selectedOptions[0].hidden
        ) {
            section.value = '';
        }

    }


    branch.addEventListener(
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