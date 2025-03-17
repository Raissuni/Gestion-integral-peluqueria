<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stylists', function (Blueprint $table) {
            $table->dropForeign(['service_id']); // Eliminar la clave foránea primero (si aplica)
            $table->dropColumn('service_id');   // Eliminar el campo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stylists', function (Blueprint $table) {
            $table->foreignId('service_id')->nullable()->constrained('services')->onDelete('cascade'); // Volver a agregar el campo
        });
    }
};
