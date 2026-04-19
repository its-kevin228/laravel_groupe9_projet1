<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cycles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tontine_id')->constrained('tontines')->cascadeOnDelete();
            $table->unsignedInteger('numero_cycle');          // 1, 2, 3...
            $table->foreignId('beneficiaire_id')              // membre bénéficiaire
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->unsignedInteger('ordre_beneficiaire');    // ordre_passage du bénéficiaire
            $table->enum('statut', ['ouvert', 'ferme'])->default('ouvert');
            $table->date('date_ouverture');
            $table->date('date_fermeture')->nullable();
            $table->timestamps();

            // Un seul cycle ouvert par tontine à la fois
            $table->unique(['tontine_id', 'numero_cycle']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cycles');
    }
};
