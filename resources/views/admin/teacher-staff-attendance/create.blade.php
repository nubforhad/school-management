@extends('admin.layouts.app')

@section('title', 'Add Attendance')

@section('content')

<div class="space-y-6">
 
{{-- Page Header --}}
<div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
    <div>
        <h1 class="text-2xl font-bold text-slate-800">
            Add Attendance
        </h1>
        <p class="mt-1 text-sm text-slate-500">
            Create attendance record for teacher or staff.
        </p>
    </div>
    <a href="{{ route('admin.teacher-staff-attendance.index') }}"
       class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
        <i class="bi bi-arrow-left"></i>
        Back to Attendance
    </a>
</div>

{{-- Validation Errors --}}
@if($errors->any())

    <div class="rounded-xl border border-red-200 bg-red-50 px-5 py-4">
        <div class="flex items-start gap-3">
            <i class="bi bi-exclamation-circle-fill mt-0.5 text-red-500"></i>
            <div>
                <h3 class="text-sm font-semibold text-red-800">
                    Please fix the following errors:
                </h3>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif


{{-- Form Card --}}
<div class="overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm">

    {{-- Card Header --}}
    <div class="border-b border-slate-200 bg-slate-50 px-5 py-4">
        <div class="flex items-center gap-3">
            <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                <i class="bi bi-calendar-check text-lg"></i>
            </div>
            <div>
                <h2 class="text-sm font-semibold text-slate-800">
                    Attendance Information
                </h2>
                <p class="mt-0.5 text-xs text-slate-500">
                    Fill in the attendance details below.
                </p>
            </div>
        </div>
    </div>
    {{-- Form --}}
    <form method="POST"
          action="{{ route('admin.teacher-staff-attendance.store') }}"
          class="p-5">
        @csrf
        {{-- Employee Information --}}
        <div class="mb-6">
            <div class="mb-4 flex items-center gap-2">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-person-badge"></i>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-slate-800">
                        Teacher / Staff
                    </h3>
                    <p class="text-xs text-slate-500">
                        Select the teacher or staff member.
                    </p>
                </div>
            </div>
            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                {{-- Teacher / Staff --}}
                <div>
                   <label for="teacher_staff_id"  class="mb-1.5 block text-sm font-medium text-slate-700">
                        Teacher / Staff
                        <span class="text-red-500">*</span>
                    </label>
                    <select id="teacher_staff_id" name="teacher_staff_id" required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            Select Teacher / Staff
                        </option>

                        @foreach($teacherStaff ?? [] as $staff)

                            <option
                                value="{{ $staff->id }}"
                                {{ old('teacher_staff_id') == $staff->id ? 'selected' : '' }}>

                                {{ $staff->name }}

                                @if(!empty($staff->employee_id))
                                    — {{ $staff->employee_id }}
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


                {{-- Date --}}
                <div>

                    <label for="date"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Attendance Date
                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="date"
                        id="date"
                        name="date"
                        value="{{ old('date', now()->format('Y-m-d')) }}"
                        required
                        class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    @error('date')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


            </div>

        </div>


        {{-- Attendance Status --}}
        <div class="mb-6">

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-check2-circle"></i>
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-slate-800">
                        Attendance Status
                    </h3>

                    <p class="text-xs text-slate-500">
                        Select the attendance status.
                    </p>

                </div>

            </div>


            <div>

                <label for="status"
                       class="mb-1.5 block text-sm font-medium text-slate-700">

                    Status
                    <span class="text-red-500">*</span>

                </label>

                <select
                    id="status"
                    name="status"
                    required
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                    <option value="">
                        Select Status
                    </option>

                    <option value="present"
                        {{ old('status') === 'present' ? 'selected' : '' }}>
                        Present
                    </option>

                    <option value="late"
                        {{ old('status') === 'late' ? 'selected' : '' }}>
                        Late
                    </option>

                    <option value="absent"
                        {{ old('status') === 'absent' ? 'selected' : '' }}>
                        Absent
                    </option>

                    <option value="leave"
                        {{ old('status') === 'leave' ? 'selected' : '' }}>
                        Leave
                    </option>

                </select>

                @error('status')

                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>


        {{-- Time Information --}}
        <div class="mb-6">

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-clock"></i>
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-slate-800">
                        Time Information
                    </h3>

                    <p class="text-xs text-slate-500">
                        In and out time is available for Present and Late attendance.
                    </p>

                </div>

            </div>


            <div class="grid grid-cols-1 gap-5 md:grid-cols-2">


                {{-- In Time --}}
                <div>

                    <label for="in_time"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        In Time

                    </label>

                    <input
                        type="time"
                        id="in_time"
                        name="in_time"
                        value="{{ old('in_time') }}"
                        disabled
                        class="attendance-time w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400">

                    @error('in_time')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Out Time --}}
                <div>

                    <label for="out_time"
                           class="mb-1.5 block text-sm font-medium text-slate-700">

                        Out Time

                    </label>

                    <input
                        type="time"
                        id="out_time"
                        name="out_time"
                        value="{{ old('out_time') }}"
                        disabled
                        class="attendance-time w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100 disabled:cursor-not-allowed disabled:bg-slate-100 disabled:text-slate-400">

                    @error('out_time')

                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>

            </div>

        </div>


        {{-- Remarks --}}
        <div class="mb-6">

            <div class="mb-4 flex items-center gap-2">

                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-chat-left-text"></i>
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-slate-800">
                        Remarks
                    </h3>

                    <p class="text-xs text-slate-500">
                        Add any additional information if required.
                    </p>

                </div>

            </div>


            <div>

                <label for="remarks"
                       class="mb-1.5 block text-sm font-medium text-slate-700">

                    Remarks
                    <span class="text-xs font-normal text-slate-400">
                        (Optional)
                    </span>

                </label>

                <textarea
                    id="remarks"
                    name="remarks"
                    rows="4"
                    placeholder="Enter remarks..."
                    class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('remarks') }}</textarea>

                @error('remarks')

                    <p class="mt-1 text-xs text-red-600">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>


        {{-- Information Box --}}
        <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3">

            <div class="flex items-start gap-3">

                <i class="bi bi-info-circle-fill mt-0.5 text-blue-600"></i>

                <div class="text-sm text-blue-800">

                    <p class="font-semibold">
                        Attendance Status
                    </p>

                    <p class="mt-0.5 text-xs text-blue-700">
                        <strong>Present</strong> and <strong>Late</strong>
                        require In Time and Out Time.
                        For <strong>Absent</strong> or <strong>Leave</strong>,
                        time fields will automatically be disabled.
                    </p>

                </div>

            </div>

        </div>


        {{-- Buttons --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

            <a
                href="{{ route('admin.teacher-staff-attendance.index') }}"
                class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                <i class="bi bi-x-lg"></i>
                Cancel

            </a>


            <button
                type="submit"
                class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                <i class="bi bi-check-lg"></i>
                Save Attendance

            </button>

        </div>

    </form>

</div> 

</div>

{{-- Attendance Time Enable / Disable --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const status = document.getElementById('status');

    const inTime = document.getElementById('in_time');

    const outTime = document.getElementById('out_time');


    function toggleTimeFields() {

        const selectedStatus = status.value;

        const enableTime =
            selectedStatus === 'present' ||
            selectedStatus === 'late';


        inTime.disabled = !enableTime;

        outTime.disabled = !enableTime;


        if (!enableTime) {

            inTime.value = '';
            outTime.value = '';

        }

    }


    status.addEventListener('change', toggleTimeFields);


    // Run on page load for old input
    toggleTimeFields();

});

</script>

@endsection
