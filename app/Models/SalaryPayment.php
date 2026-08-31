<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryPayment extends Model
{
    protected $fillable = [
        'branch_id',
        'teacher_staff_id',
        'salary_structure_id',
        'salary_month',
        'salary_year',
        'basic_salary',
        'gross_salary',
        'total_deduction',
        'net_salary',
        'paid_amount',
        'payment_date',
        'payment_method',
        'status',
        'remarks',
    ];

    protected $casts = [
        'salary_month' => 'integer',
        'salary_year' => 'integer',
        'basic_salary' => 'decimal:2',
        'gross_salary' => 'decimal:2',
        'total_deduction' => 'decimal:2',
        'net_salary' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'payment_date' => 'date',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function teacherStaff(): BelongsTo
    {
        return $this->belongsTo(
            TeacherStaff::class,
            'teacher_staff_id'
        );
    }

    public function salaryStructure(): BelongsTo
    {
        return $this->belongsTo(
            SalaryStructure::class,
            'salary_structure_id'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Remaining Amount
    |--------------------------------------------------------------------------
    */

    public function getRemainingAmountAttribute(): float
    {
        return max(
            0,
            (float) $this->net_salary - (float) $this->paid_amount
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Payment Status Helper
    |--------------------------------------------------------------------------
    */

    public function getIsPaidAttribute(): bool
    {
        return (float) $this->paid_amount >= (float) $this->net_salary;
    }
}