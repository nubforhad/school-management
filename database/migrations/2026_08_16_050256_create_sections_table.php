<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sections', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('class_id')
                ->constrained('classes')
                ->cascadeOnDelete();

            $table->string('name');
            $table->unsignedInteger('capacity')->nullable();

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->unique([
                'branch_id',
                'class_id',
                'name'
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};