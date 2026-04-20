<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete(); // admin qui a agi
            $table->string('action');           // ex: paiement.enregistre, cycle.ouvert, membre.ajoute
            $table->string('entite_type');      // ex: Payment, Cycle, User
            $table->unsignedBigInteger('entite_id')->nullable();
            $table->json('details')->nullable(); // données avant/après ou contexte
            $table->string('ip_address', 45)->nullable();
            $table->timestamps();

            $table->index(['entite_type', 'entite_id']);
            $table->index('action');
            $table->index('created_at');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
