<div id="containerTrabajadores">
@php
$user = Auth::user();
@endphp
    @if ($trabajadores->count() > 0)
        <div class="card" wire:ignore>
            <h5 class="card-header">Resultados</h5>
            <div class="card-body" x-data="{}" x-init="$nextTick(() => {
                $('#tableEmpresas').DataTable({
                    responsive: true,
                    fixedHeader: true,
                    searching: false,
                    paging: false,
                });
            })"> 
                <table class="table responsive" id="tableEmpresas">
                    <thead>
                        <tr>
                            <th scope="col">Nombre</th>
                            @if ($user && $user->role == 'admin')
                            <th scope="col">Productividad</th>
                            @endif
                            <th scope="col">ID de usuario</th>
                            <th scope="col">Puesto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                        @foreach ($trabajadores as $trabajador)
                            <tr>
                                <td>{{ $trabajador->name }} {{ $trabajador->surname }} </td>
                                @if ($user && $user->role == 'admin')
                                <td> 
                                    @php
                                    $productividad = $productividadPorTrabajador[$trabajador->id] ?? 0;
                                    @endphp
                                    <div class="progress">
                                        <div class="progress-bar" role="progressbar" 
                                            style="width: {{ $trabajador->productividad }}%;" 
                                            aria-valuenow="{{ $trabajador->productividad }}" 
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ number_format($productividadPorTrabajador[$trabajador->id], 2) }}%
                                        </div>
                                     </div>
                                </td>
                                @endif
                                <td>{{ $trabajador->username }} </td>
                                <td>{{ $trabajador->role }} </td>
                                <td> <button type="button" class="btn btn-primary boton-producto"
                                        onclick="Livewire.emit('seleccionarProducto', {{ $trabajador->id }});">Ver/Editar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h3>¡No hay usuarios registrados!</h3>
            </div>
        </div>
    @endif
</div>
