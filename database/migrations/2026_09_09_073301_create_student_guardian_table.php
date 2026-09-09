<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('student_guardian', function (Blueprint $table) {
            $table->id();

            $table->foreignId('student_id')
                ->constrained('students')
                ->cascadeOnDelete();

            $table->foreignId('guardian_id')
                ->constrained('guardians')
                ->cascadeOnDelete();

            // Father, Mother, Guardian, Other
            $table->string('relationship');

            // Main/Primary guardian
            $table->boolean('is_primary')->default(false);

            $table->timestamps();

            // Prevent duplicate relationship
            $table->unique(
                ['student_id', 'guardian_id', 'relationship'],
                'student_guardian_unique'
            );

            $table->index(['student_id', 'is_primary']);
            $table->index(['guardian_id', 'relationship']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('student_guardian');
    }
};