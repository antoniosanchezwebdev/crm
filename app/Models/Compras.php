<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compras extends Model
{
    use HasFactory;


    protected $fillable = [
        'proveedores_id',
        'productos_id',
        'cantidad',
        'fecha_pedido',
        'fecha_llegada',
        'archivo_path'
    ];

    protected $dates = [
        'created_at', 'updated_at', 'deleted_at',
    ];

      /**
     * Obtener el proveedor asociado a la compra.
     */
    public function proveedor()
    {
        return $this->belongsTo(Proveedores::class);
    }

    /**
     * Obtener el producto asociado a la compra.
     */
    public function productos()
    {
        return $this->belongsTo(Productos::class);
    }
}
