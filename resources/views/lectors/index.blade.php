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
                    <li class="breadcrumb-item active">Lectores</li>
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
                        <a href="{{route('lectors.create')}}" class="btn btn-info"><i class="fa fa-plus"></i> Nuevo</a>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example2" class="table data-table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Nombre</th>
                                    <th>C.I.</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Fecha Registro</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $cont = 1;
                                @endphp
                                @foreach($lectors as $lector)
                                <tr>
                                    <td>{{$cont++}}</td>
                                    <td>{{$lector->nombre}} {{$lector->apellidos}}</td>
                                    <td>{{$lector->ci}} {{$lector->ci_exp}}</td>
                                    <td>{{$lector->correo}}</td>
                                    <td>{{$lector->celular}}</td>
                                    <td>{{$lector->fecha_registro}}</td>
                                    <td class="btns-opciones">
                                        <a href="{{route('lectors.edit',$lector->id)}}" class="modificar"><i class="fa fa-edit" data-toggle="tooltip" data-placement="left" title="Modificar"></i></a>

                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="#" data-url="{{route('lectors.reasigna_contrasenia',$lector->id)}}" data-toggle="modal" data-target="#modal-reasigna_contrasenia" class="ir-evaluacion"><i class="fa fa-key" data-toggle="tooltip" data-placement="left" title="Reasignar Contraseña"></i></a>
    
                                        <a href="#" data-url="{{route('lectors.destroy',$lector->user_id)}}" data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i class="fa fa-trash" data-toggle="tooltip" data-placement="left" title="Eliminar"></i></a>
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

@include('modal.eliminar')
@include('modal.reasignar_contrasenia')

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


     $('table.data-table').DataTable({
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            null,
            {width:"15%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.eliminar',function(e){
        e.preventDefault();
        let lector = $(this).parents('tr').children('td').eq(1).text();
        $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al lector <b>${lector}</b>?`);
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formEliminar').prop('action',url);
    });

    $('#btnEliminar').click(function(){
        $('#formEliminar').submit();
    });

    // REASIGNAR CONTRASEÑÁ
    $(document).on('click','table tbody tr td.btns-opciones a.ir-evaluacion',function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formReasignaContrasenia').prop('action',url);
    });
    
</script>
@endsection

@endsection
