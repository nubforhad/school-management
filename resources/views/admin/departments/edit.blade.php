@extends('admin.layouts.app')

@section('title', 'Edit Department')
@section('page-title', 'Edit Department')

@section('content')

<div class="max-w-screen-xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex items-center gap-2 mb-2">

            <a href="{{ route('admin.departments.index') }}"
               class="text-slate-400 hover:text-blue-600 transition">

                <i class="bi bi-arrow-left"></i>

            </a>

            <span class="text-xs text-slate-400">
                Departments
            </span>

        </div>

        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Edit Department
        </h1>

        <p class="mt-1 text-xs sm:text-sm text-slate-500">
            Update department information
        </p>

    </div>


    {{-- Errors --}}
    @if($errors->any())

        <div class="mb-5 rounded-xl border border-red-200
                    bg-red-50 p-4">

            <p class="text-sm font-semibold text-red-800">
                Please fix the following errors
            </p>

            <ul class="mt-2 space-y-1 text-sm text-red-700">

                @foreach($errors->all() as $error)

                    <li>• {{ $error }}</li>

                @endforeach

            </ul>

        </div>

    @endif


    <form method="POST"
          action="{{ route(
              'admin.departments.update',
              $department
          ) }}">

        @csrf
        @method('PUT')

        <div class="bg-white rounded-xl border
                    border-slate-200 shadow-sm overflow-hidden">

            <div class="px-4 sm:px-5 py-4 border-b
                        border-slate-200">

                <h2 class="font-semibold text-slate-800">
                    Department Information
                </h2>

            </div>


            <div class="p-4 sm:p-5">

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">


                    {{-- Branch --}}
                    <div>

                        <label for="branch_id"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Branch <span class="text-red-500">*</span>

                        </label>

                        <select name="branch_id"
                                id="branch_id"
                                required
                                class="w-full rounded-lg border
                                       border-slate-300 bg-white
                                       px-3 py-2.5 text-sm
                                       outline-none focus:border-blue-500
                                       focus:ring-2 focus:ring-blue-100">

                            @foreach($branches as $branch)

                                <option value="{{ $branch->id }}"
                                    {{ old(
                                        'branch_id',
                                        $department->branch_id
                                    ) == $branch->id
                                        ? 'selected'
                                        : '' }}>

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


                    {{-- Name --}}
                    <div>

                        <label for="name"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Department Name
                            <span class="text-red-500">*</span>

                        </label>

                        <input type="text"
                               name="name"
                               id="name"
                               value="{{ old(
                                   'name',
                                   $department->name
                               ) }}"
                               required
                               class="w-full rounded-lg border
                                      border-slate-300 bg-white
                                      px-3 py-2.5 text-sm
                                      outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100">

                        @error('name')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Code --}}
                    <div>

                        <label for="code"
                               class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Department Code

                        </label>

                        <input type="text"
                               name="code"
                               id="code"
                               value="{{ old(
                                   'code',
                                   $department->code
                               ) }}"
                               class="w-full rounded-lg border
                                      border-slate-300 bg-white
                                      px-3 py-2.5 text-sm
                                      outline-none focus:border-blue-500
                                      focus:ring-2 focus:ring-blue-100">

                        @error('code')
                            <p class="mt-1 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Status --}}
                    <div>

                        <label class="block text-sm font-medium
                                      text-slate-700 mb-1.5">

                            Status

                        </label>

                        <label class="flex items-center gap-3
                                      rounded-lg border border-slate-300
                                      px-3 py-2.5 cursor-pointer">

                            <input type="checkbox"
                                   name="status"
                                   value="1"
                                   {{ old(
                                       'status',
                                       $department->status
                                   ) ? 'checked' : '' }}
                                   class="h-4 w-4 rounded
                                          border-slate-300
                                          text-blue-600">

                            <span class="text-sm text-slate-700">
                                Active
                            </span>

                        </label>

                    </div>

                </div>


                {{-- Description --}}
                <div class="mt-5">

                    <label for="description"
                           class="block text-sm font-medium
                                  text-slate-700 mb-1.5">

                        Description

                    </label>

                    <textarea name="description"
                              id="description"
                              rows="4"
                              class="w-full rounded-lg border
                                     border-slate-300 bg-white
                                     px-3 py-2.5 text-sm
                                     outline-none resize-none
                                     focus:border-blue-500
                                     focus:ring-2 focus:ring-blue-100">{{ old(
    'description',
    $department->description
) }}</textarea>

                    @error('description')
                        <p class="mt-1 text-xs text-red-600">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

            </div>


            {{-- Footer --}}
            <div class="border-t border-slate-200
                        bg-slate-50 px-4 sm:px-5 py-4">

                <div class="flex flex-col-reverse
                            sm:flex-row sm:justify-end gap-2">

                    <a href="{{ route('admin.departments.index') }}"
                       class="inline-flex items-center justify-center
                              gap-2 rounded-lg border border-slate-300
                              bg-white px-5 py-2.5 text-sm
                              font-medium text-slate-700">

                        <i class="bi bi-x-lg"></i>

                        Cancel

                    </a>

                    <button type="submit"
                            class="inline-flex items-center
                                   justify-center gap-2 rounded-lg
                                   bg-blue-600 px-5 py-2.5
                                   text-sm font-semibold text-white
                                   hover:bg-blue-700">

                        <i class="bi bi-check-lg"></i>

                        Update Department

                    </button>

                </div>

            </div>

        </div>

    </form>

</div>

@endsection