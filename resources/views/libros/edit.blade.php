@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/libros/create.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Libros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('libros.index')}}">Libros</a></li>
                    <li class="breadcrumb-item active">Modificar</li>
                </ol>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Modificar registro</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('libros.update',$libro->id)}}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Fecha de Ingreso*</label>
                                        <input type="date" name="fecha_ingreso" value="{{date('Y-m-d')}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Área*</label>
                                        <div class="info_editable" data-url="{{route('areas.store')}}" data-col="nombre">
                                            <select name="area_id" id="area_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($areas as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Autor*</label>
                                        <div class="info_editable" data-url="{{route('autors.store')}}" data-col="nombre">
                                            <select name="autor_id" id="autor_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($autors as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Título*</label>
                                        <input type="text" name="titulo" value="{{$libro->titulo}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Edición*</label>
                                        <div class="info_editable" data-url="{{route('edicions.store')}}" data-col="nombre">
                                            <select name="edicion_id" id="edicion_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($edicions as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Volumen*</label>
                                        <div class="info_editable" data-url="{{route('volumens.store')}}" data-col="nombre">
                                            <select name="volumen_id" id="volumen_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($volumens as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Lugar*</label>
                                        <div class="info_editable" data-url="{{route('lugars.store')}}" data-col="nombre">
                                            <select name="lugar_id" id="lugar_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($lugars as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Editorial*</label>
                                        <div class="info_editable" data-url="{{route('editorials.store')}}" data-col="nombre">
                                            <select name="editorial_id" id="editorial_id" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                @foreach($editorials as $value)
                                                <option value="{{$value->id}}">{{$value->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Año*</label>
                                        <select name="fecha_anio" id="fecha_anio" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Nro. de páginas*</label>
                                        <input type="text" name="nro_paginas" value="{{$libro->nro_paginas}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Procedencia</label>
                                        <input type="text" name="procedencia" value="{{$libro->procedencia}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Precio en Bolivianos</label>
                                        <input type="number" step="0.01" name="precio" value="{{$libro->precio}}" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Signatura Topográfica*</label>
                                        <input type="text" name="signatura" value="{{$libro->signatura}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Estado*</label>
                                        <select name="estado" id="estado" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            <option value="NUEVO">NUEVO</option>
                                            <option value="BUENO">BUENO</option>
                                            <option value="REGULAR">REGULAR</option>
                                            <option value="MALO">MALO</option>
                                            <option value="MALO EN USO">MALO EN USO</option>
                                            <option value="MALO EN DESUSO">MALO EN DESUSO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Tipo*</label>
                                        <select name="tipo" id="tipo" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            <option value="LIBRO">LIBRO</option>
                                            <option value="REVISTA">REVISTA</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Ubicación*</label>
                                        <select name="ubicacion_id" id="ubicacion_id" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            @foreach($ubicacions as $value)
                                            <option value="{{$value->id}}">{{$value->estante}} - {{$value->balda}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-2">
                                    <label>Portal Web*</label>
                                    <select name="portal" id="portal" class="form-control">
                                        <option value="">Seleccione...</option>
                                        <option value="SI">SI</option>
                                        <option value="NO">NO</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Descriptores y/o Palabras Claves*</label>
                                        <textarea name="descriptores" id="descriptores" cols="30" rows="3" class="form-control" required>{{$libro->descriptores}}</textarea>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <label>Resumen y/o Índice*</label>
                                        <textarea name="resumen" id="resumen" cols="30" rows="3" class="form-control" required>{{$libro->resumen}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>ISBN*</label>
                                        <input type="text" name="isbn" value="{{$libro->isbn}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Portada</label>
                                        <input type="file" name="portada" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Contraportada</label>
                                        <input type="file" name="contraportada" class="form-control">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control">{{$libro->observaciones}}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button class="btn btn-info"><i class="fa fa-update"></i> ACTUALIZAR</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                    <div class="overlay dark">
                        <i class="fas fa-2x fa-sync-alt fa-spin"></i>
                    </div>
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>


@php
    $script = '<script type="text/javascript">
                window.onload = function() {
                    document.getElementById("area_id").value = "'.$libro->area_id.'";
                    document.getElementById("autor_id").value = "'.$libro->autor_id.'";
                    document.getElementById("edicion_id").value = "'.$libro->edicion_id.'";
                    document.getElementById("volumen_id").value = "'.$libro->volumen_id.'";
                    document.getElementById("lugar_id").value = "'.$libro->lugar_id.'";
                    document.getElementById("editorial_id").value = "'.$libro->editorial_id.'";
                    document.getElementById("fecha_anio").value = "'.$libro->fecha_anio.'";
                    document.getElementById("estado").value = "'.$libro->estado.'";
                    document.getElementById("tipo").value = "'.$libro->tipo.'";
                    document.getElementById("ubicacion_id").value = "'.$libro->ubicacion_id.'";
                    document.getElementById("portal").value = "'.$libro->portal.'";
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')
<script src="{{asset('js/libros/create.js')}}"></script>
@endsection

@endsection
