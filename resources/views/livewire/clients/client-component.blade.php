<div id="containerClientes">
    <div class="card mb-3">
        <h5 class="card-header">
            Clientes
        </h5>
        <div class="card-body">
            @if (count($clientes) > 0)
                <table class="table" id="tableCliente">
                    <thead>
                        <tr>
                            <th scope="col">ID del cliente</th>
                            <th scope="col">DNI</th>
                            <th scope="col">Nombre fiscal</th>
                            <th scope="col">Nombre comercial</th>
                            <th scope="col">Email</th>
                            <th scope="col">Dirección</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Observaciones</th>
                            <th scope="col"><strong>Editar cliente</strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                            <tr>
                                <th scope="row">{{ $cliente->id }}</th>
                                <td>{{ $cliente->dni }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->nombre }}</td>
                                <td>{{ $cliente->email }}</td>
                                <td>{{ $cliente->direccion }}</td>
                                <td>{{ $cliente->telefono }}</td>
                                <td>{{ $cliente->observaciones }}</td>
                                <td><a href="/admin/clients/edit/{{ $cliente->id }}" class="btn btn-primary">Editar</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h5>No hay clientes en la base de datos</h5>
            @endif
            <br>
            <a href="{{ route('clients.create') }}" class="btn btn-primary">Añadir cliente</a>
        </div>
    </div>
</div>
