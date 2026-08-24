<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FeePayment extends Model
{
    protected $fillable = [
        'branch_id',
        'student_fee_assignment_id',
        'student_id',
        'fee_type_id',
        'amount',
        'payment_date',
        'payment_method',
        'reference_no',
        'remarks',
        'collected_by',
    ];

    protected $casts = [
        'payment_date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function studentFeeAssignment(): BelongsTo
    {
        return $this->belongsTo(
            StudentFee::class,
            'student_fee_assignment_id'
        );
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function feeType(): BelongsTo
    {
        return $this->belongsTo(FeeType::class);
    }

    public function collector(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'collected_by'
        );
    }
}