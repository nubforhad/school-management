@extends('admin.layouts.app')

@section('content')

<div class="max-w-screen-lg mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">


    {{-- =========================================================
        Header
    ========================================================== --}}

    <div class="mb-4 sm:mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-3">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Add Fee Type
                </h1>

                <p class="text-xs sm:text-sm text-slate-500 mt-1">
                    Create a new fee type for your branch
                </p>

            </div>

            <a href="{{ route('admin.fee-types.index') }}"
               class="w-full sm:w-auto
                      inline-flex items-center justify-center gap-2
                      px-4 py-2.5 rounded-lg
                      bg-slate-100 text-slate-700
                      text-sm font-medium
                      hover:bg-slate-200 transition">

                <i class="bi bi-arrow-left"></i>

                Back

            </a>

        </div>

    </div>


    {{-- =========================================================
        Form
    ========================================================== --}}

    <div class="bg-white rounded-xl shadow-sm
                border border-slate-200
                overflow-hidden">


        {{-- Form Header --}}

        <div class="p-4 sm:p-5
                    border-b border-slate-200">

            <div class="flex items-center gap-3">

                <div class="w-10 h-10 rounded-lg
                            bg-blue-50
                            flex items-center justify-center">

                    <i class="bi bi-receipt
                              text-blue-600 text-lg"></i>

                </div>

                <div>

                    <h2 class="text-base sm:text-lg
                               font-semibold text-slate-800">

                        Fee Type Information

                    </h2>

                    <p class="text-xs sm:text-sm text-slate-500">

                        Enter the basic information of this fee type.

                    </p>

                </div>

            </div>

        </div>


        {{-- Form Body --}}

        <form method="POST"
              action="{{ route('admin.fee-types.store') }}">

            @csrf

            <div class="p-4 sm:p-6">

                <div class="grid grid-cols-1 md:grid-cols-2
                            gap-4 sm:gap-5">


                    {{-- Name --}}

                    <div>

                        <label class="block text-xs sm:text-sm
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
                                      bg-white
                                      px-3 py-2.5
                                      text-sm
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      outline-none
                                      @error('name')
                                          border-red-400
                                      @enderror">

                        @error('name')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Code --}}

                    <div>

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Fee Code

                        </label>

                        <input type="text"
                               name="code"
                               value="{{ old('code') }}"
                               placeholder="e.g. TUITION"
                               class="w-full rounded-lg
                                      border border-slate-300
                                      bg-white
                                      px-3 py-2.5
                                      text-sm
                                      uppercase
                                      focus:border-blue-500
                                      focus:ring-2
                                      focus:ring-blue-100
                                      outline-none
                                      @error('code')
                                          border-red-400
                                      @enderror">

                        @error('code')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Description --}}

                    <div class="md:col-span-2">

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-1">

                            Description

                        </label>

                        <textarea name="description"
                                  rows="4"
                                  placeholder="Enter fee type description..."
                                  class="w-full rounded-lg
                                         border border-slate-300
                                         bg-white
                                         px-3 py-2.5
                                         text-sm
                                         focus:border-blue-500
                                         focus:ring-2
                                         focus:ring-blue-100
                                         outline-none
                                         resize-none
                                         @error('description')
                                             border-red-400
                                         @enderror">{{ old('description') }}</textarea>

                        @error('description')

                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>

                        @enderror

                    </div>


                    {{-- Status --}}

                    <div class="md:col-span-2">

                        <label class="block text-xs sm:text-sm
                                      font-medium text-slate-700 mb-2">

                            Status

                        </label>

                        <label class="inline-flex items-center
                                      cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   class="sr-only peer"
                                   {{ old('status', true) ? 'checked' : '' }}>

                            <div class="relative w-11 h-6
                                        bg-slate-300
                                        rounded-full
                                        peer
                                        peer-checked:bg-blue-600
                                        after:content-['']
                                        after:absolute
                                        after:top-[2px]
                                        after:left-[2px]
                                        after:bg-white
                                        after:border
                                        after:border-slate-300
                                        after:rounded-full
                                        after:h-5
                                        after:w-5
                                        after:transition-all
                                        peer-checked:after:translate-x-full
                                        peer-checked:after:border-white">
                            </div>

                            <span class="ml-3 text-sm text-slate-700">
                                Active
                            </span>

                        </label>

                    </div>

                </div>

            </div>


            {{-- Footer --}}

            <div class="px-4 sm:px-6 py-4
                        bg-slate-50
                        border-t border-slate-200
                        flex flex-col xs:flex-row
                        gap-2.5 sm:gap-3
                        sm:justify-end">

                <a href="{{ route('admin.fee-types.index') }}"
                   class="w-full xs:w-auto
                          inline-flex items-center
                          justify-center gap-2
                          px-5 py-2.5 rounded-lg
                          bg-white
                          border border-slate-300
                          text-slate-700
                          text-sm font-medium
                          hover:bg-slate-100 transition">

                    Cancel

                </a>

                <button type="submit"
                        class="w-full xs:w-auto
                               inline-flex items-center
                               justify-center gap-2
                               px-5 py-2.5 rounded-lg
                               bg-blue-600 text-white
                               text-sm font-medium
                               hover:bg-blue-700 transition">

                    <i class="bi bi-check-lg"></i>

                    Save Fee Type

                </button>

            </div>

        </form>

    </div>

</div>

@endsection