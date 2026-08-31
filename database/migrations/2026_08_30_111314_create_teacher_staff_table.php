<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_staff', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete();

            $table->foreignId('designation_id')
                ->nullable()
                ->constrained('designations')
                ->nullOnDelete();

            $table->string('employee_id')->unique();

            $table->string('name');

            $table->string('photo')->nullable();

            $table->enum('gender', [
                'Male',
                'Female',
                'Other'
            ])->nullable();

            $table->date('date_of_birth')->nullable();

            $table->string('phone', 30)->nullable();

            $table->string('email')->nullable();

            $table->text('address')->nullable();

            $table->date('joining_date')->nullable();

            $table->decimal('basic_salary', 12, 2)
                ->default(0);

            $table->enum('employment_type', [
                'Permanent',
                'Temporary',
                'Contractual',
                'Part Time'
            ])->default('Permanent');

            $table->boolean('status')
                ->default(true);

            $table->text('remarks')->nullable();

            $table->timestamps();

            $table->index([
                'branch_id',
                'department_id',
                'designation_id'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_staff');
    }
}; 
