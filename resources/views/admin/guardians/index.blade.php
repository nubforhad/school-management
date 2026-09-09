@extends('admin.layouts.app')

@section('title', 'Guardians')

@section('content')

<div class="p-6">

    {{-- Header --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">

        <div>
            <h1 class="text-2xl font-bold text-slate-800">
                Parent / Guardian
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage students' parents and guardians
            </p>
        </div>

        <a href="{{ route('admin.guardians.create') }}"
           class="inline-flex items-center justify-center gap-2
                  px-4 py-2.5 rounded-lg
                  bg-blue-600 hover:bg-blue-700
                  text-white text-sm font-medium
                  shadow-sm transition">

            <svg xmlns="http://www.w3.org/2000/svg"
                 class="w-5 h-5"
                 fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor">

                <path stroke-linecap="round"
                      stroke-linejoin="round"
                      stroke-width="2"
                      d="M12 4v16m8-8H4"/>
            </svg>

            Add Guardian
        </a>

    </div>


    {{-- Success Message --}}
    @if(session('success'))

        <div class="mb-5 rounded-lg border border-green-200
                    bg-green-50 px-4 py-3 text-sm text-green-700">

            {{ session('success') }}

        </div>

    @endif


    {{-- Error Message --}}
    @if(session('error'))

        <div class="mb-5 rounded-lg border border-red-200
                    bg-red-50 px-4 py-3 text-sm text-red-700">

            {{ session('error') }}

        </div>

    @endif


    {{-- Filters --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm p-5 mb-6">

        <form method="GET"
              action="{{ route('admin.guardians.index') }}">

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">

                {{-- Search --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Search
                    </label>

                    <input type="text"
                           name="search"
                           value="{{ request('search') }}"
                           placeholder="Name, phone, email or NID"
                           class="w-full rounded-lg border border-slate-300
                                  px-3 py-2.5 text-sm
                                  focus:border-blue-500
                                  focus:ring-2 focus:ring-blue-100
                                  outline-none">

                </div>


                {{-- Branch --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Branch
                    </label>

                    <select name="branch_id"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   outline-none">

                        <option value="">All Branches</option>

                        @foreach($branches as $branch)

                            <option value="{{ $branch->id }}"
                                {{ request('branch_id') == $branch->id ? 'selected' : '' }}>

                                {{ $branch->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label class="block text-sm font-medium text-slate-700 mb-1.5">
                        Status
                    </label>

                    <select name="status"
                            class="w-full rounded-lg border border-slate-300
                                   px-3 py-2.5 text-sm
                                   focus:border-blue-500
                                   focus:ring-2 focus:ring-blue-100
                                   outline-none">

                        <option value="">All Status</option>

                        <option value="1"
                            {{ request('status') === '1' ? 'selected' : '' }}>
                            Active
                        </option>

                        <option value="0"
                            {{ request('status') === '0' ? 'selected' : '' }}>
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- Buttons --}}
                <div class="flex items-end gap-2">

                    <button type="submit"
                            class="px-4 py-2.5 rounded-lg
                                   bg-blue-600 hover:bg-blue-700
                                   text-white text-sm font-medium
                                   transition">

                        Search

                    </button>

                    <a href="{{ route('admin.guardians.index') }}"
                       class="px-4 py-2.5 rounded-lg
                              bg-slate-100 hover:bg-slate-200
                              text-slate-700 text-sm font-medium
                              transition">

                        Reset

                    </a>

                </div>

            </div>

        </form>

    </div>


    {{-- Guardian Table --}}
    <div class="bg-white border border-slate-200
                rounded-xl shadow-sm overflow-hidden">

        <div class="overflow-x-auto">

            <table class="w-full text-sm">

                <thead class="bg-slate-50 border-b border-slate-200">

                    <tr>

                        <th class="px-5 py-3 text-left
                                   font-semibold text-slate-600">
                            #
                        </th>

                        <th class="px-5 py-3 text-left
                                   font-semibold text-slate-600">
                            Guardian
                        </th>

                        <th class="px-5 py-3 text-left
                                   font-semibold text-slate-600">
                            Contact
                        </th>

                        <th class="px-5 py-3 text-left
                                   font-semibold text-slate-600">
                            Branch
                        </th>

                        <th class="px-5 py-3 text-center
                                   font-semibold text-slate-600">
                            Students
                        </th>

                        <th class="px-5 py-3 text-center
                                   font-semibold text-slate-600">
                            Status
                        </th>

                        <th class="px-5 py-3 text-right
                                   font-semibold text-slate-600">
                            Action
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-slate-100">

                    @forelse($guardians as $guardian)

                        <tr class="hover:bg-slate-50 transition">

                            {{-- Serial --}}
                            <td class="px-5 py-4 text-slate-500">

                                {{ $guardians->firstItem() + $loop->index }}

                            </td>


                            {{-- Guardian --}}
                            <td class="px-5 py-4">

                                <div class="flex items-center gap-3">

                                    {{-- Photo --}}
                                    @if($guardian->photo)

                                        <img src="{{ asset('storage/' . $guardian->photo) }}"
                                             alt="{{ $guardian->name }}"
                                             class="w-10 h-10 rounded-full
                                                    object-cover border border-slate-200">

                                    @else

                                        <div class="w-10 h-10 rounded-full
                                                    bg-blue-50 text-blue-600
                                                    flex items-center justify-center
                                                    font-semibold">

                                            {{ strtoupper(substr($guardian->name, 0, 1)) }}

                                        </div>

                                    @endif


                                    <div>

                                        <div class="font-semibold text-slate-800">

                                            {{ $guardian->name }}

                                        </div>

                                        @if($guardian->occupation)

                                            <div class="text-xs text-slate-500 mt-0.5">

                                                {{ $guardian->occupation }}

                                            </div>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Contact --}}
                            <td class="px-5 py-4">

                                <div class="text-slate-700">

                                    {{ $guardian->phone ?: '—' }}

                                </div>

                                @if($guardian->email)

                                    <div class="text-xs text-slate-500 mt-0.5">

                                        {{ $guardian->email }}

                                    </div>

                                @endif

                            </td>


                            {{-- Branch --}}
                            <td class="px-5 py-4 text-slate-700">

                                {{ $guardian->branch->name ?? '—' }}

                            </td>


                            {{-- Students --}}
                            <td class="px-5 py-4 text-center">

                                <span class="inline-flex items-center
                                             justify-center min-w-[32px]
                                             px-2 py-1 rounded-full
                                             bg-blue-50 text-blue-700
                                             font-semibold">

                                    {{ $guardian->students_count }}

                                </span>

                            </td>


                            {{-- Status --}}
                            <td class="px-5 py-4 text-center">

                                @if($guardian->status)

                                    <span class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-green-50 text-green-700
                                                 text-xs font-semibold">

                                        Active

                                    </span>

                                @else

                                    <span class="inline-flex px-2.5 py-1
                                                 rounded-full
                                                 bg-red-50 text-red-700
                                                 text-xs font-semibold">

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- Actions --}}
                            <td class="px-5 py-4">

                                <div class="flex justify-end items-center gap-2">

                                    {{-- View --}}
                                    <a href="{{ route('admin.guardians.show', $guardian) }}"
                                       title="View"
                                       class="p-2 rounded-lg
                                              bg-blue-50 text-blue-600
                                              hover:bg-blue-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M15 12a3 3 0 11-6 0
                                                     3 3 0 016 0z"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M2.458 12C3.732 7.943
                                                     7.523 5 12 5c4.477 0
                                                     8.268 2.943 9.542 7
                                                     -1.274 4.057-5.065 7-9.542
                                                     7-4.477 0-8.268-2.943-9.542-7z"/>

                                        </svg>

                                    </a>


                                    {{-- Edit --}}
                                    <a href="{{ route('admin.guardians.edit', $guardian) }}"
                                       title="Edit"
                                       class="p-2 rounded-lg
                                              bg-amber-50 text-amber-600
                                              hover:bg-amber-100 transition">

                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             class="w-4 h-4"
                                             fill="none"
                                             viewBox="0 0 24 24"
                                             stroke="currentColor">

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M11 5H6a2 2 0 00-2
                                                     2v11a2 2 0 002 2h11a2
                                                     2 0 002-2v-5"/>

                                            <path stroke-linecap="round"
                                                  stroke-linejoin="round"
                                                  stroke-width="2"
                                                  d="M18.5 2.5a2.121
                                                     2.121 0 013 3L12
                                                     15l-4 1 1-4 9.5-9.5z"/>

                                        </svg>

                                    </a>


                                    {{-- Delete --}}
                                    <form action="{{ route('admin.guardians.destroy', $guardian) }}"
                                          method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this guardian?');">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                title="Delete"
                                                class="p-2 rounded-lg
                                                       bg-red-50 text-red-600
                                                       hover:bg-red-100 transition">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 class="w-4 h-4"
                                                 fill="none"
                                                 viewBox="0 0 24 24"
                                                 stroke="currentColor">

                                                <path stroke-linecap="round"
                                                      stroke-linejoin="round"
                                                      stroke-width="2"
                                                      d="M19 7l-.867 12.142A2
                                                         2 0 0116.138 21H7.862a2
                                                         2 0 01-1.995-1.858L5
                                                         7m5 4v6m4-6v6M9 7V4a1
                                                         1 0 011-1h4a1 1 0 011
                                                         1v3m-9 0h12"/>

                                            </svg>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="7"
                                class="px-5 py-12 text-center">

                                <div class="text-slate-400">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="w-12 h-12 mx-auto mb-3"
                                         fill="none"
                                         viewBox="0 0 24 24"
                                         stroke="currentColor">

                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="1.5"
                                              d="M17 20h5v-2a3 3 0
                                                 00-5.356-1.857M17
                                                 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7
                                                 20H2v-2a3 3 0
                                                 015.356-1.857M7
                                                 20v-2c0-.656.126-1.283.356-1.857m0
                                                 0a5.002 5.002 0
                                                 019.288 0M15
                                                 7a3 3 0 11-6 0
                                                 3 3 0 016 0zm6
                                                 3a2 2 0 11-4 0
                                                 2 2 0 014 0zM7
                                                 10a2 2 0 11-4 0 2 2
                                                 0 014 0z"/>

                                    </svg>

                                    <p class="font-medium text-slate-600">
                                        No guardians found
                                    </p>

                                    <p class="text-sm mt-1">
                                        Add a parent or guardian to get started.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        @if($guardians->hasPages())

            <div class="px-5 py-4 border-t border-slate-200">

                {{ $guardians->links() }}

            </div>

        @endif

    </div>

</div>

@endsection