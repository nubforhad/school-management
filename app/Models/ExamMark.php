<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'exam_id',
        'academic_session_id',
        'school_class_id',
        'section_id',
        'student_id',
        'subject_id',
        'exam_subject_id',
        'full_marks',
        'pass_marks',
        'obtained_marks',
        'grade',
        'grade_point',
        'remarks',
        'status',
    ];

    protected $casts = [
        'full_marks' => 'decimal:2',
        'pass_marks' => 'decimal:2',
        'obtained_marks' => 'decimal:2',
        'grade_point' => 'decimal:2',
        'status' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Branch
    |--------------------------------------------------------------------------
    */

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Exam
    |--------------------------------------------------------------------------
    */

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Academic Session
    |--------------------------------------------------------------------------
    */

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    /*
    |--------------------------------------------------------------------------
    | School Class
    |--------------------------------------------------------------------------
    */

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(
            SchoolClass::class,
            'school_class_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Section
    |--------------------------------------------------------------------------
    */

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Subject
    |--------------------------------------------------------------------------
    */

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Exam Subject
    |--------------------------------------------------------------------------
    */

    public function examSubject(): BelongsTo
    {
        return $this->belongsTo(
            ExamSubject::class,
            'exam_subject_id'
        );
    }
}