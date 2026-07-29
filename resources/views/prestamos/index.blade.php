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
                    <li class="breadcrumb-item active">Préstamos de Libros</li>
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
                        {{-- <h3 class="card-title"></h3> --}}
                        <a href="{{route('prestamos.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Nuevo Préstamo</a>
                        <a href="{{route('prestamos.create_solicitud')}}" class="btn btn-danger"><i class="fa fa-plus"></i> Préstamo Solicitud</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha Registro</th>
                                    <th>Fecha Devolución</th>
                                    <th>Título</th>
                                    <th>Lector</th>
                                    <th>Tipo Movimiento</th>
                                    <th>Observaciones</th>
                                    <th>Descripción</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                @foreach($prestamos as $prestamo)
                                @php
                                    $rojo = '';
                                    if($prestamo->descripcion == 'PRESTAMO')
                                    if(date('Y-m-d') > date('Y-m-d',strtotime($prestamo->fecha_devolucion)))
                                    {
                                        $rojo = 'bg-red';
                                    }                                    
                                @endphp

                                <tr class="{{$rojo}}">
                                    <td>{{$prestamo->fecha_registro}}</td>
                                    <td>{{$prestamo->fecha_devolucion}}</td>
                                    <td>{{$prestamo->libro->titulo}}</td>
                                    <td>
                                        @if($prestamo->lector)
                                        {{$prestamo->lector->nombre}} {{$prestamo->lector->apellidos}}
                                        @endif
                                    </td>
                                    <td>{{$prestamo->tipo}}</td>
                                    <td>{{$prestamo->observaciones}}</td>
                                    <td>{{$prestamo->descripcion}}</td>
                                    <td class="btns-opciones">
                                        @if($prestamo->descripcion == 'PRESTAMO')
                                        <a href="{{route('prestamos.comprobantePrestamo', $prestamo->id)}}" class="evaluar" target="_blank"><i class="fa fa-file-pdf" data-toggle="tooltip" data-placement="left" title="Boleta Préstamo"></i></a>
                                        @else
                                        @if($prestamo->descripcion == 'DEVOLUCION')
                                        <a href="{{route('prestamos.comprobanteDevolucion', $prestamo->id)}}" class="evaluar" target="_blank"><i class="fa fa-file-pdf" data-toggle="tooltip" data-placement="left" title="Boleta Devolución"></i></a>
                                        @endif
                                        @endif

                                        @if($prestamo->tipo == 'EGRESO' && $prestamo->estado == 1)
                                        <a href="#" data-url="{{route('prestamos.registra_devolucion',$prestamo->id)}}" data-id="{{$prestamo->id}}" class="ir-evaluacion"><i class="fa fa-clipboard-check" data-toggle="tooltip" data-placement="left" title="Devolución"></i></a>
                                        @endif

                                        @if($prestamo->solicitud)
                                        <a href="{{route('prestamos.edit_solicitud',$prestamo->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                        @else
                                        <a href="{{route('prestamos.edit',$prestamo->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>
                                        @endif

                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="#" data-url="{{route('prestamos.destroy',$prestamo->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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

@include('modal.devolucion')
@include('modal.eliminar')
<input type="hidden" id="urlInfoPrestamo" value="{{route('prestamos.infoPrestamo')}}">
@section('scripts')
<script>
    @if(session('bien'))
    mensajeNotificacion('{{session('bien')}}','success');
    @endif

    @if(session('info'))
    mensajeNotificacion('{{session('info')}}','info');
    @endif

    @if(session('error'))
    mensajeNotificacion('{{session('error')}}','error');
    @endif

    @if(session('comprobantePrestamo'))
    window.open("{{session('comprobantePrestamo')}}","_blank")
    @endif

     $('table.data-table').DataTable({
        order:[0,'desc'],
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            null,
            null,
            {width:"16%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let prestamo = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el prestamo <b>${prestamo}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

    // DEVOLUCIÓN PRESTAMO
    $(document).on('click','table tbody tr td.btns-opciones a.ir-evaluacion',function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        let id = $(this).attr('data-id');

        $.ajax({
            type: "GET",
            url: $('#urlInfoPrestamo').val(),
            data: {
                id : id
            },
            dataType: "json",
            success: function (response) {
                $('#mensaje_devolucion').html(`
                    <b>Fecha préstamo:</b> ${response.prestamo.fecha_registro}<br>
                    <b>Fecha devolución:</b> ${response.prestamo.fecha_devolucion}<br>
                    <hr>
                    <b>Título:</b> ${response.libro.titulo}<br>
                    <b>Tipo:</b> ${response.libro.tipo}<br>
                    <b>Autor:</b> ${response.autor.nombre}<br>
                    <b>Editorial:</b> ${response.editorial.nombre}<br>
                    <b>Volumen:</b> ${response.volumen.nombre}
                    <hr>
                    <b>Nombre Lector:</b> ${response.lector.nombre} ${response.lector.apellidos}<br>
                    <b>C.I.:</b> ${response.lector.ci} ${response.lector.ci_exp}<br>
                    <b>Celular:</b> ${response.lector.cel}<br>
                    `);
                    $('#modal-devolucion').modal('show');
            }
        });

        $('#formRegistraDevolucion').attr('action',url);

    });

    $('#btnRegistraDevolucion').click(function(){
        $('#formRegistraDevolucion').submit();
    });
    
</script>
@endsection

@endsection
