<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\IncomeCategory;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class IncomeCategoryController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $categories = IncomeCategory::with('branch')
            ->where('branch_id', $branchId)
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })->latest()->paginate(15)->withQueryString();
        return view('admin.income-categories.index', compact('categories'));
    }

    public function create()
    {
        $branchId = auth()->user()->branch_id;
        $branch = Branch::findOrFail($branchId);
        return view('admin.income-categories.create', compact('branch'));
    }

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('income_categories', 'name')
                    ->where('branch_id', $branchId),
            ],
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);
        $validated['branch_id'] = $branchId;
        IncomeCategory::create($validated);
        return redirect()->route('admin.income-categories.index')->with('success', 'Income category created successfully.');
    }

    public function edit(IncomeCategory $incomeCategory)
    {
        $this->checkBranch($incomeCategory);
        $branch = Branch::findOrFail(auth()->user()->branch_id);
        return view( 'admin.income-categories.edit', compact('incomeCategory', 'branch'));
    }

    public function update(Request $request, IncomeCategory $incomeCategory)
    {
        $this->checkBranch($incomeCategory);
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('income_categories', 'name')
                    ->where('branch_id', $branchId)
                    ->ignore($incomeCategory->id),
            ],
            'title' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $incomeCategory->update($validated);
        return redirect()->route('admin.income-categories.index')->with('success', 'Income category updated successfully.');
    }

    public function destroy(IncomeCategory $incomeCategory)
    {
        $this->checkBranch($incomeCategory);
        $incomeCategory->delete();
        return redirect()->route('admin.income-categories.index')->with('success', 'Income category deleted successfully.');
    }

    private function checkBranch(IncomeCategory $incomeCategory): void
    {
        abort_if(
            $incomeCategory->branch_id !== auth()->user()->branch_id,
            403
        );
    }
}