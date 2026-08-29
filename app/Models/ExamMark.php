<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamMark extends Model
{
    protected $fillable = [
        'branch_id',
        'academic_session_id',
        'exam_id',
        'exam_schedule_id',
        'student_id',
        'school_class_id',
        'section_id',
        'subject_id',
        'written_marks',
        'mcq_marks',
        'practical_marks',
        'total_marks',
        'percentage',
        'grade',
        'grade_point',
        'result_status',
        'remarks',
    ];

    protected $casts = [
        'written_marks'   => 'decimal:2',
        'mcq_marks'       => 'decimal:2',
        'practical_marks' => 'decimal:2',
        'total_marks'     => 'decimal:2',
        'percentage'      => 'decimal:2',
        'grade_point'     => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function exam(): BelongsTo
    {
        return $this->belongsTo(Exam::class);
    }

    public function examSchedule(): BelongsTo
    {
        return $this->belongsTo(ExamSchedule::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(SchoolClass::class);
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(Section::class);
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
}