<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::create('comparations', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('car_a_id')->constrained('cars')->cascadeOnDelete();
        $table->foreignId('car_b_id')->constrained('cars')->cascadeOnDelete();
        $table->timestamps();
    });
}


    public function down(): void
    {
        Schema::dropIfExists('comparisons');
    }
};
