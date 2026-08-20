<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'branch_id',
        'academic_session_id',
        'admission_no',
        'student_id',
        'name',
        'name_bn',
        'father_name',
        'father_name_bn',
        'mother_name',
        'mother_name_bn',
        'birth_reg_no',
        'gender',
        'date_of_birth',
        'blood_group',
        'religion',
        'photo',
        'class_id',
        'section_id',
        'roll_no',
        'guardian_name',
        'guardian_phone',
        'guardian_email',
        'address',
        'admission_date',
        'status',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'admission_date' => 'date',
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
    | Academic Session
    |--------------------------------------------------------------------------
    */

    public function academicSession(): BelongsTo
    {
        return $this->belongsTo(
            AcademicSession::class
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Class
    |--------------------------------------------------------------------------
    */

    public function schoolClass(): BelongsTo
    {
        return $this->belongsTo(
            SchoolClass::class,
            'class_id'
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Section
    |--------------------------------------------------------------------------
    */

    public function section(): BelongsTo
    {
        return $this->belongsTo(
            Section::class
        );
    }

    public function enrollments(): HasMany
    {
        return $this->hasMany(StudentEnrollment::class);
    }

    public function attendances(): HasMany
    {
        return $this->hasMany(Attendance::class, 'student_id');
    }

}