<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tontines', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->text('description')->nullable();
            $table->decimal('montant_cotisation', 10, 2)->default(0);
            $table->enum('frequence', ['hebdomadaire', 'mensuel', 'trimestriel'])->default('mensuel');
            $table->date('date_debut')->nullable();
            $table->enum('statut', ['active', 'inactive', 'terminee'])->default('active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tontines');
    }
};
