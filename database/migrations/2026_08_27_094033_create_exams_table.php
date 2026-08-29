<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnDelete();

            $table->foreignId('school_class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->nullOnDelete();

            $table->string('name');

            $table->string('code')
                ->nullable();

            $table->date('start_date')
                ->nullable();

            $table->date('end_date')
                ->nullable();

            $table->text('description')
                ->nullable();

            $table->enum('status', [
                'draft',
                'published',
                'completed',
            ])->default('draft');

            $table->timestamps();

            $table->index([
                'branch_id',
                'academic_session_id',
                'school_class_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exams');
    }
};