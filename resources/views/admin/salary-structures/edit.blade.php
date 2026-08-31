@extends('admin.layouts.app')

@section('title', 'Edit Salary Structure')

@section('page-title', 'Edit Salary Structure')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">

        <a href="{{ route('admin.salary-structures.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition">
            <i class="bi bi-arrow-left"></i>
            Back to Salary Structures
        </a>

        <div class="mt-4">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Edit Salary Structure
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Update salary structure for a teacher or staff member
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

        <form action="{{ route('admin.salary-structures.update', $salaryStructure->id) }}"
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
                            Select the teacher or staff member
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Teacher / Staff --}}
                    <div class="md:col-span-2 lg:col-span-2">

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Teacher / Staff
                            <span class="text-red-500">*</span>
                        </label>

                        <select name="teacher_staff_id"
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
                                    {{ old('teacher_staff_id', $salaryStructure->teacher_staff_id) == $teacher->id ? 'selected' : '' }}>

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


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Status
                        </label>

                        <label class="flex items-center gap-3 h-[42px] cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old('status', $salaryStructure->status) ? 'checked' : '' }}
                                   class="h-4 w-4 rounded border-slate-300
                                          text-blue-600 focus:ring-blue-500">

                            <span class="text-sm text-slate-600">
                                Active
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Earnings --}}
            <div class="px-4 sm:px-6 py-4 border-y border-slate-200 bg-slate-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-green-50 text-green-600">
                        <i class="bi bi-plus-circle"></i>
                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Salary & Allowances
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Basic salary and additional allowances
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Basic Salary --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Basic Salary
                            <span class="text-red-500">*</span>
                        </label>

                        <input type="number"
                               name="basic_salary"
                               id="basic_salary"
                               value="{{ old('basic_salary', $salaryStructure->basic_salary) }}"
                               min="0"
                               step="0.01"
                               required
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100
                                      @error('basic_salary') border-red-400 @enderror"
                               placeholder="0.00">

                        @error('basic_salary')
                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- House Rent --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            House Rent
                        </label>

                        <input type="number"
                               name="house_rent"
                               id="house_rent"
                               value="{{ old('house_rent', $salaryStructure->house_rent ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Medical Allowance --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Medical Allowance
                        </label>

                        <input type="number"
                               name="medical_allowance"
                               id="medical_allowance"
                               value="{{ old('medical_allowance', $salaryStructure->medical_allowance ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Transport Allowance --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Transport Allowance
                        </label>

                        <input type="number"
                               name="transport_allowance"
                               id="transport_allowance"
                               value="{{ old('transport_allowance', $salaryStructure->transport_allowance ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Special Allowance --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Special Allowance
                        </label>

                        <input type="number"
                               name="special_allowance"
                               id="special_allowance"
                               value="{{ old('special_allowance', $salaryStructure->special_allowance ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Other Allowance --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Other Allowance
                        </label>

                        <input type="number"
                               name="other_allowance"
                               id="other_allowance"
                               value="{{ old('other_allowance', $salaryStructure->other_allowance ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

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
                            Provident fund, tax and other deductions
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                    {{-- Provident Fund --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Provident Fund
                        </label>

                        <input type="number"
                               name="provident_fund"
                               id="provident_fund"
                               value="{{ old('provident_fund', $salaryStructure->provident_fund ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Tax --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Tax
                        </label>

                        <input type="number"
                               name="tax"
                               id="tax"
                               value="{{ old('tax', $salaryStructure->tax ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

                    </div>


                    {{-- Other Deduction --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Other Deduction
                        </label>

                        <input type="number"
                               name="other_deduction"
                               id="other_deduction"
                               value="{{ old('other_deduction', $salaryStructure->other_deduction ?? 0) }}"
                               min="0"
                               step="0.01"
                               class="salary-input w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      placeholder-slate-400 outline-none
                                      focus:border-blue-500 focus:ring-2 focus:ring-blue-100"
                               placeholder="0.00">

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
                            Automatically calculated salary amount
                        </p>

                    </div>

                </div>

            </div>


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                    {{-- Gross --}}
                    <div class="rounded-xl border border-blue-100 bg-blue-50 p-4">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs font-medium text-blue-600">
                                    Gross Salary
                                </p>

                                <p id="grossSalary"
                                   class="mt-1 text-xl font-bold text-blue-700">
                                    ৳0.00
                                </p>

                            </div>

                            <i class="bi bi-arrow-up-circle text-xl text-blue-600"></i>

                        </div>

                    </div>


                    {{-- Deduction --}}
                    <div class="rounded-xl border border-red-100 bg-red-50 p-4">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs font-medium text-red-600">
                                    Total Deduction
                                </p>

                                <p id="totalDeduction"
                                   class="mt-1 text-xl font-bold text-red-700">
                                    ৳0.00
                                </p>

                            </div>

                            <i class="bi bi-arrow-down-circle text-xl text-red-600"></i>

                        </div>

                    </div>


                    {{-- Net --}}
                    <div class="rounded-xl border border-green-100 bg-green-50 p-4">

                        <div class="flex items-center justify-between">

                            <div>

                                <p class="text-xs font-medium text-green-600">
                                    Net Salary
                                </p>

                                <p id="netSalary"
                                   class="mt-1 text-xl font-bold text-green-700">
                                    ৳0.00
                                </p>

                            </div>

                            <i class="bi bi-wallet2 text-xl text-green-600"></i>

                        </div>

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
                                     focus:border-blue-500 focus:ring-2 focus:ring-blue-100">{{ old('remarks', $salaryStructure->remarks) }}</textarea>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex flex-col-reverse sm:flex-row items-stretch sm:items-center
                        justify-end gap-3 px-4 sm:px-6 py-4
                        border-t border-slate-200 bg-slate-50">

                <a href="{{ route('admin.salary-structures.index') }}"
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
                    Update Salary Structure

                </button>

            </div>

        </form>

    </div>

</div>


{{-- Live Salary Calculation --}}
<script>

document.addEventListener('DOMContentLoaded', function () {

    const fields = [
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


    function getValue(id) {

        const element = document.getElementById(id);

        return parseFloat(element?.value) || 0;
    }


    function formatMoney(amount) {

        return '৳' + amount.toLocaleString('en-BD', {
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


        const net = gross - deduction;


        document.getElementById('grossSalary').textContent =
            formatMoney(gross);


        document.getElementById('totalDeduction').textContent =
            formatMoney(deduction);


        document.getElementById('netSalary').textContent =
            formatMoney(net);

    }


    fields.forEach(function (field) {

        const element = document.getElementById(field);

        if (element) {

            element.addEventListener('input', calculateSalary);

        }

    });


    // Calculate existing salary immediately
    calculateSalary();

});

</script>

@endsection