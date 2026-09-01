<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TeacherStaff extends Model
{
    protected $table = 'teacher_staff';

    protected $fillable = [
        'branch_id',
        'department_id',
        'designation_id',
        'employee_id',
        'name',
        'photo',
        'gender',
        'date_of_birth',
        'phone',
        'email',
        'address',
        'joining_date',
        'basic_salary',
        'employment_type',
        'status',
        'remarks',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'joining_date' => 'date',
        'basic_salary' => 'decimal:2',
        'status' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function designation(): BelongsTo
    {
        return $this->belongsTo(Designation::class);
    }

    public function salaryPayments(): HasMany
    {
        return $this->hasMany(
            SalaryPayment::class,
            'teacher_staff_id'
        );
    }

    public function leaveAllocations()
    {
        return $this->hasMany(
            LeaveAllocation::class,
            'teacher_staff_id'
        );
    }



}
