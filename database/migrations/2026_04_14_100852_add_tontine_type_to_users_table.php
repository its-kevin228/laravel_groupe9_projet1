<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('tontine_type_id')
                  ->nullable()
                  ->after('tontine_id')
                  ->constrained('tontine_types')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['tontine_type_id']);
            $table->dropColumn('tontine_type_id');
        });
    }
};
