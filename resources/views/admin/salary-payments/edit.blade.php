@extends('admin.layouts.app')

@section('title', 'Edit Salary Payment')

@section('page-title', 'Edit Salary Payment')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

```
{{-- Page Header --}}
<div class="mb-6">

    <a href="{{ route('admin.salary-payments.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition">
        <i class="bi bi-arrow-left"></i>
        Back to Salary Payments
    </a>

    <div class="mt-4">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Edit Salary Payment
        </h1>

        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Update monthly salary payment information
        </p>
    </div>

</div>


{{-- Validation Errors --}}
@if($errors->any())

    <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

        <div class="flex items-start gap-3">

            <div class="flex h-8 w-8 shrink-0 items-center justify-center
                        rounded-full bg-red-100 text-red-600">
                <i class="bi bi-exclamation-triangle"></i>
            </div>

            <div>

                <p class="text-sm font-semibold text-red-800">
                    Please fix the following errors
                </p>

                <ul class="mt-1 list-disc list-inside text-xs text-red-700 space-y-1">

                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        </div>

    </div>

@endif


{{-- Form Card --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

    <form action="{{ route('admin.salary-payments.update', $salaryPayment) }}"
          method="POST">

        @csrf
        @method('PUT')


        {{-- Employee Information --}}
        <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">
                    <i class="bi bi-person-badge"></i>
                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Employee Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Teacher or staff salary payment
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-5">


                {{-- Teacher --}}
                <div class="lg:col-span-2">

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Teacher / Staff
                        <span class="text-red-500">*</span>
                    </label>

                    <select name="teacher_staff_id"
                            id="teacher_staff_id"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   @error('teacher_staff_id') border-red-400 @enderror">

                        <option value="">
                            Select Teacher / Staff
                        </option>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_staff_id', $salaryPayment->teacher_staff_id) == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->name }}

                                @if($teacher->employee_id)
                                    — {{ $teacher->employee_id }}
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


                {{-- Month --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Salary Month
                        <span class="text-red-500">*</span>
                    </label>

                    <select name="salary_month"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100">

                        @foreach(range(1, 12) as $month)

                            <option value="{{ $month }}"
                                {{ old('salary_month', $salaryPayment->salary_month) == $month ? 'selected' : '' }}>

                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Year --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Salary Year
                        <span class="text-red-500">*</span>
                    </label>

                    <select name="salary_year"
                            required
                            class="w-full rounded-lg border border-slate-300
                                   bg-white px-3 py-2.5 text-sm text-slate-700
                                   outline-none focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100">

                        @foreach(range(now()->year + 1, 2020) as $year)

                            <option value="{{ $year }}"
                                {{ old('salary_year', $salaryPayment->salary_year) == $year ? 'selected' : '' }}>

                                {{ $year }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- Salary Structure --}}
        <div class="px-4 sm:px-6 py-4 border-y border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-green-50 text-green-600">

                    <i class="bi bi-cash-stack"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Salary Structure
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Salary values used for this payment
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div id="salaryLoading"
                 class="hidden mb-4 rounded-lg border border-blue-200
                        bg-blue-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm text-blue-700">

                    <i class="bi bi-arrow-repeat animate-spin"></i>

                    Loading salary structure...

                </div>

            </div>


            <div id="noSalaryStructure"
                 class="hidden mb-4 rounded-lg border border-amber-200
                        bg-amber-50 px-4 py-3">

                <div class="flex items-center gap-2 text-sm text-amber-700">

                    <i class="bi bi-exclamation-circle"></i>

                    No active salary structure found for this employee.

                </div>

            </div>


            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                {{-- Basic --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Basic Salary
                    </label>

                    <input type="number"
                           name="basic_salary"
                           id="basic_salary"
                           value="{{ old('basic_salary', $salaryPayment->basic_salary) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- House Rent --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        House Rent
                    </label>

                    <input type="number"
                           name="house_rent"
                           id="house_rent"
                           value="{{ old('house_rent', $salaryPayment->house_rent) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Medical --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Medical Allowance
                    </label>

                    <input type="number"
                           name="medical_allowance"
                           id="medical_allowance"
                           value="{{ old('medical_allowance', $salaryPayment->medical_allowance) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Transport --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Transport Allowance
                    </label>

                    <input type="number"
                           name="transport_allowance"
                           id="transport_allowance"
                           value="{{ old('transport_allowance', $salaryPayment->transport_allowance) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Special --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Special Allowance
                    </label>

                    <input type="number"
                           name="special_allowance"
                           id="special_allowance"
                           value="{{ old('special_allowance', $salaryPayment->special_allowance) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Other Allowance --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Other Allowance
                    </label>

                    <input type="number"
                           name="other_allowance"
                           id="other_allowance"
                           value="{{ old('other_allowance', $salaryPayment->other_allowance) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Provident Fund --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Provident Fund
                    </label>

                    <input type="number"
                           name="provident_fund"
                           id="provident_fund"
                           value="{{ old('provident_fund', $salaryPayment->provident_fund) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Tax --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Tax
                    </label>

                    <input type="number"
                           name="tax"
                           id="tax"
                           value="{{ old('tax', $salaryPayment->tax) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Other Deduction --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Other Deduction
                    </label>

                    <input type="number"
                           name="other_deduction"
                           id="other_deduction"
                           value="{{ old('other_deduction', $salaryPayment->other_deduction) }}"
                           min="0"
                           step="0.01"
                           readonly
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>

            </div>

        </div>


        {{-- Salary Summary --}}
        <div class="px-4 sm:px-6 py-4 border-y border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-calculator"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Salary Payment Summary
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Review salary and payment status
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">


                {{-- Gross --}}
                <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                    <p class="text-xs font-medium text-blue-600">
                        Gross Salary
                    </p>

                    <p id="grossSalary"
                       class="mt-1 text-xl font-bold text-blue-700">
                        ৳0.00
                    </p>

                </div>


                {{-- Deduction --}}
                <div class="rounded-xl border border-red-100 bg-red-50 p-4">

                    <p class="text-xs font-medium text-red-600">
                        Total Deduction
                    </p>

                    <p id="totalDeduction"
                       class="mt-1 text-xl font-bold text-red-700">
                        ৳0.00
                    </p>

                </div>


                {{-- Net --}}
                <div class="rounded-xl border border-green-100 bg-green-50 p-4">

                    <p class="text-xs font-medium text-green-600">
                        Net Salary
                    </p>

                    <p id="netSalary"
                       class="mt-1 text-xl font-bold text-green-700">
                        ৳0.00
                    </p>

                </div>


                {{-- Paid --}}
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">

                    <p class="text-xs font-medium text-amber-600">
                        Paid Amount
                    </p>

                    <input type="number"
                           name="paid_amount"
                           id="paid_amount"
                           value="{{ old('paid_amount', $salaryPayment->paid_amount) }}"
                           min="0"
                           step="0.01"
                           class="mt-1 w-full rounded-lg border border-amber-200
                                  bg-white px-3 py-2 text-sm font-semibold
                                  text-amber-700 outline-none
                                  focus:border-amber-500
                                  focus:ring-2 focus:ring-amber-100">

                </div>

            </div>


            {{-- Payment Status --}}
            <div class="mt-5 rounded-xl border border-slate-200 bg-slate-50 p-4">

                <div class="flex flex-col sm:flex-row sm:items-center
                            sm:justify-between gap-3">

                    <div>

                        <p class="text-xs font-medium text-slate-500">
                            Payment Status
                        </p>

                        <p id="statusText"
                           class="mt-1 text-sm font-bold text-red-600">
                            Pending
                        </p>

                    </div>


                    <div id="statusBadge"
                         class="inline-flex items-center gap-1.5
                                rounded-full bg-red-50 px-3 py-1.5
                                text-xs font-semibold text-red-700">

                        <i class="bi bi-clock"></i>
                        Pending

                    </div>

                </div>


                <div class="mt-3 text-xs text-slate-500">

                    Remaining:

                    <span id="remainingAmount"
                          class="font-semibold text-slate-700">
                        ৳0.00
                    </span>

                </div>

            </div>


            {{-- Remarks --}}
            <div class="mt-5">

                <label class="block text-sm font-medium text-slate-700 mb-1.5">
                    Remarks
                </label>

                <textarea name="remarks"
                          rows="3"
                          placeholder="Optional remarks..."
                          class="w-full rounded-lg border border-slate-300
                                 bg-white px-3 py-2.5 text-sm text-slate-700
                                 placeholder-slate-400 outline-none resize-none
                                 focus:border-blue-500 focus:ring-2
                                 focus:ring-blue-100">{{ old('remarks', $salaryPayment->remarks) }}</textarea>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex flex-col-reverse sm:flex-row items-stretch
                    sm:items-center justify-end gap-3 px-4 sm:px-6 py-4
                    border-t border-slate-200 bg-slate-50">

            <a href="{{ route('admin.salary-payments.index') }}"
               class="inline-flex items-center justify-center
                      rounded-lg border border-slate-300 bg-white
                      px-4 py-2.5 text-sm font-medium text-slate-600
                      hover:bg-slate-100 transition">

                Cancel

            </a>


            <button type="submit"
                    class="inline-flex items-center justify-center gap-2
                           rounded-lg bg-blue-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-blue-700 transition">

                <i class="bi bi-check2-circle"></i>

                Update Salary Payment

            </button>

        </div>

    </form>

</div>
```

</div>

{{-- Live Salary Calculation --}}

<script>

document.addEventListener('DOMContentLoaded', function () {

    const paidAmount = document.getElementById('paid_amount');


    function getValue(id) {

        const element = document.getElementById(id);

        return parseFloat(element?.value) || 0;

    }


    function money(value) {

        return '৳' + Number(value || 0).toLocaleString('en-BD', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }


    function calculateSalary() {

        const gross =
            getValue('basic_salary') +
            getValue('house_rent') +
            getValue('medical_allowance') +
            getValue('transport_allowance') +
            getValue('special_allowance') +
            getValue('other_allowance');


        const deduction =
            getValue('provident_fund') +
            getValue('tax') +
            getValue('other_deduction');


        const net = Math.max(gross - deduction, 0);


        let paid = parseFloat(paidAmount.value) || 0;

        paid = Math.max(paid, 0);


        /*
        |--------------------------------------------------------------------------
        | Prevent paid amount greater than net salary
        |--------------------------------------------------------------------------
        */

        if (paid > net) {
            paid = net;
            paidAmount.value = net.toFixed(2);
        }


        const remaining = Math.max(net - paid, 0);


        /*
        |--------------------------------------------------------------------------
        | Payment Status
        |--------------------------------------------------------------------------
        */

        let status = 'Pending';

        let statusClass = 'bg-red-50 text-red-700';

        let icon = 'bi-clock';


        if (net > 0 && paid >= net) {

            status = 'Paid';

            statusClass = 'bg-green-50 text-green-700';

            icon = 'bi-check-circle';

        }

        else if (paid > 0 && paid < net) {

            status = 'Partial';

            statusClass = 'bg-amber-50 text-amber-700';

            icon = 'bi-hourglass-split';

        }


        /*
        |--------------------------------------------------------------------------
        | Update Summary
        |--------------------------------------------------------------------------
        */

        document.getElementById('grossSalary').textContent =
            money(gross);


        document.getElementById('totalDeduction').textContent =
            money(deduction);


        document.getElementById('netSalary').textContent =
            money(net);


        document.getElementById('remainingAmount').textContent =
            money(remaining);


        document.getElementById('statusText').textContent =
            status;


        const badge = document.getElementById('statusBadge');


        badge.className =
            'inline-flex items-center gap-1.5 rounded-full px-3 py-1.5 text-xs font-semibold ' +
            statusClass;


        badge.innerHTML =
            '<i class="bi ' + icon + '"></i> ' + status;

    }


    /*
    |--------------------------------------------------------------------------
    | Paid Amount Live Calculation
    |--------------------------------------------------------------------------
    */

    paidAmount.addEventListener('input', calculateSalary);


    /*
    |--------------------------------------------------------------------------
    | Initial Calculation
    |--------------------------------------------------------------------------
    */

    calculateSalary();

});

</script>

@endsection
