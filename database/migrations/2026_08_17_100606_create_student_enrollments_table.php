<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_enrollments', function (Blueprint $table) {

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
            | Student
            |--------------------------------------------------------------------------
            */
            $table->foreignId('student_id')
                ->constrained('students')
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
            | Class
            |--------------------------------------------------------------------------
            */
            $table->foreignId('class_id')
                ->constrained('classes')
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
            | Academic Information
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('roll_no')->nullable();

            $table->date('admission_date')->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            | active   = বর্তমানে এই enrollment চালু
            | inactive = বন্ধ
            | completed = session/class complete
            | transferred = অন্য branch/session-এ transfer
            |--------------------------------------------------------------------------
            */
            $table->enum('status', [
                'active',
                'inactive',
                'completed',
                'transferred',
            ])->default('active');

            $table->text('remarks')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Enrollment
            |--------------------------------------------------------------------------
            */
            $table->unique(
                [
                    'student_id',
                    'academic_session_id',
                ],
                'student_session_unique'
            );

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */
            $table->index('branch_id');
            $table->index('class_id');
            $table->index('section_id');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};