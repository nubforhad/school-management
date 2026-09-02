<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeacherStaffAttendance extends Model
{
    protected $fillable = [
        'branch_id',
        'teacher_staff_id',
        'date',
        'status',
        'in_time',
        'out_time',
        'remarks',
    ];

    protected $casts = [
        'date' => 'date',
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









}