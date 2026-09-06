<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExamMark extends Model
{
    protected $fillable = [

        'exam_id',
        'exam_schedule_id',

        'student_id',
        'student_enrollment_id',

        'marks',
        'remarks',
    ];

    protected $casts = [

        'marks' => 'decimal:2',

    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function exam(): BelongsTo
    {
        return $this->belongsTo(
            Exam::class,
            'exam_id'
        );
    }

    public function schedule(): BelongsTo
    {
        return $this->belongsTo(
            ExamSchedule::class,
            'exam_schedule_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(
            Student::class,
            'student_id'
        );
    }

    public function enrollment(): BelongsTo
    {
        return $this->belongsTo(
            StudentEnrollment::class,
            'student_enrollment_id'
        );
    }
}