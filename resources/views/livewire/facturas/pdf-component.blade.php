<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            color: #333;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        h2 {
            margin-top: 30px;
        }

        p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tfoot td {
            background-color: #f2f2f2;
            font-weight: bold;
        }

    </style>
</head>

<body>
    <div class="container">
        <h1>Factura</h1>
        <div>
            <h2>Datos de la Factura</h2>
            <p><strong>Número de factura:</strong> {{ $factura->numero_factura }}</p>
            <p><strong>Fecha de emisión:</strong> {{ $factura->fecha_emision }}</p>
            <p><strong>Fecha de vencimiento:</strong> {{ $factura->fecha_vencimiento }}</p>
            <p><strong>Descripción:</strong> {{ $factura->descripcion }}</p>
        </div>

        <div>
            <h2>Datos del Cliente</h2>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
        </div>

        <div>
            <h2>Datos del Vehículo</h2>
            <p><strong>Matrícula:</strong> {{ $presupuesto->matricula }}</p>
            <p><strong>Kilómetros:</strong> {{ $presupuesto->kilometros }}</p>
            <p><strong>Modelo:</strong> {{ $presupuesto->modelo }}</p>
            <p><strong>Marca:</strong> {{ $presupuesto->marca }}</p>
        </div>

        <div>
            <h2>Lista de artículos</h2>
            <div class="mb-3 row d-flex align-items-center">
                <table class="table" id="tableProductos" wire:change="añadirProducto">
                    <thead>
                        <tr>
                            <th scope="col">Código</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lista as $productoID => $pCantidad)
                            @if ($pCantidad > 0)
                                @php
                                    $productoLista = $productos->where('id', $productoID)->first();
                                @endphp
                                <tr id="{{ $productoLista->id }}">
                                    <td>{{ $productoLista->cod_producto }}</td>
                                    <td>{{ $productoLista->descripcion }}</td>
                                    <td>{{ $productoLista->precio_venta }}€</td>
                                    <td>{{ $pCantidad }}</td>
                                    <td>{{ $productoLista->precio_venta * $pCantidad }}€</td>
                                <tr>
                            @endif
                        @endforeach
                    <tbody>
                </table>
            </div>     
        </div>
        <div>
            <p><strong>Precio:</strong> {{ $presupuestos->precio }}</p>
        </div> 
    </div>
</body>

</html>