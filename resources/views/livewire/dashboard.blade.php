

<div class="row justify-content-center mt-5">
    <div class="col-12 mb-3">
            @if ($jornada_activa == 1)
                <button class="btn btn-lg btn-danger w-100" wire:click="finalizarJornada">FINALIZAR JORNADA</button>
                @if ($pausa_activa == 1)
                    <br><button class="btn btn-lg btn-danger w-100" wire:click="finalizarPausa">FINALIZAR PAUSA</button>
                @else
                    <button class="btn btn-lg btn-primary mt-3 w-100" wire:click="iniciarPausa">INICIAR PAUSA</button>
                @endif
            @else
                <button class="btn btn-lg btn-primary w-100" wire:click="iniciarJornada">INICIAR JORNADA</button>
            @endif
    </div>
</div>
<div class="row d-flex justify-content-around">
    <div class="col-12 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div>
                    <h5 class="font-18">Horas trabajadas hoy</h5>
                </div>
                <h5 class="font-24 mt-4">{{ $this->getHorasTrabajadas('Hoy') }}</h3>
            </div>
        </div>
    </div>
    <div class="col-12 col-xl-3">
        <div class="card">
            <div class="card-heading p-4">
                <div>
                    <h5 class="font-18">Horas trabajadas esta semana</h5>
                </div>
                <h5 class="font-24 mt-4">{{ $this->getHorasTrabajadas('Semana') }}</h3>
            </div>
        </div>
    </div>
</div>
<div class="row justify-content-center">
    <style>
        .dropdown-menu.show {
            position: relative !important;
        }
    </style>
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Tarea activa</h5>
            <div class="card-body">
                @if ($tarea_en_curso != null)
                    <div id="accordion-activa">
                        <div class="card mb-0">
                            <div class="card-header" id="headingOne-activa"
                                @if ($tarea_en_curso->presupuesto->vehiculo_renting == 1) style="background-color: #edc618 !important;" @endif>
                                <h5 class="mb-0 mt-0 font-14">
                                    <a data-toggle="collapse" data-parent="#accordion-activa" href="#collapseOne-activa"
                                        aria-expanded="true" aria-controls="collapseOne-activa" class="text-dark">
                                        {{ $tarea_en_curso->descripcion }}
                                    </a>
                                </h5>
                            </div>
                            <div id="collapseOne-activa" class="collapse show" aria-labelledby="headingOne-activa"
                                data-parent="#accordion-activa">
                                <div class="card-body">
                                    <h5 class="border-bottom"> Datos </h5>
                                    <ul>
                                        <li><b>Cliente:</b> {{ $tarea_en_curso->presupuesto->cliente->nombre }} -
                                            {{ $tarea_en_curso->presupuesto->matricula }}
                                        </li>
                                        <li><b>Presupuesto:</b>
                                            {{ $tarea_en_curso->presupuesto->numero_presupuesto }} </li>
                                        <li><b>Operarios:</b>
                                            <ul>
                                                @foreach (json_decode($tarea_en_curso->operarios, true) as $operario)
                                                    <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><b>Trabajos solicitados:</b>
                                            <ul>
                                                @foreach (json_decode($tarea_en_curso->trabajos_solicitados, true) as $trabajo)
                                                    <li> {{ $trabajo }} </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><b>Trabajos a realizar:</b>
                                            <ul>
                                                @foreach (json_decode($tarea_en_curso->trabajos_realizar, true) as $trabajo)
                                                    <li> {{ $trabajo }} </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><b>Daños localizados</b>
                                            <ul>
                                                @foreach (json_decode($tarea_en_curso->danos_localizados, true) as $trabajo)
                                                    <li> {{ $trabajo }} </li>
                                                @endforeach
                                            </ul>
                                        </li>
                                    </ul>
                                    <h5 class="border-bottom"> Productos </h5>
                                    <table class="table responsive" id="tableProductosCurso">
                                        <thead>
                                            <tr>
                                                <th scope="col">Código</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col" class="none">
                                                    Cantidad
                                                </th>
                                            </tr>
                                        </thead>
                                        @if (count(json_decode($tarea_en_curso->presupuesto->listaArticulos, true)) != 0)
                                            <tbody>
                                                @foreach (json_decode($tarea_en_curso->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                    <tr>
                                                        <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                        </td>
                                                        <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                        </td>
                                                        <td>{{ $cantidad }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            <tbody>
                                        @endif
                                    </table>
                                    <h5 class="border-bottom">&nbsp;</h5>
                                    <div class="row justify-content-center">
                                        <div class="col-6"> <button type="button" class="btn btn-primary"
                                                wire:click="pausarTarea('{{ $tarea_en_curso->id }}', '{{ Auth::id() }}')">Pausar
                                                tarea</button></div>
                                        <div class="col-6"><button
                                                wire:click="completarTarea({{ $tarea_en_curso->id }})"
                                                id="delete-button-{{ $tarea_en_curso->id }}" type="button"
                                                class="btn btn-secondary">Completar
                                                tarea</button>

                                            <script>
                                                document.getElementById('delete-button-{{ $tarea_en_curso->id }}').addEventListener('click', function(event) {
                                                    event.preventDefault();

                                                    Swal.fire({
                                                        title: '¿Estás seguro?',
                                                        text: "Asegúrate de que todo en la tarea está listo.",
                                                        icon: 'warning',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#3085d6',
                                                        cancelButtonColor: '#d33',
                                                        confirmButtonText: 'Marcar como completada'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            // Esto llamará al método confirmDelete de Livewire y pasará el ID del item
                                                            @this.call('completarTarea', {{ $tarea_en_curso->id }})
                                                        }
                                                    })
                                                });
                                            </script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h5>No hay ninguna tarea en curso. </h5>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Tareas asignadas</h5>
            <div class="card-body">
                @if ($tareas_asignadas->count() > 0)
                    <div id="accordionTA">
                        @foreach ($tareas_asignadas as $tarea_asignadaIndex => $tarea_asignada)
                            @if ($tarea_en_curso != null)
                                @if ($tarea_en_curso->id == $tarea_asignada->id)
                                @else
                                    <div class="card mb-0">
                                        <div class="card-header" id="headingTA-{{ $tarea_asignadaIndex }}"
                                            @if ($tarea_asignada->presupuesto->vehiculo_renting == 1) style="background-color: #edc618 !important;" @endif>
                                            <h5 class="mb-0 mt-0 font-14">
                                                <a data-toggle="collapse" data-parent="#accordionTA"
                                                    href="#collapseTA-{{ $tarea_asignadaIndex }}" aria-expanded="true"
                                                    aria-controls="collapseTA-{{ $tarea_asignadaIndex }}"
                                                    class="text-dark">
                                                    {{ $tarea_asignada->descripcion }}
                                                </a>
                                            </h5>
                                        </div>
                                        <div id="collapseTA-{{ $tarea_asignadaIndex }}" class="collapse"
                                            aria-labelledby="headingTA-{{ $tarea_asignadaIndex }}"
                                            data-parent="#accordionTA">
                                            <div class="card-body">
                                                <h5 class="border-bottom"> Datos </h5>
                                                <ul>
                                                    <li><b>Cliente:</b>
                                                        {{ $tarea_asignada->presupuesto->cliente->nombre }}
                                                        -
                                                        {{ $tarea_asignada->presupuesto->matricula }}
                                                    </li>
                                                    <li><b>Presupuesto:</b>
                                                        {{ $tarea_asignada->presupuesto->numero_presupuesto }} </li>
                                                    <li><b>Operarios:</b>
                                                        <ul>
                                                            @foreach (json_decode($tarea_asignada->operarios, true) as $operario)
                                                                <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><b>Trabajos solicitados:</b>
                                                        <ul>
                                                            @foreach (json_decode($tarea_asignada->trabajos_solicitados, true) as $trabajo)
                                                                <li> {{ $trabajo }} </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><b>Trabajos a realizar:</b>
                                                        <ul>
                                                            @foreach (json_decode($tarea_asignada->trabajos_realizar, true) as $trabajo)
                                                                <li> {{ $trabajo }} </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li><b>Daños localizados</b>
                                                        <ul>
                                                            @foreach (json_decode($tarea_asignada->danos_localizados, true) as $trabajo)
                                                                <li> {{ $trabajo }} </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                </ul>
                                                <h5 class="border-bottom"> Productos </h5>
                                                <table class="table responsive"
                                                    id="tableProductosTA{{ $tarea_asignadaIndex }}">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Código</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col" class="none">
                                                                Cantidad
                                                            </th>
                                                        </tr>
                                                    </thead>
                                                    @if (count(json_decode($tarea_asignada->presupuesto->listaArticulos, true)) != 0)
                                                        <tbody>
                                                            @foreach (json_decode($tarea_asignada->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                                <tr>
                                                                    <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                                    </td>
                                                                    <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                                    </td>
                                                                    <td>{{ $cantidad }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        <tbody>
                                                    @endif
                                                </table>
                                                <h5 class="border-bottom">&nbsp;</h5>
                                                <div class="row justify-content-center">
                                                    @if ($tarea_asignada->logs()->count() > 0)
                                                        <div class="col-6"> <button type="button"
                                                                class="btn btn-primary"
                                                                wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Reanudar
                                                                tarea</button></div>
                                                    @else
                                                        <div class="col-6"> <button type="button"
                                                                class="btn btn-primary"
                                                                wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Iniciar
                                                                tarea</button></div>
                                                    @endif
                                                    <div class="col-6"><button
                                                            wire:click="completarTarea({{ $tarea_asignada->id }})"
                                                            id="delete-button-{{ $tarea_asignada->id }}" type="button"
                                                            class="btn btn-secondary">Completar
                                                            tarea</button>

                                                        <script>
                                                            document.getElementById('delete-button-{{ $tarea_asignada->id }}').addEventListener('click', function(event) {
                                                                event.preventDefault();

                                                                Swal.fire({
                                                                    title: '¿Estás seguro?',
                                                                    text: "Asegúrate de que todo en la tarea está listo.",
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Marcar como completada'
                                                                }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        // Esto llamará al método confirmDelete de Livewire y pasará el ID del item
                                                                        @this.call('completarTarea', {{ $tarea_asignada->id }})
                                                                    }
                                                                })
                                                            });
                                                        </script>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @else
                                <div class="card mb-0">
                                    <div class="card-header" id="headingTA-{{ $tarea_asignadaIndex }}"
                                        @if ($tarea_asignada->presupuesto->vehiculo_renting == 1) style="background-color: #edc618 !important;" @endif>
                                        <h5 class="mb-0 mt-0 font-14">
                                            <a data-toggle="collapse" data-parent="#accordionTA"
                                                href="#collapseTA-{{ $tarea_asignadaIndex }}" aria-expanded="true"
                                                aria-controls="collapseTA-{{ $tarea_asignadaIndex }}" class="text-dark"
                                                wire:key='TA-{{ $tarea_asignadaIndex }}'>
                                                {{ $tarea_asignada->descripcion }}
                                            </a>
                                        </h5>
                                    </div>
                                    <div id="collapseTA-{{ $tarea_asignadaIndex }}" class="collapse"
                                        aria-labelledby="headingTA-{{ $tarea_asignadaIndex }}"
                                        data-parent="#accordionTA">
                                        <div class="card-body">
                                            <h5 class="border-bottom"> Datos </h5>
                                            <ul>
                                                <li><b>Cliente:</b> {{ $tarea_asignada->presupuesto->cliente->nombre }}
                                                    -
                                                    {{ $tarea_asignada->presupuesto->matricula }}
                                                </li>
                                                <li><b>Presupuesto:</b>
                                                    {{ $tarea_asignada->presupuesto->numero_presupuesto }} </li>
                                                <li><b>Operarios:</b>
                                                    <ul>
                                                        @foreach (json_decode($tarea_asignada->operarios, true) as $operario)
                                                            <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li><b>Trabajos solicitados:</b>
                                                    <ul>
                                                        @foreach (json_decode($tarea_asignada->trabajos_solicitados, true) as $trabajo)
                                                            <li> {{ $trabajo }} </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li><b>Trabajos a realizar:</b>
                                                    <ul>
                                                        @foreach (json_decode($tarea_asignada->trabajos_realizar, true) as $trabajo)
                                                            <li> {{ $trabajo }} </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                                <li><b>Daños localizados</b>
                                                    <ul>
                                                        @foreach (json_decode($tarea_asignada->danos_localizados, true) as $trabajo)
                                                            <li> {{ $trabajo }} </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            </ul>
                                            <h5 class="border-bottom"> Productos </h5>
                                            <table class="table responsive"
                                                id="tableProductosTA{{ $tarea_asignadaIndex }}">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Código</th>
                                                        <th scope="col">Nombre</th>
                                                        <th scope="col" class="none">
                                                            Cantidad
                                                        </th>
                                                    </tr>
                                                </thead>
                                                @if (count(json_decode($tarea_asignada->presupuesto->listaArticulos, true)) != 0)
                                                    <tbody>
                                                        @foreach (json_decode($tarea_asignada->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                            <tr>
                                                                <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                                </td>
                                                                <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                                </td>
                                                                <td>{{ $cantidad }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    <tbody>
                                                @endif
                                            </table>
                                            <h5 class="border-bottom">&nbsp;</h5>
                                            <div class="row justify-content-center">
                                                @if ($tarea_asignada->logs()->count() > 0)
                                                    <div class="col-6"> <button type="button"
                                                            class="btn btn-primary"
                                                            wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Reanudar
                                                            tarea</button></div>
                                                @else
                                                    <div class="col-6"> <button type="button"
                                                            class="btn btn-primary"
                                                            wire:click="iniciarTarea('{{ $tarea_asignada->id }}', '{{ Auth::id() }}')">Iniciar
                                                            tarea</button></div>
                                                @endif
                                                <div class="col-6"><button
                                                        wire:click="completarTarea({{ $tarea_asignada->id }})"
                                                        id="delete-button-{{ $tarea_asignada->id }}" type="button"
                                                        class="btn btn-secondary">Completar
                                                        tarea</button>

                                                    <script>
                                                        document.getElementById('delete-button-{{ $tarea_asignada->id }}').addEventListener('click', function(event) {
                                                            event.preventDefault();

                                                            Swal.fire({
                                                                title: '¿Estás seguro?',
                                                                text: "Asegúrate de que todo en la tarea está listo.",
                                                                icon: 'warning',
                                                                showCancelButton: true,
                                                                confirmButtonColor: '#3085d6',
                                                                cancelButtonColor: '#d33',
                                                                confirmButtonText: 'Marcar como completada'
                                                            }).then((result) => {
                                                                if (result.isConfirmed) {
                                                                    // Esto llamará al método confirmDelete de Livewire y pasará el ID del item
                                                                    @this.call('completarTarea', {{ $tarea_asignada->id }})
                                                                }
                                                            })
                                                        });
                                                    </script>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                @else
                    <h5> No tienes tareas asignadas. </h5>
                @endif
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <h5 class="card-header">Tareas completadas</h5>
            <div class="card-body">
                <div id="accordionTC">
                    @if ($tareas_completadas->count() > 0)
                        @foreach ($tareas_completadas as $tarea_completadaIndex => $tarea_completada)
                            <div class="card mb-0">
                                <div class="card-header" id="headingTC-{{ $tarea_completadaIndex }}"
                                    @if ($tarea_completada->presupuesto->vehiculo_renting == 1) style="background-color: #edc618 !important;" @endif>
                                    <h5 class="mb-0 mt-0 font-14">
                                        <a data-toggle="collapse" data-parent="#accordionTC"
                                            data-target="#collapseTC-{{ $tarea_completadaIndex }}"
                                            href="#headingTC-{{ $tarea_completadaIndex }}" aria-expanded="true"
                                            aria-controls="collapseTC-{{ $tarea_completadaIndex }}"
                                            class="text-dark">
                                            {{ $tarea_completada->descripcion }}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTC-{{ $tarea_completadaIndex }}" class="collapse"
                                    aria-labelledby="headingTC-{{ $tarea_completadaIndex }}"
                                    data-parent="#accordionTC" wire:key='TC-{{ $tarea_completadaIndex }}'>
                                    <div class="card-body">
                                        <h5 class="border-bottom"> Datos </h5>
                                        <ul>
                                            <li><b>Cliente:</b>
                                                {{ $tarea_completada->presupuesto->cliente->nombre }}
                                                -
                                                {{ $tarea_completada->presupuesto->matricula }}
                                            </li>
                                            <li><b>Presupuesto:</b>
                                                {{ $tarea_completada->presupuesto->numero_presupuesto }} </li>
                                            <li><b>Operarios:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_completada->operarios, true) as $operario)
                                                        <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos solicitados:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_completada->trabajos_solicitados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos a realizar:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_completada->trabajos_realizar, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Daños localizados</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_completada->danos_localizados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                        <h5 class="border-bottom"> Productos </h5>
                                        <table class="table responsive"
                                            id="tableProductosTC{{ $tarea_completadaIndex }}">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col" class="none">
                                                        Cantidad
                                                    </th>
                                                </tr>
                                            </thead>
                                            @if (count(json_decode($tarea_completada->presupuesto->listaArticulos, true)) != 0)
                                                <tbody>
                                                    @foreach (json_decode($tarea_completada->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                        <tr>
                                                            <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                            </td>
                                                            <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                            </td>
                                                            <td>{{ $cantidad }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                <tbody>
                                            @endif
                                        </table>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                            style="width: 100%">
                                            Cobrar </button>
                                        <div class="dropdown-menu" style="height: 100%">
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Contado')">Contado</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Tarjeta de crédito')">Tarjeta
                                                de crédito</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Transferencia bancaria')">Transferencia
                                                bancaria</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Recibo bancario a 30 días')">Recibo
                                                bancario
                                                a 30 días</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Bizum')">Bizum</a>
                                            <a class="dropdown-item" href="#"
                                                wire:click="redirectToCaja('{{ $tarea_completada->id }}', 'Financiado')">Financiado</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                    @if ($tareas_facturadas->count() > 0)
                        @foreach ($tareas_facturadas as $tarea_facturadaIndex => $tarea_facturada)
                            <div class="card mb-0">
                                <div class="card-header" id="headingTF-{{ $tarea_facturadaIndex }}"
                                    style="background-color: lightgreen !important;">
                                    <h5 class="mb-0 mt-0 font-14">
                                        <a data-toggle="collapse" data-parent="#accordionTC"
                                            data-target="#collapseTF-{{ $tarea_facturadaIndex }}"
                                            href="#headingTF-{{ $tarea_facturadaIndex }}" aria-expanded="true"
                                            aria-controls="collapseTF-{{ $tarea_facturadaIndex }}" class="text-dark">
                                            {{ $tarea_facturada->descripcion }}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapseTF-{{ $tarea_facturadaIndex }}" class="collapse"
                                    aria-labelledby="headingTF-{{ $tarea_facturadaIndex }}"
                                    data-parent="#accordionTC" wire:key='TF-{{ $tarea_facturadaIndex }}'>
                                    <div class="card-body">
                                        <h5 class="border-bottom"> Datos </h5>
                                        <ul>
                                            <li><b>Cliente:</b>
                                                {{ $tarea_facturada->presupuesto->cliente->nombre }}
                                                -
                                                {{ $tarea_facturada->presupuesto->matricula }}
                                            </li>
                                            <li><b>Presupuesto:</b>
                                                {{ $tarea_facturada->presupuesto->numero_presupuesto }} </li>
                                            <li><b>Operarios:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_facturada->operarios, true) as $operario)
                                                        <li> {{ $trabajadores->where('id', $operario)->first()->name }}
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos solicitados:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_facturada->trabajos_solicitados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Trabajos a realizar:</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_facturada->trabajos_realizar, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                            <li><b>Daños localizados</b>
                                                <ul>
                                                    @foreach (json_decode($tarea_facturada->danos_localizados, true) as $trabajo)
                                                        <li> {{ $trabajo }} </li>
                                                    @endforeach
                                                </ul>
                                            </li>
                                        </ul>
                                        <h5 class="border-bottom"> Productos </h5>
                                        <table class="table responsive"
                                            id="tableProductosTC{{ $tarea_facturadaIndex }}">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Código</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col" class="none">
                                                        Cantidad
                                                    </th>
                                                </tr>
                                            </thead>
                                            @if (count(json_decode($tarea_facturada->presupuesto->listaArticulos, true)) != 0)
                                                <tbody>
                                                    @foreach (json_decode($tarea_facturada->presupuesto->listaArticulos, true) as $productoE => $cantidad)
                                                        <tr>
                                                            <td>{{ $productos->where('id', $productoE)->first()->cod_producto }}
                                                            </td>
                                                            <td>{{ $productos->where('id', $productoE)->first()->descripcion }}
                                                            </td>
                                                            <td>{{ $cantidad }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                <tbody>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

</div>
