<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuestos extends Model
{
    use HasFactory;

    protected $table = "presupuestos";

    protected $fillable = [
        'numpero_presupuesto',
        'fecha_emision',
        'alumno_id',
        'curso_id',
        'detalles',
        'total_sin_iva',
        'iva',
        'descuento',
        'precio',
        'estado',
        'observaciones',
    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];
}
