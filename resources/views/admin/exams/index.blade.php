@extends('admin.layouts.app')

@section('title', 'Exams')

@section('page-title', 'Exams')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- =========================================================
        HEADER
    ========================================================== --}}
    <div class="mb-6">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">

            <div>
                <h1 class="text-2xl font-bold text-slate-800">
                    Exams
                </h1>

                <p class="mt-1 text-sm text-slate-500">
                    Manage your examinations and exam information.
                </p>
            </div>

            <a href="{{ route('admin.exams.create') }}"
               class="inline-flex items-center justify-center gap-2 px-4 py-2.5
                      bg-blue-600 hover:bg-blue-700 text-white text-sm font-semibold
                      rounded-lg shadow-sm transition">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 4v16m8-8H4"/>
                </svg>

                Add Exam
            </a>

        </div>
    </div>


    {{-- =========================================================
        SUCCESS MESSAGE
    ========================================================== --}}
    @if(session('success'))
        <div class="mb-5 flex items-center gap-3 p-4 rounded-lg
                    bg-green-50 border border-green-200 text-green-700">

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
        <div class="mb-5 p-4 rounded-lg bg-red-50 border border-red-200">

            <div class="flex items-center gap-2 text-red-700 font-semibold text-sm mb-2">

                <svg xmlns="http://www.w3.org/2000/svg"
                     class="w-5 h-5"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke="currentColor"
                     stroke-width="2">
                    <path stroke-linecap="round"
                          stroke-linejoin="round"
                          d="M12 9v2m0 4h.01"/>
                </svg>

                Please fix the following errors:
            </div>

            <ul class="list-disc list-inside text-sm text-red-600 space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

        </div>
    @endif


    {{-- =========================================================
        FILTER CARD
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm mb-6">

        <div class="p-4 sm:p-5 border-b border-slate-200 bg-slate-50 rounded-t-xl">

            <div class="flex items-center gap-2">

                <div class="w-9 h-9 rounded-lg bg-blue-50
                            flex items-center justify-center">

                    <svg xmlns="http://www.w3.org/2000/svg"
                         class="w-5 h-5 text-blue-600"
                         fill="none"
                         viewBox="0 0 24 24"
                         stroke="currentColor"
                         stroke-width="2">
                        <path stroke-linecap="round"
                              stroke-linejoin="round"
                              d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-.293.707L15 11.414V19a1 1 0 01-.553.894l-4 2A1 1 0 019 21v-9.586L3.293 6.707A1 1 0 013 6V4z"/>
                    </svg>

                </div>

                <div>
                    <h2 class="text-sm font-semibold text-slate-800">
                        Filter Exams
                    </h2>

                    <p class="text-xs text-slate-500">
                        Search and filter examination records.
                    </p>
                </div>

            </div>

        </div>


        <form method="GET"
              action="{{ route('admin.exams.index') }}"
              class="p-4 sm:p-5">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Search --}}
                <div>
                    <label for="search"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Search
                    </label>

                    <div class="relative">

                        <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="w-4 h-4 text-slate-400"
                                 fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor"
                                 stroke-width="2">
                                <path stroke-linecap="round"
                                      stroke-linejoin="round"
                                      d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </span>

                        <input type="text"
                               id="search"
                               name="search"
                               value="{{ request('search') }}"
                               placeholder="Exam name or code..."
                               class="w-full pl-9 pr-3 py-2.5 rounded-lg
                                      border border-slate-300
                                      focus:border-blue-500 focus:ring-2
                                      focus:ring-blue-100 outline-none
                                      text-sm text-slate-700">

                    </div>
                </div>


                {{-- Academic Session --}}
                <div>
                    <label for="academic_session_id"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Academic Session
                    </label>

                    <select name="academic_session_id"
                            id="academic_session_id"
                            class="w-full px-3 py-2.5 rounded-lg
                                   border border-slate-300
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none
                                   text-sm text-slate-700">

                        <option value="">
                            All Sessions
                        </option>

                        @foreach($academicSessions as $session)
                            <option value="{{ $session->id }}"
                                {{ request('academic_session_id') == $session->id ? 'selected' : '' }}>

                                {{ $session->name ?? $session->title ?? 'Session '.$session->id }}

                            </option>
                        @endforeach

                    </select>
                </div>


                {{-- Status --}}
                <div>
                    <label for="status"
                           class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <select name="status"
                            id="status"
                            class="w-full px-3 py-2.5 rounded-lg
                                   border border-slate-300
                                   focus:border-blue-500 focus:ring-2
                                   focus:ring-blue-100 outline-none
                                   text-sm text-slate-700">

                        <option value="">
                            All Status
                        </option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>
                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="flex-1 inline-flex items-center justify-center
                                   gap-2 px-4 py-2.5 rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-semibold
                                   transition">

                        <svg xmlns="http://www.w3.org/2000/svg"
                             class="w-4 h-4"
                             fill="none"
                             viewBox="0 0 24 24"
                             stroke="currentColor"
                             stroke-width="2">
                            <path stroke-linecap="round"
                                  stroke-linejoin="round"
                                  d="M21 21l-4.35-4.35m1.35-5.65a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>

                        Filter
                    </button>

                    <a href="{{ route('admin.exams.index') }}"
                       class="inline-flex items-center justify-center
                              px-4 py-2.5 rounded-lg
                              border border-slate-300
                              bg-white hover:bg-slate-50
                              text-slate-700 text-sm font-medium
                              transition">

                        Reset
                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- =========================================================
        EXAM TABLE
    ========================================================== --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        {{-- Table Header --}}
        <div class="px-4 sm:px-5 py-4 border-b border-slate-200
                    bg-slate-50">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-2">

                <div>
                    <h2 class="text-base font-semibold text-slate-800">
                        Exam List
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Total {{ $exams->total() }} examination{{ $exams->total() != 1 ? 's' : '' }}
                    </p>
                </div>

            </div>

        </div>


        {{-- Desktop Table --}}
        <div class="hidden md:block overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Exam
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Academic Session
                        </th>

                        <th class="px-5 py-3 text-left font-semibold text-slate-600">
                            Exam Period
                        </th>

                        <th class="px-5 py-3 text-center font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($exams as $exam)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Number --}}
                            <td class="px-5 py-4 text-slate-500">
                                {{ $exams->firstItem() + $loop->index }}
                            </td>


                            {{-- Exam --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    <div class="w-10 h-10 rounded-lg bg-blue-50
                                                flex items-center justify-center
                                                flex-shrink-0">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-5 h-5 text-blue-600"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>

                                        </svg>

                                    </div>

                                    <div>

                                        <a href="{{ route('admin.exams.show', $exam) }}"
                                           class="font-semibold text-slate-800
                                                  hover:text-blue-600 transition">

                                            {{ $exam->name }}

                                        </a>

                                        @if($exam->code)
                                            <p class="text-xs text-slate-500 mt-0.5">
                                                Code: {{ $exam->code }}
                                            </p>
                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Academic Session --}}
                            <td class="px-5 py-4 text-slate-600">

                                {{ $exam->academicSession->name
                                    ?? $exam->academicSession->title
                                    ?? '-' }}

                            </td>


                            {{-- Period --}}
                            <td class="px-5 py-4">

                                @if($exam->start_date || $exam->end_date)

                                    <div class="text-slate-700">

                                        @if($exam->start_date)
                                            {{ $exam->start_date->format('d M Y') }}
                                        @else
                                            -
                                        @endif

                                        <span class="text-slate-400 mx-1">
                                            →
                                        </span>

                                        @if($exam->end_date)
                                            {{ $exam->end_date->format('d M Y') }}
                                        @else
                                            -
                                        @endif

                                    </div>

                                @else
                                    <span class="text-slate-400">
                                        Not set
                                    </span>
                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @if($exam->status)

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-green-50 text-green-700
                                                 border border-green-200">

                                        <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center gap-1.5
                                                 px-2.5 py-1 rounded-full
                                                 text-xs font-semibold
                                                 bg-red-50 text-red-700
                                                 border border-red-200">

                                        <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center justify-end gap-2">

                                    {{-- Schedule --}}
                                    <a href="#"
                                       title="Exam Schedule"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-blue-50 text-blue-600
                                              hover:bg-blue-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>

                                        </svg>

                                    </a>


                                    {{-- View --}}
                                    <a href="{{ route('admin.exams.show', $exam) }}"
                                       title="View"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-slate-100 text-slate-600
                                              hover:bg-slate-200 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('admin.exams.edit', $exam) }}"
                                       title="Edit"
                                       class="inline-flex items-center justify-center
                                              w-9 h-9 rounded-lg
                                              bg-amber-50 text-amber-600
                                              hover:bg-amber-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route('admin.exams.destroy', $exam) }}"
                                          onsubmit="return confirm('Are you sure you want to delete this exam?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex items-center justify-center
                                                       w-9 h-9 rounded-lg
                                                       bg-red-50 text-red-600
                                                       hover:bg-red-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor"
                                                 stroke-width="2">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 011-1h4a1 1 0 011 1v3m-9 0h14"/>

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="6"
                                class="px-5 py-12 text-center">

                                <div class="flex flex-col items-center">

                                    <div class="w-14 h-14 rounded-full
                                                bg-slate-100
                                                flex items-center justify-center mb-3">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-7 h-7 text-slate-400"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>

                                        </svg>

                                    </div>

                                    <h3 class="text-sm font-semibold text-slate-700">
                                        No Exams Found
                                    </h3>

                                    <p class="text-sm text-slate-500 mt-1">
                                        Create your first exam to get started.
                                    </p>

                                    <a href="{{ route('admin.exams.create') }}"
                                       class="mt-4 inline-flex items-center gap-2
                                              px-4 py-2 rounded-lg
                                              bg-blue-600 hover:bg-blue-700
                                              text-white text-sm font-semibold">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor"
                                             stroke-width="2">
                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  d="M12 4v16m8-8H4"/>
                                        </svg>

                                        Add Exam

                                    </a>

                                </div>

                            </td>
                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- =====================================================
            MOBILE CARDS
        ====================================================== --}}
        <div class="md:hidden divide-y divide-slate-100">

            @forelse($exams as $exam)

                <div class="p-4">

                    <div class="flex items-start justify-between gap-3">

                        <div class="flex items-start gap-3 min-w-0">

                            <div class="w-10 h-10 rounded-lg bg-blue-50
                                        flex items-center justify-center
                                        flex-shrink-0">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     class="w-5 h-5 text-blue-600"
                                     fill="none"
                                     viewBox="0 0 24 24"
                                     stroke="currentColor"
                                     stroke-width="2">
                                    <path stroke-linecap="round"
                                          stroke-linejoin="round"
                                          d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332-.477 4.5-1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                </svg>

                            </div>

                            <div class="min-w-0">

                                <a href="{{ route('admin.exams.show', $exam) }}"
                                   class="font-semibold text-slate-800
                                          hover:text-blue-600">

                                    {{ $exam->name }}

                                </a>

                                @if($exam->code)
                                    <p class="text-xs text-slate-500 mt-0.5">
                                        Code: {{ $exam->code }}
                                    </p>
                                @endif

                            </div>

                        </div>


                        @if($exam->status)

                            <span class="flex-shrink-0 px-2 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-green-50 text-green-700
                                         border border-green-200">
                                Active
                            </span>

                        @else

                            <span class="flex-shrink-0 px-2 py-1 rounded-full
                                         text-xs font-semibold
                                         bg-red-50 text-red-700
                                         border border-red-200">
                                Inactive
                            </span>

                        @endif

                    </div>


                    <div class="mt-4 grid grid-cols-2 gap-3 text-sm">

                        <div>
                            <p class="text-xs text-slate-400">
                                Academic Session
                            </p>

                            <p class="text-slate-700 mt-0.5">
                                {{ $exam->academicSession->name
                                    ?? $exam->academicSession->title
                                    ?? '-' }}
                            </p>
                        </div>


                        <div>
                            <p class="text-xs text-slate-400">
                                Exam Period
                            </p>

                            <p class="text-slate-700 mt-0.5">

                                @if($exam->start_date)
                                    {{ $exam->start_date->format('d M Y') }}
                                @else
                                    -
                                @endif

                                @if($exam->end_date)
                                    → {{ $exam->end_date->format('d M Y') }}
                                @endif

                            </p>
                        </div>

                    </div>


                    <div class="mt-4 flex items-center justify-end gap-2">

                        <a href="#"
                           class="inline-flex items-center gap-1.5
                                  px-3 py-2 rounded-lg
                                  bg-blue-50 text-blue-600
                                  hover:bg-blue-100
                                  text-xs font-medium">

                            Schedule
                        </a>

                        <a href="{{ route('admin.exams.show', $exam) }}"
                           class="inline-flex items-center gap-1.5
                                  px-3 py-2 rounded-lg
                                  bg-slate-100 text-slate-600
                                  hover:bg-slate-200
                                  text-xs font-medium">

                            View
                        </a>

                        <a href="{{ route('admin.exams.edit', $exam) }}"
                           class="inline-flex items-center gap-1.5
                                  px-3 py-2 rounded-lg
                                  bg-amber-50 text-amber-600
                                  hover:bg-amber-100
                                  text-xs font-medium">

                            Edit
                        </a>

                        <form method="POST"
                              action="{{ route('admin.exams.destroy', $exam) }}"
                              onsubmit="return confirm('Are you sure you want to delete this exam?');">

                            @csrf
                            @method('DELETE')

                            <button type="submit"
                                    class="inline-flex items-center gap-1.5
                                           px-3 py-2 rounded-lg
                                           bg-red-50 text-red-600
                                           hover:bg-red-100
                                           text-xs font-medium">

                                Delete

                            </button>

                        </form>

                    </div>

                </div>

            @empty

                <div class="p-10 text-center">

                    <p class="text-sm text-slate-500">
                        No exams found.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}
        @if($exams->hasPages())

            <div class="px-4 sm:px-5 py-4 border-t border-slate-200">

                {{ $exams->links() }}

            </div>

        @endif

    </div>

</div>

@endsection