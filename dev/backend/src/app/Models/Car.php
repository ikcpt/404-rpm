<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

protected $fillable = [
    'brand_id',
    'user_id', 
    'model', 
    'color', 
    'type', 
    'fuel', 
    'transmission', 
    'year', 
    'km', 
    'engine_size',
    'hp', 
    'torque', 
    'weight',
    'description', 
    'price', 
    'class', 
    'image'
];

    // Relación Brand 1:N Car
    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    // Relación User 1:N Car
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // Relación Car N:M Extra
    public function extras() {
        return $this->belongsToMany(Extra::class);
    }

    // Relación Car 1:N Appointment (Cita)
    public function cita()
    {
        return $this->hasMany(Cita::class);
    }
}