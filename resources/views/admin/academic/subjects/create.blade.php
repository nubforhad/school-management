@extends('admin.layouts.app')

@section('title', 'Add Subject')
@section('page-title', 'Add Subject')

@section('content')

<div class="w-full space-y-6">

    <div>

        <a
            href="{{ route('admin.academic.subjects.index') }}"
            class="text-sm font-medium text-blue-600 hover:text-blue-700">

            ← Back to Subjects

        </a>

        <h1 class="mt-3 text-2xl font-bold text-slate-900 sm:text-3xl">
            Add Subject
        </h1>

        <p class="mt-1 text-sm text-slate-500">
            Create a new academic subject for a branch.
        </p>

    </div>


    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <ul class="list-disc space-y-1 pl-5 text-sm text-red-700">

                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    <form
        action="{{ route('admin.academic.subjects.store') }}"
        method="POST"
        class="overflow-hidden rounded-2xl border border-slate-200
               bg-white shadow-sm">

        @csrf


        <div class="border-b border-slate-200 bg-slate-50 px-5 py-5
                    sm:px-6 lg:px-8">

            <h2 class="font-semibold text-slate-900">
                Subject Information
            </h2>

            <p class="mt-1 text-sm text-slate-500">
                Enter the subject information below.
            </p>

        </div>


        <div class="p-5 sm:p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Branch --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Branch <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="branch_id"
                        required
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        <option value="">
                            Select Branch
                        </option>

                        @foreach($branches as $branch)

                            <option
                                value="{{ $branch->id }}"
                                {{ old('branch_id') == $branch->id ? 'selected' : '' }}>

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


                {{-- Subject Name --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Subject Name <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        maxlength="150"
                        placeholder="Example: Mathematics"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('name')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Bangla Name --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Subject Name (Bangla)
                    </label>

                    <input
                        type="text"
                        name="name_bn"
                        value="{{ old('name_bn') }}"
                        maxlength="150"
                        placeholder="উদাহরণ: গণিত"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Code --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Subject Code
                    </label>

                    <input
                        type="text"
                        name="code"
                        value="{{ old('code') }}"
                        maxlength="50"
                        placeholder="Example: MAT-101"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Type --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Subject Type <span class="text-red-500">*</span>
                    </label>

                    <select
                        name="type"
                        required
                        class="w-full rounded-xl border border-slate-300
                               bg-white px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                        <option value="">
                            Select Type
                        </option>

                        <option
                            value="theory"
                            {{ old('type') === 'theory' ? 'selected' : '' }}>

                            Theory

                        </option>

                        <option
                            value="practical"
                            {{ old('type') === 'practical' ? 'selected' : '' }}>

                            Practical

                        </option>

                        <option
                            value="both"
                            {{ old('type') === 'both' ? 'selected' : '' }}>

                            Theory + Practical

                        </option>

                    </select>

                    @error('type')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Full Marks --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Full Marks <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        name="full_marks"
                        value="{{ old('full_marks') }}"
                        required
                        min="1"
                        step="0.01"
                        placeholder="100"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Pass Marks --}}
                <div>

                    <label class="mb-2 block text-sm font-semibold text-slate-700">
                        Pass Marks <span class="text-red-500">*</span>
                    </label>

                    <input
                        type="number"
                        name="pass_marks"
                        value="{{ old('pass_marks') }}"
                        required
                        min="0"
                        step="0.01"
                        placeholder="33"
                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                </div>


                {{-- Status --}}
                <div class="flex items-end">

                    <label class="flex w-full cursor-pointer items-center gap-3
                                  rounded-xl border border-slate-200
                                  bg-slate-50 p-4">

                        <input
                            type="checkbox"
                            name="status"
                            value="1"
                            {{ old('status', true) ? 'checked' : '' }}
                            class="h-4 w-4 rounded border-slate-300 text-blue-600">

                        <span>

                            <span class="block text-sm font-semibold text-slate-800">
                                Active
                            </span>

                            <span class="block text-xs text-slate-500">
                                Make this subject available.
                            </span>

                        </span>

                    </label>

                </div>

            </div>

        </div>


        <div class="flex flex-col-reverse gap-3 border-t border-slate-200
                    bg-slate-50 px-5 py-4 sm:flex-row sm:justify-end
                    sm:px-6 lg:px-8">

            <a
                href="{{ route('admin.academic.subjects.index') }}"
                class="rounded-xl border border-slate-300 bg-white
                       px-5 py-2.5 text-center text-sm font-semibold text-slate-700">

                Cancel

            </a>

            <button
                type="submit"
                class="rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white hover:bg-blue-700">

                Create Subject

            </button>

        </div>

    </form>

</div>

@endsection