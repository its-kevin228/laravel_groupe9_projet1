<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->foreignId('tontine_id')->nullable()->constrained('tontines')->nullOnDelete();
            $table->date('date_adhesion')->nullable();
            $table->unsignedInteger('ordre_passage')->nullable();
            $table->string('adresse')->nullable();
            $table->string('quartier')->nullable();
            $table->string('profession')->nullable();
            $table->string('piece_identite_type')->nullable();
            $table->string('piece_identite_numero')->nullable();
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->dropColumn([
                'first_name', 'last_name', 'phone', 'tontine_id',
                'date_adhesion', 'ordre_passage', 'adresse', 'quartier',
                'profession', 'piece_identite_type', 'piece_identite_numero',
            ]);
        });
    }
};
