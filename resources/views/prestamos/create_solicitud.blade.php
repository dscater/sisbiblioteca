@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Préstamos de Libros</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('prestamos.index')}}">Préstamos de Libros</a></li>
                    <li class="breadcrumb-item active">Nuevo</li>
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
                        <h3 class="card-title">Nuevo préstamo de solicitud</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('prestamos.store_solicitud')}}" method="POST" id="formStorePrestamo" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Solicitud*</label>
                                        <select name="solicitud_id" id="solicitud_id" class="form-control required" required>
                                            <option value="">Seleccione...</option>
                                            @foreach($solicituds as $value)
                                            <option value="{{$value->id}}">{{$value->libro->titulo}} - {{date('d/m/Y',strtotime($value->fecha_solicitud))}} - {{$value->lector->nombre}} {{$value->lector->apellidos}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Fecha de devolución*</label>
                                        <input type="date" name="fecha_devolucion" id="fecha_devolucion" value="{{old('fecha_devolucion')}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Observaciones</label>
                                        <textarea name="observaciones" id="observaciones" cols="30" rows="3" class="form-control">{{old('observaciones')}}</textarea>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btn btn-info" id="btnConfirmaPrestamoSolicitud" disabled><i class="fa fa-save"></i> REGISTRAR PRÉSTAMO</button>
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
<input type="hidden" id="urlInfoSolicitud" value="{{route('solicituds.infoSolicitud')}}">

@include('prestamos.modal.confirma_prestamo')
@php
    $script = '<script type="text/javascript">
                window.onload = function() {
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')
<script src="{{asset('js/prestamos/create.js')}}"></script>
@endsection

@endsection
