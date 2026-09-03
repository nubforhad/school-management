<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\ExamSchedule;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\ClassSubject;

class ExamScheduleController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Exam $exam)
    {
        $schedules = ExamSchedule::with('subject')
            ->where('exam_id', $exam->id)
            ->orderBy('exam_date')
            ->orderBy('start_time')
            ->get();

        return view('admin.exam-schedules.index', compact(
            'exam',
            'schedules'
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

 public function create(Exam $exam)
{
    // Load exam information
    $exam->load([
        'branch',
        'academicSession',
        'schoolClass',
        'section',
    ]);

    // Get only subjects assigned to this exam's class
    $subjects = ClassSubject::with('subject')
        ->where('class_id', $exam->school_class_id)
        ->get()
        ->pluck('subject')
        ->filter()
        ->values();

    return view(
        'admin.exam-schedules.create',
        compact('exam', 'subjects')
    );
}

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request, Exam $exam)
    {
        $validated = $request->validate([

            'subject_id' => [
                'required',
                'exists:subjects,id',
                Rule::unique('exam_schedules', 'subject_id')
                    ->where(function ($query) use ($exam) {
                        return $query->where('exam_id', $exam->id);
                    }),
            ],

            'exam_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pass_marks' => [
                'required',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],
        ]);


        $validated['exam_id'] = $exam->id;

        ExamSchedule::create($validated);


        return redirect()
            ->route('admin.exams.schedules.index', $exam)
            ->with('success', 'Exam schedule created successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

   public function edit(Exam $exam, ExamSchedule $schedule)
{
    abort_unless(
        $schedule->exam_id == $exam->id,
        404
    );

    $exam->load([
        'branch',
        'academicSession',
        'schoolClass',
        'section',
    ]);

    $subjects = ClassSubject::with('subject')
        ->where('class_id', $exam->school_class_id)
        ->get()
        ->pluck('subject')
        ->filter()
        ->values();

    return view(
        'admin.exam-schedules.edit',
        compact(
            'exam',
            'schedule',
            'subjects'
        )
    );
}

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(
        Request $request,
        Exam $exam,
        ExamSchedule $schedule
    ) {

        abort_unless(
            $schedule->exam_id == $exam->id,
            404
        );


        $validated = $request->validate([

            'subject_id' => [
                'required',
                'exists:subjects,id',

                Rule::unique('exam_schedules', 'subject_id')
                    ->where(function ($query) use ($exam) {
                        return $query->where('exam_id', $exam->id);
                    })
                    ->ignore($schedule->id),
            ],

            'exam_date' => [
                'required',
                'date',
            ],

            'start_time' => [
                'nullable',
                'date_format:H:i',
            ],

            'end_time' => [
                'nullable',
                'date_format:H:i',
                'after:start_time',
            ],

            'room' => [
                'nullable',
                'string',
                'max:100',
            ],

            'full_marks' => [
                'required',
                'numeric',
                'min:0',
            ],

            'pass_marks' => [
                'required',
                'numeric',
                'min:0',
                'lte:full_marks',
            ],

            'instructions' => [
                'nullable',
                'string',
            ],
        ]);


        $schedule->update($validated);


        return redirect()
            ->route('admin.exams.schedules.index', $exam)
            ->with('success', 'Exam schedule updated successfully.');
    }


    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy(
        Exam $exam,
        ExamSchedule $schedule
    ) {

        abort_unless(
            $schedule->exam_id == $exam->id,
            404
        );


        $schedule->delete();


        return redirect()
            ->route('admin.exams.schedules.index', $exam)
            ->with('success', 'Exam schedule deleted successfully.');
    }


    public function show(Exam $exam, ExamSchedule $schedule)
    {
        abort_if(
            $schedule->exam_id != $exam->id,
            404
        );

        $schedule->load([
            'subject',
            'exam.branch',
            'exam.academicSession',
        ]);

        return view('admin.exam-schedules.show', compact(
            'exam',
            'schedule'
        ));
    }






}