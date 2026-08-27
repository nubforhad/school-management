<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_schedules', function (Blueprint $table) {

            $table->id();

            $table->foreignId('exam_id')
                ->constrained('exams')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->date('exam_date');

            $table->time('start_time')->nullable();

            $table->time('end_time')->nullable();

            $table->string('room')->nullable();

            $table->decimal('full_marks', 8, 2)
                ->default(100);

            $table->decimal('pass_marks', 8, 2)
                ->default(33);

            $table->text('instructions')->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Prevent duplicate subject in same exam
            |--------------------------------------------------------------------------
            */

            $table->unique(
                ['exam_id', 'subject_id'],
                'exam_subject_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_schedules');
    }
};