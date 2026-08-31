<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SalaryStructure extends Model
{
    protected $fillable = [
        'branch_id',
        'teacher_staff_id',

        'basic_salary',

        'house_rent',
        'medical_allowance',
        'transport_allowance',
        'special_allowance',
        'other_allowance',

        'provident_fund',
        'tax',
        'other_deduction',

        'status',
        'remarks',
    ];

    protected $casts = [
        'basic_salary' => 'decimal:2',

        'house_rent' => 'decimal:2',
        'medical_allowance' => 'decimal:2',
        'transport_allowance' => 'decimal:2',
        'special_allowance' => 'decimal:2',
        'other_allowance' => 'decimal:2',

        'provident_fund' => 'decimal:2',
        'tax' => 'decimal:2',
        'other_deduction' => 'decimal:2',

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
    | Gross Salary
    |--------------------------------------------------------------------------
    */

    public function getGrossSalaryAttribute(): float
    {
        return
            (float) $this->basic_salary
            + (float) $this->house_rent
            + (float) $this->medical_allowance
            + (float) $this->transport_allowance
            + (float) $this->special_allowance
            + (float) $this->other_allowance;
    }


    /*
    |--------------------------------------------------------------------------
    | Total Deduction
    |--------------------------------------------------------------------------
    */

    public function getTotalDeductionAttribute(): float
    {
        return
            (float) $this->provident_fund
            + (float) $this->tax
            + (float) $this->other_deduction;
    }


    /*
    |--------------------------------------------------------------------------
    | Net Salary
    |--------------------------------------------------------------------------
    */

    public function getNetSalaryAttribute(): float
    {
        return $this->gross_salary - $this->total_deduction;
    }
}