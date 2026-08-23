@extends('admin.layouts.app')

@section('title', 'Add Academic Session')
@section('page-title', 'Add Academic Session')

@section('content')

<div class="w-full space-y-6">

    {{-- Page Header --}}
    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

        <div>
            <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="inline-flex items-center gap-1 text-sm font-medium text-blue-600 hover:text-blue-700">

                ← Back to Sessions

            </a>

            <h1 class="mt-3 text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">
                Add Academic Session
            </h1>

            <p class="mt-1 text-sm text-slate-500">
                Create a new academic session for a branch.
            </p>
        </div>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="rounded-xl border border-red-200 bg-red-50 p-4">

            <div class="flex gap-3">

                <div class="text-red-600">
                    ⚠️
                </div>

                <div>

                    <h3 class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </h3>

                    <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                        @foreach($errors->all() as $error)

                            <li>
                                {{ $error }}
                            </li>

                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Main Form --}}
    <form
        action="{{ route('admin.academic.sessions.store') }}"
        method="POST"
        class="w-full overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

        @csrf


        {{-- Form Header --}}
        <div class="border-b border-slate-200 bg-slate-50/70 px-5 py-5 sm:px-6 lg:px-8">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100 text-xl">
                    📅
                </div>

                <div>

                    <h2 class="text-base font-semibold text-slate-900">
                        Session Information
                    </h2>

                    <p class="mt-0.5 text-sm text-slate-500">
                        Enter the basic information for this academic session.
                    </p>

                </div>

            </div>

        </div>


        {{-- Form Body --}}
        <div class="p-5 sm:p-6 lg:p-8">

            <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">


                {{-- Branch --}}
                <div class="lg:col-span-2">

                    <label
                        for="branch_id"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Branch

                        <span class="text-red-500">*</span>

                    </label>

                    <select
                        id="branch_id"
                        name="branch_id"
                        required

                        class="w-full rounded-xl border border-slate-300 bg-white
                               px-4 py-3 text-sm text-slate-800
                               shadow-sm transition
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

                                @if($branch->code)
                                    — {{ $branch->code }}
                                @endif

                            </option>

                        @endforeach

                    </select>

                    @error('branch_id')

                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Session Name --}}
                <div>

                    <label
                        for="name"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Session Name

                        <span class="text-red-500">*</span>

                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"

                        value="{{ old('name') }}"

                        required
                        autocomplete="off"

                        placeholder="Example: 2026"

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm text-slate-800
                               shadow-sm placeholder:text-slate-400
                               transition
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('name')

                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Start Date --}}
                <div>

                    <label
                        for="start_date"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        Start Date

                    </label>

                    <input
                        id="start_date"
                        type="date"
                        name="start_date"

                        value="{{ old('start_date') }}"

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm text-slate-800
                               shadow-sm transition
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('start_date')

                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- End Date --}}
                <div>

                    <label
                        for="end_date"
                        class="mb-2 block text-sm font-semibold text-slate-700">

                        End Date

                    </label>

                    <input
                        id="end_date"
                        type="date"
                        name="end_date"

                        value="{{ old('end_date') }}"

                        class="w-full rounded-xl border border-slate-300
                               px-4 py-3 text-sm text-slate-800
                               shadow-sm transition
                               focus:border-blue-500 focus:outline-none
                               focus:ring-4 focus:ring-blue-500/10">

                    @error('end_date')

                        <p class="mt-1.5 text-xs font-medium text-red-600">
                            {{ $message }}
                        </p>

                    @enderror

                </div>


                {{-- Settings --}}
                <div class="lg:col-span-2">

                    <div class="rounded-xl border border-slate-200 bg-slate-50 p-5">

                        <h3 class="text-sm font-semibold text-slate-800">
                            Session Settings
                        </h3>

                        <p class="mt-1 text-xs text-slate-500">
                            Configure the current status of this session.
                        </p>


                        <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2">


                            {{-- Current --}}
                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-xl
                                       border border-slate-200 bg-white p-4
                                       transition hover:border-blue-300 hover:bg-blue-50/30">

                                <input
                                    type="checkbox"
                                    name="is_current"
                                    value="1"

                                    {{ old('is_current') ? 'checked' : '' }}

                                    class="mt-0.5 h-4 w-4 rounded border-slate-300
                                           text-blue-600
                                           focus:ring-blue-500">

                                <span>

                                    <span class="block text-sm font-semibold text-slate-800">
                                        Current Session
                                    </span>

                                    <span class="mt-1 block text-xs leading-5 text-slate-500">
                                        Make this the current academic session for the selected branch.
                                    </span>

                                </span>

                            </label>


                            {{-- Active --}}
                            <label
                                class="flex cursor-pointer items-start gap-3 rounded-xl
                                       border border-slate-200 bg-white p-4
                                       transition hover:border-green-300 hover:bg-green-50/30">

                                <input
                                    type="checkbox"
                                    name="status"
                                    value="1"

                                    {{ old('status', true) ? 'checked' : '' }}

                                    class="mt-0.5 h-4 w-4 rounded border-slate-300
                                           text-green-600
                                           focus:ring-green-500">

                                <span>

                                    <span class="block text-sm font-semibold text-slate-800">
                                        Active
                                    </span>

                                    <span class="mt-1 block text-xs leading-5 text-slate-500">
                                        Active sessions can be used throughout the academic system.
                                    </span>

                                </span>

                            </label>

                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Footer --}}
        <div class="flex flex-col-reverse gap-3 border-t border-slate-200
                    bg-slate-50 px-5 py-4
                    sm:flex-row sm:items-center sm:justify-end
                    sm:px-6 lg:px-8">

            <a
                href="{{ route('admin.academic.sessions.index') }}"
                class="inline-flex items-center justify-center rounded-xl
                       border border-slate-300 bg-white px-5 py-2.5
                       text-sm font-semibold text-slate-700
                       transition hover:bg-slate-50">

                Cancel

            </a>

            <button
                type="submit"

                class="inline-flex items-center justify-center gap-2
                       rounded-xl bg-blue-600 px-6 py-2.5
                       text-sm font-semibold text-white shadow-sm
                       transition hover:bg-blue-700
                       focus:outline-none focus:ring-4 focus:ring-blue-500/20">

                <span>✓</span>

                Create Session

            </button>

        </div>

    </form>

</div>

@endsection