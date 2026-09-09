@extends('admin.layouts.app')

@section('title', 'Routine Details')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Routine Details
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View class routine information
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a href="{{ route('admin.class-routines.index') }}"
               class="px-4 py-2 rounded-lg bg-slate-100 text-slate-700
                      hover:bg-slate-200 text-sm font-medium">
                ← Back
            </a>

            <a href="{{ route('admin.class-routines.edit', $classRoutine) }}"
               class="px-4 py-2 rounded-lg bg-blue-600 text-white
                      hover:bg-blue-700 text-sm font-medium">
                Edit
            </a>

        </div>

    </div>


    {{-- Main Card --}}
    <div class="bg-white border border-slate-200 rounded-2xl shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-6 py-5 border-b border-slate-200 bg-slate-50">

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3">

                <div>
                    <h2 class="text-lg font-semibold text-slate-800">
                        {{ $classRoutine->schoolClass?->name ?? 'N/A' }}
                        -
                        {{ $classRoutine->section?->name ?? 'N/A' }}
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        {{ $classRoutine->subject?->name ?? 'N/A' }}
                    </p>
                </div>

                @if($classRoutine->status)
                    <span class="inline-flex w-fit items-center px-3 py-1
                                 rounded-full text-xs font-semibold
                                 bg-green-100 text-green-700">
                        Active
                    </span>
                @else
                    <span class="inline-flex w-fit items-center px-3 py-1
                                 rounded-full text-xs font-semibold
                                 bg-red-100 text-red-700">
                        Inactive
                    </span>
                @endif

            </div>

        </div>


        {{-- Routine Information --}}
        <div class="p-6">

            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-6">


                {{-- Branch --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Branch
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->branch?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Academic Session --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Academic Session
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->academicSession?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Class --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Class
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->schoolClass?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Section --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Section
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->section?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Subject --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Subject
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->subject?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Teacher --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Teacher
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->teacher?->name ?? 'N/A' }}
                    </p>
                </div>


                {{-- Day --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Day
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->day }}
                    </p>
                </div>

                {{-- Room --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Room / Classroom
                    </p>
                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ $classRoutine->room ?: 'Not Assigned' }}
                    </p>
                </div>


                {{-- Start Time --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Start Time
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ \Carbon\Carbon::parse($classRoutine->start_time)->format('h:i A') }}
                    </p>
                </div>


                {{-- End Time --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        End Time
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        {{ \Carbon\Carbon::parse($classRoutine->end_time)->format('h:i A') }}
                    </p>
                </div>


                {{-- Duration --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Duration
                    </p>

                    <p class="mt-1 text-sm font-semibold text-slate-800">
                        @php
                            $start = \Carbon\Carbon::parse($classRoutine->start_time);
                            $end = \Carbon\Carbon::parse($classRoutine->end_time);
                            $minutes = $start->diffInMinutes($end);
                            $hours = intdiv($minutes, 60);
                            $remainingMinutes = $minutes % 60;
                        @endphp

                        @if($hours > 0)
                            {{ $hours }} hour{{ $hours > 1 ? 's' : '' }}
                        @endif

                        @if($remainingMinutes > 0)
                            {{ $remainingMinutes }} min
                        @endif
                    </p>
                </div>


                {{-- Status --}}
                <div>
                    <p class="text-xs font-medium text-slate-500 uppercase tracking-wide">
                        Status
                    </p>

                    <div class="mt-1">

                        @if($classRoutine->status)
                            <span class="inline-flex items-center px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-green-100 text-green-700">
                                Active
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1
                                         rounded-full text-xs font-semibold
                                         bg-red-100 text-red-700">
                                Inactive
                            </span>
                        @endif

                    </div>
                </div>


            </div>

        </div>


        {{-- Footer --}}
        <div class="px-6 py-4 bg-slate-50 border-t border-slate-200">

            <div class="flex flex-col sm:flex-row sm:items-center
                        sm:justify-between gap-3">
                <div class="text-xs text-slate-500">
                    Created:
                    {{ $classRoutine->created_at?->format('d M Y, h:i A') }}

                    @if($classRoutine->updated_at && $classRoutine->updated_at != $classRoutine->created_at)
                        <span class="mx-1">•</span>

                        Updated:
                        {{ $classRoutine->updated_at->format('d M Y, h:i A') }}
                    @endif
                </div>
                {{-- Delete --}}
                <form action="{{ route('admin.class-routines.destroy', $classRoutine) }}"
                      method="POST"
                      onsubmit="return confirm('Are you sure you want to delete this routine?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            class="px-4 py-2 rounded-lg bg-red-50
                                   text-red-700 hover:bg-red-100
                                   text-sm font-medium">
                        Delete Routine
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection