<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
    use HasFactory;

    protected $fillable = [
        'branch_id',
        'student_id',
        'academic_session_id',
        'class_id',
        'section_id',
        'roll_no',
        'admission_date',
        'status',
        'remarks',
    ];

    protected $casts = [
        'admission_date' => 'date',
        'roll_no' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Branch
    |--------------------------------------------------------------------------
    */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Student
    |--------------------------------------------------------------------------
    */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Academic Session
    |--------------------------------------------------------------------------
    */
    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Class
    |--------------------------------------------------------------------------
    */
    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    /*
    |--------------------------------------------------------------------------
    | Section
    |--------------------------------------------------------------------------
    */
    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}