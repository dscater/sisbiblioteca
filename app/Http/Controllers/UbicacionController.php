<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ubicacion;
use App\Models\Libro;

class UbicacionController extends Controller
{
    public function index()
    {
        $ubicacions = Ubicacion::all();
        return view('ubicacions.index', compact('ubicacions'));
    }

    public function create()
    {
        return view('ubicacions.create');
    }

    public function store(Request $request)
    {
        $ubicacion = Ubicacion::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $ubicacion->id,
                'valor' => $ubicacion->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('ubicacions.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Ubicacion $ubicacion)
    {
        return view('ubicacions.edit', compact('ubicacion'));
    }

    public function update(Ubicacion $ubicacion, Request $request)
    {
        $ubicacion->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('ubicacions.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Ubicacion $ubicacion)
    {
        return 'mostrar cargo';
    }

    public function destroy(Ubicacion $ubicacion)
    {
        $comprueba = Libro::where('ubicacion_id', $ubicacion->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('ubicacions.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $ubicacion->delete();
            return redirect()->route('ubicacions.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
