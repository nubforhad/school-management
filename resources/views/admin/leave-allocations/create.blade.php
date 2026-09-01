@extends('admin.layouts.app')

@section('title', 'Allocate Leave')

@section('content')

<div class="max-w-screen-lg mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">
 
{{-- =========================================================
    Header
========================================================== --}}

<div class="mb-4 sm:mb-6">

    <div class="flex flex-col sm:flex-row
                sm:items-center sm:justify-between gap-3">

        <div>

            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Allocate Leave
            </h1>

            <p class="text-xs sm:text-sm text-slate-500 mt-1">
                Allocate leave days to a teacher or staff member
            </p>

        </div>

        <a href="{{ route('admin.leave-allocations.index') }}"
           class="w-full sm:w-auto
                  inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg
                  bg-slate-100 text-slate-700
                  text-sm font-medium
                  hover:bg-slate-200 transition">

            <i class="bi bi-arrow-left"></i>

            Back

        </a>

    </div>

</div>


{{-- =========================================================
    Validation Errors
========================================================== --}}

@if ($errors->any())

    <div class="mb-4 bg-red-50 border border-red-200
                rounded-xl p-4">

        <div class="flex items-start gap-3">

            <i class="bi bi-exclamation-triangle-fill
                      text-red-500 text-lg"></i>

            <div>

                <h3 class="text-sm font-semibold text-red-700">
                    Please fix the following errors:
                </h3>

                <ul class="mt-1 text-xs sm:text-sm
                           text-red-600 list-disc list-inside">

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- =========================================================
    Form
========================================================== --}}

<div class="bg-white rounded-xl shadow-sm
            border border-slate-200
            overflow-hidden">


    {{-- Form Header --}}

    <div class="p-4 sm:p-5
                border-b border-slate-200">

        <div class="flex items-center gap-3">

            <div class="w-10 h-10 rounded-lg
                        bg-blue-50
                        flex items-center justify-center">

                <i class="bi bi-calendar-check
                          text-blue-600 text-lg"></i>

            </div>

            <div>

                <h2 class="text-base sm:text-lg
                           font-semibold text-slate-800">

                    Leave Allocation Information

                </h2>

                <p class="text-xs sm:text-sm text-slate-500">

                    Enter the leave allocation information.

                </p>

            </div>

        </div>

    </div>


    {{-- Form Body --}}

    <form method="POST"
          action="{{ route('admin.leave-allocations.store') }}">

        @csrf

        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2
                        gap-4 sm:gap-5">


                {{-- Teacher / Staff --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Teacher / Staff

                        <span class="text-red-500">*</span>

                    </label>

                    <select name="teacher_staff_id"
                            required
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none
                                   @error('teacher_staff_id')
                                       border-red-400
                                   @enderror">

                        <option value="">
                            Select Teacher / Staff
                        </option>

                        @foreach($teacherStaff as $staff)

                            <option value="{{ $staff->id }}"
                                {{ old('teacher_staff_id') == $staff->id ? 'selected' : '' }}>

                                {{ $staff->name }}

                                @if($staff->employee_id)
                                    ({{ $staff->employee_id }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('teacher_staff_id')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Leave Type --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Leave Type

                        <span class="text-red-500">*</span>

                    </label>

                    <select name="leave_type_id"
                            required
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none
                                   @error('leave_type_id')
                                       border-red-400
                                   @enderror">

                        <option value="">
                            Select Leave Type
                        </option>

                        @foreach($leaveTypes as $leaveType)

                            <option value="{{ $leaveType->id }}"
                                {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>

                                {{ $leaveType->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('leave_type_id')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Academic Session --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Academic Session

                        <span class="text-red-500">*</span>

                    </label>

                    <select name="academic_session_id"
                            required
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100
                                   outline-none
                                   @error('academic_session_id')
                                       border-red-400
                                   @enderror">

                        <option value="">
                            Select Academic Session
                        </option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ old('academic_session_id') == $session->id ? 'selected' : '' }}>

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


                {{-- Year --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Year

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="number"
                           name="year"
                           value="{{ old('year', date('Y')) }}"
                           min="2000"
                           max="2100"
                           required
                           placeholder="e.g. 2026"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2.5
                                  text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none
                                  @error('year')
                                      border-red-400
                                  @enderror">

                    @error('year')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Allocated Days --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Allocated Days

                        <span class="text-red-500">*</span>

                    </label>

                    <input type="number"
                           name="allocated_days"
                           value="{{ old('allocated_days') }}"
                           min="0"
                           step="0.5"
                           required
                           placeholder="e.g. 15"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2.5
                                  text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none
                                  @error('allocated_days')
                                      border-red-400
                                  @enderror">

                    @error('allocated_days')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Remarks --}}

                <div>

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-1">

                        Remarks

                    </label>

                    <input type="text"
                           name="remarks"
                           value="{{ old('remarks') }}"
                           placeholder="Optional remarks"
                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white
                                  px-3 py-2.5
                                  text-sm
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100
                                  outline-none
                                  @error('remarks')
                                      border-red-400
                                  @enderror">

                    @error('remarks')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Status --}}

                <div class="md:col-span-2">

                    <label class="block text-xs sm:text-sm
                                  font-medium text-slate-700 mb-2">

                        Status

                    </label>

                    <label class="inline-flex items-center
                                  cursor-pointer">

                        <input type="checkbox"
                               name="status"
                               value="1"
                               class="sr-only peer"
                               {{ old('status', true) ? 'checked' : '' }}>

                        <div class="relative w-11 h-6
                                    bg-slate-300
                                    rounded-full
                                    peer
                                    peer-checked:bg-blue-600
                                    after:content-['']
                                    after:absolute
                                    after:top-[2px]
                                    after:left-[2px]
                                    after:bg-white
                                    after:border
                                    after:border-slate-300
                                    after:rounded-full
                                    after:h-5
                                    after:w-5
                                    after:transition-all
                                    peer-checked:after:translate-x-full
                                    peer-checked:after:border-white">
                        </div>

                        <span class="ml-3 text-sm text-slate-700">
                            Active
                        </span>

                    </label>

                </div>


            </div>

        </div>


        {{-- Footer --}}

        <div class="px-4 sm:px-6 py-4
                    bg-slate-50
                    border-t border-slate-200
                    flex flex-col xs:flex-row
                    gap-2.5 sm:gap-3
                    sm:justify-end">

            <a href="{{ route('admin.leave-allocations.index') }}"
               class="w-full xs:w-auto
                      inline-flex items-center
                      justify-center gap-2
                      px-5 py-2.5 rounded-lg
                      bg-white
                      border border-slate-300
                      text-slate-700
                      text-sm font-medium
                      hover:bg-slate-100 transition">

                Cancel

            </a>


            <button type="submit"
                    class="w-full xs:w-auto
                           inline-flex items-center
                           justify-center gap-2
                           px-5 py-2.5 rounded-lg
                           bg-blue-600 text-white
                           text-sm font-medium
                           hover:bg-blue-700 transition">

                <i class="bi bi-check-lg"></i>

                Allocate Leave

            </button>

        </div>

    </form>

</div> 

</div>

@endsection
