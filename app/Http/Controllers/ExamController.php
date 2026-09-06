<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AcademicSession;
use App\Models\Exam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ExamController extends Controller
{
    /**
     * Display a listing of exams.
     */
    public function index(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $exams = Exam::with('academicSession')
            ->where('branch_id', $branchId)
            ->when($request->filled('search'), function ($query) use ($request) {
                $search = $request->search;

                $query->where(function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%")
                        ->orWhere('code', 'like', "%{$search}%");
                });
            })
            ->when(
                $request->filled('academic_session_id'),
                function ($query) use ($request) {
                    $query->where(
                        'academic_session_id',
                        $request->academic_session_id
                    );
                }
            )
            ->when(
                $request->filled('status'),
                function ($query) use ($request) {
                    $query->where('status', $request->status);
                }
            )
            ->latest()
            ->paginate(15)
            ->withQueryString();

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.exams.index', compact(
            'exams',
            'academicSessions'
        ));
    }

    /**
     * Show the form for creating a new exam.
     */
    public function create()
    {
        $branchId = Auth::user()->branch_id;

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.exams.create', compact(
            'academicSessions',
            'branchId'
        ));
    }

    /**
     * Store a newly created exam.
     */
    public function store(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $validated = $request->validate([
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('exams', 'code')
                    ->where(function ($query) use ($branchId) {
                        return $query->where('branch_id', $branchId);
                    }),
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
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

        $validated['branch_id'] = $branchId;
        $validated['status'] = $request->boolean('status');

        Exam::create($validated);

        return redirect()
            ->route('admin.exams.index')
            ->with('success', 'Exam created successfully.');
    }

    /**
     * Display the specified exam.
     */
    public function show(Exam $exam)
    {
        $this->checkBranch($exam);

        $exam->load([
            'academicSession',
            'schedules',
        ]);

        return view('admin.exams.show', compact('exam'));
    }

    /**
     * Show the form for editing the specified exam.
     */
    public function edit(Exam $exam)
    {
        $this->checkBranch($exam);

        $academicSessions = AcademicSession::query()
            ->orderByDesc('id')
            ->get();

        return view('admin.exams.edit', compact(
            'exam',
            'academicSessions'
        ));
    }

    /**
     * Update the specified exam.
     */
    public function update(Request $request, Exam $exam)
    {
        $this->checkBranch($exam);

        $branchId = Auth::user()->branch_id;

        $validated = $request->validate([
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'code' => [
                'nullable',
                'string',
                'max:100',
                Rule::unique('exams', 'code')
                    ->ignore($exam->id)
                    ->where(function ($query) use ($branchId) {
                        return $query->where('branch_id', $branchId);
                    }),
            ],

            'start_date' => [
                'nullable',
                'date',
            ],

            'end_date' => [
                'nullable',
                'date',
                'after_or_equal:start_date',
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

        $validated['status'] = $request->boolean('status');

        $exam->update($validated);

        return redirect()
            ->route('admin.exams.index')
            ->with('success', 'Exam updated successfully.');
    }

    /**
     * Remove the specified exam.
     */
    public function destroy(Exam $exam)
    {
        $this->checkBranch($exam);

        $exam->delete();

        return redirect()
            ->route('admin.exams.index')
            ->with('success', 'Exam deleted successfully.');
    }

    /**
     * Check branch access.
     */
    private function checkBranch(Exam $exam): void
    {
        abort_if(
            $exam->branch_id !== Auth::user()->branch_id,
            403
        );
    }
}