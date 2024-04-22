<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Factura de Neumalgex</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            background-color: #f4f4f4;
            padding: 20px;
            line-height: 1.6;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }
        .header {
            font-size: 20px;
            color: #333;
            border-bottom: 2px solid #0067A3;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .footer {
            font-size: 14px;
            text-align: center;
            margin-top: 20px;
            color: #777;
        }
        a {
            color: #0067A3;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            Factura de Neumalgex
        </div>
        <p>Estimado/a <strong>{{ $cliente->nombre }}</strong>,</p>
        <p>Adjunto a este correo encontrará su factura. Le pedimos que la revise a la mayor brevedad posible.</p>
        <p>Agradecemos su elección por nuestros servicios y esperamos continuar asistiéndole en sus necesidades automotrices.</p>
        <p>Puede ponerse en contacto con nosotros a través de nuestro correo electrónico <a href="mailto:info@neumalgex.com">info@neumalgex.com</a> o llamando al <a href="tel:+685353934">685 353 934</a> para cualquier consulta.</p>
        <div class="footer">
            Atentamente,<br>
            <strong>Equipo de Neumalgex</strong><br>
            C/Los Metalúricos 1, Antigua Aliauto, Algeciras
        </div>
    </div>
</body>
</html>
