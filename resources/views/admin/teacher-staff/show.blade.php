@extends('admin.layouts.app')

@section('title', 'Teacher / Staff Details')

@section('page-title', 'Teacher / Staff Details')

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

        <div class="mt-4 flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-4">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Teacher / Staff Details
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    View complete information of the teacher or staff member
                </p>

            </div>

            <a href="{{ route('admin.teacher-staff.edit', $teacherStaff->id) }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-pencil-square"></i>
                Edit

            </a>

        </div>

    </div>


    {{-- Main Profile Card --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">


        {{-- Profile Header --}}
        <div class="px-4 sm:px-6 py-6
                    bg-slate-50 border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        items-center sm:items-start gap-5">

                {{-- Photo --}}
                <div class="h-24 w-24 shrink-0
                            rounded-full overflow-hidden
                            bg-blue-50 text-blue-600
                            flex items-center justify-center
                            border-4 border-white shadow-sm">

                    @if($teacherStaff->photo)

                        <img src="{{ asset('storage/' . $teacherStaff->photo) }}"
                             alt="{{ $teacherStaff->name }}"
                             class="h-full w-full object-cover">

                    @else

                        <i class="bi bi-person text-4xl"></i>

                    @endif

                </div>


                {{-- Name --}}
                <div class="text-center sm:text-left">

                    <h2 class="text-xl font-bold text-slate-800">
                        {{ $teacherStaff->name }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $teacherStaff->employee_id ?? 'No Employee ID' }}
                    </p>


                    <div class="flex flex-wrap
                                justify-center sm:justify-start
                                gap-2 mt-3">

                        {{-- Status --}}
                        @if($teacherStaff->status)

                            <span class="inline-flex items-center gap-1
                                         rounded-full bg-green-50
                                         px-3 py-1 text-xs font-medium
                                         text-green-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                Active

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1
                                         rounded-full bg-red-50
                                         px-3 py-1 text-xs font-medium
                                         text-red-700">

                                <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                Inactive

                            </span>

                        @endif


                        {{-- Employment Type --}}
                        @if($teacherStaff->employment_type)

                            <span class="inline-flex items-center
                                         rounded-full bg-blue-50
                                         px-3 py-1 text-xs font-medium
                                         text-blue-700">

                                {{ $teacherStaff->employment_type }}

                            </span>

                        @endif

                    </div>

                </div>

            </div>

        </div>


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
                        Basic personal information
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2
                        lg:grid-cols-3 gap-5">


                {{-- Employee ID --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Employee ID
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->employee_id ?? '—' }}
                    </p>

                </div>


                {{-- Full Name --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Full Name
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->name ?? '—' }}
                    </p>

                </div>


                {{-- Gender --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Gender
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->gender ?? '—' }}
                    </p>

                </div>


                {{-- Date of Birth --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Date of Birth
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        @if($teacherStaff->date_of_birth)

                            {{ \Carbon\Carbon::parse($teacherStaff->date_of_birth)->format('d M Y') }}

                        @else

                            —

                        @endif

                    </p>

                </div>


                {{-- Phone --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Phone
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->phone ?? '—' }}
                    </p>

                </div>


                {{-- Email --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Email
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800 break-all">
                        {{ $teacherStaff->email ?? '—' }}
                    </p>

                </div>


                {{-- Address --}}
                <div class="md:col-span-2 lg:col-span-3
                            rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Address
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->address ?? '—' }}
                    </p>

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
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Branch
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $teacherStaff->branch->name ?? '—' }}

                    </p>

                </div>


                {{-- Department --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Department
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $teacherStaff->department->name ?? '—' }}

                    </p>

                </div>


                {{-- Designation --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Designation
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        {{ $teacherStaff->designation->name ?? '—' }}

                    </p>

                </div>


                {{-- Joining Date --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Joining Date
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        @if($teacherStaff->joining_date)

                            {{ \Carbon\Carbon::parse($teacherStaff->joining_date)->format('d M Y') }}

                        @else

                            —

                        @endif

                    </p>

                </div>


                {{-- Employment Type --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Employment Type
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $teacherStaff->employment_type ?? '—' }}
                    </p>

                </div>


                {{-- Basic Salary --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Basic Salary
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">

                        @if($teacherStaff->basic_salary !== null)

                            ৳ {{ number_format($teacherStaff->basic_salary, 2) }}

                        @else

                            —

                        @endif

                    </p>

                </div>


                {{-- Status --}}
                <div class="rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Status
                    </p>

                    <div class="mt-2">

                        @if($teacherStaff->status)

                            <span class="inline-flex items-center gap-1.5
                                         rounded-full bg-green-50
                                         px-3 py-1 text-xs font-medium
                                         text-green-700">

                                <i class="bi bi-check-circle"></i>
                                Active

                            </span>

                        @else

                            <span class="inline-flex items-center gap-1.5
                                         rounded-full bg-red-50
                                         px-3 py-1 text-xs font-medium
                                         text-red-700">

                                <i class="bi bi-x-circle"></i>
                                Inactive

                            </span>

                        @endif

                    </div>

                </div>


                {{-- Remarks --}}
                <div class="md:col-span-2 lg:col-span-3
                            rounded-lg border border-slate-200
                            bg-slate-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Remarks
                    </p>

                    <p class="mt-1 text-sm text-slate-700 whitespace-pre-line">
                        {{ $teacherStaff->remarks ?? '—' }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex flex-col-reverse sm:flex-row
                    items-stretch sm:items-center
                    justify-end gap-3
                    px-4 sm:px-6 py-4
                    border-t border-slate-200
                    bg-slate-50">

            <a href="{{ route('admin.teacher-staff.index') }}"
               class="inline-flex items-center justify-center
                      gap-2 rounded-lg border border-slate-300
                      bg-white px-4 py-2.5
                      text-sm font-medium text-slate-600
                      hover:bg-slate-100 transition">

                <i class="bi bi-arrow-left"></i>
                Back

            </a>


            <a href="{{ route('admin.teacher-staff.edit', $teacherStaff->id) }}"
               class="inline-flex items-center justify-center
                      gap-2 rounded-lg bg-blue-600
                      px-5 py-2.5 text-sm
                      font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-pencil-square"></i>
                Edit Teacher / Staff

            </a>

        </div>

    </div>

</div>

@endsection 
