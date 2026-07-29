<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Editorial;
use App\Models\Libro;

class EditorialController extends Controller
{
    public function index()
    {
        $editorials = Editorial::all();
        return view('editorials.index', compact('editorials'));
    }

    public function create()
    {
        return view('editorials.create');
    }

    public function store(Request $request)
    {
        $editorial = Editorial::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $editorial->id,
                'valor' => $editorial->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('editorials.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Editorial $editorial)
    {
        return view('editorials.edit', compact('editorial'));
    }

    public function update(Editorial $editorial, Request $request)
    {
        $editorial->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('editorials.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Editorial $editorial)
    {
        return 'mostrar cargo';
    }

    public function destroy(Editorial $editorial)
    {
        $comprueba = Libro::where('editorial_id', $editorial->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('editorials.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $editorial->delete();
            return redirect()->route('editorials.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
