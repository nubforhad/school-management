@extends('admin.layouts.app')

@section('title', 'Edit Exam')

@section('page-title', 'Edit Exam')

@section('content')

<div class="max-w-7xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-5 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>
                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Edit Exam
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Update examination information
                </p>
            </div>

            <a href="{{ route('admin.exams.index') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg border border-slate-300
                      bg-white px-4 py-2.5
                      text-sm font-medium text-slate-700
                      hover:bg-slate-50 transition">

                <i class="bi bi-arrow-left"></i>
                Back to Exams

            </a>

        </div>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-xl border border-red-200
                    bg-red-50 px-4 py-3 text-sm text-red-700">

            <div class="flex items-start gap-2">

                <i class="bi bi-exclamation-triangle-fill mt-0.5"></i>

                <div>

                    <p class="font-semibold mb-1">
                        Please fix the following errors:
                    </p>

                    <ul class="list-disc list-inside space-y-1">

                        @foreach($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Form --}}
    <div class="bg-white rounded-xl
                border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Header --}}
        <div class="border-b border-slate-200
                    bg-slate-50
                    px-4 sm:px-6 py-4">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-blue-50 text-blue-600">

                    <i class="bi bi-pencil-square text-lg"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Exam Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Update the information below
                    </p>

                </div>

            </div>

        </div>


        <form method="POST"
              action="{{ route('admin.exams.update', $exam->id) }}">

            @csrf
            @method('PUT')


            <div class="p-4 sm:p-6">


                {{-- =====================================================
                    ACADEMIC INFORMATION
                ====================================================== --}}

                <div class="mb-7">

                    <div class="flex items-center gap-2 mb-4">

                        <div class="h-7 w-1 rounded-full bg-blue-600"></div>

                        <h3 class="text-sm font-semibold text-slate-800">
                            Academic Information
                        </h3>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        {{-- Branch --}}
                        <div>

                            <label for="branch_id"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Branch
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="branch_id"
                                    id="branch_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-800
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    Select Branch
                                </option>

                                @foreach($branches as $branch)

                                    <option value="{{ $branch->id }}"
                                        {{ old(
                                            'branch_id',
                                            $exam->branch_id
                                        ) == $branch->id
                                            ? 'selected'
                                            : '' }}>

                                        {{ $branch->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('branch_id')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Academic Session --}}
                        <div>

                            <label for="academic_session_id"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Academic Session
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="academic_session_id"
                                    id="academic_session_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-800
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    Select Academic Session
                                </option>

                                @foreach($academicSessions as $session)

                                    <option value="{{ $session->id }}"
                                        {{ old(
                                            'academic_session_id',
                                            $exam->academic_session_id
                                        ) == $session->id
                                            ? 'selected'
                                            : '' }}>

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


                        {{-- Class --}}
                        <div>

                            <label for="school_class_id"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Class
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="school_class_id"
                                    id="school_class_id"
                                    required
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-800
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    Select Class
                                </option>

                                @foreach($classes as $class)

                                    <option value="{{ $class->id }}"
                                        {{ old(
                                            'school_class_id',
                                            $exam->school_class_id
                                        ) == $class->id
                                            ? 'selected'
                                            : '' }}>

                                        {{ $class->name }}

                                    </option>

                                @endforeach

                            </select>

                            @error('school_class_id')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Section --}}
                        <div>

                            <label for="section_id"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Section

                            </label>

                            <select name="section_id"
                                    id="section_id"
                                    class="w-full rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-800
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                <option value="">
                                    All Sections
                                </option>

                                @foreach($sections as $section)

                                    <option value="{{ $section->id }}"
                                        {{ old(
                                            'section_id',
                                            $exam->section_id
                                        ) == $section->id
                                            ? 'selected'
                                            : '' }}>

                                        {{ $section->name }}

                                    </option>

                                @endforeach

                            </select>

                            <p class="mt-1 text-xs text-slate-400">
                                Leave empty if this exam applies to all sections.
                            </p>

                            @error('section_id')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- =====================================================
                    EXAM DETAILS
                ====================================================== --}}

                <div class="mb-7">

                    <div class="flex items-center gap-2 mb-4">

                        <div class="h-7 w-1 rounded-full bg-blue-600"></div>

                        <h3 class="text-sm font-semibold text-slate-800">
                            Exam Details
                        </h3>

                    </div>


                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                        {{-- Exam Name --}}
                        <div>

                            <label for="name"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Exam Name
                                <span class="text-red-500">*</span>

                            </label>

                            <input type="text"
                                   name="name"
                                   id="name"
                                   value="{{ old(
                                       'name',
                                       $exam->name
                                   ) }}"
                                   required
                                   maxlength="255"
                                   placeholder="e.g. Half Yearly Examination"
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white px-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('name')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Exam Code --}}
                        <div>

                            <label for="code"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Exam Code

                            </label>

                            <input type="text"
                                   name="code"
                                   id="code"
                                   value="{{ old(
                                       'code',
                                       $exam->code
                                   ) }}"
                                   maxlength="100"
                                   placeholder="e.g. HY-2026"
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white px-3 py-2.5
                                          text-sm text-slate-800
                                          uppercase
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('code')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Start Date --}}
                        <div>

                            <label for="start_date"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Start Date

                            </label>

                            <input type="date"
                                   name="start_date"
                                   id="start_date"
                                   value="{{ old(
                                       'start_date',
                                       $exam->start_date
                                           ? \Carbon\Carbon::parse(
                                               $exam->start_date
                                           )->format('Y-m-d')
                                           : ''
                                   ) }}"
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white px-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('start_date')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- End Date --}}
                        <div>

                            <label for="end_date"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                End Date

                            </label>

                            <input type="date"
                                   name="end_date"
                                   id="end_date"
                                   value="{{ old(
                                       'end_date',
                                       $exam->end_date
                                           ? \Carbon\Carbon::parse(
                                               $exam->end_date
                                           )->format('Y-m-d')
                                           : ''
                                   ) }}"
                                   class="w-full rounded-lg
                                          border border-slate-300
                                          bg-white px-3 py-2.5
                                          text-sm text-slate-800
                                          outline-none
                                          focus:border-blue-500
                                          focus:ring-2
                                          focus:ring-blue-100">

                            @error('end_date')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Status --}}
                        <div class="md:col-span-2">

                            <label for="status"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Status
                                <span class="text-red-500">*</span>

                            </label>

                            <select name="status"
                                    id="status"
                                    required
                                    class="w-full md:max-w-md
                                           rounded-lg
                                           border border-slate-300
                                           bg-white px-3 py-2.5
                                           text-sm text-slate-800
                                           outline-none
                                           focus:border-blue-500
                                           focus:ring-2
                                           focus:ring-blue-100">

                                @foreach([
                                    'draft' => 'Draft',
                                    'published' => 'Published',
                                    'completed' => 'Completed'
                                ] as $value => $label)

                                    <option value="{{ $value }}"
                                        {{ old(
                                            'status',
                                            $exam->status
                                        ) === $value
                                            ? 'selected'
                                            : '' }}>

                                        {{ $label }}

                                    </option>

                                @endforeach

                            </select>

                            @error('status')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Description --}}
                        <div class="md:col-span-2">

                            <label for="description"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Description

                            </label>

                            <textarea name="description"
                                      id="description"
                                      rows="4"
                                      placeholder="Optional exam description..."
                                      class="w-full rounded-lg
                                             border border-slate-300
                                             bg-white px-3 py-2.5
                                             text-sm text-slate-800
                                             outline-none resize-y
                                             focus:border-blue-500
                                             focus:ring-2
                                             focus:ring-blue-100">{{ old(
                                                'description',
                                                $exam->description
                                            ) }}</textarea>

                            @error('description')

                                <p class="mt-1 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>


                {{-- Actions --}}
                <div class="flex flex-col-reverse
                            sm:flex-row sm:justify-end
                            gap-2
                            border-t border-slate-200
                            pt-5">

                    <a href="{{ route('admin.exams.index') }}"
                       class="inline-flex items-center
                              justify-center gap-2
                              rounded-lg
                              border border-slate-300
                              bg-white px-5 py-2.5
                              text-sm font-medium
                              text-slate-700
                              hover:bg-slate-50 transition">

                        <i class="bi bi-x-lg"></i>
                        Cancel

                    </a>


                    <button type="submit"
                            class="inline-flex items-center
                                   justify-center gap-2
                                   rounded-lg
                                   bg-blue-600
                                   px-5 py-2.5
                                   text-sm font-semibold
                                   text-white
                                   hover:bg-blue-700 transition">

                        <i class="bi bi-check-lg"></i>
                        Update Exam

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

@endsection