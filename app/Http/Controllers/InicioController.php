<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Libro;
use App\Models\Prestamo;
use App\Models\SolicitudPrestamo;
use App\Models\Carrusel;
use Illuminate\Support\Facades\DB;

class InicioController extends Controller
{
    public function inicio(Request $request)
    {
        $libros = Libro::where('status', 1)
            ->where('portal', 'SI')
            ->orderBy('created_at', 'DESC')
            ->get();
        $array_prestamo = InicioController::verificaPrestamo($libros);
        if ($request->ajax()) {
            $buscador = $request->buscador;

            $libros = DB::select("SELECT * FROM libros WHERE status = 1 AND portal = 'SI' AND CONCAT(titulo,' ',descriptores) LIKE '%$buscador%'");
            $array_prestamo = InicioController::verificaPrestamo($libros);

            $vista = view('parcials.inicio_libros', compact('libros', 'array_prestamo'))->render();
            return response()->JSON([
                'sw' => true,
                'vista' => $vista
            ]);
        }
        return view('inicio', compact('libros', 'array_prestamo'));
    }

    public function mas_vistos(Request $request)
    {
        $libros = Libro::where('status', 1)
            ->where('portal', 'SI')
            ->where('vistos', '>', 0)
            ->orderBy('vistos', 'DESC')
            ->get();
        $array_prestamo = InicioController::verificaPrestamo($libros);
        return view('mas_vistos', compact('libros', 'array_prestamo'));
    }

    public function revistas(Request $request)
    {
        $libros = Libro::where('status', 1)
            ->where('portal', 'SI')
            ->where('tipo', 'REVISTA')
            ->orderBy('created_at', 'DESC')
            ->get();
        $array_prestamo = InicioController::verificaPrestamo($libros);
        return view('revistas', compact('libros', 'array_prestamo'));
    }

    public function areas(Area $area, Request $request)
    {
        $libros = Libro::where('status', 1)
            ->where('portal', 'SI')
            ->where('area_id', $area->id)
            ->orderBy('created_at', 'DESC')
            ->get();
        $array_prestamo = InicioController::verificaPrestamo($libros);
        return view('areas', compact('libros', 'array_prestamo', 'area'));
    }

    public function informacion(Libro $libro)
    {
        $libro->vistos = (int)$libro->vistos + 1;
        $libro->save();
        return view('informacion', compact('libro'));
    }

    /*VERIFICAR SI EL LIBRO TIENE ALGUN PRESTAMO*/
    public static function verificaPrestamo($libros)
    {
        $array_prestamo = [];
        foreach ($libros as $libro) {
            // BUSCAR EN PRESTAMOS
            $prestamo_egreso = Prestamo::where('libro_id', $libro->id)
                ->where('estado', 1)
                ->where('tipo', 'EGRESO')
                ->orderBy('id', 'ASC')
                ->get()
                ->last();
            $prestamo_solicitud = SolicitudPrestamo::where('libro_id', $libro->id)
                ->where('estado_solicitud', 'PENDIENTE')
                ->orderBy('id', 'ASC')
                ->get()
                ->last();

            // SI ES FALSE ES PORQUE ESTA DISPONIBLE
            // CASO CONTRARIO ES VERDADERO PORQUE SE REALIZO UN PRESTAMO (EGRESO)
            $array_prestamo[$libro->id] = false;
            if ($prestamo_egreso || $prestamo_solicitud) {
                $array_prestamo[$libro->id] = true;
            }
        }

        return $array_prestamo;
    }
}
