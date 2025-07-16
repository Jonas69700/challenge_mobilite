<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date'); // date de l'activité
            $table->enum('type', ['bike', 'walk']); // vélo ou marche/course
            $table->float('distance_km')->default(0);
            $table->integer('steps')->nullable(); // steps uniquement si marche/course
            $table->timestamps();
            $table->unique(['user_id', 'date']); // une seule activité par jour par utilisateur
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activities');
    }
};
