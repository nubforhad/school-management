<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Branch Selection
         

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
            $branch = Branch::find($branchId);
        }


        /*
        |--------------------------------------------------------------------------
        | Classes
        |--------------------------------------------------------------------------
        */

        $classesQuery = SchoolClass::query();

        if ($branchId) {
            $classesQuery->where('branch_id', $branchId);
        }

        $totalClasses = $classesQuery
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Sections
        |--------------------------------------------------------------------------
        */

        $sectionsQuery = Section::query();

        if ($branchId) {
            $sectionsQuery->where('branch_id', $branchId);
        }

        $totalSections = $sectionsQuery
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Subjects
        |--------------------------------------------------------------------------
        */

        $subjectsQuery = Subject::query();

        if ($branchId) {
            $subjectsQuery->where('branch_id', $branchId);
        }

        $totalSubjects = $subjectsQuery
            ->where('status', true)
            ->count();


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        |
        | Student model তৈরি হলে এখানে query add করব.
        |
        */

        $totalStudents = 0;
        $activeStudents = 0;


        //Teachers
         

        $totalTeachers = 0;
        $activeTeachers = 0;


        //Attendance
         

        $todayStudentAttendance = [
            'present' => 0,
            'absent'  => 0,
            'late'    => 0,
            'leave'   => 0,
        ];

        $todayTeacherAttendance = [
            'present' => 0,
            'absent'  => 0,
            'late'    => 0,
            'leave'   => 0,
        ];


        /*
        |--------------------------------------------------------------------------
        | Finance
        |--------------------------------------------------------------------------
        */

        $todayCollection = 0;
        $totalCollection = 0;
        $totalDue = 0;


        /*
        |--------------------------------------------------------------------------
        | Recent Data
        |--------------------------------------------------------------------------
        */

        $recentStudents = collect();

        $recentPayments = collect();


        return view(
            'admin.dashboard',
            compact(
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
                'totalDue',

                'recentStudents',
                'recentPayments'
            )
        );
    }
}