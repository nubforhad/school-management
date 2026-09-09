@extends('admin.layouts.app')

@section('title', 'Guardian Details')

@section('content')

<div class="space-y-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Guardian Details
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                View guardian information and assigned students.
            </p>
        </div>

        <div class="flex items-center gap-2">

            <a href="{{ route('admin.guardians.index') }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      bg-slate-100 hover:bg-slate-200
                      text-slate-700 rounded-lg text-sm font-medium">
                ← Back
            </a>

            <a href="{{ route('admin.guardians.edit', $guardian) }}"
               class="inline-flex items-center gap-2 px-4 py-2.5
                      bg-blue-600 hover:bg-blue-700
                      text-white rounded-lg text-sm font-medium">
                ✎ Edit
            </a>

        </div>
    </div>


    {{-- Guardian Profile --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm overflow-hidden">

        <div class="p-6">

            <div class="flex flex-col md:flex-row gap-6">

                {{-- Photo --}}
                <div class="shrink-0">

                    @if($guardian->photo)

                        <img src="{{ asset('storage/' . $guardian->photo) }}"
                             alt="{{ $guardian->name }}"
                             class="w-28 h-28 rounded-xl object-cover border border-slate-200">

                    @else

                        <div class="w-28 h-28 rounded-xl
                                    bg-blue-50 border border-blue-100
                                    flex items-center justify-center">

                            <span class="text-4xl font-bold text-blue-600">
                                {{ strtoupper(substr($guardian->name, 0, 1)) }}
                            </span>

                        </div>

                    @endif

                </div>


                {{-- Basic Info --}}
                <div class="flex-1">

                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">

                        <div>
                            <h2 class="text-xl font-bold text-slate-800">
                                {{ $guardian->name }}
                            </h2>

                            @if($guardian->occupation)
                                <p class="text-sm text-slate-500 mt-1">
                                    {{ $guardian->occupation }}
                                </p>
                            @endif
                        </div>


                        {{-- Status --}}
                        @if($guardian->status)

                            <span class="inline-flex items-center w-fit
                                         px-3 py-1 rounded-full
                                         bg-green-50 text-green-700
                                         text-xs font-semibold">
                                Active
                            </span>

                        @else

                            <span class="inline-flex items-center w-fit
                                         px-3 py-1 rounded-full
                                         bg-red-50 text-red-700
                                         text-xs font-semibold">
                                Inactive
                            </span>

                        @endif

                    </div>


                    {{-- Information Grid --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3
                                gap-5 mt-6">

                        {{-- Phone --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                Phone
                            </p>

                            <p class="text-sm font-medium text-slate-700 mt-1">
                                {{ $guardian->phone ?: '—' }}
                            </p>
                        </div>


                        {{-- Email --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                Email
                            </p>

                            <p class="text-sm font-medium text-slate-700 mt-1 break-all">
                                {{ $guardian->email ?: '—' }}
                            </p>
                        </div>


                        {{-- NID --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                NID
                            </p>

                            <p class="text-sm font-medium text-slate-700 mt-1">
                                {{ $guardian->nid ?: '—' }}
                            </p>
                        </div>


                        {{-- Occupation --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                Occupation
                            </p>

                            <p class="text-sm font-medium text-slate-700 mt-1">
                                {{ $guardian->occupation ?: '—' }}
                            </p>
                        </div>


                        {{-- Branch --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                Branch
                            </p>

                            <p class="text-sm font-medium text-slate-700 mt-1">
                                {{ $guardian->branch->name ?? '—' }}
                            </p>
                        </div>


                        {{-- Students --}}
                        <div>
                            <p class="text-xs font-medium text-slate-400 uppercase">
                                Assigned Students
                            </p>

                            <p class="text-sm font-semibold text-blue-600 mt-1">
                                {{ $guardian->students->count() }}
                            </p>
                        </div>

                    </div>

                </div>

            </div>


            {{-- Address --}}
            @if($guardian->address)

                <div class="mt-6 pt-6 border-t border-slate-100">

                    <p class="text-xs font-medium text-slate-400 uppercase">
                        Address
                    </p>

                    <p class="text-sm text-slate-700 mt-2 leading-6">
                        {{ $guardian->address }}
                    </p>

                </div>

            @endif

        </div>

    </div>


    {{-- Assigned Students --}}
    <div class="bg-white border border-slate-200 rounded-xl shadow-sm">

        <div class="px-6 py-5 border-b border-slate-200">

            <div class="flex items-center justify-between">

                <div>
                    <h2 class="text-lg font-bold text-slate-800">
                        Assigned Students
                    </h2>

                    <p class="text-sm text-slate-500 mt-1">
                        Students connected with this guardian.
                    </p>
                </div>

                <span class="px-3 py-1 rounded-full
                             bg-blue-50 text-blue-700
                             text-sm font-semibold">
                    {{ $guardian->students->count() }}
                </span>

            </div>

        </div>


        @if($guardian->students->count())

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-slate-200">

                    <thead class="bg-slate-50">

                        <tr>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                #
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Student
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Student ID
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Relationship
                            </th>

                            <th class="px-6 py-3 text-left text-xs
                                       font-semibold text-slate-500 uppercase">
                                Primary
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-slate-100">

                        @foreach($guardian->students as $index => $student)

                            <tr class="hover:bg-slate-50">

                                {{-- Serial --}}
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $index + 1 }}
                                </td>


                                {{-- Student --}}
                                <td class="px-6 py-4">

                                    <div class="flex items-center gap-3">

                                        @if(!empty($student->photo))

                                            <img src="{{ asset('storage/' . $student->photo) }}"
                                                 alt="{{ $student->name }}"
                                                 class="w-10 h-10 rounded-full object-cover">

                                        @else

                                            <div class="w-10 h-10 rounded-full
                                                        bg-blue-50
                                                        flex items-center justify-center">

                                                <span class="text-sm font-bold text-blue-600">
                                                    {{ strtoupper(substr($student->name, 0, 1)) }}
                                                </span>

                                            </div>

                                        @endif


                                        <div>

                                            @if(\Illuminate\Support\Facades\Route::has('admin.students.show'))

                                                <a href="{{ route('admin.students.show', $student) }}"
                                                   class="text-sm font-semibold
                                                          text-blue-600 hover:text-blue-800">
                                                    {{ $student->name }}
                                                </a>

                                            @else

                                                <p class="text-sm font-semibold text-slate-800">
                                                    {{ $student->name }}
                                                </p>

                                            @endif

                                        </div>

                                    </div>

                                </td>


                                {{-- Student ID --}}
                                <td class="px-6 py-4 text-sm text-slate-600">

                                    {{ $student->student_id
                                        ?? $student->admission_no
                                        ?? $student->id }}

                                </td>


                                {{-- Relationship --}}
                                <td class="px-6 py-4">

                                    <span class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-slate-100 text-slate-700
                                                 text-xs font-medium">

                                        {{ $student->pivot->relationship }}

                                    </span>

                                </td>


                                {{-- Primary --}}
                                <td class="px-6 py-4">

                                    @if($student->pivot->is_primary)

                                        <span class="inline-flex items-center
                                                     px-2.5 py-1
                                                     rounded-full
                                                     bg-green-50 text-green-700
                                                     text-xs font-semibold">
                                            Primary Guardian
                                        </span>

                                    @else

                                        <span class="text-xs text-slate-400">
                                            No
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            {{-- Empty State --}}
            <div class="px-6 py-12 text-center">

                <div class="mx-auto w-14 h-14 rounded-full
                            bg-slate-100
                            flex items-center justify-center">

                    <span class="text-2xl text-slate-400">
                        👨‍👩‍👧
                    </span>

                </div>

                <h3 class="mt-4 text-sm font-semibold text-slate-700">
                    No students assigned
                </h3>

                <p class="mt-1 text-sm text-slate-500">
                    No student has been assigned to this guardian yet.
                </p>

                <a href="{{ route('admin.guardians.edit', $guardian) }}"
                   class="inline-flex items-center mt-4
                          px-4 py-2
                          bg-blue-600 hover:bg-blue-700
                          text-white rounded-lg
                          text-sm font-medium">
                    Assign Student
                </a>

            </div>

        @endif

    </div>


    {{-- Footer Actions --}}
    <div class="flex flex-col sm:flex-row justify-end gap-2">

        <a href="{{ route('admin.guardians.index') }}"
           class="px-4 py-2.5 rounded-lg
                  bg-slate-100 hover:bg-slate-200
                  text-slate-700 text-sm font-medium text-center">
            Back to List
        </a>

        <a href="{{ route('admin.guardians.edit', $guardian) }}"
           class="px-4 py-2.5 rounded-lg
                  bg-blue-600 hover:bg-blue-700
                  text-white text-sm font-medium text-center">
            Edit Guardian
        </a>

    </div>

</div>

@endsection