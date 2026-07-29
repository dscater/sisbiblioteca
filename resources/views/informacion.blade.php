@extends('layouts.inicio')

@section('css')
<link rel="stylesheet" href="{{asset('css/informacion.css')}}">
@endsection

@section('content')
<div class="container inicio">
    <br>
    <div class="card">
        <div class="card-body">
            {{-- <div class="row">
                <div class="col-md-6 mr-auto ml-auto">
                    <div class="input-group">
                        <input type="text" name="nombre" value="" class="form-control" autofocus placeholder="Buscar" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                            <span class="fas fa-search"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <br>
            <div class="contenedor">
                <h3 class="titulo libro">{{$libro->tipo}}: {{$libro->titulo}}</h3>
                <div class="contenedor_info">
                    <div class="imagenes">
                        <div class="portada">
                            <img src="{{asset('imgs/libros/'.$libro->portada)}}" alt="Imagen">
                        </div>
                        <div class="contraportada">
                            <img src="{{asset('imgs/libros/'.$libro->contraportada)}}" alt="Imagen">
                        </div>
                        <div class="opcion opciones">
                            <a href="" data-id="{{$libro->id}}" class="reservar btn bg-orange btn-sm" style="color:white!important;">RESERVAR</a>
                            <a href="{{route('inicio')}}" class="btn btn-outline-success btn-sm">INICIO</a>
                        </div>
                    </div>
                    <div class="contenedor_adicional">
                        <div class="resumen">
                            {{$libro->resumen}}
                        </div>
                        <div class="info_adicional">
                            <table border="1">
                                <tbody>
                                    <tr>
                                        <td width="100px">Área:</td>
                                        <td>{{$libro->area->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Autor:</td>
                                        <td>{{$libro->autor->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Edición:</td>
                                        <td>{{$libro->edicion->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Volumen:</td>
                                        <td>{{$libro->volumen->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Lugar:</td>
                                        <td>{{$libro->lugar->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Editorial:</td>
                                        <td>{{$libro->editorial->nombre}}</td>
                                    </tr>
                                    <tr>
                                        <td>Año:</td>
                                        <td>{{$libro->fecha_anio}}</td>
                                    </tr>
                                    <tr>
                                        <td>Nro. páginas:</td>
                                        <td>{{$libro->nro_paginas}}</td>
                                    </tr>
                                    <tr>
                                        <td>ISBN:</td>
                                        <td>{{$libro->isbn}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    @if(session('bien'))
    mensajeNotificacion('{{session('bien')}}','success');
    @endif

    @if(session('info'))
    mensajeNotificacion('{{session('info')}}','info');
    @endif

    @if(session('error'))
    mensajeNotificacion('{{session('error')}}','error');
    @endif
</script>

<script src="{{asset('js/inicio.js')}}"></script>
@endsection