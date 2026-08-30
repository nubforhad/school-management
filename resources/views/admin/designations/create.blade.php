@extends('admin.layouts.app')

@section('title', 'Add Designation')
@section('page-title', 'Add Designation')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-6">

        <a href="{{ route('admin.designations.index') }}"
           class="inline-flex items-center gap-2
                  text-sm text-slate-500
                  hover:text-blue-600 transition">

            <i class="bi bi-arrow-left"></i>

            Back to Designations

        </a>


        <div class="mt-4">

            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Add Designation
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Create a new teacher or staff designation
            </p>

        </div>

    </div>


    {{-- Form Card --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        {{-- Card Header --}}
        <div class="px-4 sm:px-6 py-4
                    border-b border-slate-200
                    bg-slate-50">

            <div class="flex items-center gap-3">

                <div class="flex h-10 w-10 items-center justify-center
                            rounded-lg bg-blue-50 text-blue-600">

                    <i class="bi bi-person-badge"></i>

                </div>

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Designation Information
                    </h2>

                    <p class="text-xs text-slate-500 mt-0.5">
                        Enter designation details below
                    </p>

                </div>

            </div>

        </div>


        <form action="{{ route('admin.designations.store') }}"
              method="POST">

            @csrf


            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">


                    {{-- Branch --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Branch
                            <span class="text-red-500">*</span>

                        </label>

                        <select name="branch_id"
                                class="w-full rounded-lg
                                       border border-slate-300
                                       bg-white
                                       px-3 py-2.5
                                       text-sm text-slate-700
                                       outline-none
                                       focus:border-blue-500
                                       focus:ring-2
                                       focus:ring-blue-100
                                       @error('branch_id')
                                           border-red-400
                                       @enderror">

                            <option value="">
                                Select Branch
                            </option>

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ old(
                                        'branch_id',
                                        auth()->user()->branch_id
                                    ) == $branch->id ? 'selected' : '' }}>

                                    {{ $branch->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('branch_id')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Name --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Designation Name
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name') }}"
                               placeholder="e.g. Senior Teacher"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      @error('name')
                                          border-red-400
                                      @enderror">

                        @error('name')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Code --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Code

                        </label>

                        <input type="text"
                               name="code"
                               value="{{ old('code') }}"
                               placeholder="e.g. ST"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm text-slate-700
                                      placeholder-slate-400
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100">

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Status

                        </label>

                        <label class="flex items-center gap-3
                                      h-[42px] cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   checked
                                   class="h-4 w-4 rounded
                                          border-slate-300
                                          text-blue-600
                                          focus:ring-blue-500">

                            <span class="text-sm text-slate-600">
                                Active
                            </span>

                        </label>

                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2">

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Description

                        </label>

                        <textarea name="description"
                                  rows="4"
                                  placeholder="Optional description..."
                                  class="w-full rounded-lg
                                         border border-slate-300
                                         bg-white
                                         px-3 py-2.5
                                         text-sm text-slate-700
                                         placeholder-slate-400
                                         outline-none
                                         resize-none
                                         focus:border-blue-500
                                         focus:ring-2
                                         focus:ring-blue-100">{{ old('description') }}</textarea>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex flex-col-reverse sm:flex-row
                        items-stretch sm:items-center
                        justify-end gap-3
                        px-4 sm:px-6 py-4
                        border-t border-slate-200
                        bg-slate-50">

                <a href="{{ route('admin.designations.index') }}"
                   class="inline-flex items-center justify-center
                          rounded-lg border border-slate-300
                          bg-white px-4 py-2.5
                          text-sm font-medium text-slate-600
                          hover:bg-slate-100 transition">

                    Cancel

                </a>


                <button type="submit"
                        class="inline-flex items-center justify-center
                               gap-2 rounded-lg bg-blue-600
                               px-5 py-2.5 text-sm
                               font-semibold text-white
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check-lg"></i>

                    Save Designation

                </button>

            </div>

        </form>

    </div>

</div>

@endsection 
