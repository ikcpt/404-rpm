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
    Schema::create('citas', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('car_id')->nullable()->constrained()->onDelete('cascade');
        
        $table->date('fecha');
        $table->string('hora');
        
        // --- AÑADE ESTA LÍNEA ---
        $table->string('tipo')->default('Taller'); // Puede ser 'Taller', 'Prueba de conducción', etc.
        // ------------------------

        $table->text('description')->nullable();
        $table->string('estado')->default('Pendiente');
        
        $table->string('brand_manual')->nullable();
        $table->string('model_manual')->nullable();

        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};