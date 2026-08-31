@extends('admin.layouts.app')

@section('title', 'Add Salary Payment')

@section('page-title', 'Add Salary Payment')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

{{-- Page Header --}}
<div class="mb-6">
    <a href="{{ route('admin.salary-payments.index') }}"
       class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition">
        <i class="bi bi-arrow-left"></i>
        Back to Salary Payments
    </a>

    <div class="mt-4">
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Add Salary Payment
        </h1>

        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Create monthly salary payment for a teacher or staff member
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


{{-- Salary Structure Error --}}
<div id="structureError"
     class="hidden mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

    <div class="flex items-center gap-3">

        <div class="flex h-8 w-8 items-center justify-center
                    rounded-full bg-red-100 text-red-600">

            <i class="bi bi-exclamation-triangle"></i>

        </div>

        <p id="structureErrorText"
           class="text-sm font-medium text-red-800">
        </p>

    </div>

</div>


{{-- Form --}}
<div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">

    <form action="{{ route('admin.salary-payments.store') }}"
          method="POST"
          id="salaryPaymentForm">

        @csrf

        {{-- Hidden Salary Structure --}}
        <input type="hidden"
               name="salary_structure_id"
               id="salary_structure_id"
               value="">


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
                        Select teacher or staff and salary month
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- Teacher --}}
                <div class="md:col-span-1">

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
                                   focus:ring-2 focus:ring-blue-100">

                        <option value="">
                            Select Teacher / Staff
                        </option>

                        @foreach($teachers as $teacher)

                            <option value="{{ $teacher->id }}"
                                {{ old('teacher_staff_id') == $teacher->id ? 'selected' : '' }}>

                                {{ $teacher->name }}

                                @if($teacher->employee_id)
                                    — {{ $teacher->employee_id }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Salary Month --}}
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

                        <option value="">
                            Select Month
                        </option>

                        @foreach(range(1, 12) as $month)

                            <option value="{{ $month }}"
                                {{ old('salary_month', now()->month) == $month ? 'selected' : '' }}>

                                {{ \Carbon\Carbon::create()->month($month)->format('F') }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Salary Year --}}
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
                                {{ old('salary_year', now()->year) == $year ? 'selected' : '' }}>

                                {{ $year }}

                            </option>

                        @endforeach

                    </select>

                </div>

            </div>

        </div>


        {{-- Loading --}}
        <div id="structureLoading"
             class="hidden px-4 sm:px-6 py-3 border-y border-blue-100 bg-blue-50">

            <div class="flex items-center gap-2 text-sm text-blue-700">

                <i class="bi bi-arrow-repeat animate-spin"></i>

                Loading active salary structure...

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
                        Active salary structure of selected employee
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                {{-- Basic --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Basic Salary
                    </label>

                    <input type="number"
                           id="basic_salary"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- House Rent --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        House Rent
                    </label>

                    <input type="number"
                           id="house_rent"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Medical --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Medical Allowance
                    </label>
                    <input type="number" id="medical_allowance" readonly   value="0"  class="salary-field w-full rounded-lg border border-slate-300  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">
                </div>


                {{-- Transport --}}
                <div>
                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Transport Allowance
                    </label>
                    <input type="number"
                           id="transport_allowance"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">
                </div>

                {{-- Special --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Special Allowance
                    </label>

                    <input type="number"
                           id="special_allowance"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Other --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Other Allowance
                    </label>

                    <input type="number"
                           id="other_allowance"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>

            </div>

        </div>


        {{-- Deductions --}}
        <div class="px-4 sm:px-6 py-4 border-y border-slate-200 bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-red-50 text-red-600">

                    <i class="bi bi-dash-circle"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Salary Deductions
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Deductions from salary
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                {{-- Provident --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Provident Fund
                    </label>

                    <input type="number"
                           id="provident_fund"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Tax --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Tax
                    </label>

                    <input type="number"
                           id="tax"
                           readonly
                           value="0"
                           class="salary-field w-full rounded-lg border border-slate-300
                                  bg-slate-50 px-3 py-2.5 text-sm text-slate-700">

                </div>


                {{-- Other Deduction --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Other Deduction
                    </label>

                    <input type="number"
                           id="other_deduction"
                           readonly
                           value="0"
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
                        Salary Summary
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Salary calculation from active structure
                    </p>

                </div>

            </div>

        </div>


        <div class="p-4 sm:p-6">

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">


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

            </div>


            {{-- Payment --}}
            <div class="mt-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    {{-- Paid Amount --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">

                            Paid Amount
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               name="paid_amount"
                               id="paid_amount"
                               value="{{ old('paid_amount', 0) }}"
                               min="0"
                               step="0.01"
                               required
                               class="w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Payment Date --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Payment Date
                        </label>

                        <input type="date"
                               name="payment_date"
                               value="{{ old('payment_date', now()->format('Y-m-d')) }}"
                               class="w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100">

                    </div>


                    {{-- Payment Method --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Payment Method
                        </label>

                        <select name="payment_method"
                                class="w-full rounded-lg border border-slate-300
                                       bg-white px-3 py-2.5 text-sm text-slate-700
                                       outline-none focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            <option value="">
                                Select Method
                            </option>

                            <option value="Cash"
                                {{ old('payment_method') == 'Cash' ? 'selected' : '' }}>
                                Cash
                            </option>

                            <option value="Bank"
                                {{ old('payment_method') == 'Bank' ? 'selected' : '' }}>
                                Bank
                            </option>

                            <option value="Mobile Banking"
                                {{ old('payment_method') == 'Mobile Banking' ? 'selected' : '' }}>
                                Mobile Banking
                            </option>

                            <option value="Cheque"
                                {{ old('payment_method') == 'Cheque' ? 'selected' : '' }}>
                                Cheque
                            </option>

                        </select>

                    </div>

                </div>

            </div>


            {{-- Payment Status --}}
            <div class="mt-5 grid grid-cols-1 md:grid-cols-3 gap-4">

                {{-- Status --}}
                <div id="statusBox"
                     class="rounded-xl border border-red-100 bg-red-50 p-4">

                    <p class="text-xs font-medium text-slate-500">
                        Payment Status
                    </p>

                    <div class="mt-2">

                        <span id="paymentStatus"
                              class="inline-flex items-center gap-1
                                     rounded-full bg-red-50
                                     px-3 py-1.5 text-xs
                                     font-semibold text-red-700">

                            <i class="bi bi-clock"></i>
                            Pending

                        </span>

                    </div>

                    <input type="hidden"
                           name="status"
                           id="status"
                           value="Pending">

                </div>


                {{-- Paid --}}
                <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                    <p class="text-xs font-medium text-blue-600">
                        Paid Amount
                    </p>

                    <p id="paidDisplay"
                       class="mt-1 text-xl font-bold text-blue-700">
                        ৳0.00
                    </p>

                </div>


                {{-- Due --}}
                <div class="rounded-xl border border-amber-100 bg-amber-50 p-4">

                    <p class="text-xs font-medium text-amber-600">
                        Due Amount
                    </p>

                    <p id="dueSalary"
                       class="mt-1 text-xl font-bold text-amber-700">
                        ৳0.00
                    </p>

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
                                 focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('remarks') }}</textarea>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center
                    justify-end gap-3 px-4 sm:px-6 py-4
                    border-t border-slate-200 bg-slate-50">

            <a href="{{ route('admin.salary-payments.index') }}"
               class="inline-flex items-center justify-center
                      rounded-lg border border-slate-300 bg-white
                      px-4 py-2.5 text-sm font-medium text-slate-600
                      hover:bg-slate-100 transition">

                Cancel

            </a>

            <button type="submit"
                    id="saveButton"
                    class="inline-flex items-center justify-center gap-2
                           rounded-lg bg-blue-600 px-5 py-2.5
                           text-sm font-semibold text-white
                           hover:bg-blue-700 transition">

                <i class="bi bi-check2-circle"></i>

                Save Salary Payment

            </button>

        </div>

    </form>

</div>

</div>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const teacherSelect = document.getElementById('teacher_staff_id');

    const loading = document.getElementById('structureLoading');

    const errorBox = document.getElementById('structureError');

    const errorText = document.getElementById('structureErrorText');

    const saveButton = document.getElementById('saveButton');

    const structureId = document.getElementById('salary_structure_id');

    const paidAmountInput = document.getElementById('paid_amount');


    const salaryFields = [
        'basic_salary',
        'house_rent',
        'medical_allowance',
        'transport_allowance',
        'special_allowance',
        'other_allowance',
        'provident_fund',
        'tax',
        'other_deduction'
    ];


    function money(value) {

        return '৳' + Number(value || 0).toLocaleString('en-BD', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });

    }


    function numberValue(id) {

        const element = document.getElementById(id);

        return parseFloat(element?.value) || 0;

    }


    function clearStructure() {

        structureId.value = '';

        salaryFields.forEach(function (field) {

            const element = document.getElementById(field);

            if (element) {
                element.value = '0';
            }

        });

        document.getElementById('grossSalary').textContent = '৳0.00';

        document.getElementById('totalDeduction').textContent = '৳0.00';

        document.getElementById('netSalary').textContent = '৳0.00';

        document.getElementById('dueSalary').textContent = '৳0.00';

        document.getElementById('paidDisplay').textContent = '৳0.00';

        paidAmountInput.max = '';

        saveButton.disabled = true;

        saveButton.classList.add('opacity-50', 'cursor-not-allowed');

    }


    function showError(message) {

        errorText.textContent = message;

        errorBox.classList.remove('hidden');

    }


    function hideError() {

        errorBox.classList.add('hidden');

        errorText.textContent = '';

    }


    function calculatePayment() {

        const gross = numberValue('basic_salary')
            + numberValue('house_rent')
            + numberValue('medical_allowance')
            + numberValue('transport_allowance')
            + numberValue('special_allowance')
            + numberValue('other_allowance');


        const deduction = numberValue('provident_fund')
            + numberValue('tax')
            + numberValue('other_deduction');


        const net = Math.max(0, gross - deduction);


        document.getElementById('grossSalary').textContent = money(gross);

        document.getElementById('totalDeduction').textContent = money(deduction);

        document.getElementById('netSalary').textContent = money(net);


        paidAmountInput.max = net;


        let paid = parseFloat(paidAmountInput.value) || 0;


        if (paid > net) {

            paid = net;

            paidAmountInput.value = net.toFixed(2);

        }


        const due = Math.max(0, net - paid);


        document.getElementById('paidDisplay').textContent = money(paid);

        document.getElementById('dueSalary').textContent = money(due);


        let status = 'Pending';

        let statusClass = 'bg-red-50 text-red-700';

        let icon = 'bi-clock';


        if (paid > 0 && paid < net) {

            status = 'Partial';

            statusClass = 'bg-amber-50 text-amber-700';

            icon = 'bi-hourglass-split';

        }


        if (net > 0 && paid >= net) {

            status = 'Paid';

            statusClass = 'bg-green-50 text-green-700';

            icon = 'bi-check-circle';

        }


        document.getElementById('status').value = status;


        const statusElement = document.getElementById('paymentStatus');

        statusElement.className =
            'inline-flex items-center gap-1 rounded-full px-3 py-1.5 text-xs font-semibold ' +
            statusClass;


        statusElement.innerHTML =
            '<i class="bi ' + icon + '"></i> ' + status;


    }


    function loadSalaryStructure(teacherId) {

        hideError();

        clearStructure();

        if (!teacherId) {
            return;
        }


        loading.classList.remove('hidden');


        /*
         * IMPORTANT:
         * This route must exist in web.php:
         *
         * Route::get(
         *     '/salary-payments/salary-structure/{teacherStaffId}',
         *     [SalaryPaymentController::class, 'salaryStructure']
         * )->name('admin.salary-payments.salary-structure');
         */

        const url =
            "{{ route('admin.salary-payments.salary-structure', ':teacherStaffId') }}"
                .replace(':teacherStaffId', teacherId);


        fetch(url, {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {

            if (!response.ok) {
                throw new Error('HTTP error: ' + response.status);
            }

            return response.json();

        })
        .then(data => {

            loading.classList.add('hidden');


            if (!data.success) {

                showError(
                    data.message || 'No active salary structure found.'
                );

                return;

            }


            const salary = data.salary_structure;


            structureId.value = salary.id ?? '';


            document.getElementById('basic_salary').value =
                salary.basic_salary ?? 0;

            document.getElementById('house_rent').value =
                salary.house_rent ?? 0;

            document.getElementById('medical_allowance').value =
                salary.medical_allowance ?? 0;

            document.getElementById('transport_allowance').value =
                salary.transport_allowance ?? 0;

            document.getElementById('special_allowance').value =
                salary.special_allowance ?? 0;

            document.getElementById('other_allowance').value =
                salary.other_allowance ?? 0;

            document.getElementById('provident_fund').value =
                salary.provident_fund ?? 0;

            document.getElementById('tax').value =
                salary.tax ?? 0;

            document.getElementById('other_deduction').value =
                salary.other_deduction ?? 0;


            calculatePayment();


            saveButton.disabled = false;

            saveButton.classList.remove(
                'opacity-50',
                'cursor-not-allowed'
            );

        })
        .catch(error => {

            console.error(error);

            loading.classList.add('hidden');

            showError(
                'Unable to load salary structure. Please check your route and try again.'
            );

        });

    }


    teacherSelect.addEventListener('change', function () {

        loadSalaryStructure(this.value);

    });


    paidAmountInput.addEventListener('input', function () {

        calculatePayment();

    });


    /*
     * Load automatically if validation failed
     * and teacher was previously selected.
     */

    @if(old('teacher_staff_id'))

        loadSalaryStructure('{{ old('teacher_staff_id') }}');

    @endif


    calculatePayment();

});

</script>

@endsection
