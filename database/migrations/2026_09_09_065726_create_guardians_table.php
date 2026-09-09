<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guardians', function (Blueprint $table) {
            $table->id();
            // Branch
            $table->foreignId('branch_id')->constrained('branches')->cascadeOnDelete();
            // Guardian Information
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('nid')->nullable();
            $table->string('occupation')->nullable();
            // Address
            $table->text('address')->nullable();
            // Photo
            $table->string('photo')->nullable();
            // Status
            $table->boolean('status')->default(true);
            $table->timestamps();
            // Indexes
            $table->index(['branch_id', 'status']);
            $table->index('phone');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guardians');
    }
};