<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->foreignId('academic_session_id')
                ->after('leave_type_id')
                ->nullable()
                ->constrained('academic_sessions')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('leave_allocations', function (Blueprint $table) {
            $table->dropForeign(['academic_session_id']);
            $table->dropColumn('academic_session_id');
        });
    }
};