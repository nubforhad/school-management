<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_structures', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('teacher_staff_id')
                ->constrained('teacher_staff')
                ->cascadeOnDelete();

            // Basic Salary
            $table->decimal('basic_salary', 12, 2)->default(0);

            // Allowances
            $table->decimal('house_rent', 12, 2)->default(0);
            $table->decimal('medical_allowance', 12, 2)->default(0);
            $table->decimal('transport_allowance', 12, 2)->default(0);
            $table->decimal('special_allowance', 12, 2)->default(0);
            $table->decimal('other_allowance', 12, 2)->default(0);

            // Deductions
            $table->decimal('provident_fund', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('other_deduction', 12, 2)->default(0);

            // Status
            $table->boolean('status')->default(true);

            $table->text('remarks')->nullable();

            $table->timestamps();

            // One active salary structure per teacher/staff per branch
            $table->unique(
                ['branch_id', 'teacher_staff_id'],
                'salary_structures_branch_teacher_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_structures');
    }
};