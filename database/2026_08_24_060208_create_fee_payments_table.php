<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_payments', function (Blueprint $table) {
            $table->id();

            // Branch
            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            // Student Fee Assignment
            $table->foreignId('student_fee_assignment_id')
                ->constrained('student_fees')
                ->cascadeOnDelete();

            // Student
            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            // Fee Type
            $table->foreignId('fee_type_id')
                ->constrained('fee_types')
                ->cascadeOnDelete();

            // Payment information
            $table->decimal('amount', 12, 2);

            $table->date('payment_date');

            $table->enum('payment_method', [
                'cash',
                'bank',
                'mobile_banking',
                'other',
            ])->default('cash');

            $table->string('reference_no')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            // User who collected the payment
            $table->foreignId('collected_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            // Indexes
            $table->index('branch_id');
            $table->index('student_id');
            $table->index('fee_type_id');
            $table->index('payment_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_payments');
    }
};