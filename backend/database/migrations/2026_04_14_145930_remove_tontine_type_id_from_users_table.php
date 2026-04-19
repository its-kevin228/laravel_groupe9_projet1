<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// tontine_type_id n'a jamais été créé sur SQLite (migration précédente vide),
// donc rien à supprimer ici non plus.
return new class extends Migration
{
    public function up(): void
    {
        // Pas d'action sur SQLite
    }

    public function down(): void
    {
        // Pas d'action
    }
};
