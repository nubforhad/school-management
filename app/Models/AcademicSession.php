<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AcademicSession extends Model
{
    protected $fillable = [
        'branch_id',
        'name',
        'start_date',
        'end_date',
        'is_current',
        'status',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'is_current' => 'boolean',
        'status' => 'boolean',
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function studentEnrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }
    public function studentFees()
    {
        return $this->hasMany(StudentFee::class);
    }

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(
            AcademicSession::class,
            'academic_session_id'
        );
    }

}