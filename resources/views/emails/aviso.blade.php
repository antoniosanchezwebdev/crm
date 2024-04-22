<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trabajo Completado - Neumalgex</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #ffffff;
            border: 1px solid #dddddd;
            padding: 20px;
            margin-top: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        h1 {
            color: #0056b3;
        }
        p {
            line-height: 1.5;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: small;
            color: #666;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Confirmación de Trabajo Completado - Neumalgex</h1>
        <p>Estimado/a {{ $clientName }},</p>
        <p>Estamos encantados de informarle que el trabajo en su vehículo {{$vehiculo->marca}} con matrícula {{$vehiculo->matricula}} ha sido completado con éxito. Su vehículo está listo para ser recogido en nuestras instalaciones.</p>
        <p>Por favor, pase por nuestro taller para recoger su vehículo en cualquier momento durante nuestras horas de trabajo. Si tiene alguna pregunta o necesita más información, no dude en contactarnos.</p>
        <p>Agradecemos su confianza en nosotros para cuidar de su vehículo.</p>
        <p>Gracias,</p>
        <p>El equipo de Neumalgex</p>
        <div class="footer">
            <p>Visítenos en: www.neumalgex.com</p>
            <p>Contacto: info@neumalgex.com | Teléfono: 685 353 934</p>
        </div>
    </div>
</body>

</html>
