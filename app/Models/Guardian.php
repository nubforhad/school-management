<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_id',
        'name',
        'phone',
        'email',
        'nid',
        'occupation',
        'address',
        'photo',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    /**
     * Guardian belongs to a Branch
     */
    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    /**
     * Guardian has many Students
     */
    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'student_guardian'
        )->withPivot([
            'relationship',
            'is_primary',
        ])->withTimestamps();
    }

    /**
     * Primary Students
     */
    public function primaryStudents()
    {
        return $this->belongsToMany(
            Student::class,
            'student_guardian'
        )
        ->wherePivot('is_primary', true)
        ->withPivot('relationship')
        ->withTimestamps();
    }
}