<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="accordion border-primary" id="accordionExample">
            @foreach ($tareas as $tareaIndex => $tarea)
                <div class="card accordion-item">
                    @if($tarea->presupuesto->vehiculo_renting == 1)
                    <button class="card-header accordion-button bg-warning" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $tareaIndex }}" aria-expanded="true"
                        aria-controls="collapse{{ $tareaIndex }}">
                        <h5 class="accordion-header" id="heading{{ $tareaIndex }}">
                            {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}</h5>
                    </button>
                    @else
                    <button class="card-header accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapse{{ $tareaIndex }}" aria-expanded="true"
                        aria-controls="collapse{{ $tareaIndex }}">
                        <h5 class="accordion-header" id="heading{{ $tareaIndex }}">
                            {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}</h5>
                    </button>
                    @endif
                    <div id="collapse{{ $tareaIndex }}" class="accordion-collapse collapse"
                        aria-labelledby="heading{{ $tareaIndex }}" data-bs-parent="#accordionExample">
                        <div class="card-body accordion-body">
                            <h5>ESTADO:</h5>
                            {{ $tarea->estado }}
                            <hr />

                            <div class="accordion border-primary" id="accordionExample1{{ $tareaIndex }}">
                                <div class="card accordion-item">
                                    <button class="card-header accordion-button" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse1{{ $tareaIndex }}"
                                        aria-expanded="true" aria-controls="collapse1{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading1{{ $tareaIndex }}"> Datos </h5>
                                    </button>
                                    <div id="collapse1{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading1{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample1{{ $tareaIndex }}">
                                        <div class="card-body accordion-body">
                                            <h5 class="card-title">Fecha de emisión:</h5>
                                            <p class="card-text">{{ $tarea->fecha }}</p>
                                            <hr />
                                            <h5 class="card-title">Descripción del trabajo:</h5>
                                            <p class="card-text">{{ $tarea->descripcion }}</p>
                                            <hr />
                                            <h5 class="card-title">Datos del vehículo:</h5>
                                            <p><b>Matrícula:</b> {{ $tarea->presupuesto->matricula }}</p>
                                            <p><b>Marca:</b> {{ $tarea->presupuesto->marca }}</p>
                                            <p><b>Modelo:</b> {{ $tarea->presupuesto->modelo }}</p>
                                            <hr />
                                            <h5 class="card-title">Precio (IVA incluido):</h5>
                                            <p class="card-text">
                                                {{ $tarea->presupuesto->precio + $tarea->presupuesto->precio * 0.21 }}
                                            </p>
                                            <hr />
                                            <h5 class="card-title">Comentarios:</h5>
                                            <p class="card-text" id="comentarios">{{ $tarea->observaciones }}
                                            </p>
                                            <hr />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion border-primary" id="accordionExample2{{ $tareaIndex }}">
                                <div class="card accordion-item" wire:ignore>
                                    <button class="card-header accordion-button" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2{{ $tareaIndex }}"
                                        aria-expanded="true" aria-controls="collapse2{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading2{{ $tareaIndex }}"> Productos </h5>
                                    </button>
                                    <div id="collapse2{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading2{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample2{{ $tareaIndex }}">
                                        <div class="card-body accordion-body">
                                            <div x-data="{}" x-init="$nextTick(() => {
                                                console.log('hola');
                                                $('#tableProductos{{ $tareaIndex }}').DataTable({
                                                    responsive: true,
                                                    fixedHeader: true,
                                                    searching: false,
                                                    paging: false,
                                                    autoWidth: false,
                                                });
                                            })">
                                                <table class="table responsive" id="tableProductos{{ $tareaIndex }}">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">Código</th>
                                                            <th scope="col">Nombre</th>
                                                            <th scope="col" class="none">Cantidad</th>
                                                        </tr>
                                                    </thead>
                                                    @if (count(json_decode($tarea->presupuesto->listaArticulos, true)) != 0)
                                                        <tbody>
                                                            @foreach (json_decode($tarea->presupuesto->listaArticulos, true) as $productoE => $cantidad)
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
                                </div>
                            </div>

                            <div class="accordion border-primary" id="accordionExample3{{ $tareaIndex }}">
                                <div class="card accordion-item">
                                    <button class="card-header accordion-button" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse3{{ $tareaIndex }}"
                                        aria-expanded="true" aria-controls="collapse3{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading3{{ $tareaIndex }}"> Opciones </h5>
                                    </button>
                                    <div id="collapse3{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading3{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample3{{ $tareaIndex }}">
                                        <div class="card-body accordion-body" wire:ignore>
                                            <ul>
                                                <li><button type="button" class="btn btn-success">Cobrar</button></li>
                                                @if ($tarea->logsEnCurso()->count() > 0)
                                                    <li> <button type="button" class="btn btn-danger"
                                                            wire:click="pausarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Pausar
                                                            tarea</button></li>
                                                @else
                                                    @if ($tarea->logs()->count() > 0)
                                                        <li> <button type="button" class="btn btn-primary"
                                                                wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Reanudar
                                                                tarea</button></li>
                                                    @else
                                                        <li> <button type="button" class="btn btn-primary"
                                                                wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Iniciar
                                                                tarea</button></li>
                                                    @endif
                                                @endif
                                                <li><button type="button" class="btn btn-secondary">Completar
                                                        tarea</button></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr />
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
