<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Mail;
use App\Mail\RecordatorioCorreo;
use Illuminate\Support\Facades\DB;

// Obtener la fecha de emisión de la última factura por cada cliente y coche
$ultimasFacturas = DB::table('facturas')
    ->join('presupuestos', 'facturas.id_presupuesto', '=', 'presupuestos.id')
    ->join('clients', 'presupuestos.cliente_id', '=', 'clients.id')
    ->join('vehiculos', 'clients.id', '=', 'vehiculos.clients_id')
    ->select('clients.id as cliente_id', 'vehiculos.id as vehiculo_id', DB::raw('MAX(facturas.fecha_emision) as fecha_ultima_factura'))
    ->groupBy('clients.id', 'vehiculos.id') 
    ->orderBy('facturas.fecha_emision', 'desc')
    ->get();

// Calcular la fecha límite para enviar el correo electrónico (un año después de la fecha de emisión de la última factura)
$fechaLimite = now()->subYear();

// Verificar y enviar el correo electrónico si corresponde
foreach ($ultimasFacturas as $factura) {
    $fechaUltimaFactura = $factura->fecha_ultima_factura;
    $clienteId = $factura->cliente_id;
    $vehiculoId = $factura->vehiculo_id;

    // Verificar si ha pasado un año desde la fecha de emisión de la última factura
    if ($fechaUltimaFactura->equalTo($fechaLimite)) {
        // Obtener el cliente y el vehículo asociados
        $cliente = Cliente::find($clienteId);
        $vehiculo = Vehiculo::find($vehiculoId);

        // Enviar el correo electrónico de recordatorio al cliente
        Mail::to($cliente->email)->send(new RecordatorioCorreo($cliente, $vehiculo));
    }
}