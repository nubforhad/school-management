<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('type', [
                'cash',
                'bank',
                'mobile_banking',
            ])->default('cash');
            $table->string('account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->decimal('opening_balance', 15, 2)->default(0);
            $table->date('opening_balance_date')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index([
                'company_id',
                'branch_id',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};