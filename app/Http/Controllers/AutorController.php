<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Autor;
use App\Models\Libro;

class AutorController extends Controller
{
    public function index()
    {
        $autors = Autor::all();
        return view('autors.index', compact('autors'));
    }

    public function create()
    {
        return view('autors.create');
    }

    public function store(Request $request)
    {
        $autor = Autor::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $autor->id,
                'valor' => $autor->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }
        return redirect()->route('autors.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Autor $autor)
    {
        return view('autors.edit', compact('autor'));
    }

    public function update(Autor $autor, Request $request)
    {
        $autor->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('autors.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Autor $autor)
    {
        return 'mostrar cargo';
    }

    public function destroy(Autor $autor)
    {
        $comprueba = Libro::where('autor_id', $autor->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('autors.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $autor->delete();
            return redirect()->route('autors.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
