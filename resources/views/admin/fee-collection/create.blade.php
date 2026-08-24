@extends('admin.layouts.app')

@section('title', 'Collect Fee')
@section('page-title', 'Collect Fee')

@section('content')

<div class="max-w-5xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Collect Fee
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Collect payment from student
                </p>

            </div>

            <a href="{{ route('admin.fee-collection.index') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg border border-slate-300
                      bg-white px-4 py-2.5
                      text-sm font-medium text-slate-700
                      hover:bg-slate-50 transition">

                <i class="bi bi-arrow-left"></i>

                Back

            </a>

        </div>

    </div>


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if($errors->any())

        <div class="mb-5 rounded-xl
                    border border-red-200
                    bg-red-50
                    px-4 py-3
                    text-sm text-red-700">

            <div class="flex items-start gap-3">

                <i class="bi bi-exclamation-circle-fill mt-0.5"></i>

                <div>

                    <p class="font-semibold mb-1">
                        Please fix the following errors:
                    </p>

                    <ul class="list-disc pl-5 space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- =========================================================
        STUDENT INFORMATION
    ========================================================== --}}

    <div class="rounded-xl border border-slate-200
                bg-white shadow-sm overflow-hidden mb-5">

        <div class="border-b border-slate-200
                    bg-slate-50 px-4 sm:px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Student Information
            </h2>

        </div>


        <div class="p-4 sm:p-5">

            <div class="grid grid-cols-1
                        sm:grid-cols-2
                        lg:grid-cols-4 gap-4">


                {{-- Student --}}

                <div>

                    <p class="text-xs font-medium
                              uppercase tracking-wide
                              text-slate-400">

                        Student

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $studentFeeAssignment->student->name ?? 'N/A' }}

                    </p>

                </div>


                {{-- Student ID --}}

                <div>

                    <p class="text-xs font-medium
                              uppercase tracking-wide
                              text-slate-400">

                        Student ID

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $studentFeeAssignment->student->student_id
                            ?? $studentFeeAssignment->student_id }}

                    </p>

                </div>


                {{-- Fee Type --}}

                <div>

                    <p class="text-xs font-medium
                              uppercase tracking-wide
                              text-slate-400">

                        Fee Type

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $studentFeeAssignment->feeType->name ?? 'N/A' }}

                    </p>

                    @if($studentFeeAssignment->feeType?->code)

                        <p class="text-xs text-slate-400 mt-0.5">
                            {{ $studentFeeAssignment->feeType->code }}
                        </p>

                    @endif

                </div>


                {{-- Branch --}}

                <div>

                    <p class="text-xs font-medium
                              uppercase tracking-wide
                              text-slate-400">

                        Branch

                    </p>

                    <p class="mt-1 font-semibold
                              text-slate-800">

                        {{ $studentFeeAssignment->branch->name ?? 'N/A' }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FEE SUMMARY
    ========================================================== --}}

    <div class="grid grid-cols-1
                sm:grid-cols-3 gap-4 mb-5">


        {{-- Assigned --}}

        <div class="rounded-xl border
                    border-blue-200
                    bg-blue-50
                    p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-white
                            text-blue-600">

                    <i class="bi bi-receipt text-lg"></i>

                </div>

                <div>

                    <p class="text-xs text-blue-600">
                        Assigned Amount
                    </p>

                    <p class="mt-1 text-xl font-bold
                              text-blue-800">

                        ৳ {{ number_format($studentFeeAssignment->amount, 2) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Paid --}}

        <div class="rounded-xl border
                    border-green-200
                    bg-green-50
                    p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-white
                            text-green-600">

                    <i class="bi bi-check-circle text-lg"></i>

                </div>

                <div>

                    <p class="text-xs text-green-600">
                        Already Paid
                    </p>

                    <p class="mt-1 text-xl font-bold
                              text-green-700">

                        ৳ {{ number_format($studentFeeAssignment->paid_amount, 2) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Due --}}

        <div class="rounded-xl border
                    border-red-200
                    bg-red-50
                    p-5">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-white
                            text-red-600">

                    <i class="bi bi-exclamation-circle text-lg"></i>

                </div>

                <div>

                    <p class="text-xs text-red-600">
                        Current Due
                    </p>

                    <p class="mt-1 text-xl font-bold
                              text-red-700">

                        ৳ {{ number_format($studentFeeAssignment->due_amount, 2) }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        COLLECTION FORM
    ========================================================== --}}

    <div class="rounded-xl border border-slate-200
                bg-white shadow-sm overflow-hidden">

        <div class="border-b border-slate-200
                    px-4 sm:px-5 py-4">

            <h2 class="font-semibold text-slate-800">
                Payment Information
            </h2>

            <p class="mt-1 text-xs text-slate-500">
                Enter the amount received from the student.
            </p>

        </div>


        <form method="POST"
              action="{{ route(
                  'admin.fee-collection.store',
                  $studentFeeAssignment->id
              ) }}">

            @csrf


            <div class="p-4 sm:p-5 space-y-5">


                {{-- Payment Amount --}}

                <div>

                    <label for="amount"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Payment Amount
                        <span class="text-red-500">*</span>

                    </label>


                    <div class="relative">

                        <span class="absolute left-3 top-1/2
                                     -translate-y-1/2
                                     text-sm font-semibold
                                     text-slate-500">

                            ৳

                        </span>

                        <input
                            type="number"
                            name="amount"
                            id="amount"
                            value="{{ old('amount') }}"
                            min="0.01"
                            max="{{ $studentFeeAssignment->due_amount }}"
                            step="0.01"
                            required
                            placeholder="Enter payment amount"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   pl-9 pr-3 py-2.5
                                   text-sm text-slate-800
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                    </div>


                    <p class="mt-1.5 text-xs text-slate-500">

                        Maximum collectible amount:

                        <span class="font-semibold text-red-600">

                            ৳ {{ number_format(
                                $studentFeeAssignment->due_amount,
                                2
                            ) }}

                        </span>

                    </p>

                </div>


                {{-- Payment Method --}}

                <div>

                    <label for="payment_method"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Payment Method
                        <span class="text-red-500">*</span>

                    </label>


                    <select name="payment_method"
                            id="payment_method"
                            required
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white
                                   px-3 py-2.5
                                   text-sm text-slate-800
                                   outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            Select payment method
                        </option>

                        <option value="cash"
                            {{ old('payment_method') === 'cash'
                                ? 'selected'
                                : '' }}>

                            Cash

                        </option>

                        <option value="bank"
                            {{ old('payment_method') === 'bank'
                                ? 'selected'
                                : '' }}>

                            Bank

                        </option>

                        <option value="mobile_banking"
                            {{ old('payment_method') === 'mobile_banking'
                                ? 'selected'
                                : '' }}>

                            Mobile Banking

                        </option>

                        <option value="other"
                            {{ old('payment_method') === 'other'
                                ? 'selected'
                                : '' }}>

                            Other

                        </option>

                    </select>

                </div>


                {{-- Payment Date --}}

                <div>

                    <label for="payment_date"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Payment Date
                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        type="date"
                        name="payment_date"
                        id="payment_date"
                        value="{{ old(
                            'payment_date',
                            now()->format('Y-m-d')
                        ) }}"
                        required
                        class="w-full rounded-lg
                               border border-slate-300
                               bg-white
                               px-3 py-2.5
                               text-sm text-slate-800
                               outline-none
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-100">

                </div>


                {{-- Remarks --}}

                <div>

                    <label for="remarks"
                           class="block text-sm
                                  font-medium
                                  text-slate-700 mb-1.5">

                        Remarks

                        <span class="text-xs font-normal
                                     text-slate-400">

                            (Optional)

                        </span>

                    </label>

                    <textarea
                        name="remarks"
                        id="remarks"
                        rows="3"
                        maxlength="1000"
                        placeholder="Enter any payment remarks..."
                        class="w-full rounded-lg
                               border border-slate-300
                               bg-white
                               px-3 py-2.5
                               text-sm text-slate-800
                               outline-none
                               resize-none
                               focus:border-blue-500
                               focus:ring-2
                               focus:ring-blue-100">{{ old('remarks') }}</textarea>

                </div>


            </div>


            {{-- =====================================================
                FOOTER
            ====================================================== --}}

            <div class="flex flex-col-reverse
                        sm:flex-row
                        sm:items-center
                        sm:justify-end
                        gap-3
                        border-t border-slate-200
                        bg-slate-50
                        px-4 sm:px-5 py-4">


                <a href="{{ route('admin.fee-collection.index') }}"
                   class="inline-flex
                          items-center
                          justify-center
                          gap-2
                          rounded-lg
                          border border-slate-300
                          bg-white
                          px-4 py-2.5
                          text-sm font-medium
                          text-slate-700
                          hover:bg-slate-50
                          transition">

                    <i class="bi bi-x-lg"></i>

                    Cancel

                </a>


                <button type="submit"
                        class="inline-flex
                               items-center
                               justify-center
                               gap-2
                               rounded-lg
                               bg-blue-600
                               px-5 py-2.5
                               text-sm font-semibold
                               text-white
                               hover:bg-blue-700
                               focus:outline-none
                               focus:ring-2
                               focus:ring-blue-200
                               transition">

                    <i class="bi bi-cash-stack"></i>

                    Collect Payment

                </button>

            </div>

        </form>

    </div>

</div>

@endsection