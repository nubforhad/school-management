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
     * Student Fee Assignment List
     */
    public function index(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $query = StudentFee::with([
            'student',
            'feeType',
            'academicSession',
            'branch',
        ])
            ->where('branch_id', $branchId);

        /*
        |--------------------------------------------------------------------------
        | Search Student
        |--------------------------------------------------------------------------
        */

        if ($request->filled('search')) {

            $search = $request->search;

            $query->whereHas('student', function ($q) use ($search) {

                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('student_id', 'like', "%{$search}%");
            });
        }

        /*
        |--------------------------------------------------------------------------
        | Fee Type Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('fee_type_id')) {

            $query->where(
                'fee_type_id',
                $request->fee_type_id
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Status Filter
        |--------------------------------------------------------------------------
        */

        if ($request->filled('status')) {

            $query->where(
                'status',
                $request->status
            );
        }

        $studentFees = $query
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $feeTypes = FeeType::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        return view(
            'admin.student-fees.index',
            compact(
                'studentFees',
                'feeTypes'
            )
        );
    }


    /**
     * Create Assignment
     */
    public function create()
    {
        $user = auth()->user();

        $branchId = $user->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $students = Student::where('branch_id', $branchId)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Fee Types
        |--------------------------------------------------------------------------
        */

        $feeTypes = FeeType::where('branch_id', $branchId)
            ->where('status', true)
            ->orderBy('name')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | Academic Sessions
        |--------------------------------------------------------------------------
        */

        $academicSessions = AcademicSession::where(
            'branch_id',
            $branchId
        )
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
     * Store Assignment
     */
    public function store(Request $request)
    {
        $user = auth()->user();

        $branchId = $user->branch_id;

        if (!$branchId) {
            abort(403, 'Your account is not assigned to any branch.');
        }

        $validated = $request->validate([

            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'fee_type_id' => [
                'required',
                'integer',
                Rule::exists('fee_types', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
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

        /*
        |--------------------------------------------------------------------------
        | Duplicate Check
        |--------------------------------------------------------------------------
        |
        | Same student + same fee type + same session + same month/year
        | should not accidentally be assigned twice.
        |
        */

        $exists = StudentFee::where('branch_id', $branchId)
            ->where('student_id', $validated['student_id'])
            ->where('fee_type_id', $validated['fee_type_id'])
            ->where(
                'academic_session_id',
                $validated['academic_session_id']
            )
            ->where('fee_month', $validated['fee_month'] ?? null)
            ->where('fee_year', $validated['fee_year'] ?? null)
            ->exists();

        if ($exists) {

            return back()
                ->withInput()
                ->withErrors([
                    'student_id' =>
                        'This fee has already been assigned to this student for the selected period.',
                ]);
        }

        StudentFee::create([

            'branch_id' => $branchId,

            'student_id' =>
                $validated['student_id'],

            'fee_type_id' =>
                $validated['fee_type_id'],

            'academic_session_id' =>
                $validated['academic_session_id'],

            'fee_month' =>
                $validated['fee_month'] ?? null,

            'fee_year' =>
                $validated['fee_year'] ?? null,

            'amount' =>
                $amount,

            'discount' =>
                $discount,

            'payable_amount' =>
                $payableAmount,

            'due_date' =>
                $validated['due_date'] ?? null,

            'status' =>
                'unpaid',

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('admin.student-fees.index')
            ->with(
                'success',
                'Student fee assigned successfully.'
            );
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
        $branchId = auth()->user()->branch_id;
        $students = Student::where('branch_id', $branchId)->orderBy('name')->get();
        $feeTypes = FeeType::where('branch_id', $branchId)->where('status', true)->orderBy('name')->get();
        $academicSessions = AcademicSession::where('branch_id',  $branchId )->orderByDesc('id')->get();

        return view( 'admin.student-fees.edit', compact(
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
    public function update(
        Request $request,
        StudentFee $studentFee
    ) {
        $this->authorizeBranch($studentFee);

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([

            'student_id' => [
                'required',
                'integer',
                Rule::exists('students', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'fee_type_id' => [
                'required',
                'integer',
                Rule::exists('fee_types', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
                    }),
            ],

            'academic_session_id' => [
                'required',
                'integer',
                Rule::exists('academic_sessions', 'id')
                    ->where(function ($query) use ($branchId) {
                        $query->where('branch_id', $branchId);
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

        $amount = (float) $validated['amount'];

        $discount = (float) ($validated['discount'] ?? 0);

        if ($discount > $amount) {

            return back()
                ->withInput()
                ->withErrors([
                    'discount' =>
                        'Discount cannot be greater than the fee amount.',
                ]);
        }

        $studentFee->update([

            'student_id' =>
                $validated['student_id'],

            'fee_type_id' =>
                $validated['fee_type_id'],

            'academic_session_id' =>
                $validated['academic_session_id'],

            'fee_month' =>
                $validated['fee_month'] ?? null,

            'fee_year' =>
                $validated['fee_year'] ?? null,

            'amount' =>
                $amount,

            'discount' =>
                $discount,

            'payable_amount' =>
                $amount - $discount,

            'due_date' =>
                $validated['due_date'] ?? null,

            'remarks' =>
                $validated['remarks'] ?? null,
        ]);

        return redirect()
            ->route('admin.student-fees.index')
            ->with(
                'success',
                'Student fee updated successfully.'
            );
    }


    /**
     * Delete Assignment
     */
    public function destroy(StudentFee $studentFee)
    {
        $this->authorizeBranch($studentFee);

        /*
        |--------------------------------------------------------------------------
        | Later:
        | If payment has already been collected,
        | deletion should be blocked.
        |--------------------------------------------------------------------------
        */

        $studentFee->delete();

        return redirect()
            ->route('admin.student-fees.index')
            ->with(
                'success',
                'Student fee deleted successfully.'
            );
    }


    /**
     * Branch Authorization
     */
    private function authorizeBranch(StudentFee $studentFee): void
    {
        $user = auth()->user();

        if (
            !$user ||
            !$user->branch_id ||
            $studentFee->branch_id != $user->branch_id
        ) {
            abort(403, 'Unauthorized access.');
        }
    }
}