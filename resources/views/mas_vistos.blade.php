@extends('layouts.inicio')

@section('css')
@endsection

@section('content')
    <div class="container inicio">
        <br>
        <div class="card">
            <div class="card-body">
                <h1 class="titulo_seccion">MÁS VISTOS</h1>
                <div class="row" id="contenedorInicioLibros">
                    @if (count($libros))
                        @foreach ($libros as $libro)
                            <div class="col-md-3">
                                <div class="contenedor">
                                    <div class="imagen">
                                        <img src="{{ asset('imgs/libros/' . $libro->portada) }}" alt="">
                                    </div>
                                    <div class="titulo">
                                        {{ $libro->titulo }}
                                    </div>
                                    <div class="opciones">
                                        @if ($array_prestamo[$libro->id])
                                            <a href="" class="btn-block btn bg-danger btn-sm"
                                                style="color:white!important;">NO DISPONIBLE</a>
                                        @else
                                            <a href="" data-id="{{ $libro->id }}"
                                                class="reservar btn-block btn bg-navy btn-sm"
                                                style="color:white!important;">RESERVAR</a>
                                        @endif
                                        <a href="{{ route('informacion', $libro->id) }}"
                                            class="btn-block btn btn-default btn-sm info">INFORMACIÓN</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        NO SE ENCONTRO NINGÚN REGISTRO
                    @endif
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" id="urlBuscadorLibros" value="{{ route('inicio') }}">

@endsection

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

    <script src="{{ asset('js/inicio.js') }}"></script>
@endsection
