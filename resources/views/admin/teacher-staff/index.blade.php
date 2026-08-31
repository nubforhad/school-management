@extends('admin.layouts.app')

@section('title', 'Teachers & Staff')
@section('page-title', 'Teachers & Staff')

@section('content')

<div class="max-w-screen-2xl mx-auto px-3 sm:px-4 lg:px-6 py-4 sm:py-6">

    {{-- Page Header --}}
    <div class="mb-6">

        <div class="flex flex-col sm:flex-row
                    sm:items-center sm:justify-between gap-4">

            <div>

                <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
                    Teachers & Staff
                </h1>

                <p class="mt-1 text-xs sm:text-sm text-slate-500">
                    Manage teachers and staff members
                </p>

            </div>


            <a href="{{ route('admin.teacher-staff.create') }}"
               class="inline-flex items-center justify-center gap-2
                      rounded-lg bg-blue-600 px-4 py-2.5
                      text-sm font-semibold text-white
                      hover:bg-blue-700 transition">

                <i class="bi bi-plus-lg"></i>

                Add Teacher / Staff

            </a>

        </div>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200
                    bg-green-50 px-4 py-3">

            <div class="flex items-center gap-3">

                <div class="flex h-8 w-8 items-center justify-center
                            rounded-full bg-green-100 text-green-600">

                    <i class="bi bi-check-lg"></i>

                </div>

                <div>

                    <p class="text-sm font-semibold text-green-800">
                        Success
                    </p>

                    <p class="text-sm text-green-700">
                        {{ session('success') }}
                    </p>

                </div>

            </div>

        </div>

    @endif


    {{-- Main Card --}}
    <div class="bg-white rounded-xl border border-slate-200
                shadow-sm overflow-hidden">


        {{-- Card Header --}}
        <div class="px-4 sm:px-5 py-4
                    border-b border-slate-200">

            <div class="flex flex-col sm:flex-row
                        sm:items-center sm:justify-between gap-3">

                <div>

                    <h2 class="font-semibold text-slate-800">
                        Teacher & Staff List
                    </h2>

                    <p class="mt-1 text-xs text-slate-500">
                        All teachers and staff members
                    </p>

                </div>


                <div class="inline-flex items-center gap-2
                            w-fit
                            rounded-lg
                            bg-slate-50
                            border border-slate-200
                            px-3 py-1.5
                            text-xs font-medium
                            text-slate-600">

                    <i class="bi bi-people"></i>

                    {{ $teacherStaff->total() }} Members

                </div>

            </div>

        </div>


        {{-- Table --}}
        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50
                              border-b border-slate-200">

                    <tr>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Employee
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Employee ID
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Department
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Designation
                        </th>

                        <th class="px-4 py-3 text-left
                                   font-semibold text-slate-600">
                            Phone
                        </th>

                        <th class="px-4 py-3 text-center
                                   font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-4 py-3 text-right
                                   font-semibold text-slate-600">
                            Actions
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($teacherStaff as $staff)

                        <tr class="hover:bg-slate-50 transition">


                            {{-- Number --}}
                            <td class="px-4 py-4 text-slate-500">

                                {{ $teacherStaff->firstItem() + $loop->index }}

                            </td>


                            {{-- Employee --}}
                            <td class="px-4 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Photo --}}
                                    @if($staff->photo)

                                        <img
                                            src="{{ asset('storage/' . $staff->photo) }}"
                                            alt="{{ $staff->name }}"
                                            class="h-10 w-10 rounded-full
                                                   object-cover
                                                   border border-slate-200">

                                    @else

                                        <div class="flex h-10 w-10 shrink-0
                                                    items-center justify-center
                                                    rounded-full
                                                    bg-blue-50
                                                    text-blue-600">

                                            <i class="bi bi-person text-lg"></i>

                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <p class="font-semibold
                                                  text-slate-800 truncate">

                                            {{ $staff->name }}

                                        </p>


                                        @if($staff->email)

                                            <p class="text-xs text-slate-400
                                                      truncate max-w-[180px]">

                                                {{ $staff->email }}

                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Employee ID --}}
                            <td class="px-4 py-4">

                                <span class="inline-flex items-center
                                             rounded-md
                                             bg-slate-100
                                             px-2 py-1
                                             text-xs font-medium
                                             text-slate-600">

                                    {{ $staff->employee_id }}

                                </span>

                            </td>


                            {{-- Department --}}
                            <td class="px-4 py-4">

                                @if($staff->department)

                                    <div class="flex items-center gap-2
                                                text-slate-700">

                                        <span class="flex h-7 w-7
                                                     items-center justify-center
                                                     rounded-md bg-blue-50
                                                     text-blue-600">

                                            <i class="bi bi-diagram-3 text-xs"></i>

                                        </span>

                                        <span>
                                            {{ $staff->department->name }}
                                        </span>

                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Designation --}}
                            <td class="px-4 py-4">

                                @if($staff->designation)

                                    <span class="text-slate-700">

                                        {{ $staff->designation->name }}

                                    </span>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Phone --}}
                            <td class="px-4 py-4">

                                @if($staff->phone)

                                    <div class="flex items-center gap-2
                                                text-slate-600">

                                        <i class="bi bi-telephone
                                                  text-slate-400"></i>

                                        {{ $staff->phone }}

                                    </div>

                                @else

                                    <span class="text-slate-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td class="px-4 py-4 text-center">

                                @if($staff->status)

                                    <span class="inline-flex items-center
                                                 gap-1.5
                                                 rounded-full
                                                 bg-green-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-green-700">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-green-500"></span>

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex items-center
                                                 gap-1.5
                                                 rounded-full
                                                 bg-red-50
                                                 px-2.5 py-1
                                                 text-xs font-medium
                                                 text-red-700">

                                        <span class="h-1.5 w-1.5
                                                     rounded-full
                                                     bg-red-500"></span>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-4 py-4">

                                <div class="flex items-center  justify-end gap-2">

                                <a href="{{ route('admin.teacher-staff.show', $teacherStaff->id) }}">
                                    <i class="bi bi-eye"></i>
                                </a>


                                    {{-- Edit --}}
                                    <a href="{{ route(
                                        'admin.teacher-staff.edit',
                                        $staff
                                    ) }}"
                                       title="Edit"
                                       class="inline-flex h-9 w-9
                                              items-center justify-center
                                              rounded-lg
                                              border border-blue-200
                                              bg-blue-50
                                              text-blue-600
                                              hover:bg-blue-100
                                              transition">

                                        <i class="bi bi-pencil-square"></i>

                                    </a>


                                    {{-- Delete --}}
                                    <form method="POST"
                                          action="{{ route(
                                              'admin.teacher-staff.destroy',
                                              $staff
                                          ) }}"
                                          onsubmit="return confirm(
                                              'Are you sure you want to delete this employee?'
                                          )">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="inline-flex h-9 w-9
                                                       items-center justify-center
                                                       rounded-lg
                                                       border border-red-200
                                                       bg-red-50
                                                       text-red-600
                                                       hover:bg-red-100
                                                       transition">

                                            <i class="bi bi-trash3"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        {{-- Empty State --}}
                        <tr>

                            <td colspan="8"
                                class="px-4 py-16 text-center">

                                <div class="flex flex-col items-center">


                                    <div class="flex h-16 w-16
                                                items-center justify-center
                                                rounded-full
                                                bg-blue-50
                                                text-blue-600">

                                        <i class="bi bi-people text-3xl"></i>

                                    </div>


                                    <h3 class="mt-4 text-base
                                               font-semibold
                                               text-slate-700">

                                        No Teachers or Staff Found

                                    </h3>


                                    <p class="mt-1 text-sm text-slate-500">

                                        Add your first teacher or staff member.

                                    </p>


                                    <a href="{{ route(
                                        'admin.teacher-staff.create'
                                    ) }}"
                                       class="mt-5 inline-flex
                                              items-center gap-2
                                              rounded-lg bg-blue-600
                                              px-4 py-2.5
                                              text-sm font-semibold
                                              text-white
                                              hover:bg-blue-700
                                              transition">

                                        <i class="bi bi-plus-lg"></i>

                                        Add Teacher / Staff

                                    </a>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($teacherStaff->hasPages())

            <div class="px-4 py-4
                        border-t border-slate-200">

                {{ $teacherStaff->links() }}

            </div>

        @endif

    </div>

</div>

@endsection 
