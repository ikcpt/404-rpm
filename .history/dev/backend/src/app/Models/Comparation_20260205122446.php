<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comparison extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'car_a_id',
        'car_b_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function carA()
    {
        return $this->belongsTo(Car::class, 'car_a_id');
    }

    public function carB()
    {
        return $this->belongsTo(Car::class, 'car_b_id');
    }
}
