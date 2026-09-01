@extends('admin.layouts.app')

@section('title', 'Edit Leave Allocation')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Edit Leave Allocation
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update leave allocation information.
            </p>
        </div>

        <a href="{{ route('leave-allocations.index') }}"
           class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                  bg-slate-100 hover:bg-slate-200 text-slate-700
                  rounded-lg text-sm font-medium transition">

            <i class="bi bi-arrow-left"></i>
            Back
        </a>

    </div>


    {{-- Form Card --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm">

        <div class="px-6 py-4 border-b border-slate-200">
            <h2 class="text-base font-semibold text-slate-800">
                Leave Allocation Information
            </h2>
        </div>


        <form action="{{ route('leave-allocations.update', $leaveAllocation) }}"
              method="POST"
              class="p-6">

            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Teacher / Staff --}}
                <div>
                    <label for="teacher_staff_id"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Teacher / Staff
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="teacher_staff_id"
                            id="teacher_staff_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm @error('teacher_staff_id') border-red-500 @enderror">

                        <option value="">Select Teacher / Staff</option>

                        @foreach($teacherStaff as $staff)

                            <option value="{{ $staff->id }}"
                                {{ old('teacher_staff_id', $leaveAllocation->teacher_staff_id) == $staff->id ? 'selected' : '' }}>

                                {{ $staff->name }}

                                @if($staff->employee_id)
                                    ({{ $staff->employee_id }})
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('teacher_staff_id')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Leave Type --}}
                <div>
                    <label for="leave_type_id"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Leave Type
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="leave_type_id"
                            id="leave_type_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm @error('leave_type_id') border-red-500 @enderror">

                        <option value="">Select Leave Type</option>

                        @foreach($leaveTypes as $leaveType)

                            <option value="{{ $leaveType->id }}"
                                {{ old('leave_type_id', $leaveAllocation->leave_type_id) == $leaveType->id ? 'selected' : '' }}>

                                {{ $leaveType->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('leave_type_id')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Academic Session --}}
                <div>
                    <label for="academic_session_id"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Academic Session
                        <span class="text-red-500">*</span>

                    </label>

                    <select name="academic_session_id"
                            id="academic_session_id"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm @error('academic_session_id') border-red-500 @enderror">

                        <option value="">Select Academic Session</option>

                        @foreach($academicSessions as $session)

                            <option value="{{ $session->id }}"
                                {{ old('academic_session_id', $leaveAllocation->academic_session_id) == $session->id ? 'selected' : '' }}>

                                {{ $session->name }}

                            </option>

                        @endforeach

                    </select>

                    @error('academic_session_id')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Allocated Days --}}
                <div>
                    <label for="allocated_days"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Allocated Days
                        <span class="text-red-500">*</span>

                    </label>

                    <input type="number"
                           name="allocated_days"
                           id="allocated_days"
                           min="0"
                           step="0.5"
                           value="{{ old('allocated_days', $leaveAllocation->allocated_days) }}"
                           placeholder="Enter allocated days"
                           class="w-full rounded-lg border-slate-300
                                  focus:border-blue-500 focus:ring-blue-500
                                  text-sm @error('allocated_days') border-red-500 @enderror">

                    @error('allocated_days')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Used Days --}}
                <div>
                    <label for="used_days"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Used Days

                    </label>

                    <input type="number"
                           name="used_days"
                           id="used_days"
                           min="0"
                           step="0.5"
                           value="{{ old('used_days', $leaveAllocation->used_days) }}"
                           placeholder="Enter used days"
                           class="w-full rounded-lg border-slate-300
                                  focus:border-blue-500 focus:ring-blue-500
                                  text-sm @error('used_days') border-red-500 @enderror">

                    @error('used_days')
                        <p class="mt-1 text-xs text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Status --}}
                <div>
                    <label for="status"
                           class="block text-sm font-medium text-slate-700 mb-2">

                        Status

                    </label>

                    <select name="status"
                            id="status"
                            class="w-full rounded-lg border-slate-300
                                   focus:border-blue-500 focus:ring-blue-500
                                   text-sm">

                        <option value="1"
                            {{ old('status', $leaveAllocation->status) == 1 ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ old('status', $leaveAllocation->status) == 0 ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>

            </div>


            {{-- Buttons --}}
            <div class="flex items-center justify-end gap-3 mt-6 pt-5
                        border-t border-slate-200">

                <a href="{{ route('leave-allocations.index') }}"
                   class="px-4 py-2.5 bg-slate-100 hover:bg-slate-200
                          text-slate-700 rounded-lg text-sm font-medium">

                    Cancel

                </a>

                <button type="submit"
                        class="inline-flex items-center gap-2 px-5 py-2.5
                               bg-blue-600 hover:bg-blue-700 text-white
                               rounded-lg text-sm font-medium transition">

                    <i class="bi bi-save"></i>
                    Update Allocation

                </button>

            </div>

        </form>

    </div>

</div>

@endsection 
