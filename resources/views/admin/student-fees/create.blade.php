@extends('admin.layouts.app')

@section('title', 'Assign Student Fee')
@section('page-title', 'Assign Student Fee')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Assign Student Fee
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Assign an individual fee amount to a student
                </p>
            </div>

            <a href="{{ route('admin.student-fees.index') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg border border-slate-300
                      bg-white px-4 py-2.5
                      text-sm font-medium text-slate-700
                      hover:bg-slate-50 transition">

                <i class="bi bi-arrow-left"></i>

                Back to List

            </a>

        </div>

    </div>


    {{-- Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-xl border border-red-200
                    bg-red-50 px-4 py-3">

            <div class="flex gap-3">

                <i class="bi bi-exclamation-triangle-fill
                          text-red-600 mt-0.5"></i>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors:
                    </p>

                    <ul class="mt-2 list-disc pl-5 space-y-1
                               text-sm text-red-700">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    <form method="POST"
          action="{{ route('admin.student-fees.store') }}">

        @csrf


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- =====================================================
                 LEFT SIDE
            ====================================================== --}}

            <div class="lg:col-span-2 space-y-6">


                {{-- Student & Fee --}}
                <div class="rounded-2xl border border-slate-200
                            bg-white shadow-sm overflow-hidden">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <h2 class="font-semibold text-slate-800">
                            Fee Assignment
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Select the student and fee details
                        </p>

                    </div>


                    <div class="p-5 space-y-5">


                        {{-- Student --}}
                        <div>

                            <label class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Student
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="student_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-700
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    Select Student
                                </option>

                                @foreach($students as $student)

                                    <option value="{{ $student->id }}"
                                        {{ old('student_id') == $student->id ? 'selected' : '' }}>

                                        {{ $student->name }}

                                        @if($student->student_id)
                                            — {{ $student->student_id }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            @error('student_id')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Fee Type --}}
                        <div>

                            <label class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Fee Type
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="fee_type_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-700
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    Select Fee Type
                                </option>

                                @foreach($feeTypes as $feeType)

                                    <option value="{{ $feeType->id }}"
                                        {{ old('fee_type_id') == $feeType->id ? 'selected' : '' }}>

                                        {{ $feeType->name }}

                                        @if($feeType->code)
                                            — {{ $feeType->code }}
                                        @endif

                                    </option>

                                @endforeach

                            </select>

                            @error('fee_type_id')
                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>
                            @enderror

                        </div>


                        {{-- Academic Session --}}
                        <div>

                            <label class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Academic Session
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="academic_session_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-700
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

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


                        {{-- Period --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- Month --}}
                            <div>

                                <label class="block text-sm font-medium
                                              text-slate-700 mb-1.5">

                                    Fee Month

                                </label>

                                <select name="fee_month"
                                        class="w-full rounded-lg
                                               border border-slate-300
                                               bg-white px-3 py-2.5
                                               text-sm text-slate-700
                                               outline-none
                                               focus:border-blue-500
                                               focus:ring-2
                                               focus:ring-blue-100">

                                    <option value="">
                                        No Specific Month
                                    </option>

                                    @foreach([
                                        1 => 'January',
                                        2 => 'February',
                                        3 => 'March',
                                        4 => 'April',
                                        5 => 'May',
                                        6 => 'June',
                                        7 => 'July',
                                        8 => 'August',
                                        9 => 'September',
                                        10 => 'October',
                                        11 => 'November',
                                        12 => 'December',
                                    ] as $monthNumber => $monthName)

                                        <option value="{{ $monthNumber }}"
                                            {{ old('fee_month') == $monthNumber ? 'selected' : '' }}>

                                            {{ $monthName }}

                                        </option>

                                    @endforeach

                                </select>

                            </div>


                            {{-- Year --}}
                            <div>

                                <label class="block text-sm font-medium
                                              text-slate-700 mb-1.5">

                                    Fee Year

                                </label>

                                <input type="number"
                                       name="fee_year"
                                       value="{{ old('fee_year', date('Y')) }}"
                                       min="2000"
                                       max="2100"
                                       placeholder="2026"
                                       class="w-full rounded-lg
                                              border border-slate-300
                                              bg-white px-3 py-2.5
                                              text-sm text-slate-700
                                              outline-none
                                              focus:border-blue-500
                                              focus:ring-2
                                              focus:ring-blue-100">

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Amount --}}
                <div class="rounded-2xl border border-slate-200
                            bg-white shadow-sm overflow-hidden">

                    <div class="border-b border-slate-100 px-5 py-4">

                        <h2 class="font-semibold text-slate-800">
                            Amount Details
                        </h2>

                        <p class="mt-1 text-xs text-slate-500">
                            Set the amount individually for this student
                        </p>

                    </div>


                    <div class="p-5">

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                            {{-- Amount --}}
                            <div>

                                <label class="block text-sm font-medium
                                              text-slate-700 mb-1.5">

                                    Fee Amount
                                    <span class="text-red-500">*</span>

                                </label>

                                <div class="relative">

                                    <span class="absolute left-3 top-1/2
                                                 -translate-y-1/2
                                                 text-sm font-semibold
                                                 text-slate-500">

                                        ৳

                                    </span>

                                    <input type="number"
                                           name="amount"
                                           id="amount"
                                           value="{{ old('amount') }}"
                                           min="0"
                                           step="0.01"
                                           required
                                           placeholder="500.00"
                                           class="w-full rounded-lg
                                                  border border-slate-300
                                                  bg-white pl-8 pr-3 py-2.5
                                                  text-sm text-slate-700
                                                  outline-none
                                                  focus:border-blue-500
                                                  focus:ring-2
                                                  focus:ring-blue-100">

                                </div>

                                @error('amount')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>


                            {{-- Discount --}}
                            <div>

                                <label class="block text-sm font-medium
                                              text-slate-700 mb-1.5">

                                    Discount

                                </label>

                                <div class="relative">

                                    <span class="absolute left-3 top-1/2
                                                 -translate-y-1/2
                                                 text-sm font-semibold
                                                 text-slate-500">

                                        ৳

                                    </span>

                                    <input type="number"
                                           name="discount"
                                           id="discount"
                                           value="{{ old('discount', 0) }}"
                                           min="0"
                                           step="0.01"
                                           placeholder="0.00"
                                           class="w-full rounded-lg
                                                  border border-slate-300
                                                  bg-white pl-8 pr-3 py-2.5
                                                  text-sm text-slate-700
                                                  outline-none
                                                  focus:border-blue-500
                                                  focus:ring-2
                                                  focus:ring-blue-100">

                                </div>

                                @error('discount')
                                    <p class="mt-1 text-xs text-red-600">
                                        {{ $message }}
                                    </p>
                                @enderror

                            </div>

                        </div>


                        {{-- Payable Preview --}}
                        <div class="mt-5 rounded-xl bg-blue-50
                                    border border-blue-100 p-4">

                            <div class="flex items-center justify-between">

                                <div>

                                    <p class="text-xs font-medium
                                              text-blue-600 uppercase">

                                        Payable Amount

                                    </p>

                                    <p class="mt-1 text-xs text-slate-500">
                                        Amount after discount
                                    </p>

                                </div>

                                <p id="payablePreview"
                                   class="text-2xl font-bold text-blue-700">

                                    ৳ 0.00

                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- Due & Remarks --}}
                <div class="rounded-2xl border border-slate-200
                            bg-white shadow-sm overflow-hidden">

                    <div class="p-5 space-y-5">

                        {{-- Due Date --}}
                        <div>

                            <label class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Due Date

                            </label>

                            <input type="date"
                                   name="due_date"
                                   value="{{ old('due_date') }}"
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white px-3 py-2.5
                                          text-sm text-slate-700
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                        </div>


                        {{-- Remarks --}}
                        <div>

                            <label class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Remarks

                            </label>

                            <textarea name="remarks"
                                      rows="4"
                                      placeholder="Optional note..."
                                      class="w-full rounded-lg
                                             border border-slate-300
                                             bg-white px-3 py-2.5
                                             text-sm text-slate-700
                                             outline-none resize-none
                                             focus:border-blue-500
                                             focus:ring-2
                                             focus:ring-blue-100">{{ old('remarks') }}</textarea>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 RIGHT SIDE
            ====================================================== --}}

            <div class="space-y-5">


                {{-- Information --}}
                <div class="rounded-2xl border border-blue-100
                            bg-blue-50 p-5">

                    <div class="flex gap-3">

                        <div class="flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl bg-blue-600
                                    text-white">

                            <i class="bi bi-info-lg"></i>

                        </div>

                        <div>

                            <h3 class="font-semibold text-blue-900">
                                Flexible Fee Assignment
                            </h3>

                            <p class="mt-2 text-xs leading-5 text-blue-800">

                                Fee amounts are not fixed by class or
                                section. You can assign any amount to
                                each individual student.

                            </p>

                        </div>

                    </div>

                </div>


                {{-- Example --}}
                <div class="rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm">

                    <h3 class="text-sm font-semibold text-slate-800">
                        Example
                    </h3>

                    <div class="mt-4 space-y-3 text-sm">

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Student
                            </span>

                            <span class="font-medium text-slate-800">
                                Rahim
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Fee Type
                            </span>

                            <span class="font-medium text-slate-800">
                                Tuition Fee
                            </span>

                        </div>

                        <div class="flex justify-between">

                            <span class="text-slate-500">
                                Amount
                            </span>

                            <span class="font-semibold text-slate-800">
                                ৳ 500
                            </span>

                        </div>

                    </div>

                </div>


                {{-- Submit --}}
                <div class="rounded-2xl border border-slate-200
                            bg-white p-5 shadow-sm">

                    <button type="submit"
                            class="w-full inline-flex
                                   items-center justify-center gap-2
                                   rounded-lg bg-blue-600
                                   px-4 py-3
                                   text-sm font-semibold text-white
                                   hover:bg-blue-700
                                   transition">

                        <i class="bi bi-check2-circle"></i>

                        Assign Fee

                    </button>

                    <a href="{{ route('admin.student-fees.index') }}"
                       class="mt-2 w-full inline-flex
                              items-center justify-center
                              rounded-lg border border-slate-300
                              bg-white px-4 py-3
                              text-sm font-medium text-slate-600
                              hover:bg-slate-50 transition">

                        Cancel

                    </a>

                </div>

            </div>

        </div>

    </form>

</div>


{{-- Payable Calculation --}}
<script>

    document.addEventListener('DOMContentLoaded', function () {

        const amount = document.getElementById('amount');
        const discount = document.getElementById('discount');
        const preview = document.getElementById('payablePreview');

        function calculatePayable() {

            let amountValue =
                parseFloat(amount.value) || 0;

            let discountValue =
                parseFloat(discount.value) || 0;

            let payable =
                Math.max(amountValue - discountValue, 0);

            preview.textContent =
                '৳ ' + payable.toFixed(2);
        }

        amount.addEventListener('input', calculatePayable);

        discount.addEventListener('input', calculatePayable);

        calculatePayable();

    });

</script>

@endsection