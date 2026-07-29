<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Edicion;
use App\Models\Libro;

class EdicionController extends Controller
{
    public function index()
    {
        $edicions = Edicion::all();
        return view('edicions.index', compact('edicions'));
    }

    public function create()
    {
        return view('edicions.create');
    }

    public function store(Request $request)
    {
        $edicion = Edicion::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $edicion->id,
                'valor' => $edicion->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('edicions.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Edicion $edicion)
    {
        return view('edicions.edit', compact('edicion'));
    }

    public function update(Edicion $edicion, Request $request)
    {
        $edicion->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('edicions.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Edicion $edicion)
    {
        return 'mostrar cargo';
    }

    public function destroy(Edicion $edicion)
    {
        $comprueba = Libro::where('edicion_id', $edicion->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('edicions.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $edicion->delete();
            return redirect()->route('edicions.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
