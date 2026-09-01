<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveAllocation extends Model
{
    protected $fillable = [
        'branch_id',
        'teacher_staff_id',
        'leave_type_id',
        'year',
        'allocated_days',
        'used_days',
        'remaining_days',
        'status',
        'remarks',
    ];

    protected $casts = [
        'year' => 'integer',
        'allocated_days' => 'decimal:2',
        'used_days' => 'decimal:2',
        'remaining_days' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacherStaff(): BelongsTo
    {
        return $this->belongsTo( TeacherStaff::class,'teacher_staff_id');
    }

    public function leaveType(): BelongsTo
    {
        return $this->belongsTo(
            LeaveType::class,
            'leave_type_id'
        );
    }
}