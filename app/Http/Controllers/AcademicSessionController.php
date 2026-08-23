<?php

namespace App\Http\Controllers;

use App\Models\AcademicSession;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AcademicSessionController extends Controller
{
    public function index()
    {
        $sessions = AcademicSession::with('branch')
            ->latest()
            ->paginate(15);

        return view('admin.academic.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view('admin.academic.sessions.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('academic_sessions', 'name')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $request->branch_id)
                    ),
            ],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('is_current')) {
            AcademicSession::where('branch_id', $request->branch_id)
                ->update(['is_current' => false]);
        }

        $validated['is_current'] = $request->boolean('is_current');
        $validated['status'] = $request->boolean('status');

        AcademicSession::create($validated);

        return redirect()
            ->route('admin.academic.sessions.index')
            ->with('success', 'Academic session created successfully.');
    }

    public function show(AcademicSession $session)
    {
        $session->load('branch');

        return view(
            'admin.academic.sessions.show',
            compact('session')
        );
    }

    public function edit(AcademicSession $session)
    {
        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.academic.sessions.edit',
            compact('session', 'branches')
        );
    }

    public function update(
        Request $request,
        AcademicSession $session
    ) {
        $validated = $request->validate([
            'branch_id' => ['required', 'exists:branches,id'],
            'name' => [
                'required',
                'string',
                'max:100',
                Rule::unique('academic_sessions', 'name')
                    ->where(fn ($query) =>
                        $query->where('branch_id', $request->branch_id)
                    )
                    ->ignore($session->id),
            ],
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            'is_current' => ['nullable', 'boolean'],
            'status' => ['nullable', 'boolean'],
        ]);

        if ($request->boolean('is_current')) {
            AcademicSession::where('branch_id', $request->branch_id)
                ->where('id', '!=', $session->id)
                ->update(['is_current' => false]);
        }

        $validated['is_current'] = $request->boolean('is_current');
        $validated['status'] = $request->boolean('status');

        $session->update($validated);

        return redirect()
            ->route('admin.academic.sessions.index')
            ->with('success', 'Academic session updated successfully.');
    }

    public function destroy(AcademicSession $session)
    {
        $session->delete();

        return redirect()
            ->route('admin.academic.sessions.index')
            ->with('success', 'Academic session deleted successfully.');
    }
}