<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>ComprobanteDevolución</title>
    <style type="text/css">
        *{
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right:  1cm;
            border: 5px solid blue;
          }

        table{
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top:20px;
        }

        table thead tr th, tbody tr td{
            font-size: 0.63em;
        }
        .encabezado{
            width: 100%;
        }

        .logo img{
            position: absolute;
            width: 200px;
            height: 90px;
            top:-40px;
            left:-20px;
        }
        h2.titulo{
            width: 400px;
            margin: auto;
            margin-top:15px; 
            margin-bottom:15px; 
            text-align: center;
            font-size:14pt;
        }

        .texto{
            width: 380px;
            text-align: center;
            margin:auto;
            margin-top:15px; 
            font-weight: bold;
            font-size:1.1em;
        }

        .fecha{
            width: 250px;
            text-align: center;
            margin:auto;
            margin-top:15px; 
            font-weight: normal;
            font-size:0.85em;
        }

        .total{
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table{
            width: 100%;
        }

        table thead{
            background:rgb(236, 236, 236)
        }

        table thead tr th{
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td{
            padding: 3px;
            font-size: 0.7em;
        }

        .centreado{
            padding-left: 0px;
            text-align: center;
        }

        .datos{
            margin-left: 15px;
            border-top:solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt{
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center{
            font-weight: bold;
            text-align: center;
        }

        .b_top{
            border-top:solid 1px black;
        }

        .gray{
            background: rgb(202, 202, 202);
        }

        .txt_rojo{
        }

        .img_celda img{
            width: 45px;
        }

        .bold{
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/'.biblioteca\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ biblioteca\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">COMPROBANTE DE DEVOLUCIÓN</h4>
        <h4 class="fecha">Expedido: {{date('Y-m-d')}}</h4>
    </div>

    <table border="1">
        <thead>
            <tr>
                <th colspan="4">INFORMACIÓN DEL LECTOR</th>
            </tr>
        </thead>
        <tbody> 
            <tr>
                <td class="bold" width="15%">Nombre: </td>
                <td>{{$prestamo->lector->nombre}} {{$prestamo->lector->apellidos}}</td>
                <td class="bold" width="15%">C.I.: </td>
                <td>{{$prestamo->lector->ci}} {{$prestamo->lector->ci_exp}}</td>
            </tr>
            <tr>
                <td class="bold">Celular: </td>
                <td>{{$prestamo->lector->cel}}</td>
                <td class="bold">Correo: </td>
                <td>{{$prestamo->lector->correo}}</td>
            </tr>
        </tbody>
    </table>

    <table border="1">
        <thead>
            <tr>
                <th colspan="4">INFORMACIÓN DE DEVOLUCIÓN PRÉSTAMO</th>
            </tr>
        </thead>
        <tbody> 
            <tr>
                <td class="bold" width="15%">Fecha devolución: </td>
                <td>{{$prestamo->fecha_registro}}</td>
                <td class="bold" width="15%">Título del Libro/Revista: </td>
                <td>{{$prestamo->libro->titulo}}</td>
            </tr>
            <tr>
                <td class="bold">Área: </td>
                <td>{{$prestamo->libro->area->nombre}}</td>
                <td class="bold">Autor: </td>
                <td>{{$prestamo->libro->autor->nombre}}</td>
            </tr>
            <tr>
                <td class="bold">Edición: </td>
                <td>{{$prestamo->libro->edicion->nombre}}</td>
                <td class="bold">Volumen: </td>
                <td>{{$prestamo->libro->volumen->nombre}}</td>
            </tr>
            <tr>
                <td class="bold">Lugar: </td>
                <td>{{$prestamo->libro->lugar->nombre}}</td>
                <td class="bold">Editorial: </td>
                <td>{{$prestamo->libro->editorial->nombre}}</td>
            </tr>
            <tr>
                <td class="bold">Año publicación: </td>
                <td>{{$prestamo->libro->fecha_anio}}</td>
                <td class="bold">Nro. Páginas: </td>
                <td>{{$prestamo->libro->nro_paginas}}</td>
            </tr>
            <tr>
                <td class="bold">ISBN: </td>
                <td>{{$prestamo->libro->isbn}}</td>
                <td class="bold">Procedencia: </td>
                <td>{{$prestamo->libro->procedencia}}</td>
            </tr>
            <tr>
                <td class="bold">Observaciones: </td>
                <td colspan="3">{{$prestamo->observaciones}}</td>
            </tr>
        </tbody>
    </table>
</body>
</html>