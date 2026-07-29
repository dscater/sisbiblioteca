<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lugar;
use App\Models\Libro;

class LugarController extends Controller
{
    public function index()
    {
        $lugars = Lugar::all();
        return view('lugars.index', compact('lugars'));
    }

    public function create()
    {
        return view('lugars.create');
    }

    public function store(Request $request)
    {
        $lugar = Lugar::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $lugar->id,
                'valor' => $lugar->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('lugars.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Lugar $lugar)
    {
        return view('lugars.edit', compact('lugar'));
    }

    public function update(Lugar $lugar, Request $request)
    {
        $lugar->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('lugars.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Lugar $lugar)
    {
        return 'mostrar cargo';
    }

    public function destroy(Lugar $lugar)
    {
        $comprueba = Libro::where('lugar_id', $lugar->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('lugars.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $lugar->delete();
            return redirect()->route('lugars.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
