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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->foreignId('stylist_id')->constrained('stylists')->onDelete('cascade'); // Relación con estilista
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con usuarios
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Relación con servicio
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};
