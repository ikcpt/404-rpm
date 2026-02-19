<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'car_a_id', 
        'car_b_id',
    ];

    // Relación User 1:N Comparation
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Relación del comparador
    public function carA() {
        return $this->belongsTo(Car::class, 'car_a_id');
    }

    public function carB() {
        return $this->belongsTo(Car::class, 'car_b_id');
    }
}
