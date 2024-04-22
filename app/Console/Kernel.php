<?php

namespace App\Console;


use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;
use App\Mail\RevisionReminder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\Clients;
use App\Models\Presupuesto;
use App\Models\Facturas;
use App\Models\Vehiculo;
use App\Models\Alertas;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {

            // Obtener la fecha de emisión de la última factura por cada cliente y coche
            $ultimasFacturas = DB::table('facturas as f')
            ->join('presupuestos as p', 'f.id_presupuesto', '=', 'p.id')
            ->select('p.cliente_id as cliente_id', 'p.matricula as matricula', 'f.fecha_emision as fecha_ultima_factura', 'p.id as presupuesto_id')
            ->whereRaw('f.fecha_emision = (SELECT MAX(f2.fecha_emision) FROM facturas f2 WHERE f2.id_presupuesto = p.id)')
            ->orderBy('p.matricula', 'desc')
            ->get();

            // Calcular la fecha límite para enviar el correo electrónico (un año después de la fecha de emisión de la última factura)
            $fechaLimite = Carbon::now()->subYear()->startOfDay();

            // Verificar y enviar el correo electrónico si corresponde
            foreach ($ultimasFacturas as $factura) {
                $fechaUltimaFactura = Carbon::parse($factura->fecha_ultima_factura);
                $clienteId = $factura->cliente_id;
                $matricula = $factura->matricula;

                // Verificar si ha pasado un año desde la fecha de emisión de la última factura
                if ($fechaUltimaFactura->eq($fechaLimite)) {
                    // Obtener el cliente y el vehículo asociados
                    $cliente = Clients::find($clienteId);
                    $vehiculo = Vehiculo::where('matricula',$matricula)->first();
                    // Enviar el correo electrónico de recordatorio al cliente
                    Mail::to($cliente->email)->send(new RevisionReminder($cliente,$vehiculo));
                }
            }

            $hoy = Carbon::now()->startOfDay();
            $FacturasVencimiento = Facturas::whereDate('fecha_vencimiento', '=', $hoy->toDateString())->get();
            foreach ($FacturasVencimiento as $factura) {
                // Verificar si ya existe una alerta para este pedido
                $alertaExistente = Alertas::where('referencia_id', $factura->id)->where('estado_id',1)->first();
                if (!$alertaExistente) {
                    Alertas::create([
                        'tipo_id' => 1,
                        'estado_id' => 0,
                        'titulo' => 'Factura Vencimiento',
                        'descripcion' => 'La factura nº ' . $factura->numero_factura . ' ha vencido.',
                        'referencia_id' => $factura->id,
                    ]);
                }
            }
        })->everyMinute();


    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');

    }
}
