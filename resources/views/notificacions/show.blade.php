@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Notificaciones de Préstamo</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('notificacions.index') }}">Notificaciones</a></li>
                        <li class="breadcrumb-item active">Ver</li>
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
                            <h3 class="card-title">Ver notificación</h3>
                            {{-- <a href="{{route('notificacions.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Nuevo</a> --}}
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <p><strong>Fecha Notificación:</strong> {{ $notificacion->fecha_hora_t }}</p>
                            <p><strong>Descripción:</strong> {{ $notificacion->descripcion }}</p>
                            <div class="row">
                                <div class="col-12">
                                    <h3>Información</h3>
                                </div>
                            </div>
                            @if ($notificacion->modulo == 'Prestamo')
                                <p><strong>Título:</strong> {{ $notificacion->prestamo->libro->titulo }}</p>
                                <p><strong>Tipo:</strong> {{ $notificacion->prestamo->libro->tipo }}</p>
                                <p><strong>Autor:</strong> {{ $notificacion->prestamo->libro->autor->nombre }}</p>
                                <p><strong>Editorial:</strong> {{ $notificacion->prestamo->libro->editorial->nombre }}</p>
                                <p><strong>Volumen:</strong> {{ $notificacion->prestamo->libro->volumen->nombre }}</p>
                                <hr>
                                @if ($notificacion->prestamo->solicitud)
                                    <p><strong>Tipo Registro:</strong> PORTAL</p>
                                    <p><strong>Código Solicitud:</strong> {{ $notificacion->prestamo->solicitud->codigo }}
                                    </p>
                                    <p><strong>Fecha Solicitud:</strong>
                                        {{ $notificacion->prestamo->solicitud->fecha_solicitud }}</p>
                                @else
                                    <p><strong>Tipo Registro:</strong> SISTEMA</p>
                                @endif
                                <p><strong>Lector:</strong> {{ $notificacion->prestamo->lector->nombre }}
                                    {{ $notificacion->prestamo->lector->apellidos }}</p>
                                <p><strong>C.I.:</strong> {{ $notificacion->prestamo->lector->ci }}
                                    {{ $notificacion->prestamo->lector->ci_exp }}</p>
                                <p><strong>Observaciones:</strong> {{ $notificacion->prestamo->observaciones }}</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>

    @include('modal.eliminar')

@section('scripts')
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif
    </script>
@endsection
@endsection
