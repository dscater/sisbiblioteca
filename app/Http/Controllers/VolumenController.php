<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volumen;
use App\Models\Libro;

class VolumenController extends Controller
{
    public function index()
    {
        $volumens = Volumen::all();
        return view('volumens.index', compact('volumens'));
    }

    public function create()
    {
        return view('volumens.create');
    }

    public function store(Request $request)
    {
        $volumen = Volumen::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $volumen->id,
                'valor' => $volumen->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('volumens.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Volumen $volumen)
    {
        return view('volumens.edit', compact('volumen'));
    }

    public function update(Volumen $volumen, Request $request)
    {
        $volumen->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('volumens.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Volumen $volumen)
    {
        return 'mostrar cargo';
    }

    public function destroy(Volumen $volumen)
    {
        $comprueba = Libro::where('volumen_id', $volumen->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('volumens.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $volumen->delete();
            return redirect()->route('volumens.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
