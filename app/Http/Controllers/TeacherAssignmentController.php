<?php

namespace App\Http\Controllers;

use App\Models\TeacherAssignment;
use App\Models\TeacherStaff;
use App\Models\Branch;
use App\Models\Department;
use App\Models\Designation;
use App\Models\AcademicSession;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TeacherAssignmentController extends Controller
{
    /**
     * Display a listing of teacher assignments.
     */
    public function index(Request $request)
    {
        $teacherAssignments = TeacherAssignment::with([
            'branch',
            'academicSession',
            'teacherStaff',
            'schoolClass',
            'section',
            'subject',
        ])
        ->where('branch_id', auth()->user()->branch_id)
        ->when($request->teacher_staff_id, function ($query) use ($request) {
            $query->where('teacher_staff_id', $request->teacher_staff_id);
        })
        ->when($request->academic_session_id, function ($query) use ($request) {
            $query->where('academic_session_id', $request->academic_session_id);
        })
        ->when($request->school_class_id, function ($query) use ($request) {
            $query->where('school_class_id', $request->school_class_id);
        })
        ->when($request->section_id, function ($query) use ($request) {
            $query->where('section_id', $request->section_id);
        })
        ->when($request->subject_id, function ($query) use ($request) {
            $query->where('subject_id', $request->subject_id);
        })
        ->latest()
        ->paginate(15)
        ->withQueryString();

        $teachers = TeacherStaff::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        $academicSessions = AcademicSession::orderByDesc('id')->get();

        $classes = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $subjects = Subject::orderBy('name')->get();

        return view(
            'admin.teacher-assignment.index',
            compact(
                'teacherAssignments',
                'teachers',
                'academicSessions',
                'classes',
                'sections',
                'subjects'
            )
        );
    }

    /**
     * Show the form for creating a new assignment.
     */
    public function create()
    {
        $branches = Branch::where(
            'id',
            auth()->user()->branch_id
        )->get();

        $teachers = TeacherStaff::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        $academicSessions = AcademicSession::orderByDesc('id')->get();

        $classes = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $subjects = Subject::orderBy('name')->get();

        return view(
            'admin.teacher-assignment.create',
            compact(
                'branches',
                'teachers',
                'academicSessions',
                'classes',
                'sections',
                'subjects'
            )
        );
    }

    /**
     * Store a newly created assignment.
     */
    public function store(Request $request)
    {
        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'teacher_staff_id' => [
                'required',
                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'school_class_id' => [
                'required',
                'exists:classes,id',
            ],

            'section_id' => [
                'required',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'is_class_teacher' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['branch_id'] = $branchId;

        $validated['is_class_teacher'] =
            $request->boolean('is_class_teacher');

        $validated['status'] =
            $request->boolean('status');

        /*
        |--------------------------------------------------------------------------
        | Duplicate Assignment Check
        |--------------------------------------------------------------------------
        */
        $exists = TeacherAssignment::where([
            'branch_id' => $branchId,
            'academic_session_id' => $validated['academic_session_id'],
            'teacher_staff_id' => $validated['teacher_staff_id'],
            'school_class_id' => $validated['school_class_id'],
            'section_id' => $validated['section_id'],
            'subject_id' => $validated['subject_id'],
        ])->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'This teacher is already assigned to this class, section and subject.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Class Teacher Check
        |--------------------------------------------------------------------------
        */
        if ($validated['is_class_teacher']) {

            $classTeacherExists = TeacherAssignment::where([
                'branch_id' => $branchId,
                'academic_session_id' =>
                    $validated['academic_session_id'],
                'school_class_id' =>
                    $validated['school_class_id'],
                'section_id' =>
                    $validated['section_id'],
                'is_class_teacher' => true,
            ])->exists();

            if ($classTeacherExists) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'is_class_teacher' =>
                            'This class and section already has a class teacher.',
                    ]);
            }
        }

        TeacherAssignment::create($validated);

        return redirect()
            ->route('admin.teacher-assignment.index')
            ->with('success', 'Teacher assignment created successfully.');
    }

    /**
     * Display the specified assignment.
     */
    public function show(TeacherAssignment $teacherAssignment)
    {
        abort_unless(
            $teacherAssignment->branch_id === auth()->user()->branch_id,
            403
        );

        $teacherAssignment->load([
            'branch',
            'academicSession',
            'teacherStaff',
            'schoolClass',
            'section',
            'subject',
        ]);

        return view(
            'admin.teacher-assignment.show',
            compact('teacherAssignment')
        );
    }

    /**
     * Show the form for editing the assignment.
     */
    public function edit(TeacherAssignment $teacherAssignment)
    {
        abort_unless(
            $teacherAssignment->branch_id === auth()->user()->branch_id,
            403
        );

        $branches = Branch::where(
            'id',
            auth()->user()->branch_id
        )->get();

        $teachers = TeacherStaff::where(
            'branch_id',
            auth()->user()->branch_id
        )
        ->where('status', true)
        ->orderBy('name')
        ->get();

        $academicSessions = AcademicSession::orderByDesc('id')->get();

        $classes = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $subjects = Subject::orderBy('name')->get();

        return view(
            'admin.teacher-assignment.edit',
            compact(
                'teacherAssignment',
                'branches',
                'teachers',
                'academicSessions',
                'classes',
                'sections',
                'subjects'
            )
        );
    }

    /**
     * Update the specified assignment.
     */
    public function update(
        Request $request,
        TeacherAssignment $teacherAssignment
    ) {
        abort_unless(
            $teacherAssignment->branch_id === auth()->user()->branch_id,
            403
        );

        $branchId = auth()->user()->branch_id;

        $validated = $request->validate([
            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'teacher_staff_id' => [
                'required',
                Rule::exists('teacher_staff', 'id')
                    ->where('branch_id', $branchId),
            ],

            'school_class_id' => [
                'required',
                'exists:classes,id',
            ],

            'section_id' => [
                'required',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'is_class_teacher' => [
                'nullable',
                'boolean',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['branch_id'] = $branchId;

        $validated['is_class_teacher'] =
            $request->boolean('is_class_teacher');

        $validated['status'] =
            $request->boolean('status');

        /*
        |--------------------------------------------------------------------------
        | Duplicate Check
        |--------------------------------------------------------------------------
        */
        $exists = TeacherAssignment::where([
            'branch_id' => $branchId,
            'academic_session_id' =>
                $validated['academic_session_id'],
            'teacher_staff_id' =>
                $validated['teacher_staff_id'],
            'school_class_id' =>
                $validated['school_class_id'],
            'section_id' =>
                $validated['section_id'],
            'subject_id' =>
                $validated['subject_id'],
        ])
        ->where('id', '!=', $teacherAssignment->id)
        ->exists();

        if ($exists) {
            return back()
                ->withInput()
                ->withErrors([
                    'teacher_staff_id' =>
                        'This teacher is already assigned to this class, section and subject.',
                ]);
        }

        /*
        |--------------------------------------------------------------------------
        | Class Teacher Check
        |--------------------------------------------------------------------------
        */
        if ($validated['is_class_teacher']) {

            $classTeacherExists = TeacherAssignment::where([
                'branch_id' => $branchId,
                'academic_session_id' =>
                    $validated['academic_session_id'],
                'school_class_id' =>
                    $validated['school_class_id'],
                'section_id' =>
                    $validated['section_id'],
                'is_class_teacher' => true,
            ])
            ->where('id', '!=', $teacherAssignment->id)
            ->exists();

            if ($classTeacherExists) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'is_class_teacher' =>
                            'This class and section already has a class teacher.',
                    ]);
            }
        }

        $teacherAssignment->update($validated);

        return redirect()
            ->route('admin.teacher-assignment.index')
            ->with('success', 'Teacher assignment updated successfully.');
    }

    /**
     * Remove the specified assignment.
     */
    public function destroy(TeacherAssignment $teacherAssignment)
    {
        abort_unless(
            $teacherAssignment->branch_id === auth()->user()->branch_id,
            403
        );

        $teacherAssignment->delete();

        return redirect()
            ->route('admin.teacher-assignment.index')
            ->with('success', 'Teacher assignment deleted successfully.');
    }
} 
