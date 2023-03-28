<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presupuesto extends Model
{
    use HasFactory;

    protected $table = "presupuestos";

    protected $fillable = [
        'numero_presupuesto',
        'fecha_emision',
        'cliente_id',
        'matricula',
        'kilometros',
        'trabajador_id',
        'listaArticulos',
        'precio',
        'origen',
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
