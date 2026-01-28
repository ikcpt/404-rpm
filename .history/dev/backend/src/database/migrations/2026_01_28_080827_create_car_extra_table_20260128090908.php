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
    Schema::create('car_extra', function (Blueprint $table) {
        $table->id(); // ID de la relación (opcional, pero recomendado)

        // Clave foránea para el coche
        $table->foreignId('car_id')
              ->constrained('cars') // Vincula con la tabla cars
              ->onDelete('cascade'); // Si borras el coche, se borra la relación

        // Clave foránea para el extra
        $table->foreignId('extra_id')
              ->constrained('extras') // Vincula con la tabla extras
              ->onDelete('cascade'); // Si borras el extra, se quita de los coches

        // Opcional: Evitar duplicados (que un coche no tenga 2 veces el mismo extra)
        $table->unique(['car_id', 'extra_id']); 
        
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('car_extra');
    }
};
