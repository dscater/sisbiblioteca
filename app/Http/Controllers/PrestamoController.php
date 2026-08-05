<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prestamo;
use App\Models\Lector;
use App\Models\Libro;
use App\Models\SolicitudPrestamo;
use PDF;

class PrestamoController extends Controller
{
    public function index()
    {
        $prestamos = Prestamo::where('estado', 1)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('prestamos.index', compact('prestamos'));
    }

    public function infoPrestamo(Request $request)
    {
        $id = $request->id;
        $prestamo = Prestamo::find($id);
        return response()->JSON([
            'sw' => true,
            'prestamo' => $prestamo,
            'libro' => $prestamo->libro,
            'lector' => $prestamo->lector,
            'area' => $prestamo->libro->area,
            'autor' => $prestamo->libro->autor,
            'edicion' => $prestamo->libro->edicion,
            'volumen' => $prestamo->libro->volumen,
            'lugar' => $prestamo->libro->lugar,
            'editorial' => $prestamo->libro->editorial,
            'lector' => $prestamo->lector,
        ]);
    }

    public function create()
    {
        $lectors = Lector::select('lectors.*')
            ->join('users', 'users.id', '=', 'lectors.user_id')
            ->where('users.estado', 1)
            ->get();

        $libros = Libro::where('status', 1)->get();

        foreach ($libros as $key => $libro) {
            if (Libro::verificaDisponible($libro)) {
                unset($libros[$key]);
            }
        }

        return view('prestamos.create', compact('lectors', 'libros'));
    }

    public function create_solicitud()
    {
        $solicituds = SolicitudPrestamo::where('estado_solicitud', 'PENDIENTE')
            ->orderBy('created_at', 'ASC')
            ->get();

        return view('prestamos.create_solicitud', compact('solicituds'));
    }

    public function store(Request $request)
    {
        $request['tipo'] = 'EGRESO';
        $request['descripcion'] = 'PRESTAMO';
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        $nuevo_prestamo = new Prestamo(array_map('mb_strtoupper', $request->all()));
        $nuevo_prestamo->solicitud_id = null;
        $nuevo_prestamo->save();

        return redirect()->route('prestamos.index')
            ->with('bien', 'Registro realizado con éxito')
            ->with('comprobantePrestamo', route('prestamos.comprobantePrestamo', $nuevo_prestamo->id));
    }

    public function store_solicitud(Request $request)
    {
        $solicitud = SolicitudPrestamo::find($request->solicitud_id);

        $request['tipo'] = 'EGRESO';
        $request['descripcion'] = 'PRESTAMO';
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 1;
        $nuevo_prestamo = new Prestamo(array_map('mb_strtoupper', $request->all()));
        $nuevo_prestamo->libro_id = $solicitud->libro_id;
        $nuevo_prestamo->lector_id = $solicitud->lector_id;
        $nuevo_prestamo->save();

        $solicitud->estado_solicitud = 'APROBADO';
        $solicitud->save();
        return redirect()->route('prestamos.index')
            ->with('bien', 'Registro realizado con éxito')
            ->with('comprobantePrestamo', route('prestamos.comprobantePrestamo', $nuevo_prestamo->id));
    }

    public function registra_devolucion(Prestamo $prestamo, Request $request)
    {
        $nueva_devolucion = new Prestamo([
            'libro_id' => $prestamo->libro_id,
            'solicitud_id' => $prestamo->solicitud_id,
            'lector_id' => $prestamo->lector_id,
            'tipo' => 'INGRESO',
            'descripcion' => 'DEVOLUCION',
            'observaciones' => mb_strtoupper($request->observaciones),
            'fecha_registro' => date('Y-m-d'),
            'estado' => 1
        ]);

        $nueva_devolucion->save();
        $prestamo->estado = 2; //estado 2 -> registro existente y devuelto
        $prestamo->save();

        return redirect()->back()
            ->with('bien', 'Registro realizado con éxito')
            ->with('comprobantePrestamo', route('prestamos.comprobanteDevolucion', $prestamo->id));
    }

    public function edit(Prestamo $prestamo)
    {
        $lectors = Lector::select('lectors.*')
            ->join('users', 'users.id', '=', 'lectors.user_id')
            ->where('users.estado', 1)
            ->get();

        $libros = Libro::where('status', 1)->get();

        foreach ($libros as $key => $libro) {
            if (Libro::verificaDisponible($libro) && $libro->id != $prestamo->libro_id) {
                unset($libros[$key]);
            }
        }

        return view('prestamos.edit', compact('prestamo', 'lectors', 'libros'));
    }

    public function edit_solicitud(Prestamo $prestamo)
    {
        $solicituds = SolicitudPrestamo::where('estado_solicitud', 'PENDIENTE')
            ->orderBy('created_at', 'ASC')
            ->get();
        $solicituds[] = $prestamo->solicitud;
        return view('prestamos.edit_solicitud', compact('prestamo', 'solicituds'));
    }

    public function update(Prestamo $prestamo, Request $request)
    {
        $prestamo->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('prestamos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function update_solicitud(Prestamo $prestamo, Request $request)
    {
        if ($request->solicitud_id != $prestamo->solicitud_id) {
            $solicitud = SolicitudPrestamo::find($prestamo->solicitud_id);
            $solicitud->estado_solicitud = 'PENDIENTE';
            $solicitud->save();

            $solicitud = SolicitudPrestamo::find($request->solicitud_id);
            $solicitud->estado_solicitud = 'APROBADO';
            $solicitud->save();

            $prestamo->update(array_map('mb_strtoupper', $request->all()));
        }

        return redirect()->route('prestamos.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Prestamo $prestamo)
    {
        return 'mostrar cargo';
    }

    public function destroy(Prestamo $prestamo)
    {
        $prestamo->estado = 0;
        $prestamo->save();
        return redirect()->route('prestamos.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function comprobantePrestamo(Prestamo $prestamo)
    {
        $pdf = PDF::loadView('prestamos.comprobantePrestamo', compact('prestamo'))->setPaper('letter', 'portrait');
        $pdf->output();

        return $pdf->stream('ComprobantePrestamo.pdf');
    }

    public function comprobanteDevolucion(Prestamo $prestamo)
    {
        $pdf = PDF::loadView('prestamos.comprobanteDevolucion', compact('prestamo'))->setPaper('letter', 'portrait');
        $pdf->output();

        return $pdf->stream('ComprobanteDevolucion.pdf');
    }
}
