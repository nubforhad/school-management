<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('fee_types', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(true);
            $table->timestamps();
            $table->index('status');
            // Same fee type name/code can exist in different branches
            $table->unique(
                ['branch_id', 'name'],
                'fee_types_branch_name_unique'
            );
            $table->unique(
                ['branch_id', 'code'],
                'fee_types_branch_code_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fee_types');
    }
};