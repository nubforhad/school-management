<?php

namespace App\Http\Controllers;

use App\Models\ClassRoutine;
use App\Models\Branch;
use App\Models\AcademicSession;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Subject;
use App\Models\TeacherStaff;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


class ClassRoutineController extends Controller
{
    /**
     * Display routine list.
     */
    public function index(Request $request)
    {
        $query = ClassRoutine::with([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
            'teacher',
        ]);

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('room', 'like', "%{$search}%")
                    ->orWhereHas('subject', function ($subject) use ($search) {
                        $subject->where('name', 'like', "%{$search}%");
                    })
                    ->orWhereHas('teacher', function ($teacher) use ($search) {
                        $teacher->where('name', 'like', "%{$search}%");
                    });

            });
        }

        // Branch filter
        if ($request->filled('branch_id')) {
            $query->where('branch_id', $request->branch_id);
        }

        // Academic Session filter
        if ($request->filled('academic_session_id')) {
            $query->where(
                'academic_session_id',
                $request->academic_session_id
            );
        }

        // Class filter
        if ($request->filled('school_class_id')) {
            $query->where(
                'school_class_id',
                $request->school_class_id
            );
        }

        // Section filter
        if ($request->filled('section_id')) {
            $query->where(
                'section_id',
                $request->section_id
            );
        }

        // Day filter
        if ($request->filled('day')) {
            $query->where('day', $request->day);
        }

        // Status filter
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $routines = $query
            ->orderByRaw("
                FIELD(
                    day,
                    'Saturday',
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday'
                )
            ")
            ->orderBy('start_time')
            ->paginate(20)
            ->withQueryString();

        $branches = Branch::orderBy('name')->get();

        $academicSessions = AcademicSession::latest()->get();

        $schoolClasses = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        return view(
            'admin.class-routines.index',
            compact(
                'routines',
                'branches',
                'academicSessions',
                'schoolClasses',
                'sections'
            )
        );
    }


    /**
     * Show create form.
     */
    public function create()
    {
        $branches = Branch::orderBy('name')->get();
        $academicSessions = AcademicSession::latest()->get();
        $schoolClasses = SchoolClass::orderBy('name')->get();
        $sections = Section::orderBy('name')->get();
        $subjects = Subject::orderBy('name')->get();
        $teachers = TeacherStaff::orderBy('name')->get();
        return view('admin.class-routines.create',  compact(
                'branches',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects',
                'teachers'
            )
        );
    }


    /**
     * Store routine.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'section_id' => [
                'required',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'teacher_id' => [
                'required',
                'exists:teachers,id',
            ],

            'day' => [
                'required',
                Rule::in([
                    'Saturday',
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                ]),
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean(
            'status',
            true
        );

        ClassRoutine::create($validated);

        return redirect()
            ->route('admin.class-routines.index')
            ->with(
                'success',
                'Class routine created successfully.'
            );
    }


    /**
     * Display routine details.
     */
    public function show(ClassRoutine $classRoutine)
    {
        $classRoutine->load([
            'branch',
            'academicSession',
            'schoolClass',
            'section',
            'subject',
            'teacher',
        ]);

        return view(
            'admin.class-routines.show',
            compact('classRoutine')
        );
    }


    /**
     * Show edit form.
     */
    public function edit(ClassRoutine $classRoutine)
    {
        $branches = Branch::orderBy('name')->get();

        $academicSessions = AcademicSession::latest()->get();

        $schoolClasses = SchoolClass::orderBy('name')->get();

        $sections = Section::orderBy('name')->get();

        $subjects = Subject::orderBy('name')->get();

        $teachers = TeacherStaff::orderBy('name')->get();

        return view(
            'admin.class-routines.edit',
            compact(
                'classRoutine',
                'branches',
                'academicSessions',
                'schoolClasses',
                'sections',
                'subjects',
                'teachers'
            )
        );
    }


    /**
     * Update routine.
     */
    public function update(
        Request $request,
        ClassRoutine $classRoutine
    ) {
        $validated = $request->validate([

            'branch_id' => [
                'required',
                'exists:branches,id',
            ],

            'academic_session_id' => [
                'required',
                'exists:academic_sessions,id',
            ],

            'school_class_id' => [
                'required',
                'exists:school_classes,id',
            ],

            'section_id' => [
                'required',
                'exists:sections,id',
            ],

            'subject_id' => [
                'required',
                'exists:subjects,id',
            ],

            'teacher_id' => [
                'required',
                'exists:teachers,id',
            ],

            'day' => [
                'required',
                Rule::in([
                    'Saturday',
                    'Sunday',
                    'Monday',
                    'Tuesday',
                    'Wednesday',
                    'Thursday',
                    'Friday',
                ]),
            ],

            'start_time' => [
                'required',
                'date_format:H:i',
            ],

            'end_time' => [
                'required',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'status' => [
                'nullable',
                'boolean',
            ],
        ]);

        $validated['status'] = $request->boolean(
            'status',
            false
        );

        $classRoutine->update($validated);

        return redirect()
            ->route('admin.class-routines.index')
            ->with(
                'success',
                'Class routine updated successfully.'
            );
    }


    /**
     * Delete routine.
     */
    public function destroy(ClassRoutine $classRoutine)
    {
        $classRoutine->delete();

        return redirect()
            ->route('admin.class-routines.index')
            ->with(
                'success',
                'Class routine deleted successfully.'
            );
    }
}