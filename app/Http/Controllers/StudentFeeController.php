<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentFee;
use App\Models\FeeType;
use App\Models\AcademicSession;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentFeeController extends Controller
{
    /**
     * Check whether user can access all branches.
     */
    private function canAccessAllBranches(): bool
    {
        return auth()->user()->hasAnyRole([
            'Super Admin',
            'Admin',
        ]);
    }

    /**
     * Get current user branch ID.
     */
    private function getUserBranchId()
    {
        $user = auth()->user();

        if (!$this->canAccessAllBranches() && !$user->branch_id) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        return $user->branch_id;
    }

    /**
     * Student Fee Assignment List
     */
    public function index(Request $request)
    {
        $user = auth()->user();
        $allBranches = $this->canAccessAllBranches();

        $query = StudentFee::with([
            'student',
            'feeType',
            'academicSession',
            'branch',
        ]);

        // Branch restriction
        if (!$allBranches) {
            $query->where('branch_id', $this->getUserBranchId());
        } elseif ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        // Student Search
        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('student', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        // Fee Type Filter
        if ($request->filled('fee_type_id')) {
            $query->where('fee_type_id', $request->fee_type_id);
        }

        // Status Filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $studentFees = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $feeTypes = FeeType::query()
            ->when(!$allBranches, function ($q) use ($user) {
                $q->where('branch_id', $user->branch_id);
            })
            ->when(
                $allBranches && $request->filled('branch_id'),
                function ($q) use ($request) {
                    $q->where('branch_id', $request->branch_id);
                }
            )
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.student-fees.index',
            compact('studentFees', 'feeTypes')
        );
    }

    /**
     * Create Assignment
     */
    public function create()
    {
        $user = auth()->user();
        $allBranches = $this->canAccessAllBranches();

        $branchId = $this->getUserBranchId();

        $students = Student::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->orderBy('name')
            ->get();

        $feeTypes = FeeType::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.student-fees.create',
            compact(
                'students',
                'feeTypes',
                'academicSessions'
            )
        );
    }

    /**
     * Validate student, fee type and academic session
     * must belong to the same branch.
     */
    private function validateRelatedBranch(array $validated): int
    {
        $student = Student::findOrFail($validated['student_id']);

        $branchId = $student->branch_id;

        // Non-privileged users can only use their own branch
        if (
            !$this->canAccessAllBranches() &&
            $branchId != auth()->user()->branch_id
        ) {
            abort(403, 'Unauthorized branch access.');
        }

        $feeType = FeeType::findOrFail($validated['fee_type_id']);

        $academicSession = AcademicSession::findOrFail(
            $validated['academic_session_id']
        );

        if ($feeType->branch_id != $branchId) {
            abort(422, 'Selected fee type does not belong to the student branch.');
        }

        if ($academicSession->branch_id != $branchId) {
            abort(422, 'Selected academic session does not belong to the student branch.');
        }

        return $branchId;
    }

    /**
     * Store Assignment
     */
    public function store(Request $request)
    {
        $user = auth()->user();
        $allBranches = $this->canAccessAllBranches();

        $branchId = $this->getUserBranchId();

        $validated = $request->validate([

            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'fee_type_id' => [
                'required',
                'integer',
                Rule::exists('fee_types', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'fee_month' => [
                'nullable',
                'integer',
                'between:1,12',
            ],

            'fee_year' => [
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'due_date' => [
                'nullable',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        // Verify same branch
        $branchId = $this->validateRelatedBranch($validated);

        $amount = (float) $validated['amount'];
        $discount = (float) ($validated['discount'] ?? 0);

        if ($discount > $amount) {
            return back()
                ->withInput()
                ->withErrors([
                    'discount' => 'Discount cannot be greater than the fee amount.',
                ]);
        }

        $payableAmount = $amount - $discount;

        // Duplicate Check
        $exists = StudentFee::where('branch_id', $branchId)
            ->where('student_id', $validated['student_id'])
            ->where('fee_type_id', $validated['fee_type_id'])
            ->where('academic_session_id', $validated['academic_session_id'])
            ->where('fee_month', $validated['fee_month'] ?? null)
            ->where('fee_year', $validated['fee_year'] ?? null)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' => 'This fee has already been assigned to this student for the selected period.',
                ]);
        }

        StudentFee::create([

            'branch_id' => $branchId,

            'student_id' => $validated['student_id'],

            'fee_type_id' => $validated['fee_type_id'],

            'academic_session_id' => $validated['academic_session_id'],

            'fee_month' => $validated['fee_month'] ?? null,

            'fee_year' => $validated['fee_year'] ?? null,

            'amount' => $amount,

            'discount' => $discount,

            'payable_amount' => $payableAmount,

            'due_date' => $validated['due_date'] ?? null,

            'status' => 'unpaid',

            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('admin.student-fees.index')
            ->with('success', 'Student fee assigned successfully.');
    }

    /**
     * Show Assignment
     */
    public function show(StudentFee $studentFee)
    {
        $this->authorizeBranch($studentFee);

        $studentFee->load([
            'student',
            'feeType',
            'academicSession',
            'branch',
        ]);

        return view(
            'admin.student-fees.show',
            compact('studentFee')
        );
    }

    /**
     * Edit Assignment
     */
    public function edit(StudentFee $studentFee)
    {
        $this->authorizeBranch($studentFee);

        $user = auth()->user();
        $allBranches = $this->canAccessAllBranches();

        $branchId = $this->getUserBranchId();

        $students = Student::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->orderBy('name')
            ->get();

        $feeTypes = FeeType::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->where('status', true)
            ->orderBy('name')
            ->get();

        $academicSessions = AcademicSession::query()
            ->when(!$allBranches, function ($q) use ($branchId) {
                $q->where('branch_id', $branchId);
            })
            ->orderByDesc('id')
            ->get();

        return view(
            'admin.student-fees.edit',
            compact(
                'studentFee',
                'students',
                'feeTypes',
                'academicSessions'
            )
        );
    }

    /**
     * Update Assignment
     */
    public function update(Request $request, StudentFee $studentFee)
    {
        $this->authorizeBranch($studentFee);

        $user = auth()->user();
        $allBranches = $this->canAccessAllBranches();

        $branchId = $this->getUserBranchId();

        $validated = $request->validate([

            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'fee_type_id' => [
                'required',
                'integer',
                Rule::exists('fee_types', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id')
                    ->when(!$allBranches, function ($rule) use ($branchId) {
                        $rule->where('branch_id', $branchId);
                    }),
            ],

            'fee_month' => [
                'nullable',
                'integer',
                'between:1,12',
            ],

            'fee_year' => [
                'nullable',
                'integer',
                'min:2000',
                'max:2100',
            ],

            'amount' => [
                'required',
                'numeric',
                'min:0',
            ],

            'discount' => [
                'nullable',
                'numeric',
                'min:0',
            ],

            'due_date' => [
                'nullable',
                'date',
            ],

            'remarks' => [
                'nullable',
                'string',
                'max:1000',
            ],
        ]);

        // Verify same branch
        $branchId = $this->validateRelatedBranch($validated);

        $amount = (float) $validated['amount'];
        $discount = (float) ($validated['discount'] ?? 0);

        if ($discount > $amount) {
            return back()
                ->withInput()
                ->withErrors([
                    'discount' => 'Discount cannot be greater than the fee amount.',
                ]);
        }

        // Duplicate Check (excluding current record)
        $exists = StudentFee::where('branch_id', $branchId)
            ->where('student_id', $validated['student_id'])
            ->where('fee_type_id', $validated['fee_type_id'])
            ->where('academic_session_id', $validated['academic_session_id'])
            ->where('fee_month', $validated['fee_month'] ?? null)
            ->where('fee_year', $validated['fee_year'] ?? null)
            ->where('id', '!=', $studentFee->id)
            ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'student_id' => 'This fee has already been assigned to this student for the selected period.',
                ]);
        }

        $studentFee->update([

            'branch_id' => $branchId,

            'student_id' => $validated['student_id'],

            'fee_type_id' => $validated['fee_type_id'],

            'academic_session_id' => $validated['academic_session_id'],

            'fee_month' => $validated['fee_month'] ?? null,

            'fee_year' => $validated['fee_year'] ?? null,

            'amount' => $amount,

            'discount' => $discount,

            'payable_amount' => $amount - $discount,

            'due_date' => $validated['due_date'] ?? null,

            'remarks' => $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('admin.student-fees.index')
            ->with('success', 'Student fee updated successfully.');
    }

    /**
     * Delete Assignment
     */
    public function destroy(StudentFee $studentFee)
    {
        $this->authorizeBranch($studentFee);

        $studentFee->delete();

        return redirect()
            ->route('admin.student-fees.index')
            ->with('success', 'Student fee deleted successfully.');
    }

    /**
     * Branch Authorization
     */
    private function authorizeBranch(StudentFee $studentFee): void
    {
        $user = auth()->user();

        if (!$user) {
            abort(403, 'Unauthorized access.');
        }
        // Super Admin and Admin: All branches
        if ($this->canAccessAllBranches()) {
            return;
        }

        // Other users: Own branch only
        if (
            !$user->branch_id ||
            $studentFee->branch_id != $user->branch_id
        ) {
            abort(403, 'Unauthorized access.');
        }
    }
}
