<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// Cette migration est intentionnellement vide pour SQLite :
// tontine_type_id a été ajouté puis supprimé dans la migration suivante.
// La colonne n'est donc jamais créée sur SQLite.
return new class extends Migration
{
    public function up(): void
    {
        // Pas d'action — voir migration 2026_04_14_145930
    }

    public function down(): void
    {
        // Pas d'action
    }
};
