<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Appointment;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relación. User 1:N Car
    public function cars() {
        return $this->hasMany(Car::class);
    }

    // Relación User 1:1 Profile
    public function profile() {
        return $this->hasOne(Profile::class);
    }

    // Relación User 1:N Review
    public function reviews() {
        return $this->hasMany(Review::class);
    }

    // Relación User 1:N Factura
    public function facturas()
    {
        // Cambia 'Factura::class' por 'Invoice::class'
        return $this->hasMany(Invoice::class); 
    }

    // Relación User 1:N Appointment (Cita)
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    // Relación User 1:N Comparation
    public function comparations()
    {
        return $this->hasMany(Comparation::class);
    }
}