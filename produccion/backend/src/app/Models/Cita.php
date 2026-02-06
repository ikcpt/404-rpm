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
    'tipo', // <--- AÑADE ESTO
    'description',
    'estado',
    'brand_manual',  // Asegúrate de tener estos también si los usas
    'model_manual'
];

protected $casts = [
        'fecha' => 'datetime',
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