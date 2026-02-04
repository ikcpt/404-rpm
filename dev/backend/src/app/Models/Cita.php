<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    use HasFactory;

    // Campos que permitimos rellenar
    protected $fillable = [
        'user_id',
        'car_id',
        'fecha',
        'hora',
        'description',
        'estado' // 'pendiente', 'confirmada', etc.
    ];

    // Relación: Una cita pertenece a un Usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación: Una cita pertenece a un Coche
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}