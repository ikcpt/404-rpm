<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'model',
        'type',
        'description',
        'price',
    ];

    public function extras() {
        return $this->belongsToMany(Extra::class, 'car_extras');
    }
}
