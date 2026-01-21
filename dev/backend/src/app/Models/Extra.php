<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function cars() {
        return $this->belongsToMany(Car::class, 'car_extras');
    }
}
