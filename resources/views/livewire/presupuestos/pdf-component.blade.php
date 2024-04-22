<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto - Neumalgex</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background: #FFF;
            color: #000;
        }
        .invoice-container {
            padding: 20px;
        }
       .invoice-title {
            text-align: right;
        }
        .invoice-header img {
            display: inline-block;
            max-width: 15%;
            vertical-align: middle;
        }
        .invoice-header {
            width: 100%;
            display:block;
            margin-bottom: 50px;
        }
        .invoice-title {
            display: inline-block;
            vertical-align: middle;
            width: 70%; /* width of the container minus the image width */
            text-align: right;
        }
        .invoice-title p {
            margin-bottom: 0 !important;
            margin-top: 0 !important;
            font-size: 12px;
        }
        .cliente{
            margin-top: 20px;
        }

        .total-price {
            margin-top: 60px;
        }
        .total-price td ,.total-price th {
            border-right: 1px solid black;
            border-left: 1px solid black;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
         td {
            padding: 8px;
            text-align: left;
        }
        th {
            padding: 8px 8px 0 8px;
            border-bottom: 1px solid black;
        }
        .factura th{
            text-align: left;
        }

        .productos th, .productos td {
            text-align: center;
        }
        .productos td {
            border-right: 1px solid black;
            border-left: 1px solid black;
        }
        .productos tr:last-child {
            border-bottom: 1px solid black;

        }
        .productos thead th {
            background-color: #e9f2ae;
        }
        .total-price table {
            width: auto;
            border: 2px solid black;
            margin-left:auto;
        }
        .total-price th, .total-price td {
            text-align: right;
        }
        h2{
            margin-bottom: 6px !important;
            font-size: 21px;
            font-weight: bolder;
        }

        h3{
            margin-top: 0 !important;
            margin-bottom: 0 !important;
            font-weight: 500;
        }
        .total-price thead {
            background-color: #e9f2ae;
        }
        .cliente-datos{
            display: inline-block;
            width: 53%;
            text-align: right;
        }
        .factura-title{
            display: inline-block;
            width: 45%;
        }
        .cliente p {
            margin-top: 0;
            margin-bottom: 0;
        }
        .factura{
            margin-top: -2%;
        }

    </style>
</head>
<body>
    <div class="invoice-container">
        <div class="invoice-header">
             <img style="display: inline-block; max-width:180px;" src="{{ storage_path('public/logo_neumal_s.png') }}" alt="Neumalgex Logo" >
            <div class="invoice-title">
                <p><b>Tel.: 685 353 934</b></p>
                <p><b>C/Los Metalúricos 1, Antigua Aliauto, Algeciras</b></p>
                <p><b>info@neumalgex.com</b></p>
                <p><b>www.neumalgex.com</b></p>
            </div>
        </div>
        <div class="cliente">
            <div class="factura-title" >
                <h2>Presupuesto - {{ $presupuesto->numero_presupuesto }}</h2>
                <h3>Servicio {{ $presupuesto->servicio }}</h3>
            </div>
            <div class="cliente-datos">
                <p><strong>Nombre:</strong> {{ $cliente->nombre }}</p>
                <p><strong>DNI:</strong> {{ $cliente->dni }}</p>
                <p><strong>Email:</strong> {{ $cliente->email }}</p>
                <p><strong>Teléfono:</strong> {{ $cliente->telefono }}</p>
                <p><strong>Dirección:</strong> {{ $cliente->direccion }}</p>
            </div>
        </div>
        <div class="factura">
            <table>
                <tr>
                    <th>Fecha de emisión</th>
                    <th>Presupuesto dado en</th>
                    <th colspan="2">Datos del vehículo</th>
                </tr>
                <tr>
                    <td>{{ $presupuesto->fecha_emision }}</td>
                    <td>{{ $presupuesto->origen }}</td>
                    <td>Matricula:{{ $presupuesto->matricula }}</td>
                    <td>Kilometros:{{ $presupuesto->kilometros }}</td>
                </tr>
            </table>
        </div>

        <div class="productos">
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
            <div style="margin-top:1%">
                <p><b>Firma:</b></p>
            </div>
        </div>
        <div class="total-price">
            <table>
                <thead>
                    <tr>
                        <th>Imp. Bruto</th>
                        <th>% IVA</th>
                        <th>Imp. IVA</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{$presupuesto->precio}}€</td>
                        <td>21%</td>
                        <td>{{$presupuesto->precio * 0.21}}€</td>
                        <td>{{$presupuesto->precio * 1.21}}€</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div style="margin-top:1%">
            <p><b>Observaciones:</b></p><p>{{$presupuesto->observaciones}}</p>
        </div>
    </div>
</body>
</html>
