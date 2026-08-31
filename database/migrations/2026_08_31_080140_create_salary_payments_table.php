<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('salary_payments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('teacher_staff_id')
                ->constrained('teacher_staff')
                ->cascadeOnDelete();

            $table->foreignId('salary_structure_id')
                ->constrained('salary_structures')
                ->cascadeOnDelete();

            $table->unsignedTinyInteger('salary_month');
            $table->unsignedSmallInteger('salary_year');

            $table->decimal('basic_salary', 12, 2)->default(0);
            $table->decimal('gross_salary', 12, 2)->default(0);
            $table->decimal('total_deduction', 12, 2)->default(0);
            $table->decimal('net_salary', 12, 2)->default(0);

            $table->decimal('paid_amount', 12, 2)->default(0);

            $table->date('payment_date')->nullable();

            $table->string('payment_method')
                ->nullable()
                ->comment('Cash, Bank, Mobile Banking');

            $table->enum('status', [
                'Pending',
                'Paid',
                'Partial',
                'Cancelled'
            ])->default('Pending');

            $table->text('remarks')->nullable();

            $table->timestamps();

            // Same employee cannot have duplicate salary for same month/year
            $table->unique([
                'branch_id',
                'teacher_staff_id',
                'salary_month',
                'salary_year'
            ], 'salary_payment_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('salary_payments');
    }
};