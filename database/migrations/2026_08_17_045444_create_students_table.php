<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {

            $table->id();

            // Branch
            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Academic Session
            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Admission Information
            $table->string('admission_no', 50);
            $table->string('student_id', 50)->unique();

            // Student Information
            $table->string('name', 150);
            $table->string('name_bn', 150)->nullable();

            $table->string('father_name', 150);
            $table->string('father_name_bn', 150)->nullable();

            $table->string('mother_name', 150);
            $table->string('mother_name_bn', 150)->nullable();

            $table->string('birth_reg_no', 30)->nullable();

            $table->enum('gender', [
                'male',
                'female',
                'other',
            ])->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('blood_group', 10)->nullable();

            $table->string('religion', 50)->nullable();

            $table->string('photo')->nullable();

            // Academic Information
            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('section_id')
                ->nullable()
                ->constrained('sections')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->string('roll_no', 50)->nullable();

            // Guardian Information
            $table->string('guardian_name', 150)->nullable();
            $table->string('guardian_phone', 30)->nullable();
            $table->string('guardian_email', 150)->nullable();

            // Address
            $table->text('address')->nullable();

            // Admission
            $table->date('admission_date')->nullable();

            // Status
            $table->boolean('status')->default(true);

            $table->timestamps();

            // Branch-wise unique admission number
            $table->unique(
                ['branch_id', 'admission_no'],
                'students_branch_admission_unique'
            );

            // Branch-wise roll
            $table->index(
                ['branch_id', 'class_id', 'section_id', 'roll_no'],
                'students_branch_class_section_roll_index'
            );

            $table->index('academic_session_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};