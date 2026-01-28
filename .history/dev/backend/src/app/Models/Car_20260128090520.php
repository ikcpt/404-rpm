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
        'type',
        'description',
        'price',
        'image',
    ];

    public function brand() {
        return $this->belongsTo(Brand::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
    
public function extras() {
    return $this->belongsToMany(Extra::class); / o 'car_extra' s
}
}