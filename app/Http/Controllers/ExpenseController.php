<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $expenses = Expense::with('category')
            ->where('branch_id', $branchId)

            ->when($request->search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('reference_no', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%")
                        ->orWhereHas('category', function ($categoryQuery) use ($search) {
                            $categoryQuery->where('name', 'like', "%{$search}%");
                        });
                });
            })

            ->when($request->category_id, function ($query, $categoryId) use ($branchId) {
                $query->whereHas('category', function ($categoryQuery) use ($categoryId, $branchId) {
                    $categoryQuery
                        ->where('id', $categoryId)
                        ->where('branch_id', $branchId);
                });
            })

            ->when($request->payment_method, function ($query, $paymentMethod) {
                $query->where('payment_method', $paymentMethod);
            })

            ->when($request->status !== null && $request->status !== '', function ($query) use ($request) {
                $query->where('status', $request->status);
            })

            ->when($request->date_from, function ($query, $dateFrom) {
                $query->whereDate('expense_date', '>=', $dateFrom);
            })

            ->when($request->date_to, function ($query, $dateTo) {
                $query->whereDate('expense_date', '<=', $dateTo);
            })

            ->latest('expense_date')
            ->latest('id')
            ->paginate(15)
            ->withQueryString();

        $categories = ExpenseCategory::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.expenses.index', compact(
            'expenses',
            'categories'
        ));
    }

    public function create()
    {
        $branchId = auth()->user()->branch_id;

        $categories = ExpenseCategory::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.expenses.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'expense_category_id' => [
                'required',
                'integer',
                Rule::exists('expense_categories', 'id')
                    ->where('branch_id', $branchId)
                    ->where('status', true),
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_method' => [
                'required',
                'string',
                Rule::in([
                    'cash',
                    'bank',
                    'mobile_banking',
                    'cheque',
                    'other',
                ]),
            ],

            'reference_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        Expense::create([
            'branch_id' => $branchId,
            'expense_category_id' => $validated['expense_category_id'],
            'expense_date' => $validated['expense_date'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference_no' => $validated['reference_no'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
            'created_by' => auth()->id(),
        ]);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense created successfully.');
    }

    public function show(Expense $expense)
    {
        abort_unless(
            $expense->branch_id === auth()->user()->branch_id,
            403
        );

        $expense->load([
            'category',
            'creator',
        ]);

        return view('admin.expenses.show', compact('expense'));
    }

    public function edit(Expense $expense)
    {
        abort_unless(
            $expense->branch_id === auth()->user()->branch_id,
            403
        );

        $branchId = auth()->user()->branch_id;

        $categories = ExpenseCategory::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        /*
         * If the current category was made inactive,
         * still include it in the edit form.
         */
        if (
            $expense->category &&
            !$categories->contains('id', $expense->expense_category_id)
        ) {
            $categories->push($expense->category);
            $categories = $categories->sortBy('name')->values();
        }

        return view('admin.expenses.edit', compact(
            'expense',
            'categories'
        ));
    }

    public function update(Request $request, Expense $expense)
    {
        abort_unless(
            $expense->branch_id === auth()->user()->branch_id,
            403
        );

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'expense_category_id' => [
                'required',
                'integer',
                Rule::exists('expense_categories', 'id')
                    ->where('branch_id', $branchId),
            ],

            'expense_date' => [
                'required',
                'date',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0.01',
            ],

            'payment_method' => [
                'required',
                'string',
                Rule::in([
                    'cash',
                    'bank',
                    'mobile_banking',
                    'cheque',
                    'other',
                ]),
            ],

            'reference_no' => [
                'nullable',
                'string',
                'max:255',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'required',
                'boolean',
            ],
        ]);

        $expense->update([
            'expense_category_id' => $validated['expense_category_id'],
            'expense_date' => $validated['expense_date'],
            'amount' => $validated['amount'],
            'payment_method' => $validated['payment_method'],
            'reference_no' => $validated['reference_no'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $validated['status'],
        ]);

        return redirect()
            ->route('admin.expenses.index')
            ->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense)
    {
        abort_unless(
            $expense->branch_id === auth()->user()->branch_id,
            403
        );

        DB::transaction(function () use ($expense) {
            $expense->delete();
        });
        return redirect()->route('admin.expenses.index')->with('success', 'Expense deleted successfully.');
    }
}
