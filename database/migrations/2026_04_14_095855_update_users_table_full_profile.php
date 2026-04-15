<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Remplacement de name par prénom + nom
            $table->string('first_name')->after('id');
            $table->string('last_name')->after('first_name');

            // Contact
            $table->string('phone', 20)->unique()->after('email');

            // Tontine
            $table->foreignId('tontine_id')->nullable()->constrained('tontines')->nullOnDelete()->after('phone');

            // Infos membres
            $table->date('date_adhesion')->nullable()->after('tontine_id');
            $table->unsignedInteger('ordre_passage')->nullable()->after('date_adhesion');
            $table->string('adresse')->nullable()->after('ordre_passage');
            $table->string('quartier')->nullable()->after('adresse');
            $table->string('profession')->nullable()->after('quartier');

            // Pièce d'identité
            $table->string('piece_identite_type')->nullable()->after('profession'); // CNI, Passeport, etc.
            $table->string('piece_identite_numero')->nullable()->after('piece_identite_type');

            // Supprimer l'ancien champ name
            $table->dropColumn('name');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->dropColumn([
                'first_name', 'last_name', 'phone', 'tontine_id',
                'date_adhesion', 'ordre_passage', 'adresse', 'quartier',
                'profession', 'piece_identite_type', 'piece_identite_numero',
            ]);
        });
    }
};
