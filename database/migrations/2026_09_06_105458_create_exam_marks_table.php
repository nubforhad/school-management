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

            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained('school_classes')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('subject_id')->constrained('subjects')->cascadeOnDelete();
            $table->foreignId('exam_subject_id')->nullable()->constrained('exam_subjects')->nullOnDelete();
            $table->decimal('full_marks', 8, 2)->default(100);
            $table->decimal('pass_marks', 8, 2)->nullable();
            $table->decimal('obtained_marks', 8, 2)->nullable();
            $table->string('grade', 20)->nullable();
            $table->decimal('grade_point', 5, 2)->nullable();
            $table->text('remarks')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->unique([
                'exam_id',
                'student_id',
                'subject_id'
            ], 'exam_marks_unique');

            $table->index([
                'branch_id',
                'exam_id',
                'school_class_id',
                'section_id',
                'student_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_marks');
    }
};