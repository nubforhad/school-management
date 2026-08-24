<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentFee extends Model
{
    protected $fillable = [
        'branch_id',
        'student_id',
        'fee_type_id',
        'academic_session_id',
        'fee_month',
        'fee_year',
        'amount',
        'discount',
        'payable_amount',
        'due_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'discount' => 'decimal:2',
        'payable_amount' => 'decimal:2',
        'due_date' => 'date',
        'fee_month' => 'integer',
        'fee_year' => 'integer',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function feeType(): BelongsTo
    {
        return $this->belongsTo(FeeType::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(AcademicSession::class);
    }
}