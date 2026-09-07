<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Attendance;
use App\Models\FeePayment;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | Branches
        |--------------------------------------------------------------------------
        */

        $branches = Branch::where('status', true)
            ->orderBy('name')
            ->get();

        $branchId = $request->branch_id;

        /*
        |--------------------------------------------------------------------------
        | Selected Branch
        |--------------------------------------------------------------------------
        */

        $branch = null;

        if ($branchId) {
            $branch = Branch::where('status', true)
                ->find($branchId);
        }

        /*
        |--------------------------------------------------------------------------
        | Date
        |--------------------------------------------------------------------------
        */

        $today = Carbon::today();


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $studentQuery = Student::query();

        if ($branchId) {
            $studentQuery->where('branch_id', $branchId);
        }

        $totalStudents = (clone $studentQuery)->count();

        $activeStudents = (clone $studentQuery)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Teachers / Staff
        |--------------------------------------------------------------------------
        */

        $teacherQuery = TeacherStaff::query();

        if ($branchId) {
            $teacherQuery->where('branch_id', $branchId);
        }

        $totalTeachers = (clone $teacherQuery)->count();

        $activeTeachers = (clone $teacherQuery)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classQuery = SchoolClass::query();

        if ($branchId) {
            $classQuery->where('branch_id', $branchId);
        }

        $totalClasses = (clone $classQuery)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
        */

        $sectionQuery = Section::query();

        if ($branchId) {
            $sectionQuery->where('branch_id', $branchId);
        }

        $totalSections = (clone $sectionQuery)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */

        $subjectQuery = Subject::query();

        if ($branchId) {
            $subjectQuery->where('branch_id', $branchId);
        }

        $totalSubjects = (clone $subjectQuery)
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Student Attendance
        |--------------------------------------------------------------------------
        */

        $studentAttendanceQuery = Attendance::query()
            ->whereDate('date', $today);

        if ($branchId) {
            $studentAttendanceQuery->where('branch_id', $branchId);
        }

        $todayStudentAttendance = [
            'present' => (clone $studentAttendanceQuery)
                ->where('status', 'present')
                ->count(),

            'absent' => (clone $studentAttendanceQuery)
                ->where('status', 'absent')
                ->count(),

            'late' => (clone $studentAttendanceQuery)
                ->where('status', 'late')
                ->count(),

            'leave' => (clone $studentAttendanceQuery)
                ->where('status', 'leave')
                ->count(),
        ];


        /*
        |--------------------------------------------------------------------------
        | Teacher Attendance
        |--------------------------------------------------------------------------
        |
        | যদি Teacher/Staff-এর attendance আলাদা table-এ থাকে,
        | এখানে সেই model/table ব্যবহার করবেন।
        |
        */

        $todayTeacherAttendance = [
            'present' => 0,
            'absent'  => 0,
            'late'    => 0,
            'leave'   => 0,
        ];


        /*
        |--------------------------------------------------------------------------
        | Fee Payments
        |--------------------------------------------------------------------------
        */

        $paymentQuery = FeePayment::query();

        if ($branchId) {
            $paymentQuery->where('branch_id', $branchId);
        }


        /*
        | Today's Collection
        */

        $todayCollection = (clone $paymentQuery)
            ->whereDate(
                'payment_date',
                $today
            )
            ->sum('amount');


        /*
        | Total Collection
        */

        $totalCollection = (clone $paymentQuery)
            ->sum('amount');


        /*
        |--------------------------------------------------------------------------
        | Total Due
        |--------------------------------------------------------------------------
        |
        | যদি fee_payments table-এ due_amount থাকে,
        | সেটি ব্যবহার করা হবে।
        |
        */

        // $totalDue = (clone $paymentQuery)
        //     ->sum('due_amount');


        /*
        |--------------------------------------------------------------------------
        | Recent Students
        |--------------------------------------------------------------------------
        */

        $recentStudents = Student::query()
            ->when(
                $branchId,
                fn ($query) => $query->where('branch_id', $branchId)
            )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Recent Payments
        |--------------------------------------------------------------------------
        */

        $recentPayments = FeePayment::query()
            ->when(
                $branchId,
                fn ($query) => $query->where('branch_id', $branchId)
            )
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | Return Dashboard
        |--------------------------------------------------------------------------
        */

        return view('admin.dashboard', compact(

            'branches',
            'branch',
            'branchId',

            'totalStudents',
            'activeStudents',

            'totalTeachers',
            'activeTeachers',

            'totalClasses',
            'totalSections',
            'totalSubjects',

            'todayStudentAttendance',
            'todayTeacherAttendance',

            'todayCollection',
            'totalCollection',
            'recentStudents',
            'recentPayments'
        ));
    }
} 
