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

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
public function extras() {
    return $this->belongsToMany(Extra::class);
}
}