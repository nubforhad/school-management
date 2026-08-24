<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeeTypeController extends Controller
{
    /**
     * Display fee types - branch wise.
     */
    public function index()
    {
        $user = auth()->user();
        // User login করা না থাকলে
        if (!$user) {
            return redirect()
                ->route('login')
                ->with('error', 'Please login first.');
        }
        // User-এর branch না থাকলে
        if (!$user->branch_id) {
            return redirect()
                ->route('dashboard')
                ->with('error', 'Your account is not assigned to any branch.');
        }
        $feeTypes = FeeType::with('branch')
            ->where('branch_id', $user->branch_id)
            ->latest()
            ->get();
        return view('admin.fee-types.index', compact('feeTypes'));
    }

    /**
     * Show create form.
     */
    public function create()
    {
        return view('admin.fee-types.create');
    }

    /**
     * Store fee type - current user's branch.
     */
    public function store(Request $request)
{
    $branchId = auth()->user()->branch_id;

    // User-এর branch না থাকলে
    if (!$branchId) {
        return back()
            ->withInput()
            ->with('error', 'Your account is not assigned to any branch.');
    }

    $validated = $request->validate([

        'name' => [
            'required',
            'string',
            'max:100',

            Rule::unique('fee_types', 'name')
                ->where(function ($query) use ($branchId) {
                    return $query->where('branch_id', $branchId);
                }),
        ],

        'code' => [
            'nullable',
            'string',
            'max:50',

            Rule::unique('fee_types', 'code')
                ->where(function ($query) use ($branchId) {
                    return $query->where('branch_id', $branchId);
                }),
        ],

        'description' => [
            'nullable',
            'string',
            'max:1000',
        ],

        'status' => [
            'nullable',
            'boolean',
        ],
    ]);


    FeeType::create([
        'branch_id'  => $branchId,
        'name'       => $validated['name'],
        'code'       => $validated['code'] ?? null,
        'description'=> $validated['description'] ?? null,
        'status'     => $request->boolean('status', true),
    ]);


    return redirect()
        ->route('admin.fee-types.index')
        ->with('success', 'Fee type created successfully.');
}
    /**
     * Show edit form.
     */
    public function edit(FeeType $feeType)
    {
        $this->authorizeBranch($feeType);
        return view('admin.fee-types.edit', compact('feeType'));
    }

    /**
     * Update fee type.
     */
    public function update(Request $request, FeeType $feeType)
    {
        $this->authorizeBranch($feeType);
        $user = auth()->user();
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('fee_types', 'name')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $user->branch_id)
                    )
                    ->ignore($feeType->id),
            ],
            'code' => ['nullable', 'string', 'max:50',
                Rule::unique('fee_types', 'code')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $user->branch_id)
                    )
                    ->ignore($feeType->id),
            ],
            'description' => [  'nullable',  'string',  'max:1000',  ],
            'status' => [  'nullable', 'boolean',],
        ]);

        $feeType->update([
            'name' => $validated['name'],
            'code' => $validated['code'] ?? null,
            'description' => $validated['description'] ?? null,
            'status' => $request->boolean('status'),
        ]);

        return redirect()->route('admin.fee-types.index')->with('success', 'Fee type updated successfully.');
    }

    /**
     * Delete fee type.
     */
    public function destroy(FeeType $feeType)
    {
        $this->authorizeBranch($feeType);

        $feeType->delete();

        return redirect()
            ->route('admin.fee-types.index')
            ->with('success', 'Fee type deleted successfully.');
    }

    /**
     * Toggle status.
     */
    public function toggleStatus(FeeType $feeType)
    {
        $this->authorizeBranch($feeType);

        $feeType->update([
            'status' => ! $feeType->status,
        ]);

        return back()->with(
            'success',
            'Fee type status updated successfully.'
        );
    }

    /**
     * Ensure fee type belongs to current user's branch.
     */
    private function authorizeBranch(FeeType $feeType): void
    {
        $user = auth()->user();

        if (!$user || $feeType->branch_id != $user->branch_id) {
            abort(403, 'Unauthorized access.');
        }
    }
}