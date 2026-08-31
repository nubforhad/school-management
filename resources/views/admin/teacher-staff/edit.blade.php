@extends('admin.layouts.app')

@section('title', 'Edit Teacher / Staff')

@section('page-title', 'Edit Teacher / Staff')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">

        <a href="{{ route('admin.teacher-staff.index') }}"
           class="inline-flex items-center gap-2
                  text-sm text-slate-500
                  hover:text-blue-600 transition">

            <i class="bi bi-arrow-left"></i>
            Back to Teachers & Staff

        </a>

        <div class="mt-4">

            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Edit Teacher / Staff
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Update teacher or staff member information
            </p>

        </div>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200
                    bg-red-50 px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0
                            items-center justify-center
                            rounded-full bg-red-100
                            text-red-600">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-1 list-disc list-inside
                               text-xs text-red-700 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        <form action="{{ route('admin.teacher-staff.update', $teacherStaff->id) }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf
            @method('PUT')


            {{-- Personal Information --}}
            <div class="px-4 sm:px-6 py-4
                        border-b border-slate-200
                        bg-slate-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center
                                justify-center rounded-lg
                                bg-blue-50 text-blue-600">

                        <i class="bi bi-person"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Personal Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Basic information of the teacher or staff
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">


                    {{-- Photo --}}
                    <div class="lg:col-span-3">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-2">

                            Profile Photo

                        </label>

                        <div class="flex items-center gap-4">

                            {{-- Preview --}}
                            <div id="photoPreview"
                                 class="flex h-20 w-20 shrink-0
                                        items-center justify-center
                                        rounded-full
                                        bg-blue-50
                                        text-blue-600
                                        overflow-hidden">

                                @if($teacherStaff->photo)

                                    <img src="{{ asset('storage/' . $teacherStaff->photo) }}"
                                         alt="{{ $teacherStaff->name }}"
                                         class="h-full w-full object-cover">

                                @else

                                    <i class="bi bi-person text-3xl"></i>

                                @endif

                            </div>


                            <div>

                                <input type="file"
                                       name="photo"
                                       id="photo"
                                       accept="image/*"
                                       onchange="previewPhoto(event)"
                                       class="block w-full text-sm
                                              text-slate-500
                                              file:mr-3
                                              file:rounded-lg
                                              file:border-0
                                              file:bg-blue-50
                                              file:px-3
                                              file:py-2
                                              file:text-sm
                                              file:font-medium
                                              file:text-blue-700
                                              hover:file:bg-blue-100">

                                <p class="mt-1 text-xs text-slate-400">
                                    Leave empty to keep current photo.
                                    JPG, JPEG, PNG or WEBP. Max 2MB.
                                </p>

                            </div>

                        </div>


                        @error('photo')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Employee ID --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Employee ID
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               name="employee_id"
                               value="{{ old('employee_id', $teacherStaff->employee_id) }}"
                               placeholder="e.g. EMP-001"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      @error('employee_id')
                                          border-red-400
                                      @enderror">

                        @error('employee_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Name --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Full Name
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $teacherStaff->name) }}"
                               placeholder="Enter full name"
                               required
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      @error('name')
                                          border-red-400
                                      @enderror">

                        @error('name')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Gender --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Gender

                        </label>

                        <select name="gender"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                Select Gender
                            </option>

                            <option value="Male"
                                {{ old('gender', $teacherStaff->gender) == 'Male' ? 'selected' : '' }}>
                                Male
                            </option>

                            <option value="Female"
                                {{ old('gender', $teacherStaff->gender) == 'Female' ? 'selected' : '' }}>
                                Female
                            </option>

                            <option value="Other"
                                {{ old('gender', $teacherStaff->gender) == 'Other' ? 'selected' : '' }}>
                                Other
                            </option>

                        </select>

                    </div>


                    {{-- Date of Birth --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Date of Birth

                        </label>

                        <input type="date"
                               name="date_of_birth"
                               value="{{ old('date_of_birth', optional($teacherStaff->date_of_birth)->format('Y-m-d')) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Phone --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Phone

                        </label>

                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $teacherStaff->phone) }}"
                               placeholder="01XXXXXXXXX"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Email --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Email

                        </label>

                        <input type="email"
                               name="email"
                               value="{{ old('email', $teacherStaff->email) }}"
                               placeholder="example@email.com"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Address --}}
                    <div class="md:col-span-2 lg:col-span-3">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Address

                        </label>

                        <textarea name="address"
                                  rows="3"
                                  placeholder="Enter address"
                                  class="w-full rounded-lg
                                         border border-slate-300
                                         bg-white px-3 py-2.5
                                         text-sm text-slate-700
                                         placeholder-slate-400
                                         outline-none resize-none
                                         focus:border-blue-500
                                         focus:ring-2
                                         focus:ring-blue-100">{{ old('address', $teacherStaff->address) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Employment Information --}}
            <div class="px-4 sm:px-6 py-4
                        border-y border-slate-200
                        bg-slate-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center
                                justify-center rounded-lg
                                bg-blue-50 text-blue-600">

                        <i class="bi bi-briefcase"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Employment Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Department, designation and employment details
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            lg:grid-cols-3 gap-5">


                    {{-- Branch --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Branch
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="branch_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       @error('branch_id')
                                           border-red-400
                                       @enderror">

                            <option value="">
                                Select Branch
                            </option>

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ old('branch_id', $teacherStaff->branch_id) == $branch->id ? 'selected' : '' }}>

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('branch_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Department --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Department

                        </label>

                        <select name="department_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                Select Department
                            </option>

                            @foreach($departments as $department)

                                <option value="{{ $department->id }}"
                                    {{ old('department_id', $teacherStaff->department_id) == $department->id ? 'selected' : '' }}>

                                    {{ $department->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Designation --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Designation

                        </label>

                        <select name="designation_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="">
                                Select Designation
                            </option>

                            @foreach($designations as $designation)

                                <option value="{{ $designation->id }}"
                                    {{ old('designation_id', $teacherStaff->designation_id) == $designation->id ? 'selected' : '' }}>

                                    {{ $designation->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Joining Date --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Joining Date

                        </label>

                        <input type="date"
                               name="joining_date"
                               value="{{ old('joining_date', optional($teacherStaff->joining_date)->format('Y-m-d')) }}"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Employment Type --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Employment Type
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="employment_type"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100">

                            <option value="Permanent"
                                {{ old('employment_type', $teacherStaff->employment_type) == 'Permanent' ? 'selected' : '' }}>
                                Permanent
                            </option>

                            <option value="Temporary"
                                {{ old('employment_type', $teacherStaff->employment_type) == 'Temporary' ? 'selected' : '' }}>
                                Temporary
                            </option>

                            <option value="Contractual"
                                {{ old('employment_type', $teacherStaff->employment_type) == 'Contractual' ? 'selected' : '' }}>
                                Contractual
                            </option>

                            <option value="Part Time"
                                {{ old('employment_type', $teacherStaff->employment_type) == 'Part Time' ? 'selected' : '' }}>
                                Part Time
                            </option>

                        </select>

                    </div>


                    {{-- Basic Salary --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Basic Salary

                        </label>

                        <input type="number"
                               name="basic_salary"
                               value="{{ old('basic_salary', $teacherStaff->basic_salary ?? 0) }}"
                               min="0"
                               step="0.01"
                               placeholder="0.00"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Status

                        </label>

                        <label class="flex items-center gap-3
                                      h-[42px] cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old('status', $teacherStaff->status) ? 'checked' : '' }}
                                   class="h-4 w-4 rounded
                                          border-slate-300
                                          text-blue-600
                                          focus:ring-blue-500">

                            <span class="text-sm text-slate-600">
                                Active
                            </span>

                        </label>

                    </div>


                    {{-- Remarks --}}
                    <div class="md:col-span-2 lg:col-span-3">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Remarks

                        </label>

                        <textarea name="remarks"
                                  rows="3"
                                  placeholder="Optional remarks..."
                                  class="w-full rounded-lg
                                         border border-slate-300
                                         bg-white px-3 py-2.5
                                         text-sm text-slate-700
                                         placeholder-slate-400
                                         outline-none resize-none
                                         focus:border-blue-500
                                         focus:ring-2
                                         focus:ring-blue-100">{{ old('remarks', $teacherStaff->remarks) }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Form Footer --}}
            <div class="flex flex-col-reverse sm:flex-row
                        items-stretch sm:items-center
                        justify-end gap-3
                        px-4 sm:px-6 py-4
                        border-t border-slate-200
                        bg-slate-50">

                <a href="{{ route('admin.teacher-staff.index') }}"
                   class="inline-flex items-center justify-center
                          rounded-lg border border-slate-300
                          bg-white px-4 py-2.5
                          text-sm font-medium text-slate-600
                          hover:bg-slate-100 transition">

                    Cancel

                </a>


                <button type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 rounded-lg bg-blue-600
                               px-5 py-2.5 text-sm
                               font-semibold text-white
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check2-circle"></i>

                    Update Teacher / Staff

                </button>

            </div>

        </form>

    </div>

</div>


{{-- Photo Preview --}}
<script>

function previewPhoto(event)
{
    const input = event.target;
    const preview = document.getElementById('photoPreview');

    if (!input.files || !input.files[0]) {
        return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {

        preview.innerHTML = `
            <img
                src="${e.target.result}"
                class="h-full w-full object-cover"
                alt="Preview"
            >
        `;

    };

    reader.readAsDataURL(input.files[0]);
}

</script>

@endsection
