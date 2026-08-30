<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class DepartmentController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $user = auth()->user();

        $departments = Department::with('branch')
            ->when(
                $user->branch_id,
                fn ($query) => $query->where(
                    'branch_id',
                    $user->branch_id
                )
            )
            ->latest()
            ->paginate(15);

        return view(
            'admin.departments.index',
            compact('departments')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        $user = auth()->user();

        $branches = Branch::when(
            $user->branch_id,
            fn ($query) => $query->where(
                'id',
                $user->branch_id
            )
        )
        ->orderBy('name')
        ->get();

        return view(
            'admin.departments.create',
            compact('branches')
        );
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('departments', 'name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    }),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        // Branch manager/user cannot create department for another branch
        if (
            $user->branch_id &&
            $validated['branch_id'] != $user->branch_id
        ) {
            abort(403);
        }

        $validated['status'] = $request->boolean('status');

        Department::create($validated);

        return redirect()
            ->route('admin.departments.index')
            ->with(
                'success',
                'Department created successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit(Department $department)
    {
        $user = auth()->user();

        if (
            $user->branch_id &&
            $department->branch_id != $user->branch_id
        ) {
            abort(403);
        }

        $branches = Branch::when(
            $user->branch_id,
            fn ($query) => $query->where(
                'id',
                $user->branch_id
            )
        )
        ->orderBy('name')
        ->get();

        return view(
            'admin.departments.edit',
            compact(
                'department',
                'branches'
            )
        );
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Department $department
    ) {
        $user = auth()->user();

        if (
            $user->branch_id &&
            $department->branch_id != $user->branch_id
        ) {
            abort(403);
        }

        $validated = $request->validate([
            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'name' => [
                'required',
                'string',
                'max:100',

                Rule::unique('departments', 'name')
                    ->where(function ($query) use ($request) {
                        return $query->where(
                            'branch_id',
                            $request->branch_id
                        );
                    })
                    ->ignore($department->id),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
            ],

            'description' => [
                'nullable',
                'string',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        if (
            $user->branch_id &&
            $validated['branch_id'] != $user->branch_id
        ) {
            abort(403);
        }

        $validated['status'] = $request->boolean('status');

        $department->update($validated);

        return redirect()
            ->route('admin.departments.index')
            ->with(
                'success',
                'Department updated successfully.'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(Department $department)
    {
        $user = auth()->user();

        if (
            $user->branch_id &&
            $department->branch_id != $user->branch_id
        ) {
            abort(403);
        }

        $department->delete();

        return redirect()
            ->route('admin.departments.index')
            ->with(
                'success',
                'Department deleted successfully.'
            );
    }
}