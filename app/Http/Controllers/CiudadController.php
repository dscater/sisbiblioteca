<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ciudad;
use App\Models\Ubicacion;

class CiudadController extends Controller
{
    public function index()
    {
        $ciudads = Ciudad::all();
        return view('ciudads.index', compact('ciudads'));
    }

    public function create()
    {
        return view('ciudads.create');
    }

    public function store(Request $request)
    {
        Ciudad::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('ciudads.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Ciudad $ciudad)
    {
        return view('ciudads.edit', compact('ciudad'));
    }

    public function update(Ciudad $ciudad, Request $request)
    {
        $ciudad->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('ciudads.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Ciudad $ciudad)
    {
        return 'mostrar cargo';
    }

    public function destroy(Ciudad $ciudad)
    {
        $comprueba = Ubicacion::where('ciudad_id', $ciudad->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('ciudads.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $ciudad->delete();
            return redirect()->route('ciudads.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
