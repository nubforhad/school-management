<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
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
            |
            | Nullable রাখা হয়েছে।
            | কারণ কোনো student-এর section পরে assign করা হতে পারে।
            |
            */
            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            /*
            |--------------------------------------------------------------------------
            | Roll Number
            |--------------------------------------------------------------------------
            */
            $table->unsignedInteger('roll_no')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Enrollment / Promotion Date
            |--------------------------------------------------------------------------
            */
            $table->date('enrollment_date')
                ->nullable();

            /*
            |--------------------------------------------------------------------------
            | Status
            |--------------------------------------------------------------------------
            |
            | active       = বর্তমানে এই class/session-এ আছে
            | completed    = session/class শেষ করেছে
            | transferred  = অন্য branch/class/session-এ গেছে
            | inactive     = inactive
            |
            */
            $table->enum('status', [
                'active',
                'completed',
                'transferred',
                'inactive',
            ])->default('active');

            /*
            |--------------------------------------------------------------------------
            | Remarks
            |--------------------------------------------------------------------------
            */
            $table->text('remarks')
                ->nullable();

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index('branch_id');
            $table->index('student_id');
            $table->index('academic_session_id');
            $table->index('class_id');
            $table->index('section_id');
            $table->index('status');


            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Enrollment
            |--------------------------------------------------------------------------
            |
            | একই student একই session + branch + class-এ
            | একই enrollment আবার করতে পারবে না।
            |
            */
            $table->unique(
                [
                    'student_id',
                    'academic_session_id',
                    'branch_id',
                    'class_id',
                ],
                'student_session_branch_class_unique'
            );
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_enrollments');
    }
};