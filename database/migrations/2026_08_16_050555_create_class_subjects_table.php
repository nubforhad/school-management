<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('class_subjects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->foreignId('subject_id')
                ->constrained('subjects')
                ->cascadeOnDelete();

            $table->foreignId('teacher_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete();

            $table->unsignedInteger('sort_order')->default(0);

            $table->boolean('is_optional')->default(false);
            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'branch_id',
                'class_id',
                'subject_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('class_subjects');
    }
};