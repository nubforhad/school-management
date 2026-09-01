<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveApplication extends Model
{
    protected $fillable = [

        'branch_id',

        'teacher_staff_id',

        'leave_type_id',

        'academic_session_id',

        'start_date',

        'end_date',

        'total_days',

        'reason',

        'status',

        'approved_by',

        'approved_at',

        'remarks',
    ];


    protected $casts = [

        'start_date' => 'date',

        'end_date' => 'date',

        'total_days' => 'decimal:2',

        'approved_at' => 'datetime',
    ];


    /*
    |--------------------------------------------------------------------------
    | Branch
    |--------------------------------------------------------------------------
    */

    public function branch(): BelongsTo
    {
        return $this->belongsTo(
            Branch::class,
            'branch_id'
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
    | Leave Type
    |--------------------------------------------------------------------------
    */

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(
            LeaveType::class,
            'leave_type_id'
        );
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
    | Approved By
    |--------------------------------------------------------------------------
    */

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'approved_by'
        );
    }
}