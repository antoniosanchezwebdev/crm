<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura - Neumalgex</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #eeeeee;
        }
        .invoice-container {
            max-width: 800px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .invoice-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 40px;
        }
        .invoice-header img {
            max-width: 100px; /* Ajustar según el tamaño del logo */
            filter: grayscale(100%);
        }
        .invoice-title {
            text-align: right;
            font-size: 24px;
        }
        h2 {
            color: #333;
            border-bottom: 2px solid #eeeeee;
            padding-bottom: 10px;
        }
        p {
            margin: 5px 0 15px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        .total-price {
            text-align: right;
            margin-top: 20px;
        }
        .total-price strong {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
            <img src="https://crm.neumalgexspain.com/images/logo.png" alt="Neumalgex Logo"> <!-- Asegúrate de reemplazar 'path/to/logo.png' con la ruta real de tu logo -->
            <div class="invoice-title">Factura</div>
        </div>
        <section>
            <h2>Datos de la Factura</h2>
            <p><strong>Número de factura:</strong> {{ $factura->numero_factura }}</p>
            <p><strong>Fecha de emisión:</strong> {{ $factura->fecha_emision }}</p>
            <p><strong>Fecha de vencimiento:</strong> {{ $factura->fecha_vencimiento }}</p>
            <p><strong>Descripción:</strong> {{ $factura->descripcion }}</p>
        </section>
        <section>
            <h2>Datos del Cliente</h2>
            <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
            <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
            <p><strong>Email:</strong> {{ $cliente->email }}</p>
            <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
            <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
        </section>
        <section>
            <h2>Datos del Vehículo</h2>
            <p><strong>Matrícula:</strong> {{ $presupuesto->matricula }}</p>
            <p><strong>Kilómetros:</strong> {{ $presupuesto->kilometros }}</p>
            <p><strong>Modelo:</strong> {{ $presupuesto->modelo }}</p>
            <p><strong>Marca:</strong> {{ $presupuesto->marca }}</p>
        </section>
        <section>
            <h2>Lista de artículos</h2>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
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
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </section>
        <div class="total-price">
            <p><strong>Precio Total:</strong> {{ $presupuesto->precio }}€</p>
        </div>
    </div>
</body>
</html>