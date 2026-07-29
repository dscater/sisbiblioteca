@extends('layouts.app')

@section('css')
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-white">Usuarios</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="{{route('users.index')}}">Usuarios</a></li>
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
                        <h3 class="card-title">Modificar Usuario</h3>
                    </div>
                    <!-- /.card-header -->
                    <form action="{{route('users.update',$usuario->id)}}" method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            {{ method_field('PUT') }}
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Nombre*</label>
                                        <input type="text" name="nombre" value="{{$usuario->nombre}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Paterno*</label>
                                        <input type="text" name="paterno" value="{{$usuario->paterno}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Materno</label>
                                        <input type="text" name="materno" value="{{$usuario->materno}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>C.I.*</label>
                                        <input type="number" name="ci" value="{{$usuario->ci}}" class="form-control" required>
                                        @if ($errors->has('ci'))
                                        <span class="invalid-feedback" style="color:red;display:block" role="alert">
                                            <strong>{{ $errors->first('ci') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div> 
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label>Expedido*</label>
                                        <select name="ci_exp" id="ci_exp" class="form-control" required>
                                            <option value="">Seleccione...</option>
                                            <option value="LP">LA PAZ</option>
                                            <option value="CB">COCHABAMBA</option>
                                            <option value="SC">SANTA CRUZ</option>
                                            <option value="PT">POTOSI</option>
                                            <option value="OR">ORURO</option>
                                            <option value="CH">CHUQUISACA</option>
                                            <option value="TJ">TARIJA</option>
                                            <option value="BN">BENI</option>
                                            <option value="PD">PANDO</option>
                                        </select>
                                    </div>
                                </div> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label>Dirección*</label>
                                        <input type="text" name="dir" value="{{$usuario->dir}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Correo</label>
                                        <input type="email" name="email" value="{{$usuario->email}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-2"> 
                                    <div class="form-group">
                                        <label>Género*</label>
                                        <select name="genero" id="genero" class="form-control">
                                            <option value="">Seleccione...</option>
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>Teléfono*</label>
                                        <input type="text" name="fono" value="{{$usuario->fono}}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="col-md-3"> 
                                    <div class="form-group">
                                        <label>Celular*</label>
                                        <input type="text" name="cel" value="{{$usuario->cel}}" class="form-control" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Foto*</label>
                                        <input type="file" name="foto" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Nombre Familiar</label>
                                        <input type="text" name="familiar" value="{{$usuario->familiar}}" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4"> 
                                    <div class="form-group">
                                        <label>Celular Familiar</label>
                                        <input type="text" name="cel_f" value="{{$usuario->cel_f}}" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Tipo Usuario*</label>
                                        <select name="tipo" id="tipo" class="form-control"  required>
                                            <option value="">Seleccione...</option>
                                            <option value="ADMINISTRADOR">ADMINISTRADOR</option>
                                            <option value="AUXILIAR">AUXILIAR</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-info"><i class="fa fa-update"></i> ACTUALIZAR</button>
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
                    document.getElementById("ci_exp").value = "'.$usuario->ci_exp.'";
                    document.getElementById("genero").value = "'.$usuario->genero.'";
                    document.getElementById("tipo").value = "'.$usuario->user->tipo.'";
                };
            </script>';
@endphp 
{!! $script !!}
@section('scripts')

@endsection

@endsection
