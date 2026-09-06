<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ExamSchedule extends Model
{
    protected $fillable = [
        'exam_id',
        'subject_id',
        'exam_date',
        'start_time',
        'end_time',
        'room',
        'full_marks',
        'pass_marks',
        'instructions',
    ];

    protected $casts = [
        'exam_date' => 'date',
        'full_marks' => 'decimal:2',
        'pass_marks' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Exam
    |--------------------------------------------------------------------------
    */

     public function exam(): BelongsTo
    {
        return $this->belongsTo(
            Exam::class,
            'exam_id'
        );
    }

    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id'
        );
    }

    public function marks(): HasMany
    {
        return $this->hasMany(
            ExamMark::class,
            'exam_schedule_id'
        );
    }
}