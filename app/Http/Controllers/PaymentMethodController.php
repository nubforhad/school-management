<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PaymentMethodController extends Controller
{
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $paymentMethods = PaymentMethod::with('branch')
            ->where('branch_id', $branchId)
            ->when($request->search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%");
            })
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view( 'admin.payment-methods.index', compact('paymentMethods'));
    }

    public function create()
    {
        $branch = Branch::findOrFail(auth()->user()->branch_id);
        return view( 'admin.payment-methods.create', compact('branch'));
    }

    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('payment_methods', 'name')
                    ->where('branch_id', $branchId),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);
        $validated['branch_id'] = $branchId;
        PaymentMethod::create($validated);

        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method created successfully.');
    }

    public function edit(PaymentMethod $paymentMethod)
    {
        $this->checkBranch($paymentMethod);

        $branch = Branch::findOrFail(auth()->user()->branch_id);

        return view(
            'admin.payment-methods.edit',
            compact('paymentMethod', 'branch')
        );
    }

    public function update(Request $request, PaymentMethod $paymentMethod)
    {
        $this->checkBranch($paymentMethod);
        $branchId = auth()->user()->branch_id;
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('payment_methods', 'name')
                    ->where('branch_id', $branchId)
                    ->ignore($paymentMethod->id),
            ],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'boolean'],
        ]);

        $paymentMethod->update($validated);
        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method updated successfully.');
    }

    public function destroy(PaymentMethod $paymentMethod)
    {
        $this->checkBranch($paymentMethod);
        $paymentMethod->delete();
        return redirect()->route('admin.payment-methods.index')->with('success', 'Payment method deleted successfully.');
    }

    private function checkBranch(PaymentMethod $paymentMethod): void
    {
        abort_if(
            $paymentMethod->branch_id !== auth()->user()->branch_id,
            403
        );
    }
}