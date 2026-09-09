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

            // Class
            $table->foreignId('school_class_id')
                ->constrained('school_classes')
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
            $table->foreignId('teacher_id')
                ->constrained('teachers')
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

            // Class Time
            $table->time('start_time');
            $table->time('end_time');

            // Room / Classroom
            $table->string('room')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            // Indexes
            $table->index([
                'branch_id',
                'academic_session_id',
                'school_class_id',
                'section_id',
                'day',
            ]);

            $table->index([
                'teacher_id',
                'day',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_routines');
    }
};