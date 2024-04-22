<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alertas extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'estado_id',
        'tipo_id',
        'referencia_id',
        'roles',
        'descripcion',
        'observaciones',
        'titulo',

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
