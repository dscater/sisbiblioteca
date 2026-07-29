<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Libros</title>
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
            word-wrap: break-word;
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
            width: 400px;
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

        .txt_rojo {}

        .img_celda img {
            width: 45px;
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
        <h4 class="texto">MOVIMIENTO DE LIBROS</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    <table border="1">
        <thead>
            <tr>
                <th width="3%">Nro. Inv.</th>
                <th>Título</th>
                <th>Área</th>
                <th>Autor</th>
                <th>Edición</th>
                <th>Volumen</th>
                <th>Lugar</th>
                <th>Editorial</th>
                <th>Año</th>
                <th>Nro. Páginas</th>
                <th>ISBN</th>
                <th>Procedencia</th>
                <th>Precio</th>
                <th>Signatura</th>
                <th>Estado</th>
                <th>Tipo</th>
                <th>Ubicación</th>
                <th width="3.5%">Portal</th>
                <th>Observaciones</th>
                <th>Fecha Registro</th>
                <th>Movimiento</th>
            </tr>
        </thead>
        <tbody>
            @php
                $cont = 1;
            @endphp
            @foreach ($libros as $libro)
                <tr>
                    <td>{{ $cont++ }}</td>
                    <td>{{ $libro->titulo }}</td>
                    <td>{{ $libro->area->nombre }}</td>
                    <td>{{ $libro->autor->nombre }}</td>
                    <td>{{ $libro->edicion->nombre }}</td>
                    <td>{{ $libro->volumen->nombre }}</td>
                    <td>{{ $libro->lugar->nombre }}</td>
                    <td>{{ $libro->editorial->nombre }}</td>
                    <td>{{ $libro->fecha_anio }}</td>
                    <td>{{ $libro->nro_paginas }}</td>
                    <td>{{ $libro->isbn }}</td>
                    <td>{{ $libro->procedencia }}</td>
                    <td>{{ $libro->precio }}</td>
                    <td>{{ $libro->signatura }}</td>
                    <td>{{ $libro->estado }}</td>
                    <td>{{ $libro->tipo }}</td>
                    <td>{{ $libro->ubicacion->estante }} - {{ $libro->ubicacion->balda }}</td>
                    <td>{{ $libro->portal }}</td>
                    <td>{{ $libro->observaciones }}</td>
                    <td>{{ $libro->fecha_registro }}</td>
                    <td>{{ $libro->prestamos->last()->tipo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
