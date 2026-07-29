@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Préstamos</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('prestamos.index')}}">Préstamos</a></li>
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
                        <h3 class="card-title">Modificar préstamo</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('prestamos.update',$prestamo->id)}}" id="formStorePrestamo" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Libro*</label>
                                        <select name="libro_id" id="libro_id" class="form-control required" required>
                                            <option value="">Seleccione...</option>
                                            @foreach($libros as $value)
                                            <option value="{{$value->id}}">{{$value->titulo}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Lector*</label>
                                        <select name="lector_id" id="lector_id" class="form-control required" required>
                                            <option value="">Seleccione...</option>
                                            @foreach($lectors as $value)
                                            <option value="{{$value->id}}">{{$value->nombre}} {{$value->apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de devolución*</label>
                                        <input type="date" name="fecha_devolucion" id="fecha_devolucion" value="{{$prestamo->fecha_devolucion}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control">{{$prestamo->observaciones}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info" id="btnConfirmaPrestamo"><i class="fa fa-update"></i> ACTUALIZAR</button>
                        </div>
                    </form>
                    <!-- /.card-body -->
                </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
</section>
<input type="hidden" name="" id="urlInfoLector" value="{{route('lectors.getInfoLector')}}">
<input type="hidden" id="urlInfoLibro" value="{{route('libros.getInfo')}}">

@include('prestamos.modal.confirma_prestamo')

@php
    $script = '<script type="text/javascript">
                window.onload = function() {
                    document.getElementById("libro_id").value = "'.$prestamo->libro_id.'";
                    document.getElementById("lector_id").value = "'.$prestamo->lector_id.'";
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')
<script src="{{asset('js/prestamos/create.js')}}"></script>
@endsection

@endsection
