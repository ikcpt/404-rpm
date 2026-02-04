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
        // El coche puede ser nulo si el usuario elige "Traeré otro vehículo" manual
        $table->foreignId('car_id')->nullable()->constrained()->onDelete('cascade');
        
        $table->date('fecha');
        $table->string('hora');
        $table->text('description')->nullable();
        $table->string('estado')->default('pendiente'); // pendiente, aprobada, finalizada
        
        // Si el usuario escribe manual marca/modelo, lo guardamos aquí (opcional)
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