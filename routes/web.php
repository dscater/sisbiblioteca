<?php

use App\Http\Controllers\AreaController;
use App\Http\Controllers\AutorController;
use App\Http\Controllers\CarruselController;
use App\Http\Controllers\EdicionController;
use App\Http\Controllers\EditorialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InicioController;
use App\Http\Controllers\LectorController;
use App\Http\Controllers\LibroController;
use App\Http\Controllers\LugarController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\PrestamoController;
use App\Http\Controllers\RazonSocialController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\SolicitudPrestamoController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VolumenController;
use Illuminate\Support\Facades\Route;


Route::get('/clear-cache', function () {
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('optimize');
    return 'Proceso realizado';
});

Route::get('/', [InicioController::class, 'inicio'])->name('inicio');

Route::get('mas_vistos', [InicioController::class, 'mas_vistos'])->name('mas_vistos');

Route::get('revistas', [InicioController::class, 'revistas'])->name('revistas');

Route::get('areas/porarea/{area}', [InicioController::class, 'areas'])->name('areas');


Route::get('/informacion/{libro}', [InicioController::class, 'informacion'])->name('informacion');

Route::get('libros/getInfo', [LibroController::class, 'getInfo'])->name('libros.getInfo');

// LECTORES
Route::post('/registrar_lector', [LectorController::class, 'registrar_lector'])->name('registrar_lector');

Route::post('/lector_login', [LectorController::class, 'lector_login'])->name('lector_login');

Route::post('/cerrar_session_lector', [LectorController::class, 'cerrar_session_lector'])->name('cerrar_session_lector');

Route::get('/compruebaSesion', [LectorController::class, 'compruebaSesion'])->name('compruebaSesion');
// FIN LECTORES


Route::get('/home', [HomeController::class, 'index'])->name('home');

// SOLICITUDES PRESTAMOS
Route::get('solicituds_lector', [SolicitudPrestamoController::class, 'solicituds_lector'])->name('solicituds_lector');

Route::get('compruebaSolicituds', [SolicitudPrestamoController::class, 'compruebaSolicituds'])->name('compruebaSolicituds');

Route::post('solicituds/store', [SolicitudPrestamoController::class, 'store'])->name('solicituds.store');

Route::delete('solicituds/destroy/{solicitud}', [SolicitudPrestamoController::class, 'destroy'])->name('solicituds.destroy');

Route::middleware(['auth'])->group(function () {

    // USUARIOS
    Route::get('users', [UserController::class, 'index'])->name('users.index');

    Route::get('users/create', [UserController::class, 'create'])->name('users.create');

    Route::post('users/store', [UserController::class, 'store'])->name('users.store');

    Route::get('users/edit/{usuario}', [UserController::class, 'edit'])->name('users.edit');

    Route::put('users/update/{usuario}', [UserController::class, 'update'])->name('users.update');

    Route::delete('users/destroy/{user}', [UserController::class, 'destroy'])->name('users.destroy');

    // Configuración de cuenta
    Route::GET('users/configurar/cuenta/{user}', [UserController::class, 'config'])->name('users.config');

    // contraseña
    Route::PUT('users/configurar/cuenta/update/{user}', [UserController::class, 'cuenta_update'])->name('users.config_update');

    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', [UserController::class, 'cuenta_update_foto'])->name('users.config_update_foto');

    // CARRUSEL
    Route::get('carrusels', [CarruselController::class, 'index'])->name('carrusels.index');

    Route::get('carrusels/create', [CarruselController::class, 'create'])->name('carrusels.create');

    Route::post('carrusels/store', [CarruselController::class, 'store'])->name('carrusels.store');

    Route::get('carrusels/edit/{carrusel}', [CarruselController::class, 'edit'])->name('carrusels.edit');

    Route::put('carrusels/update/{carrusel}', [CarruselController::class, 'update'])->name('carrusels.update');

    Route::delete('carrusels/destroy/{carrusel}', [CarruselController::class, 'destroy'])->name('carrusels.destroy');

    // AREAS
    Route::get('areas', [AreaController::class, 'index'])->name('areas.index');

    Route::get('areas/create', [AreaController::class, 'create'])->name('areas.create');

    Route::post('areas/store', [AreaController::class, 'store'])->name('areas.store');

    Route::get('areas/edit/{area}', [AreaController::class, 'edit'])->name('areas.edit');

    Route::put('areas/update/{area}', [AreaController::class, 'update'])->name('areas.update');

    Route::delete('areas/destroy/{area}', [AreaController::class, 'destroy'])->name('areas.destroy');

    // AUTORES
    Route::get('autors', [AutorController::class, 'index'])->name('autors.index');

    Route::get('autors/create', [AutorController::class, 'create'])->name('autors.create');

    Route::post('autors/store', [AutorController::class, 'store'])->name('autors.store');

    Route::get('autors/edit/{autor}', [AutorController::class, 'edit'])->name('autors.edit');

    Route::put('autors/update/{autor}', [AutorController::class, 'update'])->name('autors.update');

    Route::delete('autors/destroy/{autor}', [AutorController::class, 'destroy'])->name('autors.destroy');

    // EDICIONES
    Route::get('edicions', [EdicionController::class, 'index'])->name('edicions.index');

    Route::get('edicions/create', [EdicionController::class, 'create'])->name('edicions.create');

    Route::post('edicions/store', [EdicionController::class, 'store'])->name('edicions.store');

    Route::get('edicions/edit/{edicion}', [EdicionController::class, 'edit'])->name('edicions.edit');

    Route::put('edicions/update/{edicion}', [EdicionController::class, 'update'])->name('edicions.update');

    Route::delete('edicions/destroy/{edicion}', [EdicionController::class, 'destroy'])->name('edicions.destroy');

    // VOLUMENES
    Route::get('volumens', [VolumenController::class, 'index'])->name('volumens.index');

    Route::get('volumens/create', [VolumenController::class, 'create'])->name('volumens.create');

    Route::post('volumens/store', [VolumenController::class, 'store'])->name('volumens.store');

    Route::get('volumens/edit/{volumen}', [VolumenController::class, 'edit'])->name('volumens.edit');

    Route::put('volumens/update/{volumen}', [VolumenController::class, 'update'])->name('volumens.update');

    Route::delete('volumens/destroy/{volumen}', [VolumenController::class, 'destroy'])->name('volumens.destroy');

    // LUGARES
    Route::get('lugars', [LugarController::class, 'index'])->name('lugars.index');

    Route::get('lugars/create', [LugarController::class, 'create'])->name('lugars.create');

    Route::post('lugars/store', [LugarController::class, 'store'])->name('lugars.store');

    Route::get('lugars/edit/{lugar}', [LugarController::class, 'edit'])->name('lugars.edit');

    Route::put('lugars/update/{lugar}', [LugarController::class, 'update'])->name('lugars.update');

    Route::delete('lugars/destroy/{lugar}', [LugarController::class, 'destroy'])->name('lugars.destroy');

    // EDITORIALES
    Route::get('editorials', [EditorialController::class, 'index'])->name('editorials.index');

    Route::get('editorials/create', [EditorialController::class, 'create'])->name('editorials.create');

    Route::post('editorials/store', [EditorialController::class, 'store'])->name('editorials.store');

    Route::get('editorials/edit/{editorial}', [EditorialController::class, 'edit'])->name('editorials.edit');

    Route::put('editorials/update/{editorial}', [EditorialController::class, 'update'])->name('editorials.update');

    Route::delete('editorials/destroy/{editorial}', [EditorialController::class, 'destroy'])->name('editorials.destroy');

    // UBICACIONES
    Route::get('ubicacions', [UbicacionController::class, 'index'])->name('ubicacions.index');

    Route::get('ubicacions/create', [UbicacionController::class, 'create'])->name('ubicacions.create');

    Route::post('ubicacions/store', [UbicacionController::class, 'store'])->name('ubicacions.store');

    Route::get('ubicacions/edit/{ubicacion}', [UbicacionController::class, 'edit'])->name('ubicacions.edit');

    Route::put('ubicacions/update/{ubicacion}', [UbicacionController::class, 'update'])->name('ubicacions.update');

    Route::delete('ubicacions/destroy/{ubicacion}', [UbicacionController::class, 'destroy'])->name('ubicacions.destroy');

    // LIBROS
    Route::get('libros', [LibroController::class, 'index'])->name('libros.index');

    Route::get('libros/create', [LibroController::class, 'create'])->name('libros.create');

    Route::post('libros/store', [LibroController::class, 'store'])->name('libros.store');

    Route::get('libros/edit/{libro}', [LibroController::class, 'edit'])->name('libros.edit');

    Route::put('libros/update/{libro}', [LibroController::class, 'update'])->name('libros.update');

    Route::delete('libros/destroy/{libro}', [LibroController::class, 'destroy'])->name('libros.destroy');

    // LECTORES
    Route::get('lectors', [LectorController::class, 'index'])->name('lectors.index');

    Route::get('lectors/create', [LectorController::class, 'create'])->name('lectors.create');

    Route::post('lectors/store', [LectorController::class, 'store'])->name('lectors.store');

    Route::get('lectors/edit/{lector}', [LectorController::class, 'edit'])->name('lectors.edit');

    Route::put('lectors/update/{lector}', [LectorController::class, 'update'])->name('lectors.update');

    Route::post('lectors/reasigna_contrasenia/{lector}', [LectorController::class, 'reasigna_contrasenia'])->name('lectors.reasigna_contrasenia');

    Route::delete('lectors/destroy/{user}', [LectorController::class, 'destroy'])->name('lectors.destroy');

    Route::get('lectors/getInfoLector', [LectorController::class, 'getInfoLector'])->name('lectors.getInfoLector');

    // SOLICITUDES PRESTAMOS
    Route::get('solicituds', [SolicitudPrestamoController::class, 'index'])->name('solicituds.index');

    Route::get('solicituds/create', [SolicitudPrestamoController::class, 'create'])->name('solicituds.create');

    Route::get('solicituds/edit/{solicitud}', [SolicitudPrestamoController::class, 'edit'])->name('solicituds.edit');

    Route::put('solicituds/update/{solicitud}', [SolicitudPrestamoController::class, 'update'])->name('solicituds.update');

    Route::get('solicituds/infoSolicitud', [SolicitudPrestamoController::class, 'infoSolicitud'])->name('solicituds.infoSolicitud');

    Route::get('solicituds/verificaSolicitudes', [SolicitudPrestamoController::class, 'verificaSolicitudes'])->name('solicituds.verificaSolicitudes');


    // NOTIFICACIONES
    Route::get('notificacions', [NotificacionController::class, 'index'])->name('notificacions.index');
    Route::get('notificacions/show/{notificacion}', [NotificacionController::class, 'show'])->name('notificacions.show');
    Route::get('notificacions/usuario', [NotificacionController::class, 'usuario'])->name('notificacions.usuario');

    // PRESTAMOS
    Route::get('prestamos', [PrestamoController::class, 'index'])->name('prestamos.index');

    Route::get('prestamos/create', [PrestamoController::class, 'create'])->name('prestamos.create');

    Route::get('prestamos/create_solicitud', [PrestamoController::class, 'create_solicitud'])->name('prestamos.create_solicitud');

    Route::post('prestamos/store', [PrestamoController::class, 'store'])->name('prestamos.store');

    Route::post('prestamos/store_solicitud', [PrestamoController::class, 'store_solicitud'])->name('prestamos.store_solicitud');

    Route::get('prestamos/edit/{prestamo}', [PrestamoController::class, 'edit'])->name('prestamos.edit');

    Route::get('prestamos/edit_solicitud/{prestamo}', [PrestamoController::class, 'edit_solicitud'])->name('prestamos.edit_solicitud');

    Route::put('prestamos/update/{prestamo}', [PrestamoController::class, 'update'])->name('prestamos.update');

    Route::put('prestamos/update_solicitud/{prestamo}', [PrestamoController::class, 'update_solicitud'])->name('prestamos.update_solicitud');

    Route::post('prestamos/registra_devolucion/{prestamo}', [PrestamoController::class, 'registra_devolucion'])->name('prestamos.registra_devolucion');

    Route::delete('prestamos/destroy/{prestamo}', [PrestamoController::class, 'destroy'])->name('prestamos.destroy');

    Route::get('prestamos/infoPrestamo', [PrestamoController::class, 'infoPrestamo'])->name('prestamos.infoPrestamo');

    Route::get('prestamos/comprobantePrestamo/{prestamo}', [PrestamoController::class, 'comprobantePrestamo'])->name('prestamos.comprobantePrestamo');

    Route::get('prestamos/comprobanteDevolucion/{prestamo}', [PrestamoController::class, 'comprobanteDevolucion'])->name('prestamos.comprobanteDevolucion');


    // RAZON SOCIAL
    Route::get('razon_social/index', [RazonSocialController::class, 'index'])->name('razon_social.index');

    Route::get('razon_social/edit/{razon_social}', [RazonSocialController::class, 'edit'])->name('razon_social.edit');

    Route::put('razon_social/update/{razon_social}', [RazonSocialController::class, 'update'])->name('razon_social.update');

    // REPORTES
    Route::get('reportes', [ReporteController::class, 'index'])->name('reportes.index');

    Route::get('reportes/usuarios', [ReporteController::class, 'usuarios'])->name('reportes.usuarios');

    Route::get('reportes/libros', [ReporteController::class, 'libros'])->name('reportes.libros');

    Route::get('reportes/libros_mas_prestados', [ReporteController::class, 'libros_mas_prestados'])->name('reportes.libros_mas_prestados');

    Route::get('reportes/lista_solicitudes', [ReporteController::class, 'lista_solicitudes'])->name('reportes.lista_solicitudes');

    Route::get('reportes/lista_devoluciones', [ReporteController::class, 'lista_devoluciones'])->name('reportes.lista_devoluciones');

    Route::get('reportes/lista_estado', [ReporteController::class, 'lista_estado'])->name('reportes.lista_estado');
});

Auth::routes();
