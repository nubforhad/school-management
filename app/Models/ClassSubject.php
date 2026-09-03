<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClassSubject extends Model
{
    protected $fillable = [
        'branch_id',
        'class_id',
        'subject_id',
        'sort_order',
        'is_optional',
        'status',
    ];

    protected $casts = [
        'is_optional' => 'boolean',
        'status' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(
            SchoolClass::class,
            'class_id'
        );
    }

    // public function subject(): BelongsTo
    // {
    //     return $this->belongsTo(Subject::class);
    // }
    public function subject(): BelongsTo
    {
        return $this->belongsTo(
            Subject::class,
            'subject_id'
        );
    }

    
}