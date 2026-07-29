@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Lectores</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('lectors.index')}}">Lectores</a></li>
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
                        <h3 class="card-title">Nuevo lector</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('lectors.store')}}" method="POST" enctype="multipart/form-data">
                        <div class="card-body">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="nombre" value="{{old('nombre')}}" class="form-control" autofocus placeholder="Nombre(s)" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="text" name="apellidos" value="{{old('apellidos')}}" class="form-control" autofocus placeholder="Apelldos" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-user"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number" name="ci" value="{{old('ci')}}" class="form-control" autofocus placeholder="C.I." required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-address-card"></span>
                                                </div>
                                            </div>
                                        </div>
                                        @if ($errors->has('ci'))
                                        <span class="invalid-feedback" style="color:rgb(161, 14, 14);display:block" role="alert">
                                            <strong>{{ $errors->first('ci') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <select name="ci_exp" id="ci_exp" class="form-control" required>
                                                <option value="">Expedido</option>
                                                <option value="LP">LA PAZ</option>
                                                <option value="CB">COCHABAMBA</option>
                                                <option value="SC">SANTA CRUZ</option>
                                                <option value="PT">POTOSI</option>
                                                <option value="OR">ORURO</option>
                                                <option value="CH">CHUQUISACA</option>
                                                <option value="TJ">TARIJA</option>
                                                <option value="PD">PANDO</option>
                                                <option value="BN">BENI</option>
                                            </select>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-address-card"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="email" name="correo" value="{{old('correo')}}" class="form-control" autofocus placeholder="Correo electronico" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                <span class="fas fa-envelope"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="input-group mb-3">
                                        <input type="text" name="cel" value="{{old('cel')}}" class="form-control" autofocus placeholder="Teléfono/Celular" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-phone"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="input-group mb-3">
                                        <input type="text" name="dir" value="{{old('dir')}}" class="form-control" autofocus placeholder="Dirección" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                            <span class="fas fa-address-book"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
        
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group mb-3">
                                        <input type="text" name="password" class="form-control" placeholder="Contraseña" required>
                                        <div class="input-group-append">
                                            <div class="input-group-text">
                                                <span class="fas fa-lock"></span>
                                            </div>
                                        </div>
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
