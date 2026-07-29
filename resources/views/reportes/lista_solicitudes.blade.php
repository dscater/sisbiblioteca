<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>ListaSolicitudes</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 380px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . App\Models\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ App\Models\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">SOLICITUD DE PRÉSTAMOS DE LIBROS</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th width="10%">Código</th>
                <th>Lector</th>
                <th>Libro/Revista Solicitud</th>
                <th width="8%">Tipo</th>
                <th width="8%">Autor</th>
                <th width="8%">Edición</th>
                <th width="8%">Editorial</th>
                <th width="8%">Volumen</th>
                <th>Fecha Solicitud</th>
                <th>Observacion</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($solicituds as $solicitud)
                <tr>
                    <td>{{ $solicitud->codigo }}</td>
                    <td>{{ $solicitud->lector->nombre }} {{ $solicitud->lector->apellidos }}</td>
                    <td>{{ $solicitud->libro->titulo }}</td>
                    <td>{{ $solicitud->libro->tipo }}</td>
                    <td>{{ $solicitud->libro->autor->nombre }}</td>
                    <td>{{ $solicitud->libro->edicion->nombre }}</td>
                    <td>{{ $solicitud->libro->editorial->nombre }}</td>
                    <td>{{ $solicitud->libro->volumen->nombre }}</td>
                    <td>{{ $solicitud->fecha_solicitud }}</td>
                    <td>{{ $solicitud->observacion }}</td>
                    <td>{{ $solicitud->estado_solicitud }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
