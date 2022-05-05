<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud de nueva obra</title>
</head>
<body>
    <h1>Solicitud de nueva obra</h1>
    <p>Se ha solicitado una nueva obra a través de Heden Watercolor, a continuación se muestran los detalles aportados.</p>
    <div>
        Nombre: {{$name}} <br>
        Email: {{$email}} <br>
        Número de teléfono:  {{$phone}} <br>
        Detalles de la petición:  {{$details}} <br>
    </div>
    <p>
        Encontrará como dato adjunto en este correo electrónico la imagen que se ha adjuntado en el formulario.
    </p>
</body>
</html>