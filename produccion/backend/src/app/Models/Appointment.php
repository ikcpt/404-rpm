<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_id',
        'fecha',
        'hora',
        'tipo',
        'estado'
    ];

    protected $casts = [
        'fecha' => 'date', // Para poder formatear la fecha fácilmente en la vista
    ];

    // Relación User 1:N Appointments (Cita)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación Car 1:N Appointment (Cita)
    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}