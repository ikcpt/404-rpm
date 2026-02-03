<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    // IMPORTANTE: Como la tabla en la base de datos se llama 'facturas'
    // pero este modelo se llama 'Invoice', debemos forzar la conexión:
    protected $table = 'facturas';

    protected $fillable = [
        'user_id',
        'numero_referencia',
        'concepto',
        'importe',
        'estado',
        'fecha_emision',
    ];

    // Esto convierte automáticamente la fecha en un objeto Carbon (para poder usar ->format('d/m/Y'))
    protected $casts = [
        'fecha_emision' => 'date',
    ];

    // Relación inversa: Una factura pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}