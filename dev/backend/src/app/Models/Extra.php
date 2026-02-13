<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Extra extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
    ];
    
    // Relación Car N:M Extra
    public function cars() {
        return $this->belongsToMany(Car::class);
    }
}