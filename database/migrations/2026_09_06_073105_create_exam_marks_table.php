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

            $table->foreignId('exam_id')->constrained('exams')->cascadeOnDelete();
            $table->foreignId('exam_schedule_id')->constrained('exam_schedules')->cascadeOnDelete();
            $table->foreignId('student_id')->constrained('students')->cascadeOnDelete();
            $table->foreignId('student_enrollment_id')->nullable()->constrained('student_enrollments')->nullOnDelete();
            $table->decimal('marks', 8, 2)->default(0);
            $table->text('remarks')->nullable();
            $table->timestamps();
            $table->unique([
                'exam_schedule_id',
                'student_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_marks');
    }
};