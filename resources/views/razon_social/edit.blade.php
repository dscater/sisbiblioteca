@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Razón social</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('razon_social.index') }}">Razón social</a></li>
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
                            <h3 class="card-title">Modificar razón social</h3>
                        </div>
                        <!-- /.card-header -->
                        <form action="{{ route('razon_social.update', $razon_social->id) }}" method="post"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" value="put">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Nombre*</label>
                                            <input type="text" name="nombre" value="{{ $razon_social->nombre }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Alias</label>
                                            <input type="text" name="alias" value="{{ $razon_social->alias }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ciudad*</label>
                                            <input type="text" name="ciudad" value="{{ $razon_social->ciudad }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Dirección*</label>
                                            <input type="text" name="dir" value="{{ $razon_social->dir }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Teléfono*</label>
                                            <input type="text" name="fono" value="{{ $razon_social->fono }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Celular*</label>
                                            <input type="text" name="cel" value="{{ $razon_social->cel }}"
                                                class="form-control" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Casilla</label>
                                            <input type="text" name="casilla" value="{{ $razon_social->casilla }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Correo</label>
                                            <input type="text" name="correo" value="{{ $razon_social->correo }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Logo</label>
                                            <input type="file" name="logo" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Sitio web</label>
                                            <input type="text" name="web" value="{{ $razon_social->web }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Actividad económica*</label>
                                            <input type="text" name="actividad_economica"
                                                value="{{ $razon_social->actividad_economica }}" class="form-control"
                                                required>
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
                document.getElementById("ci_exp").value = "'.$razon_social->ci_exp.'";
            };
        </script>';
    @endphp
    {!! $script !!}
@section('scripts')
@endsection
@endsection
