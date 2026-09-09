<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_routines', function (Blueprint $table) {

            $table->id();

            // Branch
            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            // Academic Session
            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            // School Class
            $table->foreignId('school_class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            // Section
            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            // Subject
            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            // Teacher / Staff
            $table->foreignId('teacher_staff_id')
                ->constrained('teacher_staff')
                ->cascadeOnDelete();

            // Day
            $table->enum('day', [
                'Saturday',
                'Sunday',
                'Monday',
                'Tuesday',
                'Wednesday',
                'Thursday',
                'Friday',
            ]);

            // Start Time
            $table->time('start_time');

            // End Time
            $table->time('end_time');

            // Room / Classroom
            $table->string('room')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();


            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->index(
                [
                    'branch_id',
                    'academic_session_id',
                    'school_class_id',
                    'section_id',
                    'day',
                ],
                'routine_class_day_idx'
            );

            $table->index(
                [
                    'teacher_staff_id',
                    'day',
                ],
                'routine_teacher_day_idx'
            );

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_routines');
    }
};