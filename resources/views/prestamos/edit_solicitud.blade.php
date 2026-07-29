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
                    <form action="{{route('prestamos.update_solicitud',$prestamo->id)}}" id="formStorePrestamo" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ method_field('PUT') }}
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
                            </div>
                            <button type="button" class="btn btn-info" id="btnConfirmaPrestamoSolicitud"><i class="fa fa-update"></i> ACTUALIZAR</button>
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
                    document.getElementById("solicitud_id").value = "'.$prestamo->solicitud_id.'";
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')
<script src="{{asset('js/prestamos/create.js')}}"></script>
@endsection

@endsection
