@extends('admin.layouts.app')

@section('title', 'Edit Leave Type')

@section('page-title', 'Edit Leave Type')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">

        <a href="{{ route('admin.leave-types.index') }}"
           class="inline-flex items-center gap-2 text-sm text-slate-500 hover:text-blue-600 transition">

            <i class="bi bi-arrow-left"></i>
            Back to Leave Types

        </a>

        <div class="mt-4">

            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                Edit Leave Type
            </h1>

            <p class="mt-1 text-xs sm:text-sm text-slate-500">
                Update leave type information
            </p>

        </div>

    </div>


    {{-- Validation Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-lg border border-red-200 bg-red-50 px-4 py-3">

            <div class="flex items-start gap-3">

                <div class="flex h-8 w-8 shrink-0 items-center justify-center
                            rounded-full bg-red-100 text-red-600">

                    <i class="bi bi-exclamation-triangle"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-red-800">
                        Please fix the following errors
                    </p>

                    <ul class="mt-1 list-disc list-inside text-xs text-red-700 space-y-1">

                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach

                    </ul>

                </div>

            </div>

        </div>

    @endif


    {{-- Form Card --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">

        <form method="POST"
              action="{{ route('admin.leave-types.update', $leaveType) }}">

            @csrf
            @method('PUT')


            {{-- Header --}}
            <div class="px-4 sm:px-6 py-4 border-b border-slate-200 bg-slate-50">

                <div class="flex items-center gap-3">

                    <div class="flex h-10 w-10 items-center justify-center
                                rounded-lg bg-blue-50 text-blue-600">

                        <i class="bi bi-calendar2-week"></i>

                    </div>

                    <div>

                        <h2 class="font-semibold text-slate-800">
                            Leave Type Information
                        </h2>

                        <p class="text-xs text-slate-500 mt-0.5">
                            Update leave type details
                        </p>

                    </div>

                </div>

            </div>


            {{-- Fields --}}
            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">


                    {{-- Name --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">

                            Leave Name

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               name="name"
                               value="{{ old('name', $leaveType->name) }}"
                               required
                               placeholder="e.g. Casual Leave"

                               class="w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100
                                      @error('name') border-red-400 @enderror">

                        @error('name')

                            <p class="mt-1 text-xs text-red-500">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Code --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Leave Code
                        </label>

                        <input type="text"
                               name="code"
                               value="{{ old('code', $leaveType->code) }}"
                               placeholder="e.g. CL"

                               class="w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100">

                    </div>


                    {{-- Days Per Year --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">

                            Days Per Year

                            <span class="text-red-500">*</span>

                        </label>

                        <input type="number"
                               name="days_per_year"
                               value="{{ old('days_per_year', $leaveType->days_per_year) }}"
                               min="0"
                               max="365"
                               step="0.01"
                               required
                               placeholder="0"

                               class="w-full rounded-lg border border-slate-300
                                      bg-white px-3 py-2.5 text-sm text-slate-700
                                      outline-none
                                      focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100">

                    </div>


                    {{-- Description --}}
                    <div class="md:col-span-2 lg:col-span-3">

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Description
                        </label>

                        <textarea name="description"
                                  rows="4"
                                  placeholder="Optional description..."

                                  class="w-full rounded-lg border border-slate-300
                                         bg-white px-3 py-2.5 text-sm text-slate-700
                                         outline-none resize-none
                                         focus:border-blue-500
                                         focus:ring-2 focus:ring-blue-100">{{ old('description', $leaveType->description) }}</textarea>

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-1.5">
                            Status
                        </label>

                        <label class="flex items-center gap-3 h-[42px] cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"

                                   {{ old('status', $leaveType->status) ? 'checked' : '' }}

                                   class="h-4 w-4 rounded border-slate-300
                                          text-blue-600 focus:ring-blue-500">

                            <span class="text-sm text-slate-600">
                                Active
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Footer --}}
            <div class="flex flex-col-reverse sm:flex-row
                        items-stretch sm:items-center
                        justify-end gap-3
                        px-4 sm:px-6 py-4
                        border-t border-slate-200 bg-slate-50">

                <a href="{{ route('admin.leave-types.index') }}"
                   class="inline-flex items-center justify-center
                          rounded-lg border border-slate-300 bg-white
                          px-4 py-2.5 text-sm font-medium text-slate-600
                          hover:bg-slate-100 transition">

                    Cancel

                </a>

                <button type="submit"
                        class="inline-flex items-center justify-center gap-2
                               rounded-lg bg-blue-600 px-5 py-2.5
                               text-sm font-semibold text-white
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check2-circle"></i>
                    Update Leave Type

                </button>

            </div>

        </form>

    </div>

</div>

@endsection