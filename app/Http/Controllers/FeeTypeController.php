<?php

namespace App\Http\Controllers;

use App\Models\FeeType;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class FeeTypeController extends Controller
{
    /**
     * Display fee types.
     */
    public function index()
    {
        $feeTypes = FeeType::latest()->get();
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
     * Store fee type.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                'unique:fee_types,name',
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
                'unique:fee_types,code',
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
     * Show edit form.
     */
    public function edit(FeeType $feeType)
    {
        return view('admin.fee-types.edit', compact('feeType'));
    }


    /**
     * Update fee type.
     */
    public function update(Request $request, FeeType $feeType)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('fee_types', 'name')
                    ->ignore($feeType->id),
            ],

            'code' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('fee_types', 'code')
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
     * Delete fee type.
     */
    public function destroy(FeeType $feeType)
    {
        /*
        |--------------------------------------------------------------------------
        | Later, when student_fees table exists, we can prevent deletion
        | if this fee type has already been used.
        |--------------------------------------------------------------------------
        */

        $feeType->delete();

        return redirect()
            ->route('admin.fee-types.index')
            ->with('success', 'Fee type deleted successfully.');
    }

    //  Toggle status. 
    public function toggleStatus(FeeType $feeType)
    {
        $feeType->update([
            'status' => ! $feeType->status,
        ]);

        return back()->with(
            'success',
            'Fee type status updated successfully.'
        );
    }
}