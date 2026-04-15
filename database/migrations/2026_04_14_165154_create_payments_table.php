<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cycle_id')->constrained('cycles')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->decimal('montant', 10, 2);
            $table->enum('statut', ['paye', 'en_retard'])->default('paye');
            $table->date('paid_at');
            $table->foreignId('enregistre_par')             // admin qui enregistre
                  ->constrained('users')
                  ->restrictOnDelete();
            $table->text('note')->nullable();
            $table->timestamps();

            // Un membre ne peut payer qu'une seule fois par cycle
            $table->unique(['cycle_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
