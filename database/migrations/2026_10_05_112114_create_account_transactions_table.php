<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('account_transactions', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('account_id')->constrained('accounts')->cascadeOnDelete();
            $table->date('transaction_date');
            $table->enum('transaction_type', [
                'income',
                'expense',
                'transfer',
            ]);
            $table->enum('direction', [
                'credit',
                'debit',
            ]);
            $table->decimal('amount', 15, 2);
            $table->string('transfer_reference')->nullable();
            $table->string('reference_type')->nullable();
            $table->unsignedBigInteger('reference_id')->nullable();
            $table->text('description')
                ->nullable();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();

            $table->index([
                'branch_id',
            ]);

            $table->index([
                'account_id',
                'transaction_date',
            ]);

            $table->index([
                'reference_type',
                'reference_id',
            ]);

            $table->index('transfer_reference');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('account_transactions');
    }
};