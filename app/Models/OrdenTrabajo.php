<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrdenTrabajo extends Model
{
    use HasFactory;

    protected $table = "orden_trabajos";

    protected $fillable = [
        'fecha',
        'id_cliente',
        'id_presupuesto',
        'observaciones',
        'trabajos_solicitados',
        'trabajos_realizar',
        'operarios',
        'operarios_tiempo',
        'danos_localizados',

    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function presupuesto()
    {
        return $this->hasOne(Presupuesto::class, 'id', 'id_presupuesto');
    }
}
