<div class="row justify-content-center">
    <div class="col-md-11">
        <br>
        <h4 class="text-center">Tareas sin completar </h4>
        <hr />
        <div class="accordion border-primary" id="accordionExample1">
            @foreach ($tareas_no_completadas as $tareaIndex => $tarea)
                <div class="card accordion-item mb-3 mb-1">
                    @if ($tarea->estado == 'Facturada')
                        <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            style="background-color: #7dc15b !important;" data-bs-target="#collapseNC{{ $tareaIndex }}"
                            aria-expanded="false" aria-controls="collapseNC{{ $tareaIndex }}">
                            <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                            </h5>
                        </button>
                    @else
                        @if ($tarea->presupuesto->vehiculo_renting == 1)
                            <button class="card-header accordion-button collapsed bg-warning" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseNC{{ $tareaIndex }}"
                                aria-expanded="false" aria-controls="collapseNC{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @else
                            <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseNC{{ $tareaIndex }}" aria-expanded="false"
                                aria-controls="collapseNC{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingNC{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @endif
                    @endif

                    <div id="collapseNC{{ $tareaIndex }}" class="accordion-collapse collapse"
                        aria-labelledby="headingNC{{ $tareaIndex }}" data-bs-parent="#accordionExample">
                        <div class="card-body accordion-body">
                            <h5>ESTADO:</h5>
                            {{ $tarea->estado }}
                            <hr />

                            <div class="accordion border-primary" id="accordionExample1NC{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1">
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse1NC{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse1NC{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading1NC{{ $tareaIndex }}"> Datos </h5>
                                    </button>
                                    <div id="collapse1NC{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading1NC{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample1NC{{ $tareaIndex }}">
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

                            <div class="accordion border-primary" id="accordionExample2NC{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1" wire:ignore>
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2NC{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse2NC{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading2NC{{ $tareaIndex }}"> Productos
                                        </h5>
                                    </button>
                                    <div id="collapse2NC{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading2NC{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample2NC{{ $tareaIndex }}">
                                        <div class="card-body accordion-body">
                                            <div x-data="{}" x-init="$nextTick(() => {
                                                console.log('hola');
                                                $('#tableProductosNCNC{{ $tareaIndex }}').DataTable({
                                                    responsive: true,
                                                    fixedHeader: true,
                                                    searching: false,
                                                    paging: false,
                                                    autoWidth: false,
                                                });
                                            })">
                                                <table class="table responsive"
                                                    id="tableProductosNC{{ $tareaIndex }}">
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

                            <div class="row">
                                @if ($tarea->estado == 'Facturada')
                                @else
                                    <hr />
                                    @if ($tarea->estado == 'Completada')
                                        <div class="col">
                                            <div class="d-grid gap-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones de cobro
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'No pagado')">Guardar
                                                            sin cobrar</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Contado')">Contado</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Tarjeta de crédito')">Tarjeta
                                                            de crédito</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Transferencia bancaria')">Transferencia
                                                            bancaria</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Recibo bancario a 30 días')">Recibo
                                                            bancario
                                                            a 30 días</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Bizum')">Bizum</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'Financiado')">Financiado</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($tarea->logsEnCurso()->count() > 0)
                                            <div class="col-6"> <button type="button" class="btn btn-danger"
                                                    wire:click="pausarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Pausar
                                                    tarea</button></div>
                                        @else
                                            @if ($tarea->logs()->count() > 0)
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Reanudar
                                                        tarea</button></div>
                                            @else
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Iniciar
                                                        tarea</button></div>
                                            @endif
                                        @endif
                                        <div class="col-6"><button wire:click="completarTarea({{ $tarea->id }})"
                                                id="delete-button-{{ $tarea->id }}" type="button"
                                                class="btn btn-secondary">Completar tarea</button>

                                            <script>
                                                document.getElementById('delete-button-{{ $tarea->id }}').addEventListener('click', function(event) {
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
                                                            @this.call('completarTarea', {{ $tarea->id }})
                                                        }
                                                    })
                                                });
                                            </script>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <hr />

                        </div>
                    </div>

                    @endforeach
        </div>
        <br>
        <h4 class="text-center">Tareas completadas </h4>
        <hr />
        <div class="accordion border-primary" id="accordionExampleC">

            @foreach ($tareas_completadas as $tareaIndex => $tarea)
                <div class="card accordion-item mb-3 mb-1">
                    @if ($tarea->estado == 'Facturada')
                        <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            style="background-color: #7dc15b !important;"
                            data-bs-target="#collapseC{{ $tareaIndex }}" aria-expanded="false"
                            aria-controls="collapseC{{ $tareaIndex }}">
                            <h5 class="accordion-header" id="headingC{{ $tareaIndex }}">
                                {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                            </h5>
                        </button>
                    @else
                        @if ($tarea->presupuesto->vehiculo_renting == 1)
                            <button class="card-header accordion-button collapsed bg-warning" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseC{{ $tareaIndex }}"
                                aria-expanded="false" aria-controls="collapseC{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingC{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @else
                            <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseC{{ $tareaIndex }}" aria-expanded="false"
                                aria-controls="collapseC{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingC{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @endif
                    @endif

                    <div id="collapseC{{ $tareaIndex }}" class="accordion-collapse collapse"
                        aria-labelledby="headingC{{ $tareaIndex }}" data-bs-parent="#accordionExample">
                        <div class="card-body accordion-body">
                            <h5>ESTADO:</h5>
                            {{ $tarea->estado }}
                            <hr />

                            <div class="accordion border-primary" id="accordionExample1C{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1">
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse1C{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse1C{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading1C{{ $tareaIndex }}"> Datos </h5>
                                    </button>
                                    <div id="collapse1C{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading1C{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample1C{{ $tareaIndex }}">
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

                            <div class="accordion border-primary" id="accordionExample2C{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1" wire:ignore>
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2C{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse2C{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading2C{{ $tareaIndex }}"> Productos
                                        </h5>
                                    </button>
                                    <div id="collapse2C{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading2C{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample2C{{ $tareaIndex }}">
                                        <div class="card-body accordion-body">
                                            <div x-data="{}" x-init="$nextTick(() => {
                                                console.log('hola');
                                                $('#tableProductosC{{ $tareaIndex }}').DataTable({
                                                    responsive: true,
                                                    fixedHeader: true,
                                                    searching: false,
                                                    paging: false,
                                                    autoWidth: false,
                                                });
                                            })">
                                                <table class="table responsive"
                                                    id="tableProductosC{{ $tareaIndex }}">
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

                            <div class="row">
                                @if ($tarea->estado == 'Facturada')
                                @else
                                    <hr />
                                    @if ($tarea->estado == 'Completada')
                                        <div class="col">
                                            <div class="d-grid gap-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones de cobro
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'No pagado')">Guardar
                                                            sin cobrar</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Contado')">Contado</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Tarjeta de crédito')">Tarjeta
                                                            de crédito</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Transferencia bancaria')">Transferencia
                                                            bancaria</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Recibo bancario a 30 días')">Recibo
                                                            bancario
                                                            a 30 días</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Bizum')">Bizum</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'Financiado')">Financiado</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($tarea->logsEnCurso()->count() > 0)
                                            <div class="col-6"> <button type="button" class="btn btn-danger"
                                                    wire:click="pausarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Pausar
                                                    tarea</button></div>
                                        @else
                                            @if ($tarea->logs()->count() > 0)
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Reanudar
                                                        tarea</button></div>
                                            @else
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Iniciar
                                                        tarea</button></div>
                                            @endif
                                        @endif
                                        <div class="col-6"><button wire:click="completarTarea({{ $tarea->id }})"
                                                id="delete-button-{{ $tarea->id }}" type="button"
                                                class="btn btn-secondary">Completar tarea</button>

                                            <script>
                                                document.getElementById('delete-button-{{ $tarea->id }}').addEventListener('click', function(event) {
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
                                                            @this.call('completarTarea', {{ $tarea->id }})
                                                        }
                                                    })
                                                });
                                            </script>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <hr />

                        </div>
                    </div>
            @endforeach
        </div>

        <br />
        <h4 class="text-center">Tareas facturadas </h4>
        <hr />
        <div class="accordion border-primary" id="accordionExampleF">

            @foreach ($tareas_facturadas as $tareaIndex => $tarea)
                <div class="card accordion-item mb-3 mb-1">
                    @if ($tarea->estado == 'Facturada')
                        <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            style="background-color: #7dc15b !important;"
                            data-bs-target="#collapseF{{ $tareaIndex }}" aria-expanded="false"
                            aria-controls="collapseF{{ $tareaIndex }}">
                            <h5 class="accordion-header" id="headingF{{ $tareaIndex }}">
                                {{ $tarea->presupuesto->cliente->nombre }} - {{ $tarea->presupuesto->matricula }}
                            </h5>
                        </button>
                    @else
                        @if ($tarea->presupuesto->vehiculo_renting == 1)
                            <button class="card-header accordion-button collapsed bg-warning" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapseF{{ $tareaIndex }}"
                                aria-expanded="false" aria-controls="collapseF{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingF{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} -
                                    {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @else
                            <button class="card-header accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseF{{ $tareaIndex }}" aria-expanded="false"
                                aria-controls="collapseF{{ $tareaIndex }}">
                                <h5 class="accordion-header" id="headingF{{ $tareaIndex }}">
                                    {{ $tarea->presupuesto->cliente->nombre }} -
                                    {{ $tarea->presupuesto->matricula }}
                                </h5>
                            </button>
                        @endif
                    @endif

                    <div id="collapseF{{ $tareaIndex }}" class="accordion-collapse collapse"
                        aria-labelledby="headingF{{ $tareaIndex }}" data-bs-parent="#accordionExample">
                        <div class="card-body accordion-body">
                            <h5>ESTADO:</h5>
                            {{ $tarea->estado }}
                            <hr />

                            <div class="accordion border-primary" id="accordionExample1F{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1">
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse1F{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse1F{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading1F{{ $tareaIndex }}"> Datos </h5>
                                    </button>
                                    <div id="collapse1F{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading1F{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample1F{{ $tareaIndex }}">
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

                            <div class="accordion border-primary" id="accordionExample2F{{ $tareaIndex }}">
                                <div class="card accordion-item mb-3 mb-1" wire:ignore>
                                    <button class="card-header accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#collapse2F{{ $tareaIndex }}"
                                        aria-expanded="false" aria-controls="collapse2F{{ $tareaIndex }}">
                                        <h5 class="accordion-header" id="heading2F{{ $tareaIndex }}"> Productos
                                        </h5>
                                    </button>
                                    <div id="collapse2F{{ $tareaIndex }}" class="accordion-collapse collapse"
                                        aria-labelledby="heading2F{{ $tareaIndex }}"
                                        data-bs-parent="#accordionExample2F{{ $tareaIndex }}">
                                        <div class="card-body accordion-body">
                                            <div x-data="{}" x-init="$nextTick(() => {
                                                console.log('hola');
                                                $('#tableProductosF{{ $tareaIndex }}').DataTable({
                                                    responsive: true,
                                                    fixedHeader: true,
                                                    searching: false,
                                                    paging: false,
                                                    autoWidth: false,
                                                });
                                            })">
                                                <table class="table responsive"
                                                    id="tableProductosF{{ $tareaIndex }}">
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

                            <div class="row">
                                @if ($tarea->estado == 'Facturada')
                                @else
                                    <hr />
                                    @if ($tarea->estado == 'Completada')
                                        <div class="col">
                                            <div class="d-grid gap-2">
                                                <div class="dropdown">
                                                    <button class="btn btn-secondary dropdown-toggle" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        Opciones de cobro
                                                    </button>
                                                    <div class="dropdown-menu">
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'No pagado')">Guardar
                                                            sin cobrar</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Contado')">Contado</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Tarjeta de crédito')">Tarjeta
                                                            de crédito</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Transferencia bancaria')">Transferencia
                                                            bancaria</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Recibo bancario a 30 días')">Recibo
                                                            bancario
                                                            a 30 días</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}','Bizum')">Bizum</a>
                                                        <a class="dropdown-item" href="#"
                                                            wire:click="redirectToCaja('{{ $tarea->id }}', 'Financiado')">Financiado</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        @if ($tarea->logsEnCurso()->count() > 0)
                                            <div class="col-6"> <button type="button" class="btn btn-danger"
                                                    wire:click="pausarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Pausar
                                                    tarea</button></div>
                                        @else
                                            @if ($tarea->logs()->count() > 0)
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Reanudar
                                                        tarea</button></div>
                                            @else
                                                <div class="col-6"> <button type="button" class="btn btn-primary"
                                                        wire:click="iniciarTarea('{{ $tarea->id }}', '{{ Auth::id() }}')">Iniciar
                                                        tarea</button></div>
                                            @endif
                                        @endif
                                        <div class="col-6"><button wire:click="completarTarea({{ $tarea->id }})"
                                                id="delete-button-{{ $tarea->id }}" type="button"
                                                class="btn btn-secondary">Completar tarea</button>

                                            <script>
                                                document.getElementById('delete-button-{{ $tarea->id }}').addEventListener('click', function(event) {
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
                                                            @this.call('completarTarea', {{ $tarea->id }})
                                                        }
                                                    })
                                                });
                                            </script>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            <hr />

                        </div>
                    </div>
            @endforeach
        </div>
    </div>
</div>
