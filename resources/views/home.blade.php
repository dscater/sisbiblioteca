@extends('layouts.app')

@section('background-image')
{{-- style="background-image:url({{asset('imgs/fondo.jpg')}})" --}}
@endsection

@section('content')

 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-white">Inicio</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right bg-white">
                    <li class="breadcrumb-item active">Inicio</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        @if(Auth::user()->tipo == 'ADMINISTRADOR')
        @include('includes.home.home_admin')
        @endif
        @if(Auth::user()->tipo == 'AUXILIAR')
        @include('includes.home.home_auxiliar')
        @endif
    </div><!--/. container-fluid -->
</section>
<!-- /.content -->

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-11 mr-auto ml-auto">
                <div class="card">
                    <div class="card-header bg-navy">
                        <h4 class="text-white">SOLICITUDES DE PRÉSTAMO</h4>
                    </div>
                    <div class="card-body">
                        <table id="example1" class="table data-table1 table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha Solicitud</th>
                                    <th>Código</th>
                                    <th>Lector</th>
                                    <th>Libro/Revista</th>
                                    <th>Observaciones</th>
                                    <th>Fecha Finalización</th>
                                    <th>Estado</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                @foreach($solicituds as $solicitud)
                                <tr>
                                    <td>{{$solicitud->fecha_solicitud}}</td>
                                    <td>{{$solicitud->codigo}}</td>
                                    <td>{{$solicitud->lector->nombre}} {{$solicitud->lector->apellidos}}</td>
                                    <td>{{$solicitud->libro->titulo}}</td>
                                    <td>{{$solicitud->observacion}}</td>
                                    <td>{{$solicitud->fecha_fin}}</td>
                                    <td>{{$solicitud->estado_solicitud}}</td>
                                    <td class="btns-opciones">
                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="#" data-url="{{route('solicituds.destroy',$solicitud->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-11 mr-auto ml-auto">
                <div class="card">
                    <div class="card-header bg-black">
                        <h4 class="text-white">PRÉSTAMOS EN CURSO</h4>
                    </div>
                    <div class="card-body">
                        <table id="example2" class="table data-table2 table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Fecha Registro</th>
                                    <th>Título</th>
                                    <th>Lector</th>
                                    <th>Tipo Movimiento</th>
                                    <th>Observaciones</th>
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
                                    <td>{{$prestamo->libro->titulo}}</td>
                                    <td>
                                        @if($prestamo->lector)
                                        {{$prestamo->lector->nombre}} {{$prestamo->lector->apellidos}}
                                        @endif
                                    </td>
                                    <td>{{$prestamo->tipo}}</td>
                                    <td>{{$prestamo->observaciones}}</td>
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

                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="#" data-url="{{route('prestamos.destroy',$prestamo->id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@include('modal.eliminar')
@include('modal.devolucion')
<input type="hidden" id="urlInfoPrestamo" value="{{route('prestamos.infoPrestamo')}}">
@endsection

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


    $('table.data-table1').DataTable({
        order:[0,'desc'],
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            null,
            null,
            {width:"15%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:10
    });

    // ELIMINAR
    $(document).on('click','table.data-table1 tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let solicitud = $(this).parents('tr').children('td').eq(2).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la solicitud del lector <b>${solicitud}</b>?<h4>Estación no se podra deshacer después</h4>`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('table.data-table2').DataTable({
        order:[0,'desc'],
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            {width:"16%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:10
    });
    // ELIMINAR
    $(document).on('click','table.data-table2 tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let prestamo = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar el prestamo <b>${prestamo}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    // DEVOLUCIÓN PRESTAMO
    $(document).on('click','table.data-table2 tbody tr td.btns-opciones a.ir-evaluacion',function(e){
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

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

</script>
@endsection


