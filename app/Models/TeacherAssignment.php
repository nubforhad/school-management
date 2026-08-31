<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherAssignment extends Model
{
    protected $fillable = [
        'branch_id',
        'academic_session_id',
        'teacher_staff_id',
        'school_class_id',
        'section_id',
        'subject_id',
        'is_class_teacher',
        'status',
    ];

    protected $casts = [
        'is_class_teacher' => 'boolean',
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
    | Academic Session
    |--------------------------------------------------------------------------
    */
    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(
            AcademicSession::class,
            'academic_session_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Teacher / Staff
    |--------------------------------------------------------------------------
    */
    public function teacherStaff(): BelongsTo
    {
        return $this->belongsTo(
            TeacherStaff::class,
            'teacher_staff_id'
        );
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
    | Subject
    |--------------------------------------------------------------------------
    */
    public function subject(): BelongsTo
    {
        return $this->belongsTo(Subject::class);
    }
} 
