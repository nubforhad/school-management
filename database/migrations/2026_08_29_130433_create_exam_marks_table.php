<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_marks', function (Blueprint $table) {

            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            $table->foreignId('exam_schedule_id')
                ->constrained('exam_schedules')
                ->cascadeOnDelete();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->constrained('sections')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->decimal('written_marks', 8, 2)
                ->default(0);

            $table->decimal('mcq_marks', 8, 2)
                ->default(0);

            $table->decimal('practical_marks', 8, 2)
                ->default(0);

            $table->decimal('total_marks', 8, 2)
                ->default(0);

            $table->decimal('percentage', 5, 2)
                ->default(0);

            $table->string('grade', 10)
                ->nullable();

            $table->decimal('grade_point', 4, 2)
                ->default(0);

            $table->enum('result_status', [
                'pass',
                'fail'
            ])->default('pass');

            $table->text('remarks')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Prevent Duplicate Marks
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'exam_schedule_id',
                'student_id'
            ], 'exam_marks_schedule_student_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_marks');
    }
};