<?php

namespace App\Http\Livewire\Trabajadores;

use App\Models\User;
use Livewire\Component;
use App\Models\OrdenTrabajo;
use App\Models\OrdenLog;
use Carbon\Carbon;

class IndexComponent extends Component
{
    // public $search;
    public $trabajadores;

    public function mount()
    {
        $this->trabajadores = User::all();
    }

    public function render()
    {
        return view('livewire.trabajadores.index-component');
    }
    public function seleccionarProducto($user)
    {
        $this->emit("seleccionarProducto", $user);
    }
    
    public function calcularProductividad($trabajadorId)
    {
    $inicioMes = Carbon::now()->startOfMonth();
    $finMes = Carbon::now()->endOfMonth();
    $tareas = OrdenTrabajo::whereHas('logs', function ($query) use ($trabajadorId) {
                        $query->where('trabajador_id', $trabajadorId);
                    })
                    ->where('estado', 'Completada')
                    ->orWhere('estado', 'Facturada')
                    ->whereBetween('updated_at', [$inicioMes, $finMes])
                    ->get();

    $totalEstimado = 0;
    $totalReal = 0;

    foreach ($tareas as $tarea) {
        $totalEstimado += $this->getTiempoEstimadoTareaEnHoras($tarea->lista_tiempo);
        $totalReal += $this->getTiempoRealTareaEnHoras($tarea->id);
    }

    if ($totalReal > 0) {
        $productividad = ($totalEstimado / $totalReal) * 100;
    } else {
        $productividad = 0;
    }

    return round($productividad, 2); // Redondear a dos decimales
    }

    public function getTiempoEstimadoTareaEnHoras($listaTiempo)
    {
    return array_sum(json_decode($listaTiempo));
    }

    public function getTiempoRealTareaEnHoras($tareaId)
    {
    $logs = OrdenLog::where('tarea_id', $tareaId)->get();
    $totalSegundos = 0;

    foreach ($logs as $log) {
        $inicio = new Carbon($log->fecha_inicio);
        $fin = $log->fecha_fin ? new Carbon($log->fecha_fin) : Carbon::now();
        $totalSegundos += $inicio->diffInSeconds($fin);
    }

    return $totalSegundos / 3600; // Convertir segundos a horas
    }
}
