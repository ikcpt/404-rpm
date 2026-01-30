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
    Schema::create('cars', function (Blueprint $table) {
        $table->id();
        $table->foreignId('brand_id')->constrained()->onDelete('cascade');
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // El dueño puede ser null (coche de stock)
        
        $table->string('model');
        $table->string('color')->nullable();        // <--- COLOR
        $table->string('type');                     // Carrocería (Coupé, SUV...)
        
        // Detalles técnicos
        $table->string('fuel')->nullable();         // Gasolina, Híbrido...
        $table->string('transmission')->nullable(); // Automática/Manual
        $table->integer('year')->nullable();
        $table->integer('km')->nullable();
        $table->string('engine_size')->nullable();  // ej: V8 4.0L
        $table->integer('hp')->nullable();          // Caballos
        $table->integer('torque')->nullable();      // Par
        $table->integer('weight')->nullable();      // Peso
        
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->string('class');                    // Gama Alta, Media...
        $table->string('image');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};