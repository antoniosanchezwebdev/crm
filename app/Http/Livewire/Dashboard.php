<?php

namespace App\Http\Livewire;

use App\Models\OrdenLog;
use App\Models\OrdenTrabajo;
use App\Models\Productos;
use App\Models\User;
use App\Models\Jornada;
use App\Models\Pausa;
use Carbon\Carbon as CarbonCarbon;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Dashboard extends Component
{
    use LivewireAlert;
    use WithFileUploads;
    public $tareas_asignadas;
    public $tareas_completadas;
    public $tareas_facturadas;
    public $tareas_en_curso;
    public $alertas;
    public $trabajadores;
    public $jornada_activa;
    public $pausa_activa;
    public $documento;
    public $horasTrabajadasHoy;
    public $horasTrabajadasSemana;
    public $documentosArray = [];
    public $tareaSeleccionadaId = null;
    public $rutasDocumentos = [];


    public $tab = "tab1";

    public $productos;

    public function mount()
    {
        $mes = Carbon::now()->month;
        $this->tareas_en_curso = Auth::user()->tareasEnCurso;
        $this->tareas_asignadas = Auth::user()->tareas->where('estado' ,'Asignada');
        $this->tareas_completadas = Auth::user()->tareas->where('estado', 'Completada')->filter(function ($tarea) use ($mes) {
            return Carbon::parse($tarea->updated_at)->month == $mes;
        });
        $this->tareas_facturadas = Auth::user()->tareas->where('estado', 'Facturada');
        $this->alertas = [];
        $this->trabajadores = User::all();
        $this->recalcularHoras();
        $this->checkJornada();
        $this->productos = Productos::all();
    }

    public function render()
    {
        return view('livewire.dashboard');
    }

    public function seleccionarTarea($tareaId) {
        $this->tareaSeleccionadaId = $tareaId;
    }
    public function iniciarTarea($tareaId, $trabajadorId)
    {
        $log = new OrdenLog();

        $log->tarea_id = $tareaId;
        $log->trabajador_id = $trabajadorId;
        $log->fecha_inicio = Carbon::now();
        $log->estado = "En curso";

        $log->save();

        return redirect(request()->header('Referer'));
    }

    public function pausarTarea($tareaId, $trabajadorId)
    {
        $log = OrdenLog::where('tarea_id', $tareaId)
            ->where('trabajador_id', $trabajadorId)
            ->where('estado', "En curso")
            ->whereNull('fecha_fin')
            ->orderBy('fecha_inicio', 'desc')
            ->first();

        if ($log) {
            $log->fecha_fin = Carbon::now();
            $log->estado = "Pausa";
            $log->save();
        }

        $totalMinutes = $this->tiempoTotalTrabajado($tareaId, $trabajadorId);

        $tarea = OrdenTrabajo::find($tareaId);
        if ($tarea->operarios_tiempo != null && !empty($tarea->operarios_tiempo)) {
            $operarios_tiempo = json_decode($tarea->operarios_tiempo, true);
            if (!is_array($operarios_tiempo)) {
                $operarios_tiempo = []; // Asegúrate de que es un arreglo
            }

            // Actualiza el tiempo trabajado por el operario
            $operarios_tiempo[$trabajadorId] = $totalMinutes;

            // Guarda los cambios
            $tarea->operarios_tiempo = json_encode($operarios_tiempo); // Convierte el array a un string JSON
            $tarea->save();
        } else {

            // Actualiza el tiempo trabajado por el operario
            $operarios_tiempo = [$trabajadorId => $totalMinutes];

            // Guarda los cambios
            $tarea->operarios_tiempo = json_encode($operarios_tiempo); // Convierte el array a un string JSON
            $tarea->save();
        }

        return redirect(request()->header('Referer'));
    }

    public function tiempoTotalTrabajado($tareaId, $trabajadorId)
    {
        $logs = OrdenLog::where('tarea_id', $tareaId)
            ->where('trabajador_id', $trabajadorId)
            ->get();

        $totalMinutes = 0;

        foreach ($logs as $log) {
            $start = new Carbon($log->fecha_inicio);
            $end = $log->fecha_fin ? new Carbon($log->fecha_fin) : Carbon::now();

            $totalMinutes += $end->diffInSeconds($start);
        }

        return $totalMinutes;
    }

    public function completarTarea($tareaId)
    {
        $tarea = OrdenTrabajo::find($tareaId);
        $tarea->estado = "Completada";
        $tarea->save();

        return redirect(request()->header('Referer'));
    }
    public function redirectToCaja($tarea, $metodo_pago)
    {
        session()->flash('tarea', $tarea);
        session()->flash('metodo_pago', $metodo_pago);

        return redirect()->route('caja.index');
    }

    public function cambioTab($tab){
        $this->tab = $tab;
    }

    public function iniciarJornada()
    {
        $hora_inicio = Carbon::now()->toDateTimeString();
        $user_id = Auth::id();
        Jornada::create(['user_id' => $user_id, 'hora_inicio' => $hora_inicio, 'status' => 1]);
        $this->checkJornada();
        $this->recalcularHoras();
    }


    public function finalizarJornada()
    {
        $hora_final = Carbon::now()->toDateTimeString();
    $user_id = Auth::id();

    // Obtener la jornada activa actual
    $jornada_actual = Jornada::where('user_id', $user_id)->where('status', 1)->first();

    // Asegurarse de que existe una jornada activa antes de intentar actualizar
    if ($jornada_actual) {
        $jornada_actual->update([
            'hora_final' => $hora_final, // Actualizar solo la hora final
            'status' => 0 // Cambiar el estado a inactivo
        ]);

    }

    $this->checkJornada();
    $this->recalcularHoras();
    }

    public function iniciarPausa()
    {
        $hora_inicio = Carbon::now()->toDateTimeString();
        $user_id = Auth::id();
        Pausa::create(['user_id' => $user_id, 'hora_inicio' => $hora_inicio, 'status' => 1]);
        $this->checkJornada();
        $this->recalcularHoras();
    }

    public function finalizarPausa()
    {
        $hora_final = Carbon::now()->toDateTimeString();
        $user_id = Auth::id();
        $jornada_actual = Pausa::where('user_id', $user_id)->where('status', 1)->first();
        $jornada_actual->update(['hora_final' => $hora_final, 'status' => 0]);
        $this->checkJornada();
        $this->recalcularHoras();
    }

    public function checkJornada()
    {
        $jornada = Jornada::where('user_id', Auth::id())->where('status', 1)->count();
        $pausa = Pausa::where('user_id', Auth::id())->where('status', 1)->count();
        if ($jornada > 0) {
            $this->jornada_activa = 1;
        } else {
            $this->jornada_activa = 0;
        }
        if ($pausa > 0) {
            $this->pausa_activa = 1;
        } else {
            $this->pausa_activa = 0;
        }

    }
    private function recalcularHoras() {
        // Asumiendo que tienes una propiedad en tu componente para almacenar las horas
        $this->horasTrabajadasHoy = $this->getHorasTrabajadas('Hoy');
        $this->horasTrabajadasSemana = $this->getHorasTrabajadas('Semana');
    }
    public function getHorasTrabajadas($query)
    {
        switch ($query) {
            case 'Hoy':
                $fecha = Carbon::now();

                $inicioDelDia = $fecha->copy()->startOfDay();
                $finalDelDia = $fecha->copy()->endOfDay();

                $usuarioId = auth()->id();

                $logsJornada = Jornada::where('user_id', $usuarioId)
                    ->where('hora_inicio', '>=', $inicioDelDia)
                    ->where(function ($query) use ($finalDelDia) {
                        $query->where('hora_final', '<=', $finalDelDia)->orWhereNull('hora_final');
                    })
                    ->orderBy('hora_inicio', 'asc')
                    ->get();

                $logsPausas = Pausa::where('user_id', $usuarioId)
                    ->where('hora_inicio', '>=', $inicioDelDia)
                    ->where(function ($query) use ($finalDelDia) {
                        $query->where('hora_final', '<=', $finalDelDia)->orWhereNull('hora_final');
                    })
                    ->orderBy('hora_inicio', 'asc')
                    ->get();

                $totalSegundosTrabajados = 0;

                foreach ($logsJornada as $log) {
                    $hora_inicio = Carbon::parse($log->hora_inicio);
                    $hora_final = $log->hora_final ? Carbon::parse($log->hora_final) : $fecha;

                    $totalSegundosTrabajados += $hora_inicio->diffInSeconds($hora_final);
                }

                foreach ($logsPausas as $log) {
                    $hora_inicio = Carbon::parse($log->hora_inicio);
                    $hora_final = $log->hora_final ? Carbon::parse($log->hora_final) : $fecha;

                    $totalSegundosTrabajados -= $hora_inicio->diffInSeconds($hora_final);
                }

                $horas = intdiv($totalSegundosTrabajados, 3600);
                $minutos = intdiv($totalSegundosTrabajados % 3600, 60);
                $segundos = $totalSegundosTrabajados % 60;

                $diferencia = sprintf("%02d horas, %02d minutos, %02d segundos", $horas, $minutos, $segundos);

                return $diferencia;

            case 'Semana':
                $usuarioId = Auth::id();
                $ahora = Carbon::now();
                $inicioDeSemana = $ahora->copy()->startOfWeek();
                $finDeSemana = $ahora->copy()->endOfWeek();

                $totalSegundosJornada = 0;
                $totalSegundosPausas = 0;

                for ($dia = $inicioDeSemana->copy(); $dia->lte($finDeSemana); $dia->addDay()) {
                    // Calcular duración total de las jornadas del día
                    $logsJornada = Jornada::where('user_id', $usuarioId)
                        ->whereDate('hora_inicio', $dia->toDateString())
                        ->get();

                    foreach ($logsJornada as $log) {
                        $hora_inicio = Carbon::parse($log->hora_inicio);
                        $hora_final = $log->hora_final ? Carbon::parse($log->hora_final) : $ahora;

                        $duracion = $hora_inicio->diffInSeconds($hora_final);
                        $totalSegundosJornada += $duracion;
                    }

                    // Calcular duración total de las pausas del día
                    $logsPausas = Pausa::where('user_id', $usuarioId)
                        ->whereDate('hora_inicio', $dia->toDateString())
                        ->get();

                    foreach ($logsPausas as $log) {
                        $hora_inicio = Carbon::parse($log->hora_inicio);
                        $hora_final = $log->hora_final ? Carbon::parse($log->hora_final) : $ahora;

                        $duracion = $hora_inicio->diffInSeconds($hora_final);
                        $totalSegundosPausas += $duracion;
                    }
                }

                // Restar la duración total de las pausas a la duración total de las jornadas
                $totalSegundosTrabajados = $totalSegundosJornada - $totalSegundosPausas;

                $horas = intdiv($totalSegundosTrabajados, 3600);
                $minutos = intdiv($totalSegundosTrabajados % 3600, 60);
                $segundos = $totalSegundosTrabajados % 60;

                $diferencia = sprintf("%02d horas, %02d minutos, %02d segundos", $horas, $minutos, $segundos);
                return $diferencia;
        }
    }


    public function subirArchivo()
    {
        // Encuentra la orden de trabajo
        $ordenTrabajo = OrdenTrabajo::find($this->tareaSeleccionadaId);
        $documentosExistentes = $ordenTrabajo ? json_decode($ordenTrabajo->documentos, true) ?? [] : [];

        $index = count($documentosExistentes);

        foreach ($this->documentosArray as $documento) {
            $this->documento = $documento;
            $this->validate([
                'documento' => 'file|max:10240', // 10MB
            ]);

            // Generar un nombre de archivo más simple y secuencial
            $index++;  // Incrementar el índice por cada archivo subido
            $extension = $documento->getClientOriginalExtension();  // Obtener la extensión del archivo original
            $nombreDelArchivo = time() . '_' ."documento_{$this->tareaSeleccionadaId}_{$index}.{$extension}";
            $rutaDocumento = $documento->storeAs('documentos', $nombreDelArchivo, 'public_local');
            $this->rutasDocumentos[] = $rutaDocumento;
        }

        if ($ordenTrabajo) {
            // Añadir los nuevos documentos a los existentes y guardar
            $documentosActualizados = array_merge($documentosExistentes, $this->rutasDocumentos);
            $ordenTrabajo->documentos = json_encode($documentosActualizados);
            $ordenTrabajo->save();
        }

        // Restablecer la variable para ocultar el formulario
        $this->tareaSeleccionadaId = null;
        $this->documentosArray = [];
        $this->rutasDocumentos = [];

        // Opcional: agregar una notificación de éxito
        $this->alert('success', 'Archivos subidos correctamente!');
    }
}


