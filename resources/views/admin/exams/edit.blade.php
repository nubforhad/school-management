@extends('admin.layouts.app')

@section('title', 'Edit Exam')

@section('page-title', 'Edit Exam')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row sm:items-center
                    sm:justify-between gap-4">

            <div>

                <div class="flex items-center gap-2 text-sm text-slate-500 mb-2">

                    <a href="{{ route('admin.exams.index') }}"
                       class="hover:text-blue-600 transition">
                        Exams
                    </a>

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              stroke-width="2"
                              d="M9 5l7 7-7 7"/>
                    </svg>

                    <span class="text-slate-600">
                        Edit Exam
                    </span>

                </div>

                <h1 class="text-2xl font-bold text-slate-800">
                    Edit Exam
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Update the information of this examination.
                </p>

            </div>


            <a href="{{ route('admin.exams.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      border border-slate-300
                      bg-white hover:bg-slate-50
                      text-slate-700 text-sm font-semibold
                      transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-4 h-4"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M10 19l-7-7m0 0l7-7m-7 7h18"/>

                </svg>

                Back to Exams

            </a>

        </div>

    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))

        <div class="mb-6 flex items-center gap-3 p-4 rounded-xl
                    bg-green-50 border border-green-200
                    text-green-700">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5 flex-shrink-0"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor"
                 stroke-width="2">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      d="M5 13l4 4L19 7"/>

            </svg>

            <span class="text-sm font-medium">
                {{ session('success') }}
            </span>

        </div>

    @endif


    {{-- =========================================================
        VALIDATION ERRORS
    ========================================================== --}}
    @if($errors->any())

        <div class="mb-6 p-4 rounded-xl
                    bg-red-50 border border-red-200">

            <div class="flex items-center gap-2
                        text-red-700 font-semibold text-sm mb-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">

                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 9v2m0 4h.01"/>

                    <circle cx="12"
                            cy="12"
                            r="9"
                            stroke-width="2"/>

                </svg>

                Please fix the following errors.

            </div>

            <ul class="list-disc list-inside
                       text-sm text-red-600 space-y-1">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- =========================================================
        FORM
    ========================================================== --}}
    <form method="POST"
          action="{{ route('admin.exams.update', $exam) }}">

        @csrf
        @method('PUT')


        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">


            {{-- =================================================
                MAIN INFORMATION
            ================================================== --}}
            <div class="lg:col-span-2">

                <div class="bg-white border border-slate-200
                            rounded-xl shadow-sm overflow-hidden">


                    {{-- Card Header --}}
                    <div class="px-5 py-4
                                border-b border-slate-200
                                bg-slate-50">

                        <div class="flex items-center gap-3">

                            <div class="w-10 h-10 rounded-lg
                                        bg-blue-50
                                        flex items-center justify-center">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-blue-600"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">

                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 6.253v13m0-13C10.832 5.477
                                             9.246 5 7.5 5S4.168 5.477
                                             3 6.253v13C4.168 18.477
                                             5.754 18 7.5 18s3.332.477
                                             4.5 1.253m0-13C13.168 5.477
                                             14.754 5 16.5 5c1.746 0
                                             3.332.477 4.5 1.253v13C19.832
                                             18.477 18.246 18 16.5 18
                                             c-1.746 0-3.332.477-4.5
                                             1.253"/>

                                </svg>

                            </div>

                            <div>

                                <h2 class="text-base font-semibold
                                           text-slate-800">
                                    Exam Information
                                </h2>

                                <p class="text-xs text-slate-500 mt-0.5">
                                    Update the examination information.
                                </p>

                            </div>

                        </div>

                    </div>


                    {{-- Card Body --}}
                    <div class="p-5 space-y-5">


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
                                    class="w-full px-3 py-2.5 rounded-lg
                                           border border-slate-300
                                           bg-white
                                           text-sm text-slate-700
                                           focus:border-blue-500
                                           focus:ring-2 focus:ring-blue-100
                                           outline-none">

                                <option value="">
                                    Select Academic Session
                                </option>

                                @foreach($academicSessions as $session)

                                    <option value="{{ $session->id }}"
                                        {{ old(
                                            'academic_session_id',
                                            $exam->academic_session_id
                                        ) == $session->id ? 'selected' : '' }}>

                                        {{ $session->name
                                            ?? $session->title
                                            ?? 'Session '.$session->id }}

                                    </option>

                                @endforeach

                            </select>


                            @error('academic_session_id')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>


                        {{-- Exam Name + Code --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


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
                                       value="{{ old('name', $exam->name) }}"
                                       required
                                       placeholder="e.g. First Terminal Examination"
                                       class="w-full px-3 py-2.5 rounded-lg
                                              border border-slate-300
                                              text-sm text-slate-700
                                              placeholder-slate-400
                                              focus:border-blue-500
                                              focus:ring-2 focus:ring-blue-100
                                              outline-none">


                                @error('name')

                                    <p class="mt-1.5 text-xs text-red-600">
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
                                    <span class="text-slate-400">
                                        (Optional)
                                    </span>

                                </label>


                                <input type="text"
                                       name="code"
                                       id="code"
                                       value="{{ old('code', $exam->code) }}"
                                       placeholder="e.g. FTE-2026"
                                       class="w-full px-3 py-2.5 rounded-lg
                                              border border-slate-300
                                              text-sm text-slate-700
                                              placeholder-slate-400
                                              uppercase
                                              focus:border-blue-500
                                              focus:ring-2 focus:ring-blue-100
                                              outline-none">


                                @error('code')

                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- Dates --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">


                            {{-- Start Date --}}
                            <div>

                                <label for="start_date"
                                       class="block text-sm font-medium
                                              text-slate-700 mb-1.5">

                                    Start Date
                                    <span class="text-slate-400">
                                        (Optional)
                                    </span>

                                </label>


                                <input type="date"
                                       name="start_date"
                                       id="start_date"
                                       value="{{ old(
                                           'start_date',
                                           optional($exam->start_date)->format('Y-m-d')
                                       ) }}"
                                       class="w-full px-3 py-2.5 rounded-lg
                                              border border-slate-300
                                              text-sm text-slate-700
                                              focus:border-blue-500
                                              focus:ring-2 focus:ring-blue-100
                                              outline-none">


                                @error('start_date')

                                    <p class="mt-1.5 text-xs text-red-600">
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
                                    <span class="text-slate-400">
                                        (Optional)
                                    </span>

                                </label>


                                <input type="date"
                                       name="end_date"
                                       id="end_date"
                                       value="{{ old(
                                           'end_date',
                                           optional($exam->end_date)->format('Y-m-d')
                                       ) }}"
                                       class="w-full px-3 py-2.5 rounded-lg
                                              border border-slate-300
                                              text-sm text-slate-700
                                              focus:border-blue-500
                                              focus:ring-2 focus:ring-blue-100
                                              outline-none">


                                @error('end_date')

                                    <p class="mt-1.5 text-xs text-red-600">
                                        {{ $message }}
                                    </p>

                                @enderror

                            </div>

                        </div>


                        {{-- Description --}}
                        <div>

                            <label for="description"
                                   class="block text-sm font-medium
                                          text-slate-700 mb-1.5">

                                Description
                                <span class="text-slate-400">
                                    (Optional)
                                </span>

                            </label>


                            <textarea name="description"
                                      id="description"
                                      rows="5"
                                      placeholder="Write exam description..."
                                      class="w-full px-3 py-2.5 rounded-lg
                                             border border-slate-300
                                             text-sm text-slate-700
                                             placeholder-slate-400
                                             focus:border-blue-500
                                             focus:ring-2 focus:ring-blue-100
                                             outline-none resize-y">{{ old(
                                                 'description',
                                                 $exam->description
                                             ) }}</textarea>


                            @error('description')

                                <p class="mt-1.5 text-xs text-red-600">
                                    {{ $message }}
                                </p>

                            @enderror

                        </div>

                    </div>

                </div>

            </div>


            {{-- =================================================
                SETTINGS
            ================================================== --}}
            <div class="lg:col-span-1">


                <div class="bg-white border border-slate-200
                            rounded-xl shadow-sm overflow-hidden">


                    {{-- Header --}}
                    <div class="px-5 py-4
                                border-b border-slate-200
                                bg-slate-50">

                        <h2 class="text-base font-semibold
                                   text-slate-800">

                            Exam Settings

                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Configure exam status.
                        </p>

                    </div>


                    <div class="p-5">


                        {{-- Status --}}
                        <div class="flex items-start justify-between gap-4">


                            <div>

                                <label for="status"
                                       class="text-sm font-semibold
                                              text-slate-700">

                                    Active Status

                                </label>

                                <p class="text-xs text-slate-500 mt-1">
                                    Enable this exam for use in the system.
                                </p>

                            </div>


                            <label class="relative inline-flex items-center
                                          cursor-pointer flex-shrink-0">

                                <input type="checkbox"
                                       name="status"
                                       id="status"
                                       value="1"
                                       class="sr-only peer"
                                       {{ old('status', $exam->status) ? 'checked' : '' }}>


                                <div class="w-11 h-6
                                            bg-slate-300
                                            peer-focus:outline-none
                                            peer-focus:ring-4
                                            peer-focus:ring-blue-100
                                            rounded-full peer
                                            peer-checked:bg-blue-600
                                            after:content-['']
                                            after:absolute
                                            after:top-[2px]
                                            after:left-[2px]
                                            after:bg-white
                                            after:border-slate-300
                                            after:border
                                            after:rounded-full
                                            after:h-5 after:w-5
                                            after:transition-all
                                            peer-checked:after:translate-x-full
                                            peer-checked:after:border-white">
                                </div>

                            </label>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    CURRENT EXAM INFO
                ================================================== --}}
                <div class="mt-6 bg-slate-50
                            border border-slate-200
                            rounded-xl p-5">

                    <h3 class="text-sm font-semibold text-slate-800 mb-3">
                        Current Information
                    </h3>


                    <div class="space-y-3 text-sm">

                        <div class="flex items-center justify-between gap-3">

                            <span class="text-slate-500">
                                Exam ID
                            </span>

                            <span class="font-medium text-slate-700">
                                #{{ $exam->id }}
                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-3">

                            <span class="text-slate-500">
                                Created
                            </span>

                            <span class="font-medium text-slate-700">

                                {{ optional($exam->created_at)->format('d M Y') }}

                            </span>

                        </div>


                        <div class="flex items-center justify-between gap-3">

                            <span class="text-slate-500">
                                Last Updated
                            </span>

                            <span class="font-medium text-slate-700">

                                {{ optional($exam->updated_at)->format('d M Y') }}

                            </span>

                        </div>

                    </div>

                </div>


                {{-- =================================================
                    INFORMATION BOX
                ================================================== --}}
                <div class="mt-6 p-4 rounded-xl
                            bg-blue-50 border border-blue-100">

                    <div class="flex items-start gap-3">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-5 h-5 text-blue-600
                                    flex-shrink-0 mt-0.5"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">

                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M13 16h-1v-4h-1m1-4h.01
                                     M12 2a10 10 0 100 20
                                     10 10 0 000-20z"/>

                        </svg>


                        <div>

                            <h3 class="text-sm font-semibold text-blue-800">
                                Exam Schedule
                            </h3>

                            <p class="text-xs text-blue-700
                                      leading-5 mt-1">

                                After updating the exam, you can manage
                                subjects and create the examination schedule.

                            </p>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- =========================================================
            FORM ACTIONS
        ========================================================== --}}
        <div class="mt-6 bg-white border border-slate-200
                    rounded-xl shadow-sm">

            <div class="px-5 py-4
                        flex flex-col-reverse sm:flex-row
                        sm:items-center sm:justify-end gap-3">


                <a href="{{ route('admin.exams.index') }}"
                   class="inline-flex items-center justify-center
                          px-5 py-2.5 rounded-lg
                          border border-slate-300
                          bg-white hover:bg-slate-50
                          text-slate-700 text-sm font-semibold
                          transition">

                    Cancel

                </a>


                <button type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 px-5 py-2.5 rounded-lg
                               bg-blue-600 hover:bg-blue-700
                               text-white text-sm font-semibold
                               shadow-sm transition">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-4 h-4"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">

                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M5 13l4 4L19 7"/>

                    </svg>

                    Update Exam

                </button>

            </div>

        </div>

    </form>

</div>

@endsection 
