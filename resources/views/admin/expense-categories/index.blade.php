@extends('admin.layouts.app')

@section('title', 'Expense Categories')


<div class="p-4 sm:p-6">

{{-- Header --}}
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
    <div>
        <h1 class="text-xl sm:text-2xl font-bold text-slate-800">
            Expense Categories
        </h1>
        <p class="text-sm text-slate-500 mt-1">
            Manage your branch expense categories.
        </p>
    </div>

    <a href="{{ route('admin.expense-categories.create') }}"
       class="inline-flex items-center justify-center gap-2 px-4 py-2.5
              bg-blue-600 hover:bg-blue-700 text-white text-sm font-medium
              rounded-lg transition">
        <i class="bi bi-plus-lg"></i>
        Add Expense Category
    </a>
</div>

{{-- Success Message --}}
@if(session('success'))
    <div class="mb-5 flex items-center gap-3 rounded-lg border border-green-200
                bg-green-50 px-4 py-3 text-sm text-green-700">
        <i class="bi bi-check-circle-fill"></i>
        <span>{{ session('success') }}</span>
    </div>
@endif

{{-- Search --}}
<div class="bg-white border border-slate-200 rounded-xl p-4 mb-5">
    <form method="GET"
          action="{{ route('admin.expense-categories.index') }}"
          class="flex flex-col sm:flex-row gap-3">

        <div class="flex-1">
            <label for="search" class="sr-only">Search</label>

            <div class="relative">
                <i class="bi bi-search absolute left-3 top-1/2
                          -translate-y-1/2 text-slate-400"></i>

                <input
                    type="text"
                    id="search"
                    name="search"
                    value="{{ request('search') }}"
                    placeholder="Search expense category..."
                    class="w-full rounded-lg border border-slate-300
                           pl-10 pr-4 py-2.5 text-sm
                           focus:border-blue-500 focus:ring-blue-500"
                >
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center justify-center gap-2
                       px-5 py-2.5 bg-slate-800 hover:bg-slate-900
                       text-white text-sm font-medium rounded-lg transition">
            <i class="bi bi-search"></i>
            Search
        </button>

        @if(request('search'))
            <a href="{{ route('admin.expense-categories.index') }}"
               class="inline-flex items-center justify-center gap-2
                      px-5 py-2.5 bg-slate-100 hover:bg-slate-200
                      text-slate-700 text-sm font-medium rounded-lg transition">
                <i class="bi bi-x-lg"></i>
                Clear
            </a>
        @endif
    </form>
</div>

{{-- Table --}}
<div class="bg-white border border-slate-200 rounded-xl overflow-hidden">

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">

            <thead class="bg-slate-50 border-b border-slate-200">
                <tr>
                    <th class="px-5 py-3 font-semibold text-slate-600">
                        #
                    </th>

                    <th class="px-5 py-3 font-semibold text-slate-600">
                        Name
                    </th>

                    <th class="px-5 py-3 font-semibold text-slate-600">
                        Description
                    </th>

                    <th class="px-5 py-3 font-semibold text-slate-600">
                        Status
                    </th>

                    <th class="px-5 py-3 font-semibold text-slate-600 text-right">
                        Actions
                    </th>
                </tr>
            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($categories as $category)
                    <tr class="hover:bg-slate-50 transition">

                        <td class="px-5 py-4 text-slate-500">
                            {{ $categories->firstItem() + $loop->index }}
                        </td>

                        <td class="px-5 py-4">
                            <div class="font-medium text-slate-800">
                                {{ $category->name }}
                            </div>
                        </td>

                        <td class="px-5 py-4 text-slate-500">
                            {{ $category->description
                                ? Str::limit($category->description, 60)
                                : '—' }}
                        </td>

                        <td class="px-5 py-4">
                            @if($category->status)
                                <span class="inline-flex items-center gap-1.5
                                             px-2.5 py-1 rounded-full
                                             text-xs font-medium
                                             bg-green-50 text-green-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-green-500"></span>
                                    Active
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5
                                             px-2.5 py-1 rounded-full
                                             text-xs font-medium
                                             bg-red-50 text-red-700">
                                    <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                    Inactive
                                </span>
                            @endif
                        </td>

                        <td class="px-5 py-4">
                            <div class="flex items-center justify-end gap-2">

                                {{-- Show --}}
                                <a href="{{ route('admin.expense-categories.show', $category) }}"
                                   title="View"
                                   class="inline-flex items-center justify-center
                                          w-9 h-9 rounded-lg bg-blue-50
                                          text-blue-600 hover:bg-blue-100 transition">
                                    <i class="bi bi-eye"></i>
                                </a>

                                {{-- Edit --}}
                                <a href="{{ route('admin.expense-categories.edit', $category) }}"
                                   title="Edit"
                                   class="inline-flex items-center justify-center
                                          w-9 h-9 rounded-lg bg-amber-50
                                          text-amber-600 hover:bg-amber-100 transition">
                                    <i class="bi bi-pencil-square"></i>
                                </a>

                                {{-- Delete --}}
                                <form action="{{ route('admin.expense-categories.destroy', $category) }}"
                                      method="POST"
                                      class="delete-form">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            title="Delete"
                                            class="inline-flex items-center justify-center
                                                   w-9 h-9 rounded-lg bg-red-50
                                                   text-red-600 hover:bg-red-100 transition">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>

                            </div>
                        </td>

                    </tr>

                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center">

                            <div class="flex flex-col items-center justify-center">
                                <div class="w-12 h-12 rounded-full bg-slate-100
                                            flex items-center justify-center mb-3">
                                    <i class="bi bi-receipt text-xl text-slate-400"></i>
                                </div>

                                <h3 class="text-sm font-semibold text-slate-700">
                                    No Expense Categories Found
                                </h3>

                                <p class="text-sm text-slate-500 mt-1">
                                    Add your first expense category.
                                </p>

                                <a href="{{ route('admin.expense-categories.create') }}"
                                   class="mt-4 inline-flex items-center gap-2
                                          px-4 py-2 bg-blue-600 hover:bg-blue-700
                                          text-white text-sm font-medium rounded-lg">
                                    <i class="bi bi-plus-lg"></i>
                                    Add Category
                                </a>
                            </div>

                        </td>
                    </tr>
                @endforelse

            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    @if($categories->hasPages())
        <div class="px-5 py-4 border-t border-slate-200">
            {{ $categories->links() }}
        </div>
    @endif

</div> 

</div>

{{-- SweetAlert Delete --}}

<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.delete-form').forEach(function (form) {

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            Swal.fire({
                title: 'Delete Expense Category?',
                text: 'This action cannot be undone.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc2626',
                cancelButtonColor: '#64748b',
                confirmButtonText: 'Yes, Delete',
                cancelButtonText: 'Cancel'
            }).then((result) => {

                if (result.isConfirmed) {
                    form.submit();
                }

            });
        });

    });

});
</script>

@endsection
