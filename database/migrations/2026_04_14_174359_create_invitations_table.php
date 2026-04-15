<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invitations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tontine_id')->constrained('tontines')->cascadeOnDelete();
            $table->foreignId('invite_par')->constrained('users')->cascadeOnDelete(); // admin
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // si membre existant
            $table->string('email');                    // email invité
            $table->string('token', 64)->unique();      // token sécurisé
            $table->enum('statut', ['en_attente', 'acceptee', 'refusee', 'expiree'])->default('en_attente');
            $table->timestamp('expires_at');            // expiration (48h par défaut)
            $table->timestamp('repondu_at')->nullable();
            $table->text('message')->nullable();        // message personnalisé de l'admin
            $table->timestamps();

            $table->index(['token', 'statut']);
            $table->index(['email', 'tontine_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invitations');
    }
};
