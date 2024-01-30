<div id="contenedorClienteEdit">
    <form wire:submit.prevent="update">
        <input type="hidden" name="csrf-token" value="{{ csrf_token() }}">
        <div class="card text-dark bg-light mb-3">
            <h5 class="card-header">Añadir cliente</h5>
            <div class="card-body">
                <div class="mb-3 row d-flex align-items-center">
                    <label for="dni" class="col-sm-2 col-form-label">DNI </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="dni" class="form-control" name="dni" id="dni"
                            placeholder="DNI/NIF (123456789A)">
                        @error('dni')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="nombre" class="col-sm-2 col-form-label">Nombre </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="nombre" class="form-control" name="nombre" id="nombre"
                            placeholder="Nombre del cliente, particular o empresa...">
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="email" class="form-control" name="email" id="email"
                            placeholder="Correo electrónico del cliente (ejemplo@gmail.com)">
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="telefono" class="col-sm-2 col-form-label">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="telefono" class="form-control" name="telefono" id="telefono"
                            placeholder="Teléfono del cliente (123456789)">
                        @error('telefono')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="direccion" class="col-sm-2 col-form-label">Dirección</label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="direccion" class="form-control" name="direccion"
                            id="direccion" placeholder="Dirección del particular o de la empresa (c/ Baldomero, nº 12)">
                        @error('direccion')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div class="mb-3 row d-flex align-items-center">
                    <label for="observaciones" class="col-sm-2 col-form-label">Observaciones </label>
                    <div class="col-sm-10">
                        <input type="text" wire:model="observaciones" class="form-control" name="observaciones"
                            id="observaciones" placeholder="Observaciones o comentarios sobre el cliente.">
                        @error('observaciones')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        @foreach($vehiculos as $index => $vehiculo)
            <div class="card mb-3">
                <div class="card-body">
                <h5>Vehículo {{ $index + 1 }}</h5>
                    <div class="mb-3 row d-flex align-items-center">
                        <label for="matricula" class="col-sm-3 col-form-label">Matrícula</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model="vehiculos.{{ $index }}.matricula" class="form-control" name="vehiculos.{{ $index }}.matricula"
                                id="vehiculos.{{ $index }}.matricula">
                            @error('matricula')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="marca" class="col-sm-3 col-form-label">Marca</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model="vehiculos.{{ $index }}.marca" class="form-control" name="vehiculos.{{ $index }}.marca"
                                id="vehiculos.{{ $index }}.marca">
                            @error('marca')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="modelo" class="col-sm-3 col-form-label">Modelo</label>
                        <div class="col-sm-9">
                            <input type="text" wire:model="vehiculos.{{ $index }}.modelo" class="form-control" name="vehiculos.{{ $index }}.modelo"
                                id="vehiculos.{{ $index }}.modelo">
                            @error('modelo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3 row d-flex align-items-left">
                        <label for="vehiculo_renting" class="col-sm-3 col-form-label">¿Este vehículo es de
                            renting?</label>
                        <input class="col-sm-2 form-check" type="checkbox" wire:model="vehiculos.{{ $index }}.vehiculo_renting"
                        name="vehiculos.{{ $index }}.vehiculo_renting" id="vehiculos.{{ $index }}.vehiculo_renting" />
                        @error('vehiculo_renting')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 row d-flex align-items-center">
                        <label for="kilometros" class="col-sm-3 col-form-label">Kilómetros</label>
                        <div class="col-sm-9">
                            <input type="number" wire:model="vehiculos.{{ $index }}.kilometros" class="form-control" name="vehiculos.{{ $index }}.kilometros"
                                id="vehiculos.{{ $index }}.kilometros">
                            @error('fecha_emision')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <button type="button" wire:click="removeVehiculo({{ $index }})" class="btn btn-danger btn-sm">Eliminar Vehículo</button>
                </div>
            </div>
        @endforeach
        <button type="button" class="btn btn-secondary mb-3" wire:click="addVehiculo">Añadir otro vehículo</button>

        <div class="mb-3 row d-flex align-items-center">
            <button type="submit" class="btn btn-primary">Actualizar datos del cliente</button>
        </div>
    </form>

    <div class="mb-3 row d-flex align-items-center">
        <button type="submit" class="btn btn-danger" wire:click="destroy">Eliminar datos del cliente</button>
    </div>
</div>
