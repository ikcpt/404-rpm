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
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            // La cita puede ser sobre un coche específico (ej: Test Drive) o no (ej: Tasación genérica)
            $table->foreignId('car_id')->nullable()->constrained()->onDelete('cascade');
            
            $table->date('fecha');
            $table->time('hora');
            $table->string('tipo'); // Ej: 'Prueba de conducción', 'Taller', 'Entrega'
            $table->string('estado')->default('Pendiente'); // 'Pendiente', 'Confirmada', 'Cancelada'
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