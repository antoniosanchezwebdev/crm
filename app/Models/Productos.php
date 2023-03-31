<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Productos extends Model
{
    use HasFactory;

    protected $table = "productos";

    protected $fillable = [
        'cod_producto',
        'descripcion',
        'tipo_producto',
        'ecotasa',
        'fabricante',
        'etiquetado_eu',
        'estado',
        'categoria_id',
        'precio_baremo',
        'descuento',
        'precio_costoNeto',
        'precio_venta',
        'stock',

    ];

    /**
     * Mutaciones de fecha.
     *
     * @var array
     */
    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo("App\Models\ProductosCategories");
    }
}
