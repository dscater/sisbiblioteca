<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recordatorio</title>
</head>

<body>
    <h3>Recordatorio de Devolución</h3>
    <p>Señor(a) {{ $datos['nombre'] }} {{ $datos['apellidos'] }} le recordamos que tiene un libro pendiente de
        devolución.</p>
    <p>Detalles del préstamo:</p>
    <ul>
        <li><strong>Título:</strong> {{ $datos['titulo'] }}</li>
        <li><strong>Volumen:</strong> {{ $datos['volumen'] }}</li>
        <li><strong>Edición:</strong> {{ $datos['edicion'] }}</li>
        <li><strong>Autor:</strong> {{ $datos['autor'] }}</li>
        @if ($datos['tipo'] == 'PORTAL')
            <li><strong>Código Solicitud:</strong> {{ $datos['codigo_solicitud'] }}</li>
            <li><strong>Fecha Solicitud:</strong> {{ $datos['fecha_solicitud'] }}</li>
        @endif
        <li><strong>Fecha Devolución:</strong> {{ $datos['fecha_devolucion'] }}</li>
    </ul>
</body>

</html>
