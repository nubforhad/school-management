<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentEnrollment extends Model
{
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
    ];

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function academicSession()
    {
        return $this->belongsTo(AcademicSession::class);
    }

    public function schoolClass()
    {
        return $this->belongsTo(
            SchoolClass::class,
            'class_id'
        );
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }
}