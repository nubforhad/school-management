<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_assignments', function (Blueprint $table) {

            $table->id();

            /*
            |--------------------------------------------------------------------------
            | Branch
            |--------------------------------------------------------------------------
            */
            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Academic Session
            |--------------------------------------------------------------------------
            */
            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Teacher / Staff
            |--------------------------------------------------------------------------
            */
            $table->foreignId('teacher_staff_id')
                ->constrained('teacher_staff')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Class
            |--------------------------------------------------------------------------
            */
            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Section
            |--------------------------------------------------------------------------
            */
            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Subject
            |--------------------------------------------------------------------------
            */
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Class Teacher
            |--------------------------------------------------------------------------
            */
            $table->boolean('is_class_teacher')
                ->default(false);

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            */
            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Assignment
            |--------------------------------------------------------------------------
            */
            $table->unique([
                'academic_session_id',
                'teacher_staff_id',
                'school_class_id',
                'section_id',
                'subject_id',
            ], 'teacher_assignment_unique');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_assignments');
    }
}; 
