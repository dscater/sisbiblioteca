<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Biblioteca</title>

    <link rel="stylesheet" type="text/css" href="{{ asset('google-fonts/roboto.css') }}" />
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/plugins/fontawesome-free/css/all.min.css') }}">

    {{-- <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" /> --}}
    <!-- CSS Just for demo purpose, don't include it in your project -->
    {{-- <link href="./assets/demo/demo.css" rel="stylesheet" /> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/dist/css/adminlte.min.css') }}">

    <!-- DataTables -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

    <!-- SweetAlert2 -->
    <link rel="stylesheet"
        href="{{ asset('template/AdminLTE-3.0.5/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('template/AdminLTE-3.0.5/plugins/toastr/toastr.min.css') }}">

    {{-- MI ESTILO --}}
    <link rel="stylesheet" href="{{ asset('css/inicio.css') }}">
    @yield('css')
</head>

<body>
    @php
        $carrusels = App\Models\Carrusel::orderBy('id', 'ASC')->get();
        $areas = App\Models\Area::all();
    @endphp
    <header>

        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            @if (count($carrusels) > 0)
                @php
                    $cont = 0;
                @endphp
                <ol class="carousel-indicators">
                    @foreach ($carrusels as $carrusel)
                        @php
                            $active = '';
                            if ($cont == 0) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <li data-target="#carouselExampleIndicators" data-slide-to="{{ $cont }}"
                            class="{{ $active }}"></li>
                        @php
                            $cont++;
                        @endphp
                    @endforeach
                </ol>

                @php
                    $cont = 0;
                @endphp
                <div class="carousel-inner">
                    @foreach ($carrusels as $carrusel)
                        @php
                            $active = '';
                            if ($cont == 0) {
                                $active = 'active';
                            } else {
                                $active = '';
                            }
                        @endphp
                        <div class="carousel-item {{ $active }}">
                            <img class="d-block w-100" src="{{ asset('imgs/carrusel/' . $carrusel->imagen) }}"
                                alt="Imagen {{ $cont + 1 }}">
                        </div>
                        @php
                            $cont++;
                        @endphp
                    @endforeach
                </div>
            @else
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('imgs/carrusel/1.jpg') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('imgs/carrusel/2.png') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('imgs/carrusel/3.jpg') }}" alt="Third slide">
                    </div>
                </div>
            @endif
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

        <div class="descripcion">
            {{-- <div class="logo">
                <img src="{{asset('imgs/'.App\Models\RazonSocial::first()->logo)}}" alt="Logo">
            </div> --}}
            <div class="nom_empresa">
                <nav class="navbar navbar-expand-lg bg-white p-0">
                    <a class="navbar-brand" href="{{ route('inicio') }}">
                        <img src="{{ asset('imgs/' . App\Models\RazonSocial::first()->logo) }}" alt="Logo">
                    </a>
                    <button class="navbar-toggler collapsed ml-auto mr-3" type="button" data-toggle="collapse"
                        data-target="#navBarPrincipal" aria-controls="navBarPrincipal" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="fa fa-align-justify"></span>
                    </button>

                    <div class="navbar-collapse collapse p-1 text-xs-center" id="navBarPrincipal" style="">
                        <ul class="navbar-nav mr-auto ml-auto">
                            <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                                <a class="nav-link text-white" href="{{ route('inicio') }}">INICIO <span
                                        class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item {{ request()->is('mas_vistos') ? 'active' : '' }}">
                                <a class="nav-link text-white" href="{{ route('mas_vistos') }}">MÁS VISTOS</a>
                            </li>
                            <li class="nav-item {{ request()->is('revistas') ? 'active' : '' }}">
                                <a class="nav-link text-white" href="{{ route('revistas') }}">REVISTAS</a>
                            </li>
                            <li class="nav-item {{ request()->is('areas*') ? 'active' : '' }} dropdown">
                                <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    ÁREAS
                                </a>
                                <div class="dropdown-menu dropdown-menu-right bg-white"
                                    aria-labelledby="navbarDropdown">
                                    @foreach ($areas as $value)
                                        <a class="dropdown-item"
                                            href="{{ route('areas', $value->id) }}">{{ $value->nombre }}</a>
                                    @endforeach
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                {{-- <h1>{{App\Models\RazonSocial::first()->nombre}}</h1> --}}
            </div>
            <div class="carrito" id="_solicitudes_lector">
                <a href="{{ route('solicituds_lector') }}" class="nav-link" data-toggle="tooltip" title="">
                    <i class="fa fa-book"></i>
                    <span class="badge badge-warning navbar-badge" id="count_solicitudes">0</span>
                </a>
            </div>
            <div class="acceder">
                <div class="administracion">
                    <a href="{{ route('login') }}" title="Administración" data-toggle="tooltip"><i
                            class="fa fa-chalkboard-teacher"></i></a>
                </div>
                <div class="lector">
                    @if (Session::has('logeado'))
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item dropdown">
                                <a class="nav-link text-white dropdown-toggle" href="#" id="navbarDropdown2"
                                    role="button" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="fa fa-user"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right bg-white"
                                    aria-labelledby="navbarDropdown2">
                                    <a class="dropdown-item" href="{{ route('solicituds_lector') }}"><i
                                            class="fa fa-book"></i> Ver solicitudes</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#"
                                        onclick="document.getElementById('formCerrarSessionCli').submit()"><i
                                            class="fa fa-sign-out-alt"></i> Cerrar sesión</a>
                                    <form action="{{ route('cerrar_session_lector') }}" method="post"
                                        id="formCerrarSessionCli">@csrf</form>
                                </div>
                            </li>
                        </ul>
                    @else
                        <div class="opciones_no_login">
                            <a class="btn btn-block btn-sm bg-navy text-white" href="#" data-toggle="modal"
                                data-target="#modal-acceder_lector">Acceder</a>
                            <a class="btn btn-block bg-white text-white btn-sm" href="#" data-toggle="modal"
                                data-target="#modal-registrar_lector">Registro</a>
                        </div>
                    @endif
                    {{-- <a href="" class="btn btn-warning btn-sm"><i class="fa fa-sign-in-alt"></i> Acceder</a> --}}
                </div>
            </div>
        </div>
    </header>


    @include('modal.acceder_lector')
    @include('modal.registrar_lector')
    @include('modal.confirma_prestamo')

    @yield('content')

    <input type="hidden" id="urlInfoLibro" value="{{ route('libros.getInfo') }}">
    <input type="hidden" id="urlStoreSolicitud" value="{{ route('solicituds.store') }}">
    <input type="hidden" id="urlCompruebaSesion" value="{{ route('compruebaSesion') }}">
    <input type="hidden" id="urlCompruebaSolicitudesLector" value="{{ route('compruebaSolicituds') }}">
    <input type="hidden" id="urlSolicitudesLector" value="{{ route('solicituds_lector') }}">

    <footer>
        BIBLIOTECA - {{ date('Y') }}
    </footer>

    <!-- REQUIRED SCRIPTS -->
    <!-- jQuery -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery/jquery.min.js') }}"></script>

    <!-- Bootstrap -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="{{asset('template/AdminLTE-3.0.5/plugins/bootstrap/js/bootstrap.min.js')}}"></script> --}}

    <!-- DataTables -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}">
    </script>
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}">
    </script>


    <!-- SweetAlert2 -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <!-- Toastr -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/toastr/toastr.min.js') }}"></script>

    <!-- JQUERY VALIDATE -->
    <script src="{{ asset('template/AdminLTE-3.0.5/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

    <script>
        @if (session('name_error'))
            $('#modal-acceder_lector').modal('show');
        @endif

        @if ($errors->has('password') || $errors->has('ci'))
            $('#modal-registrar_lector').modal('show');
        @endif

        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif

        $('.carousel').carousel()

        $('[data-toggle="tooltip"]').tooltip();

        lenguaje = {
            "decimal": "",
            "emptyTable": "No se encontraron registros",
            "info": "Mostrando _START_ a _END_ de _TOTAL_ Registros",
            "infoEmpty": "Mostrando 0 to 0 of 0 Registros",
            "infoFiltered": "(Filtrado de _MAX_ total registros)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ Registros",
            "loadingRecords": "Cargando...",
            "processing": "Procesando...",
            "search": "Buscar:",
            "zeroRecords": "Sin resultados encontrados",
            "paginate": {
                "first": '<i class="fa fa-fast-backward"></i>',
                "last": '<i class="fa fa-fast-forward"></i>',
                "next": '<i class="fa fa-step-forward"></i>',
                "previous": '<i class="fa fa-step-backward"></i>'
            }
        };


        function mensajeNotificacion(mensaje, tipo) {
            let Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000
            });
            Toast.fire({
                icon: tipo,
                title: mensaje
            })
        }

        $.extend($.validator.messages, {
            required: "Este campo es obligatorio.",
            maxlength: $.validator.format("El tamaño maximo es de {0} caracteres."),
            minlength: $.validator.format("El tamaño minimo es de {0} caracteres."),
            rangelength: $.validator.format("El valor debe estar entre {0} y {1}."),
            email: "Correo electronico no valido.",
            url: "URL no valida.",
            date: "Formato de fecha no valido.",
            number: "El valor debe ser númerico.",
            max: $.validator.format("El valor debe ser menor o igual que {0}"),
            min: $.validator.format("El valor debe ser mayor o igual que {0}"),
        });
    </script>
    @yield('scripts')


</body>

</html>
