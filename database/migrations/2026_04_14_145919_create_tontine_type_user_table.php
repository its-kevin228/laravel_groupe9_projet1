<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tontine_type_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tontine_type_id')->constrained('tontine_types')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('date_adhesion')->nullable();
            $table->foreignId('ajoute_par')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            // Un membre ne peut pas être inscrit deux fois au même type
            $table->unique(['tontine_type_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tontine_type_user');
    }
};
