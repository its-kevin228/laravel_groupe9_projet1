<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tontine_types', function (Blueprint $table) {
            $table->id();
            $table->string('nom');                          // ex: Bronze, Silver, Gold
            $table->decimal('montant', 10, 2);              // montant de cotisation
            $table->string('devise', 10)->default('FCFA');  // devise
            $table->text('description')->nullable();        // avantages / détails
            $table->boolean('actif')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tontine_types');
    }
};
