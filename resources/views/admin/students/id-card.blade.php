@extends('admin.layouts.app')

@section('title', 'Student ID Card')

@section('content')

<div class="space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between print:hidden">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Student ID Card
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Student identification card
            </p>
        </div>

        <div class="flex flex-wrap gap-2">

            <a
                href="{{ route('admin.students.show', $student) }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-slate-300 bg-white px-4 py-2.5
                       text-sm font-semibold text-slate-700
                       hover:bg-slate-50"
            >
                Back
            </a>

            <button
                type="button"
                onclick="window.print()"
                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-4 py-2.5
                       text-sm font-semibold text-white
                       hover:bg-blue-700"
            >
                <svg
                    class="h-5 w-5"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M6 9V2h12v7M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2M6 14h12v8H6v-8z"
                    />
                </svg>

                Print ID Card
            </button>

        </div>

    </div>


    {{-- ID CARD AREA --}}
    <div class="flex justify-center rounded-2xl border border-slate-200
                bg-slate-100 p-6 shadow-sm print:border-0 print:bg-white
                print:p-0 print:shadow-none">

        {{-- ID CARD --}}
        <div
            id="student-id-card"
            class="relative w-[350px] overflow-hidden rounded-2xl
                   bg-white shadow-xl print:shadow-none"
        >

            {{-- =====================================================
                 CARD HEADER
            ====================================================== --}}
            <div class="relative bg-gradient-to-br from-blue-700
                        via-blue-600 to-indigo-700 px-5 pb-16 pt-5">

                {{-- Decorative Circle --}}
                <div class="absolute -right-12 -top-12 h-32 w-32
                            rounded-full bg-white/10">
                </div>

                <div class="absolute -left-10 bottom-0 h-24 w-24
                            rounded-full bg-white/5">
                </div>


                {{-- Logo --}}
                <div class="relative flex items-center gap-3">

                    <div class="flex h-12 w-12 shrink-0 items-center
                                justify-center overflow-hidden rounded-xl
                                bg-white shadow">

                        {{-- Branch logo থাকলে এখানে ব্যবহার করবে --}}
                        @if(!empty($student->branch->logo))

                            <img
                                src="{{ asset('storage/' . $student->branch->logo) }}"
                                alt="Branch Logo"
                                class="h-full w-full object-contain p-1"
                            >

                        @else

                            <span class="text-xl font-bold text-blue-600">
                                {{ strtoupper(substr($student->branch->name ?? 'S', 0, 1)) }}
                            </span>

                        @endif

                    </div>


                    <div class="min-w-0 text-white">

                        <h2 class="truncate text-base font-bold">
                            {{ $student->branch->name ?? 'School Management' }}
                        </h2>

                        <p class="mt-0.5 text-[10px] uppercase tracking-wider
                                  text-blue-100">
                            Student Identification Card
                        </p>

                    </div>

                </div>


                {{-- Card Title --}}
                <div class="relative mt-5 text-center">

                    <h3 class="text-lg font-bold tracking-wide text-white">
                        STUDENT ID CARD
                    </h3>

                </div>

            </div>


            {{-- =====================================================
                 STUDENT PHOTO
            ====================================================== --}}
            <div class="relative -mt-12 flex justify-center">

                <div class="h-28 w-28 overflow-hidden rounded-2xl
                            border-4 border-white bg-slate-100 shadow-lg">

                    @if(!empty($student->photo))

                        <img
                            src="{{ asset('storage/' . $student->photo) }}"
                            alt="{{ $student->name }}"
                            class="h-full w-full object-cover"
                        >

                    @else

                        <div class="flex h-full w-full items-center
                                    justify-center bg-blue-50">

                            <span class="text-4xl font-bold text-blue-600">
                                {{ strtoupper(substr($student->name ?? 'S', 0, 1)) }}
                            </span>

                        </div>

                    @endif

                </div>

            </div>


            {{-- =====================================================
                 STUDENT NAME
            ====================================================== --}}
            <div class="px-5 pt-3 text-center">

                <h2 class="text-xl font-bold text-slate-800">
                    {{ $student->name }}
                </h2>

                @if(!empty($student->name_bn))

                    <p class="mt-0.5 text-sm text-slate-500">
                        {{ $student->name_bn }}
                    </p>

                @endif

                <div class="mt-2">

                    <span class="inline-flex rounded-full bg-blue-100
                                 px-3 py-1 text-xs font-bold text-blue-700">

                        ID:
                        {{ $student->student_id }}

                    </span>

                </div>

            </div>


            {{-- =====================================================
                 STUDENT INFORMATION
            ====================================================== --}}
            <div class="px-5 py-5">

                <div class="overflow-hidden rounded-xl border border-slate-200">

                    {{-- Class --}}
                    <div class="grid grid-cols-2 border-b border-slate-200">

                        <div class="bg-slate-50 px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Class
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->schoolClass->name ?? 'N/A' }}
                            </p>

                        </div>


                        <div class="px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Section
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->section->name ?? 'N/A' }}
                            </p>

                        </div>

                    </div>


                    {{-- Roll / Session --}}
                    <div class="grid grid-cols-2 border-b border-slate-200">

                        <div class="bg-slate-50 px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Roll No
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->roll_no ?? 'N/A' }}
                            </p>

                        </div>


                        <div class="px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Session
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->academicSession->name ?? 'N/A' }}
                            </p>

                        </div>

                    </div>


                    {{-- Admission --}}
                    <div class="grid grid-cols-2">

                        <div class="bg-slate-50 px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Admission No
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->admission_no ?? 'N/A' }}
                            </p>

                        </div>


                        <div class="px-3 py-2.5">

                            <p class="text-[10px] font-medium uppercase
                                      tracking-wide text-slate-500">
                                Blood Group
                            </p>

                            <p class="mt-0.5 text-xs font-bold text-slate-800">
                                {{ $student->blood_group ?? 'N/A' }}
                            </p>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                     GUARDIAN / PHONE
                ================================================== --}}
                <div class="mt-4 rounded-xl bg-blue-50 p-3">

                    <div class="flex items-start gap-3">

                        <div class="flex h-8 w-8 shrink-0 items-center
                                    justify-center rounded-lg bg-blue-100">

                            <svg
                                class="h-4 w-4 text-blue-600"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.129a11.042 11.042 0 005.502 5.502l1.129-2.257a1 1 0 011.21-.502l4.493 1.498A1 1 0 0121 15.72V19a2 2 0 01-2 2h-1C9.611 21 3 14.389 3 6V5z"
                                />
                            </svg>

                        </div>


                        <div class="min-w-0">

                            <p class="text-[10px] font-semibold uppercase
                                      tracking-wide text-blue-500">
                                Guardian Contact
                            </p>

                            <p class="mt-0.5 truncate text-xs font-bold
                                      text-slate-800">

                                {{ $student->guardian_name ?? 'N/A' }}

                            </p>

                            @if(!empty($student->guardian_phone))

                                <p class="mt-0.5 text-xs text-slate-600">
                                    {{ $student->guardian_phone }}
                                </p>

                            @endif

                        </div>

                    </div>

                </div>

            </div>


            {{-- =====================================================
                 CARD FOOTER
            ====================================================== --}}
            <div class="bg-gradient-to-r from-blue-700 to-indigo-700 px-5 py-3">

                <div class="flex items-center justify-between">

                    <div>

                        <p class="text-[9px] uppercase tracking-wider
                                  text-blue-200">
                            Valid Session
                        </p>

                        <p class="mt-0.5 text-xs font-bold text-white">
                            {{ $student->academicSession->name ?? 'N/A' }}
                        </p>

                    </div>


                    {{-- Signature --}}
                    <div class="text-center">

                        <div class="mx-auto mb-1 h-px w-20 bg-white/70"></div>

                        <p class="text-[9px] text-blue-100">
                            Authorized Signature
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- Print Note --}}
    <div class="rounded-xl border border-blue-100 bg-blue-50 p-4
                text-sm text-blue-700 print:hidden">

        <strong>Print:</strong>
        Click the <strong>Print ID Card</strong> button above to print
        this student's ID card.

    </div>

</div>


{{-- =============================================================
     PRINT CSS
============================================================= --}}
<style>

    @media print {

        @page {
            size: auto;
            margin: 0;
        }

        html,
        body {
            margin: 0 !important;
            padding: 0 !important;
            background: #ffffff !important;
        }

        body * {
            visibility: hidden;
        }

        #student-id-card,
        #student-id-card * {
            visibility: visible;
        }

        #student-id-card {
            position: absolute;
            left: 50%;
            top: 20mm;
            transform: translateX(-50%);
            width: 350px !important;
            box-shadow: none !important;
            border: 1px solid #e2e8f0;
        }

    }

</style>

@endsection