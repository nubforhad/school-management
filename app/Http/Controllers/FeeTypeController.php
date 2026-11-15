<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeeTypeController extends Controller
{
    /**
     * Check all branch access.
     */
    private function canAccessAllBranches(): bool
    {
        $user = auth()->user();
        return $user && $user->hasAnyRole([
            'Super Admin',
            'Admin',
        ]);
    }

    /**
     * Get current user's branch.
     */
    private function getBranchId()
    {
        $user = auth()->user();
        if (!$user) {
            abort(403, 'Unauthorized access.');
        }
        if (!$this->canAccessAllBranches() && !$user->branch_id) {
            abort(403, 'Your account is not assigned to any branch.');
        }
        return $user->branch_id;
    }

    /**
     * Fee Type List.
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }
        $allBranches = $this->canAccessAllBranches();
        $query = FeeType::with('branch');
        // Super Admin / Admin
        if ($allBranches) {

            if ($request->filled('branch_id')) {
                $query->where('branch_id', $request->branch_id);
            }

        } else {

            // Other users: Own branch only
            $query->where('branch_id', $this->getBranchId());
        }

        $feeTypes = $query
            ->latest()
            ->get();

        $branches = $allBranches
            ? Branch::orderBy('name')->get()
            : collect();

        return view(
            'admin.fee-types.index',
            compact('feeTypes', 'branches')
        );
    }

    /**
     * Create Form.
     */
    public function create()
    {
        $allBranches = $this->canAccessAllBranches();

        $branches = $allBranches
            ? Branch::orderBy('name')->get()
            : collect();

        return view(
            'admin.fee-types.create',
            compact('branches', 'allBranches')
        );
    }

    /**
     * Store Fee Type.
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized access.');
        }

        $allBranches = $this->canAccessAllBranches();

        $branchId = $allBranches
            ? $request->input('branch_id')
            : $this->getBranchId();

        $rules = [

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('fee_types', 'name')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('fee_types', 'code')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
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
        ];

        // Super Admin / Admin must select branch
        if ($allBranches) {
            $rules['branch_id'] = [
                'required',
                'integer',
                Rule::exists('branches', 'id'),
            ];
        }

        $validated = $request->validate($rules);

        FeeType::create([

            'branch_id' => $branchId,

            'name' => $validated['name'],

            'code' => $validated['code'] ?? null,

            'description' => $validated['description'] ?? null,

            'status' => $request->boolean('status', true),

        ]);

        return redirect()
            ->route('admin.fee-types.index')
            ->with('success', 'Fee type created successfully.');
    }

    /**
     * Edit Form.
     */
    public function edit(FeeType $feeType)
    {
        $this->authorizeBranch($feeType);

        return view(
            'admin.fee-types.edit',
            compact('feeType')
        );
    }

    /**
     * Update Fee Type.
     */
    public function update(Request $request, FeeType $feeType)
    {
        $this->authorizeBranch($feeType);

        // Existing fee type branch
        $branchId = $feeType->branch_id;

        $validated = $request->validate([

            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('fee_types', 'name')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    })
                    ->ignore($feeType->id),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('fee_types', 'code')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    })
                    ->ignore($feeType->id),
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

        $feeType->update([

            'name' => $validated['name'],

            'code' => $validated['code'] ?? null,

            'description' => $validated['description'] ?? null,

            'status' => $request->boolean('status'),

        ]);

        return redirect()
            ->route('admin.fee-types.index')
            ->with('success', 'Fee type updated successfully.');
    }

    /**
     * Delete Fee Type.
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
     * Toggle Status.
     */
    public function toggleStatus(FeeType $feeType)
    {
        $this->authorizeBranch($feeType);

        $feeType->update([
            'status' => !$feeType->status,
        ]);

        return back()->with(
            'success',
            'Fee type status updated successfully.'
        );
    }

    /**
     * Branch Authorization.
     */
    private function authorizeBranch(FeeType $feeType): void
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized access.');
        }

        // Super Admin / Admin can access all branches
        if ($this->canAccessAllBranches()) {
            return;
        }

        // Other users can access own branch only
        if (
            !$user->branch_id ||
            $feeType->branch_id != $user->branch_id
        ) {
            abort(403, 'Unauthorized access.');
        }
    }
}
