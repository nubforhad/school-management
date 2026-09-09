@extends('admin.layouts.app')

@section('title', 'Add Guardian')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Add Parent / Guardian
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Create guardian information and assign students
            </p>
        </div>

        <a href="{{ route('admin.guardians.index') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg
                  bg-slate-100 hover:bg-slate-200
                  text-slate-700 text-sm font-medium
                  transition">

            ← Back to Guardians

        </a>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-6 rounded-lg border border-red-200
                    bg-red-50 px-4 py-3">

            <p class="font-semibold text-red-700 mb-2">
                Please fix the following errors:
            </p>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)

                    <li>{{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form action="{{ route('admin.guardians.store') }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf


        {{-- Guardian Information --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm p-6 mb-6">

            <div class="mb-5">

                <h2 class="text-lg font-semibold text-slate-800">
                    Guardian Information
                </h2>

                <p class="text-sm text-slate-500 mt-1">
                    Enter parent or guardian personal information.
                </p>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- Branch --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Branch <span class="text-red-500">*</span>

                    </label>

                    <select name="branch_id"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   outline-none">

                        <option value="">Select Branch</option>

                        @foreach($branches as $branch)

                            <option value="{{ $branch->id }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Name --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Full Name <span class="text-red-500">*</span>

                    </label>

                    <input type="text"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           placeholder="Enter guardian name"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- Phone --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Phone

                    </label>

                    <input type="text"
                           name="phone"
                           value="{{ old('phone') }}"
                           placeholder="01XXXXXXXXX"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- Email --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Email

                    </label>

                    <input type="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="example@email.com"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- NID --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        NID

                    </label>

                    <input type="text"
                           name="nid"
                           value="{{ old('nid') }}"
                           placeholder="National ID number"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- Occupation --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Occupation

                    </label>

                    <input type="text"
                           name="occupation"
                           value="{{ old('occupation') }}"
                           placeholder="e.g. Businessman, Teacher"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- Photo --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Photo

                    </label>

                    <input type="file"
                           name="photo"
                           accept="image/jpeg,image/png,image/webp"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2 text-sm
                                  file:mr-3 file:py-1.5 file:px-3
                                  file:rounded-md file:border-0
                                  file:bg-blue-50 file:text-blue-700">

                    <p class="text-xs text-slate-500 mt-1">
                        JPG, JPEG, PNG or WEBP. Maximum 2MB.
                    </p>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Status

                    </label>

                    <label class="flex items-center gap-3
                                  cursor-pointer mt-2">

                        <input type="checkbox"
                               name="status"
                               value="1"
                               checked
                               class="w-4 h-4 rounded
                                      border-slate-300
                                      text-blue-600
                                      focus:ring-blue-500">

                        <span class="text-sm text-slate-700">
                            Active Guardian
                        </span>

                    </label>

                </div>


                {{-- Address --}}
                <div class="md:col-span-2 lg:col-span-3">

                    <label class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Address

                    </label>

                    <textarea name="address"
                              rows="3"
                              placeholder="Enter full address"
                              class="w-full rounded-lg border border-slate-300
                                     px-3 py-2.5 text-sm
                                     focus:border-blue-500
                                     focus:ring-2 focus:ring-blue-100
                                     outline-none">{{ old('address') }}</textarea>

                </div>

            </div>

        </div>


        {{-- Student Assignment --}}
        <div class="bg-white border border-slate-200
                    rounded-xl shadow-sm p-6 mb-6">

            <div class="flex flex-col md:flex-row
                        md:items-center md:justify-between
                        gap-3 mb-5">

                <div>

                    <h2 class="text-lg font-semibold text-slate-800">
                        Student Assignment
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Assign one or more students to this guardian.
                    </p>

                </div>

                <button type="button"
                        id="addStudentBtn"
                        class="inline-flex items-center justify-center gap-2
                               px-4 py-2 rounded-lg
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-medium
                               transition">

                    + Add Student

                </button>

            </div>


            <div id="studentRows" class="space-y-3">

                {{-- First Student Row --}}
                <div class="student-row grid grid-cols-1 md:grid-cols-12
                            gap-3 items-end">

                    {{-- Student --}}
                    <div class="md:col-span-6">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Student

                        </label>

                        <select name="students[0][student_id]"
                                class="student-select w-full rounded-lg
                                       border border-slate-300
                                       px-3 py-2.5 text-sm
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Student
                            </option>

                            @foreach($students as $student)

                                <option value="{{ $student->id }}">

                                    {{ $student->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Relationship --}}
                    <div class="md:col-span-4">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Relationship

                        </label>

                        <select name="students[0][relationship]"
                                class="w-full rounded-lg border
                                       border-slate-300
                                       px-3 py-2.5 text-sm
                                       focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100
                                       outline-none">

                            <option value="">
                                Select Relationship
                            </option>

                            <option value="Father">
                                Father
                            </option>

                            <option value="Mother">
                                Mother
                            </option>

                            <option value="Guardian">
                                Guardian
                            </option>

                            <option value="Brother">
                                Brother
                            </option>

                            <option value="Sister">
                                Sister
                            </option>

                            <option value="Other">
                                Other
                            </option>

                        </select>

                    </div>


                    {{-- Primary --}}
                    <div class="md:col-span-2">

                        <label class="flex items-center gap-2
                                      cursor-pointer mb-2">

                            <input type="checkbox"
                                   name="students[0][is_primary]"
                                   value="1"
                                   class="primary-checkbox w-4 h-4
                                          rounded border-slate-300
                                          text-blue-600
                                          focus:ring-blue-500">

                            <span class="text-sm text-slate-700">
                                Primary
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            <div class="mt-4 p-3 rounded-lg bg-blue-50
                        border border-blue-100">

                <p class="text-xs text-blue-700">

                    <strong>Note:</strong>
                    You can assign multiple students to the same guardian.
                    Only one relationship can be marked as primary.

                </p>

            </div>

        </div>


        {{-- Submit --}}
        <div class="flex flex-col sm:flex-row
                    justify-end gap-3">

            <a href="{{ route('admin.guardians.index') }}"
               class="px-5 py-2.5 rounded-lg
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700 text-sm font-medium
                      text-center transition">

                Cancel

            </a>

            <button type="submit"
                    class="px-5 py-2.5 rounded-lg
                           bg-blue-600 hover:bg-blue-700
                           text-white text-sm font-medium
                           transition">

                Save Guardian

            </button>

        </div>

    </form>

</div>


{{-- JavaScript --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const addStudentBtn = document.getElementById('addStudentBtn');

    const studentRows = document.getElementById('studentRows');

    let rowIndex = 1;


    addStudentBtn.addEventListener('click', function () {

        const row = document.createElement('div');

        row.className =
            'student-row grid grid-cols-1 md:grid-cols-12 gap-3 items-end';


        row.innerHTML = `

            <div class="md:col-span-6">

                <label class="block text-sm font-medium
                              text-slate-700 mb-1.5">

                    Student

                </label>

                <select name="students[${rowIndex}][student_id]"
                        class="student-select w-full rounded-lg
                               border border-slate-300
                               px-3 py-2.5 text-sm
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-100
                               outline-none">

                    <option value="">
                        Select Student
                    </option>

                    @foreach($students as $student)

                        <option value="{{ $student->id }}">
                            {{ addslashes($student->name) }}
                        </option>

                    @endforeach

                </select>

            </div>


            <div class="md:col-span-3">

                <label class="block text-sm font-medium
                              text-slate-700 mb-1.5">

                    Relationship

                </label>

                <select name="students[${rowIndex}][relationship]"
                        class="w-full rounded-lg border
                               border-slate-300
                               px-3 py-2.5 text-sm
                               focus:border-blue-500
                               focus:ring-2 focus:ring-blue-100
                               outline-none">

                    <option value="">
                        Select Relationship
                    </option>

                    <option value="Father">Father</option>
                    <option value="Mother">Mother</option>
                    <option value="Guardian">Guardian</option>
                    <option value="Brother">Brother</option>
                    <option value="Sister">Sister</option>
                    <option value="Other">Other</option>

                </select>

            </div>


            <div class="md:col-span-2">

                <label class="flex items-center gap-2
                              cursor-pointer mb-2">

                    <input type="checkbox"
                           name="students[${rowIndex}][is_primary]"
                           value="1"
                           class="primary-checkbox w-4 h-4
                                  rounded border-slate-300
                                  text-blue-600
                                  focus:ring-blue-500">

                    <span class="text-sm text-slate-700">
                        Primary
                    </span>

                </label>

            </div>


            <div class="md:col-span-1">

                <button type="button"
                        class="remove-student w-full px-3 py-2.5
                               rounded-lg bg-red-50
                               hover:bg-red-100
                               text-red-600 text-sm
                               font-medium transition">

                    Remove

                </button>

            </div>

        `;


        studentRows.appendChild(row);

        rowIndex++;

    });


    // Remove Student Row
    studentRows.addEventListener('click', function (event) {

        if (
            event.target.classList.contains('remove-student')
        ) {

            const rows =
                studentRows.querySelectorAll('.student-row');

            if (rows.length > 1) {

                event.target
                    .closest('.student-row')
                    .remove();

            }

        }

    });


    // Only one primary checkbox
    studentRows.addEventListener('change', function (event) {

        if (
            event.target.classList.contains('primary-checkbox') &&
            event.target.checked
        ) {

            document
                .querySelectorAll('.primary-checkbox')
                .forEach(function (checkbox) {

                    if (checkbox !== event.target) {
                        checkbox.checked = false;
                    }

                });

        }

    });

});

</script>

@endsection