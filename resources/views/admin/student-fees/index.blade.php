@extends('admin.layouts.app')

@section('title', 'Student Fee Assignment')
@section('page-title', 'Student Fee Assignment')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Student Fee Assignment
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Assign and manage individual fees for students
                </p>

            </div>

            <a href="{{ route('admin.student-fees.create') }}"
               class="w-full sm:w-auto inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-medium text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>

                Assign Fee

            </a>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}

    @if(session('success'))

        <div class="mb-5 flex items-center gap-3
                    rounded-lg border border-green-200
                    bg-green-50 px-4 py-3
                    text-sm text-green-700">

            <i class="bi bi-check-circle-fill"></i>

            <span>
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        ERROR MESSAGE
    ========================================================== --}}

    @if(session('error'))

        <div class="mb-5 flex items-center gap-3
                    rounded-lg border border-red-200
                    bg-red-50 px-4 py-3
                    text-sm text-red-700">

            <i class="bi bi-exclamation-circle-fill"></i>

            <span>
                {{ session('error') }}
            </span>

        </div>

    @endif


    @if($errors->any())

        <div class="mb-5 rounded-lg
                    border border-red-200
                    bg-red-50 px-4 py-3
                    text-sm text-red-700">

            <p class="font-semibold mb-1">
                Please fix the following errors:
            </p>

            <ul class="list-disc pl-5 space-y-1">

                @foreach($errors->all() as $error)

                    <li>
                        {{ $error }}
                    </li>

                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        SUMMARY CARDS
    ========================================================== --}}

    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-4 mb-6">

        {{-- Total Assignments --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-blue-50 text-blue-600">

                    <i class="bi bi-receipt text-xl"></i>

                </div>

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Total Assignments
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-800">
                        {{ $studentFees->count() }}
                    </p>

                </div>

            </div>

        </div>


        {{-- Total Amount --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-indigo-50 text-indigo-600">

                    <i class="bi bi-cash-stack text-xl"></i>

                </div>

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Total Assigned
                    </p>

                    <p class="mt-1 text-2xl font-bold text-slate-800">

                        ৳ {{ number_format($studentFees->sum('amount'), 2) }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Pending --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-amber-50 text-amber-600">

                    <i class="bi bi-clock-history text-xl"></i>

                </div>

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Pending
                    </p>

                    <p class="mt-1 text-2xl font-bold text-amber-600">

                        {{ $studentFees->where('status', 'pending')->count() }}

                    </p>

                </div>

            </div>

        </div>


        {{-- Paid --}}
        <div class="rounded-xl border border-slate-200
                    bg-white p-5 shadow-sm">

            <div class="flex items-center gap-4">

                <div class="flex h-11 w-11 items-center justify-center
                            rounded-xl bg-green-50 text-green-600">

                    <i class="bi bi-check-circle text-xl"></i>

                </div>

                <div>

                    <p class="text-xs font-medium text-slate-500">
                        Paid
                    </p>

                    <p class="mt-1 text-2xl font-bold text-green-600">

                        {{ $studentFees->where('status', 'paid')->count() }}

                    </p>

                </div>

            </div>

        </div>

    </div>


    {{-- =========================================================
        FILTER / SEARCH
    ========================================================== --}}

    <div class="mb-5 rounded-xl border border-slate-200
                bg-white p-4 shadow-sm">

        <form method="GET"
              action="{{ route('admin.student-fees.index') }}">

            <div class="grid grid-cols-1 gap-3
                        sm:grid-cols-2
                        lg:grid-cols-4">

                {{-- Student Search --}}
                <div>

                    <label class="mb-1.5 block text-xs font-medium text-slate-600">
                        Student
                    </label>

                    <input type="text"
                           name="student"
                           value="{{ request('student') }}"
                           placeholder="Search student..."

                           class="w-full rounded-lg
                                  border border-slate-300
                                  bg-white px-3 py-2.5
                                  text-sm outline-none
                                  focus:border-blue-500
                                  focus:ring-2
                                  focus:ring-blue-100">

                </div>


                {{-- Fee Type --}}
                <div>

                    <label class="mb-1.5 block text-xs font-medium text-slate-600">
                        Fee Type
                    </label>

                    <select name="fee_type_id"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Fee Types
                        </option>

                        @foreach($feeTypes ?? [] as $feeType)

                            <option value="{{ $feeType->id }}"
                                {{ request('fee_type_id') == $feeType->id ? 'selected' : '' }}>

                                {{ $feeType->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label class="mb-1.5 block text-xs font-medium text-slate-600">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-lg
                                   border border-slate-300
                                   bg-white px-3 py-2.5
                                   text-sm outline-none
                                   focus:border-blue-500
                                   focus:ring-2
                                   focus:ring-blue-100">

                        <option value="">
                            All Status
                        </option>

                        <option value="pending"
                            {{ request('status') === 'pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="partial"
                            {{ request('status') === 'partial' ? 'selected' : '' }}>
                            Partial
                        </option>

                        <option value="paid"
                            {{ request('status') === 'paid' ? 'selected' : '' }}>
                            Paid
                        </option>

                    </select>

                </div>


                {{-- Search --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="flex-1 inline-flex
                                   items-center justify-center gap-2
                                   rounded-lg bg-blue-600
                                   px-4 py-2.5
                                   text-sm font-medium text-white
                                   hover:bg-blue-700 transition">

                        <i class="bi bi-search"></i>

                        Search

                    </button>

                    <a href="{{ route('admin.student-fees.index') }}"
                       class="inline-flex items-center
                              justify-center
                              rounded-lg
                              border border-slate-300
                              bg-white px-4 py-2.5
                              text-sm font-medium
                              text-slate-600
                              hover:bg-slate-50">

                        <i class="bi bi-arrow-clockwise"></i>

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        TABLE
    ========================================================== --}}

    <div class="overflow-hidden rounded-xl
                border border-slate-200
                bg-white shadow-sm">

        {{-- Table Header --}}
        <div class="flex flex-col gap-2
                    border-b border-slate-200
                    px-4 py-4
                    sm:flex-row sm:items-center
                    sm:justify-between sm:px-5">

            <div>

                <h2 class="text-base sm:text-lg
                           font-semibold text-slate-800">

                    Assigned Fees

                </h2>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">

                    Individual student fee assignments

                </p>

            </div>

            <div class="text-xs sm:text-sm text-slate-500">

                Total:
                <span class="font-semibold text-slate-700">
                    {{ $studentFees->count() }}
                </span>

            </div>

        </div>


        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">

            <table class="w-full min-w-[1000px] text-sm">

                <thead class="border-b border-slate-200 bg-slate-50">

                    <tr>

                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            Student
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            Fee Type
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            Session
                        </th>

                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Amount
                        </th>

                        <th class="px-4 py-3 text-left font-semibold text-slate-600">
                            Due Date
                        </th>

                        <th class="px-4 py-3 text-center font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-4 py-3 text-right font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($studentFees as $studentFee)

                        <tr class="transition hover:bg-slate-50">

                            {{-- # --}}
                            <td class="px-4 py-3 text-slate-500">

                                {{ $loop->iteration }}

                            </td>


                            {{-- Student --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center gap-3">

                                    <div class="flex h-9 w-9 shrink-0
                                                items-center justify-center
                                                rounded-lg bg-blue-50
                                                font-semibold text-blue-600">

                                        {{ strtoupper(
                                            substr(
                                                $studentFee->student->name ?? 'S',
                                                0,
                                                1
                                            )
                                        ) }}

                                    </div>

                                    <div>

                                        <p class="font-semibold text-slate-800">

                                            {{ $studentFee->student->name ?? 'N/A' }}

                                        </p>

                                        <p class="mt-0.5 text-xs text-slate-400">

                                            ID:
                                            {{ $studentFee->student->student_id
                                                ?? $studentFee->student->id
                                                ?? 'N/A' }}

                                        </p>

                                    </div>

                                </div>

                            </td>


                            {{-- Fee Type --}}
                            <td class="px-4 py-3">

                                <span class="font-medium text-slate-700">

                                    {{ $studentFee->feeType->name ?? 'N/A' }}

                                </span>

                            </td>


                            {{-- Session --}}
                            <td class="px-4 py-3 text-slate-600">

                                {{ $studentFee->academicSession->name
                                    ?? $studentFee->academicSession->title
                                    ?? 'N/A' }}

                            </td>


                            {{-- Amount --}}
                            <td class="px-4 py-3 text-right">

                                <span class="font-bold text-slate-800">

                                    ৳ {{ number_format($studentFee->amount, 2) }}

                                </span>

                            </td>


                            {{-- Due Date --}}
                            <td class="px-4 py-3 text-slate-600">

                                @if($studentFee->due_date)

                                    {{ \Carbon\Carbon::parse(
                                        $studentFee->due_date
                                    )->format('d M Y') }}

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-3 text-center">

                                @if($studentFee->status === 'paid')

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full
                                                 border border-green-200
                                                 bg-green-50
                                                 px-2.5 py-1
                                                 text-xs font-semibold
                                                 text-green-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>

                                        Paid

                                    </span>

                                @elseif($studentFee->status === 'partial')

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full
                                                 border border-blue-200
                                                 bg-blue-50
                                                 px-2.5 py-1
                                                 text-xs font-semibold
                                                 text-blue-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-blue-500"></span>

                                        Partial

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 rounded-full
                                                 border border-amber-200
                                                 bg-amber-50
                                                 px-2.5 py-1
                                                 text-xs font-semibold
                                                 text-amber-700">

                                        <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                        Pending

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-3">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Edit --}}
                                    <a href="{{ route(
                                        'admin.student-fees.edit',
                                        $studentFee->id
                                    ) }}"
                                       title="Edit"

                                       class="inline-flex h-9 w-9
                                              items-center justify-center
                                              rounded-lg bg-blue-50
                                              text-blue-600
                                              hover:bg-blue-100 transition">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route(
                                              'admin.student-fees.destroy',
                                              $studentFee->id
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this fee assignment?'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"

                                                class="inline-flex h-9 w-9
                                                       items-center justify-center
                                                       rounded-lg bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100 transition">

                                            <i class="bi bi-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8"
                                class="px-4 py-14 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="flex h-16 w-16
                                                items-center justify-center
                                                rounded-full bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-receipt text-3xl"></i>

                                    </div>

                                    <h3 class="mt-4 text-sm sm:text-base
                                               font-semibold text-slate-700">

                                        No Fee Assignments Found

                                    </h3>

                                    <p class="mt-1 text-xs sm:text-sm
                                              text-slate-500">

                                        No individual fees have been assigned
                                        to students yet.

                                    </p>

                                    <a href="{{ route('admin.student-fees.create') }}"
                                       class="mt-4 inline-flex
                                              items-center gap-2
                                              rounded-lg bg-blue-600
                                              px-4 py-2.5
                                              text-sm font-medium text-white
                                              hover:bg-blue-700 transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Assign First Fee

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
             MOBILE CARD VIEW
        ====================================================== --}}

        <div class="divide-y divide-slate-100 md:hidden">

            @forelse($studentFees as $studentFee)

                <div class="p-4">

                    <div class="flex items-start gap-3">

                        {{-- Avatar --}}
                        <div class="flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl bg-blue-50
                                    font-bold text-blue-600">

                            {{ strtoupper(
                                substr(
                                    $studentFee->student->name ?? 'S',
                                    0,
                                    1
                                )
                            ) }}

                        </div>


                        <div class="min-w-0 flex-1">

                            <div class="flex items-start justify-between gap-2">

                                <div>

                                    <p class="truncate text-sm font-semibold text-slate-800">

                                        {{ $studentFee->student->name ?? 'N/A' }}

                                    </p>

                                    <p class="mt-0.5 text-xs text-slate-400">

                                        ID:
                                        {{ $studentFee->student->student_id
                                            ?? $studentFee->student->id
                                            ?? 'N/A' }}

                                    </p>

                                </div>


                                {{-- Status --}}
                                @if($studentFee->status === 'paid')

                                    <span class="shrink-0 rounded-full
                                                 bg-green-50 px-2 py-1
                                                 text-[10px] font-semibold
                                                 text-green-700">

                                        Paid

                                    </span>

                                @elseif($studentFee->status === 'partial')

                                    <span class="shrink-0 rounded-full
                                                 bg-blue-50 px-2 py-1
                                                 text-[10px] font-semibold
                                                 text-blue-700">

                                        Partial

                                    </span>

                                @else

                                    <span class="shrink-0 rounded-full
                                                 bg-amber-50 px-2 py-1
                                                 text-[10px] font-semibold
                                                 text-amber-700">

                                        Pending

                                    </span>

                                @endif

                            </div>


                            {{-- Fee Information --}}
                            <div class="mt-3 grid grid-cols-2 gap-3">

                                <div>

                                    <p class="text-[10px] uppercase
                                              tracking-wide text-slate-400">

                                        Fee Type

                                    </p>

                                    <p class="mt-0.5 text-xs font-medium text-slate-700">

                                        {{ $studentFee->feeType->name ?? 'N/A' }}

                                    </p>

                                </div>


                                <div>

                                    <p class="text-[10px] uppercase
                                              tracking-wide text-slate-400">

                                        Session

                                    </p>

                                    <p class="mt-0.5 text-xs font-medium text-slate-700">

                                        {{ $studentFee->academicSession->name
                                            ?? $studentFee->academicSession->title
                                            ?? 'N/A' }}

                                    </p>

                                </div>


                                <div>

                                    <p class="text-[10px] uppercase
                                              tracking-wide text-slate-400">

                                        Assigned Amount

                                    </p>

                                    <p class="mt-0.5 text-sm font-bold text-slate-800">

                                        ৳ {{ number_format($studentFee->amount, 2) }}

                                    </p>

                                </div>


                                <div>

                                    <p class="text-[10px] uppercase
                                              tracking-wide text-slate-400">

                                        Due Date

                                    </p>

                                    <p class="mt-0.5 text-xs font-medium text-slate-700">

                                        @if($studentFee->due_date)

                                            {{ \Carbon\Carbon::parse(
                                                $studentFee->due_date
                                            )->format('d M Y') }}

                                        @else

                                            —

                                        @endif

                                    </p>

                                </div>

                            </div>


                            {{-- Actions --}}
                            <div class="mt-4 flex justify-end gap-2">

                                <a href="{{ route(
                                    'admin.student-fees.edit',
                                    $studentFee->id
                                ) }}"
                                   class="inline-flex items-center gap-1.5
                                          rounded-lg bg-blue-50
                                          px-3 py-2
                                          text-xs font-medium
                                          text-blue-600
                                          hover:bg-blue-100">

                                    <i class="bi bi-pencil-square"></i>

                                    Edit

                                </a>


                                <form method="POST"
                                      action="{{ route(
                                          'admin.student-fees.destroy',
                                          $studentFee->id
                                      ) }}"
                                      onsubmit="return confirm(
                                          'Are you sure you want to delete this fee assignment?'
                                      )">

                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="inline-flex items-center gap-1.5
                                                   rounded-lg bg-red-50
                                                   px-3 py-2
                                                   text-xs font-medium
                                                   text-red-600
                                                   hover:bg-red-100">

                                        <i class="bi bi-trash"></i>

                                        Delete

                                    </button>

                                </form>

                            </div>

                        </div>

                    </div>

                </div>

            @empty

                <div class="px-4 py-12 text-center">

                    <i class="bi bi-receipt text-3xl text-slate-300"></i>

                    <p class="mt-3 text-sm font-medium text-slate-600">
                        No Fee Assignments Found
                    </p>

                </div>

            @endforelse

        </div>

    </div>

</div>

@endsection