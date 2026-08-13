@extends('layouts.inicio')

@section('css')
    {{-- <link rel="stylesheet" href="{{asset('css/informacion.css')}}"> --}}
@endsection

@section('content')
    <div class="container inicio">
        <br>
        <div class="card">
            <div class="card-header">
                <h3 class="titulo_seccion">LISTA DE SOLICITUDES</h3>
            </div>
            <div class="card-body overflow-auto">
                <table id="example2" class="table data-table table-bordered table-hover">
                    <thead>
                        <tr>
                            <th>Código</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Editorial</th>
                            <th>Fecha Solicitud</th>
                            <th>Fecha Finalización</th>
                            <th>Estado Solicitud</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $cont = 1;
                        @endphp
                        @foreach ($solicituds as $solicitud)
                            <tr>
                                <td>{{ $solicitud->codigo }}</td>
                                <td>{{ $solicitud->libro->titulo }}</td>
                                <td>{{ $solicitud->libro->autor->nombre }}</td>
                                <td>{{ $solicitud->libro->editorial->nombre }}</td>
                                <td>{{ $solicitud->fecha_solicitud }}</td>
                                <td>{{ $solicitud->fecha_fin }}</td>
                                <td>{{ $solicitud->estado_solicitud }}</td>
                                <td class="btns-opciones">
                                    @if ($solicitud->estado_solicitud == 'PENDIENTE')
                                        <a href="#" data-url="{{ route('solicituds.destroy', $solicitud->id) }}"
                                            data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i
                                                class="fa fa-trash" data-toggle="tooltip" data-placement="left"
                                                title="Eliminar Solicitud"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('modal.eliminar')
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

        $('table.data-table').DataTable({
            columns: [{
                    width: "5%"
                },
                null,
                null,
                null,
                null,
                null,
                null,
                {
                    width: "10%"
                },
            ],
            order: [
                [4, "desc"]
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let libro = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(
                `¿Está seguro(a) de eliminar la solicitud del libro <b>${libro}</b>?<h4>Esta acción no se podra deshacer después</h4>`
            );
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>

    <script src="{{ asset('js/inicio.js') }}"></script>
@endsection
