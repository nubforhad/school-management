<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    protected $fillable = [
        'name',
        'code',
        'address',
        'phone',
        'email',
        'logo',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function academicSessions()
    {
        return $this->hasMany(AcademicSession::class);
    }

    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function classSubjects()
    {
        return $this->hasMany(ClassSubject::class);
    }
    public function studentEnrollments()
    {
        return $this->hasMany(StudentEnrollment::class);
    }

}