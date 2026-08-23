<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
         if (Schema::hasTable('attendances')) {
        return;
    }
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->date('date');

            $table->enum('status', [
                'present',
                'absent',
                'late',
                'leave'
            ])->default('present');

            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();

            $table->text('remarks')->nullable();

            $table->timestamps();

            // One student can have only one attendance record per day
            $table->unique(
                ['student_id', 'date'],
                'student_date_unique'
            );

            $table->index([
                'branch_id',
                'academic_session_id',
                'school_class_id',
                'section_id',
                'date'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};