@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Ubicaciones</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('ubicacions.index')}}">Ubicaciones</a></li>
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
                        <h3 class="card-title">Nueva ubicación</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('ubicacions.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Estante*</label>
                                        <input type="text" name="estante" value="{{ old('estante') }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Balda*</label>
                                        <input type="text" name="balda" value="{{ old('balda') }}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info"><i class="fa fa-save"></i> GUARDAR</button>
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
@php
    $script = '<script type="text/javascript">
                window.onload = function() {
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')

@endsection

@endsection
