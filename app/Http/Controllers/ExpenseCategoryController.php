<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ExpenseCategoryController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $categories = ExpenseCategory::where('branch_id', $branchId)
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.expense-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.expense-categories.create');
    }

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('expense_categories', 'name')
                    ->where('branch_id', $branchId),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        ExpenseCategory::create([
            'branch_id' => $branchId,
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.expense-categories.index')
            ->with('success', 'Expense category created successfully.');
    }

    public function show(ExpenseCategory $expenseCategory)
    {
        abort_unless(
            $expenseCategory->branch_id === auth()->user()->branch_id,
            403
        );
        return view('admin.expense-categories.show', compact('expenseCategory'));
    }

    public function edit(ExpenseCategory $expenseCategory)
    {
        abort_unless(
            $expenseCategory->branch_id === auth()->user()->branch_id,
            403
        );
        return view('admin.expense-categories.edit', compact('expenseCategory'));
    }

    public function update(Request $request, ExpenseCategory $expenseCategory)
    {
        abort_unless(
            $expenseCategory->branch_id === auth()->user()->branch_id,
            403
        );
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('expense_categories', 'name')
                    ->where('branch_id', $branchId)
                    ->ignore($expenseCategory->id),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $expenseCategory->update([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.expense-categories.index')
            ->with('success', 'Expense category updated successfully.');
    }

    public function destroy(ExpenseCategory $expenseCategory)
    {
        abort_unless(
            $expenseCategory->branch_id === auth()->user()->branch_id,
            403
        );
        $expenseCategory->delete();
        return redirect()->route('admin.expense-categories.index')->with('success', 'Expense category deleted successfully.');
    }
}