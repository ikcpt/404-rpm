<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'surname',
        'phone',
        'address',
    ];

    // Relación User 1:1 Profile
    public function user() {
        return $this->belongsTo(User::class);
    }
}