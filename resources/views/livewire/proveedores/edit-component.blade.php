<div class="container mx-auto" style="min-height: 100vh">
    <style>
        /* Estilos generales para form-group */
    .form-group {
        margin-bottom: 15px;
        position: relative;
    }

    /* Estilizar el label */
    .form-group > label {
        display: block;
        margin-bottom: 5px;
        color: #495057;
        font-size: 16px;
    }

    /* Estilizar el input de tipo archivo */
    .form-group > input[type="file"] {
        width: 100%;
        padding: 2px;
        border: 1px solid #ced4da;
        border-radius: 4px;
        line-height: 1.5;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .form-group > input[type="file"]::file-selector-button {
        padding: 4px 16px;
        margin-right: 8px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color .15s ease-in-out;
    }

    .form-group > input[type="file"]::file-selector-button:hover {
        background-color: #0056b3;
    }

    /* Estilo para los mensajes de error */
    .error {
        display: block;
        color: #dc3545;
        margin-top: 5px;
    }
    </style>
    <div class="card mb-3">
        <h5 class="card-header"> Modificar proveedor {{ $nombre }}</h5>
        <div class="card-body">
            <form wire:submit.prevent="update">
                <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">


                    <div class="mb-3 row d-flex align-items-center">
                        <label for="dni" class="col-sm-2 col-form-label">DNI </label>
                        <div class="col-sm-10">
                            <input type="text" wire:model="dni" class="form-control" name="dni" id="dni"
                                placeholder="7515763200P">
                            @error('dni')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="nombre" class="form-control" name="nombre" id="nombre"
                            placeholder="Carlos">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="email" class="form-control" name="email" id="email"
                            placeholder="ejemplo@gmail.com">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="telefono" class="form-control" name="telefono" id="telefono"
                            placeholder="956812502">
                        @error('telefono')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Dirección </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion" class="form-control" name="direccion"
                            id="direccion" placeholder="Calle Baldomero nº 12">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="observaciones" class="col-sm-2 col-form-label">Observaciones </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="observaciones" class="form-control" name="observaciones"
                            id="observaciones" placeholder="Pérez">
                        @error('observaciones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="mb-3 row d-flex align-items-center justify-content-around">
        <button type="submit" class="btn btn-primary">Guardar</button>
        <button wire:click="destroy" class="btn btn-danger">Eliminar</button>
    </div>
    <div class="card mb-3">
        <h5 class="card-header">Compras</h5>
        <div class="card-body">
            <button wire:click="agregarCompraModal()" class="btn btn-primary w-100 mb-2">Agregar Compra</button>
            @if(count($compras) > 0)
                <table class="table table-bordered" id="compras-datatable">
                    <thead>
                        <tr>
                            <th>Producto</th>
                            <th>Cantidad</th>
                            <th>Fecha de Pedido</th>
                            <th>Fecha de Llegada</th>
                            <th>Archivo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($compras as $compra)
                            <tr>
                                <td>{{ $compra->productos->cod_producto }}</td>
                                <td>{{ $compra->cantidad }}</td>
                                <td>{{ $compra->fecha_pedido }}</td>
                                <td>{{ $compra->fecha_llegada }}</td>
                                <td>
                                    @if($compra->archivo_path)
                                    <button wire:click="descargarArchivo({{$compra->id }})" class="btn btn-primary">Descargar</button>
                                    @endif
                                </td>
                                <td>
                                    <button wire:click="editarCompra({{ $compra->id }})" class="btn btn-info">Editar</button>
                                    <button wire:click="eliminarCompra({{ $compra->id }})" class="btn btn-danger">Eliminar</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
    <!-- Modal para agregar o editar compras -->
    <div class="modal fade {{ $isOpen ? 'show' : '' }}" style="display: {{ $isOpen ? 'block' : 'none' }}; background: rgba(0,0,0,0.5);" id="compraModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document"> <!-- Modal más grande -->
            <div class="modal-content">
                <div class="modal-header bg-primary text-white"> <!-- Encabezado con color -->
                    <h5 class="modal-title">{{ $compraActual ? 'Editar Compra' : 'Agregar Compra' }}</h5>
                    <button type="button" class="close text-white" wire:click="closeModal">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="productoId">Producto:</label>
                            <select wire:model="productoId" class="form-control">
                                <option value="">Seleccione un producto</option>
                                @foreach(\App\Models\Productos::all() as $producto)
                                    <option value="{{ $producto->id }}">{{ $producto->cod_producto  }}</option>
                                @endforeach
                            </select>
                            @error('productoId') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" wire:model="cantidad" class="form-control">
                            @error('cantidad') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="fechaPedido">Fecha de Pedido:</label>
                            <input type="date" wire:model="fechaPedido" class="form-control">
                            @error('fechaPedido') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group">
                            <label for="fechaLlegada">Fecha de Llegada (opcional):</label>
                            <input type="date" wire:model="fechaLlegada" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="archivo">Archivo (opcional):</label>
                            <input type="file" wire:model="archivo" class="form-control">
                            @error('archivo') <span class="error text-danger">{{ $message }}</span> @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" wire:click="closeModal">Cerrar</button>
                    <button type="button" class="btn btn-success" wire:click="guardarCompra">Guardar</button>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
<script>
        $(document).ready(function() {
            $('#compras-datatable').DataTable();
        });
    </script>
@endsection
