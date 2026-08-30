<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('code')->nullable();
            $table->text('description')->nullable();

            $table->boolean('status')
                ->default(true);

            $table->timestamps();

            // Same department name cannot exist twice in same branch
            $table->unique(
                ['branch_id', 'name'],
                'department_branch_name_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};