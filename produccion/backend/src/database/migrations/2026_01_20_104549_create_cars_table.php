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
        $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
        $table->string('model');
        $table->string('color')->nullable();   
        $table->string('type');
        $table->string('fuel')->nullable();    
        $table->string('transmission')->nullable();
        $table->integer('year')->nullable();
        $table->integer('km')->nullable();
        $table->string('engine_size')->nullable();
        $table->integer('hp')->nullable();    
        $table->integer('torque')->nullable();   
        $table->integer('weight')->nullable();      
        $table->text('description');
        $table->decimal('price', 10, 2);
        $table->string('class');    
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