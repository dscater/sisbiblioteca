<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Area;
use App\Models\Libro;

class AreaController extends Controller
{
    public function index()
    {
        $areas = Area::all();
        return view('areas.index', compact('areas'));
    }

    public function create()
    {
        return view('areas.create');
    }

    public function store(Request $request)
    {
        $area = Area::create(array_map('mb_strtoupper', $request->all()));
        if ($request->ajax()) {
            return response()->JSON([
                'sw' => true,
                'id' => $area->id,
                'valor' => $area->nombre,
                'msj' => 'Registro realizado con éxito',
            ]);
        }

        return redirect()->route('areas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Area $area)
    {
        return view('areas.edit', compact('area'));
    }

    public function update(Area $area, Request $request)
    {
        $area->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('areas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Area $area)
    {
        return 'mostrar cargo';
    }

    public function destroy(Area $area)
    {
        $comprueba = Libro::where('area_id', $area->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('areas.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $area->delete();
            return redirect()->route('areas.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
