<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LeaveType extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'code',
        'days_per_year',
        'description',
        'status',
    ];

    protected $casts = [
        'days_per_year' => 'integer',
        'status' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}