<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\ExamSchedule;

class Exam extends Model
{
    protected $fillable = [
        'branch_id',
        'academic_session_id',
        'school_class_id',
        'section_id',
        'name',
        'code',
        'start_date',
        'end_date',
        'description',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(
            AcademicSession::class,
            'academic_session_id'
        );
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(
            SchoolClass::class,
            'school_class_id'
        );
    }

    public function section(): BelongsTo
    {
        return $this->belongsTo(
            Section::class,
            'section_id'
        );
    }
    public function schedules(): HasMany
    {
        return $this->hasMany(ExamSchedule::class);
    }

    


}