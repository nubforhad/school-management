@extends('admin.layouts.app')

@section('content')

<div class="max-w-3xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex items-center gap-3">

            <a href="{{ route('admin.fee-types.index') }}"
               class="w-9 h-9 rounded-lg
                      bg-slate-100 text-slate-600
                      flex items-center justify-center
                      hover:bg-slate-200 transition">

                <i class="bi bi-arrow-left"></i>

            </a>

            <div>

                <h1 class="text-xl sm:text-2xl
                           font-bold text-slate-800">

                    Add Fee Type

                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">

                    Create a new fee category

                </p>

            </div>

        </div>

    </div>


    {{-- Form --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200 p-4 sm:p-6">

        <form method="POST"
              action="{{ route('admin.fee-types.store') }}">

            @csrf


            {{-- Name --}}

            <div class="mb-4">

                <label class="block text-sm
                              font-medium text-slate-700 mb-1">

                    Fee Type Name
                    <span class="text-red-500">*</span>

                </label>

                <input type="text"
                       name="name"
                       value="{{ old('name') }}"
                       placeholder="e.g. Tuition Fee"
                       required
                       class="w-full rounded-lg
                              border border-slate-300
                              px-3 py-2.5
                              text-sm
                              focus:border-blue-500
                              focus:ring-2
                              focus:ring-blue-100
                              outline-none">

                @error('name')

                    <p class="text-xs text-red-600 mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Code --}}

            <div class="mb-4">

                <label class="block text-sm
                              font-medium text-slate-700 mb-1">

                    Code

                </label>

                <input type="text"
                       name="code"
                       value="{{ old('code') }}"
                       placeholder="e.g. TUITION"
                       class="w-full rounded-lg
                              border border-slate-300
                              px-3 py-2.5
                              text-sm uppercase
                              focus:border-blue-500
                              focus:ring-2
                              focus:ring-blue-100
                              outline-none">

                @error('code')

                    <p class="text-xs text-red-600 mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Description --}}

            <div class="mb-4">

                <label class="block text-sm
                              font-medium text-slate-700 mb-1">

                    Description

                </label>

                <textarea name="description"
                          rows="4"
                          placeholder="Optional description..."
                          class="w-full rounded-lg
                                 border border-slate-300
                                 px-3 py-2.5
                                 text-sm
                                 focus:border-blue-500
                                 focus:ring-2
                                 focus:ring-blue-100
                                 outline-none">{{ old('description') }}</textarea>

                @error('description')

                    <p class="text-xs text-red-600 mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>


            {{-- Status --}}

            <div class="mb-5">

                <label class="flex items-center gap-2
                              cursor-pointer">

                    <input type="checkbox"
                           name="status"
                           value="1"
                           checked
                           class="w-4 h-4
                                  rounded border-slate-300
                                  text-blue-600
                                  focus:ring-blue-500">

                    <span class="text-sm text-slate-700">
                        Active
                    </span>

                </label>

            </div>


            {{-- Buttons --}}

            <div class="flex flex-col sm:flex-row gap-2.5">

                <button type="submit"
                        class="inline-flex items-center
                               justify-center gap-2
                               px-5 py-2.5 rounded-lg
                               bg-blue-600 text-white
                               text-sm font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check-lg"></i>

                    Save Fee Type

                </button>

                <a href="{{ route('admin.fee-types.index') }}"
                   class="inline-flex items-center
                          justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-slate-100 text-slate-700
                          text-sm font-medium
                          hover:bg-slate-200 transition">

                    Cancel

                </a>

            </div>

        </form>

    </div>

</div>

@endsection