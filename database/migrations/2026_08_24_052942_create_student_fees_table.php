<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_fees', function (Blueprint $table) {

            $table->id();

            // Branch
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();

            // Student
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Fee Type
            $table->foreignId('fee_type_id')
                ->constrained('fee_types')
                ->restrictOnDelete();

            // Academic Session
            $table->foreignId('academic_session_id')
                ->constrained('academic_sessions')
                ->restrictOnDelete();

            // Optional period
            $table->unsignedTinyInteger('fee_month')->nullable();
            $table->unsignedSmallInteger('fee_year')->nullable();

            // Original amount
            $table->decimal('amount', 12, 2);

            // Discount
            $table->decimal('discount', 12, 2)
                ->default(0);

            // Final payable amount
            $table->decimal('payable_amount', 12, 2);

            // Due date
            $table->date('due_date')->nullable();

            // Payment status
            $table->enum('status', [
                'unpaid',
                'partial',
                'paid',
            ])->default('unpaid');

            // Additional note
            $table->text('remarks')->nullable();

            $table->timestamps();

            // Indexes
            $table->index([
                'branch_id',
                'student_id',
            ]);

            $table->index([
                'branch_id',
                'fee_type_id',
            ]);

            $table->index([
                'academic_session_id',
                'fee_month',
                'fee_year',
            ]);

            $table->index('status');
            $table->index('due_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_fees');
    }
};