@extends('admin.layouts.app')

@section('title', 'Apply Leave')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Apply Leave
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create a new leave application for teacher or staff.
            </p>
        </div>

        <a href="{{ route('admin.leave-applications.index') }}"
           class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-4 py-2.5 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">

            <i class="bi bi-arrow-left"></i>
            Back to Applications

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
                    <i class="bi bi-calendar-plus text-lg"></i>
                </div>

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Leave Application Information
                    </h2>

                    <p class="mt-0.5 text-xs text-slate-500">
                        Fill in the information below to apply for leave.
                    </p>
                </div>

            </div>

        </div>


        {{-- Form --}}
        <form method="POST"
              action="{{ route('admin.leave-applications.store') }}"
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
                            Employee Information
                        </h3>

                        <p class="text-xs text-slate-500">
                            Select the teacher or staff member.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    {{-- Teacher / Staff --}}
                    <div>

                        <label for="teacher_staff_id"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            Teacher / Staff
                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            id="teacher_staff_id"
                            name="teacher_staff_id"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                Select Teacher / Staff
                            </option>

                            @foreach($teacherStaff ?? [] as $staff)

                                <option
                                    value="{{ $staff->id }}"
                                    {{ old('teacher_staff_id') == $staff->id ? 'selected' : '' }}>

                                    {{ $staff->name }}

                                    @if(isset($staff->employee_id))
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


                    {{-- Academic Session --}}
                    <div>

                        <label for="academic_session_id"
                            class="mb-1.5 block text-sm font-medium text-slate-700">

                            Academic Session
                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            id="academic_session_id"
                            name="academic_session_id"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                Select Academic Session
                            </option>

                            @foreach($academicSessions ?? [] as $session)

                                <option
                                    value="{{ $session->id }}"
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


                    {{-- Leave Type --}}
                    <div>

                        <label for="leave_type_id"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            Leave Type
                            <span class="text-red-500">*</span>

                        </label>

                        <select
                            id="leave_type_id"
                            name="leave_type_id"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                Select Leave Type
                            </option>

                            @foreach($leaveTypes ?? [] as $leaveType)

                                <option
                                    value="{{ $leaveType->id }}"
                                    {{ old('leave_type_id') == $leaveType->id ? 'selected' : '' }}>

                                    {{ $leaveType->name }}

                                    @if(isset($leaveType->days))
                                        — {{ $leaveType->days }} Days
                                    @endif

                                </option>

                            @endforeach

                        </select>

                        @error('leave_type_id')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Leave Period --}}
            <div class="mb-6">

                <div class="mb-4 flex items-center gap-2">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="bi bi-calendar3"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">
                            Leave Period
                        </h3>

                        <p class="text-xs text-slate-500">
                            Select the start and end dates of the leave.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5 md:grid-cols-3">

                    {{-- Start Date --}}
                    <div>

                        <label for="start_date"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            Start Date
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="date"
                            id="start_date"
                            name="start_date"
                            value="{{ old('start_date') }}"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('start_date')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- End Date --}}
                    <div>

                        <label for="end_date"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            End Date
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="date"
                            id="end_date"
                            name="end_date"
                            value="{{ old('end_date') }}"
                            required
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition focus:border-blue-500 focus:ring-2 focus:ring-blue-100">

                        @error('end_date')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Number of Days --}}
                    <div>

                        <label for="days"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            Number of Days
                            <span class="text-red-500">*</span>

                        </label>

                        <input
                            type="number"
                            id="days"
                            name="days"
                            value="{{ old('days') }}"
                            min="1"
                            readonly
                            required
                            placeholder="Auto calculated"
                            class="w-full rounded-lg border border-slate-300 bg-slate-50 px-3 py-2.5 text-sm font-semibold text-slate-700 outline-none">

                        @error('days')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-1 text-xs text-slate-500">
                            Automatically calculated from the selected dates.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Reason --}}
            <div class="mb-6">

                <div class="mb-4 flex items-center gap-2">

                    <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-50 text-blue-600">
                        <i class="bi bi-chat-left-text"></i>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold text-slate-800">
                            Leave Details
                        </h3>

                        <p class="text-xs text-slate-500">
                            Provide the reason and additional information.
                        </p>
                    </div>

                </div>


                <div class="grid grid-cols-1 gap-5">

                    {{-- Reason --}}
                    <div>

                        <label for="reason"
                               class="mb-1.5 block text-sm font-medium text-slate-700">

                            Reason
                            <span class="text-red-500">*</span>

                        </label>

                        <textarea
                            id="reason"
                            name="reason"
                            rows="4"
                            required
                            placeholder="Enter reason for leave..."
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('reason') }}</textarea>

                        @error('reason')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Remarks --}}
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
                            rows="3"
                            placeholder="Additional remarks..."
                            class="w-full rounded-lg border border-slate-300 bg-white px-3 py-2.5 text-sm text-slate-700 outline-none transition placeholder:text-slate-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('remarks') }}</textarea>

                        @error('remarks')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </div>


            {{-- Info Box --}}
            <div class="mb-6 rounded-lg border border-blue-200 bg-blue-50 px-4 py-3">

                <div class="flex items-start gap-3">

                    <i class="bi bi-info-circle-fill mt-0.5 text-blue-600"></i>

                    <div class="text-sm text-blue-800">

                        <p class="font-semibold">
                            Leave Application
                        </p>

                        <p class="mt-0.5 text-xs text-blue-700">
                            The application will be created with
                            <strong>Pending</strong> status and can be approved or rejected by an authorized user.
                        </p>

                    </div>

                </div>

            </div>


            {{-- Form Buttons --}}
            <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">

                <a
                    href="{{ route('admin.leave-applications.index') }}"
                    class="inline-flex items-center justify-center gap-2 rounded-lg border border-slate-300 bg-white px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">

                    <i class="bi bi-x-lg"></i>
                    Cancel

                </a>


                <button
                    type="submit"
                    class="inline-flex items-center justify-center gap-2 rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700">

                    <i class="bi bi-check-lg"></i>
                    Submit Leave Application

                </button>

            </div>

        </form>

    </div>

</div>


{{-- Calculate Leave Days --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {

        const startDate = document.getElementById('start_date');
        const endDate = document.getElementById('end_date');
        const days = document.getElementById('days');

        function calculateDays() {

            if (!startDate.value || !endDate.value) {
                days.value = '';
                return;
            }

            const start = new Date(startDate.value);
            const end = new Date(endDate.value);

            if (end < start) {
                days.value = '';

                endDate.setCustomValidity(
                    'End date must be greater than or equal to start date.'
                );

                return;
            }

            endDate.setCustomValidity('');

            const difference =
                Math.ceil(
                    (end - start) / (1000 * 60 * 60 * 24)
                ) + 1;

            days.value = difference;
        }

        startDate.addEventListener('change', calculateDays);
        endDate.addEventListener('change', calculateDays);

        calculateDays();

    });
</script>

@endsection 
