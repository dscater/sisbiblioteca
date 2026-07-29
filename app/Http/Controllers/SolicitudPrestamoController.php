<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SolicitudPrestamo;
use Session;

class SolicitudPrestamoController extends Controller
{
    public function index()
    {
        $solicituds = SolicitudPrestamo::all();
        return view('solicituds.index', compact('solicituds'));
    }

    public function infoSolicitud(Request $request)
    {
        $id = $request->id;
        $solicitud = SolicitudPrestamo::find($id);
        return response()->JSON([
            'sw' => true,
            'solicitud' => $solicitud,
            'libro' => $solicitud->libro,
            'area' => $solicitud->libro->area,
            'autor' => $solicitud->libro->autor,
            'edicion' => $solicitud->libro->edicion,
            'volumen' => $solicitud->libro->volumen,
            'lugar' => $solicitud->libro->lugar,
            'editorial' => $solicitud->libro->editorial,
            'lector' => $solicitud->lector,
        ]);
    }

    public function create()
    {
        return view('solicituds.create');
    }

    public function store(Request $request)
    {
        $request['codigo'] = SolicitudPrestamo::ultimoCodigo();
        $request['lector_id'] = Session::get('lector_id');
        $request['fecha_solicitud'] = date('Y-m-d H:i:s');
        $request['fecha_fin'] = date('Y-m-d H:i:s', strtotime($request['fecha_solicitud'] . '+2 days'));
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado_solicitud'] = 'PENDIENTE';
        SolicitudPrestamo::create(array_map('mb_strtoupper', $request->all()));

        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'bien' => 'Registro realizado con éxito',
            ]);
        }

        return redirect()->route('solicituds.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(SolicitudPrestamo $solicitud)
    {
        return view('solicituds.edit', compact('solicitud'));
    }

    public function update(SolicitudPrestamo $solicitud, Request $request)
    {
        $solicitud->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('solicituds.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(SolicitudPrestamo $solicitud)
    {
        return 'mostrar cargo';
    }

    public function destroy(SolicitudPrestamo $solicitud)
    {
        $solicitud->delete();
        return redirect()->back()->with('bien', 'Registro eliminado correctamente');
    }

    public function compruebaSolicituds(Request $request)
    {
        $lector_id = Session::get('lector_id');
        $solicituds = SolicitudPrestamo::where('lector_id', $lector_id)
            ->where('estado_solicitud', 'PENDIENTE')->get();
        if (count($solicituds) > 0) {
            return response()->JSON([
                'sw' => true,
                'cantidad' => count($solicituds),
            ]);
        }

        return response()->JSON([
            'sw' => false,
            'cantidad' => 0,
        ]);
    }

    public function solicituds_lector()
    {
        $lector_id = Session::get('lector_id');

        SolicitudPrestamo::verificaSolititudesLector($lector_id);

        $solicituds = SolicitudPrestamo::where('lector_id', $lector_id)
            ->orderBy('created_at', 'DESC')
            ->get();
        return view('solicituds_lector', compact('solicituds'));
    }

    public function verificaSolicitudes()
    {
        SolicitudPrestamo::verificaSolicitudes();
        return response()->JSON([
            'sw' => true,
        ]);
    }
}
