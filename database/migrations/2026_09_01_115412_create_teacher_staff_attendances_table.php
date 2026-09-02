<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teacher_staff_attendances', function (Blueprint $table) {

            $table->id();

            $table->foreignId('branch_id')
                ->constrained('branches')
                ->cascadeOnDelete();

            $table->foreignId('teacher_staff_id')
                ->constrained('teacher_staff')
                ->cascadeOnDelete();

            $table->date('date');

            $table->enum('status', [
                'present',
                'late',
                'absent',
                'leave',
            ])->default('present');

            $table->time('in_time')
                ->nullable();

            $table->time('out_time')
                ->nullable();

            $table->text('remarks')
                ->nullable();

            $table->timestamps();

            /*
            |--------------------------------------------------------------------------
            | Indexes
            |--------------------------------------------------------------------------
            */

            $table->unique([
                'branch_id',
                'teacher_staff_id',
                'date',
            ]);

            $table->index([
                'branch_id',
                'date',
            ]);

            $table->index([
                'branch_id',
                'status',
            ]);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('teacher_staff_attendances');
    }
};