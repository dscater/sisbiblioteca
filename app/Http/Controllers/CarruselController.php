<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrusel;

class CarruselController extends Controller
{
    public function index()
    {
        $carrusels = Carrusel::all();
        return view('carrusels.index', compact('carrusels'));
    }

    public function create()
    {
        return view('carrusels.create');
    }

    public function store(Request $request)
    {
        $nueva_imagen = new Carrusel();

        if ($request->hasFile('imagen')) {
            //obtener el archivo
            $file_imagen = $request->file('imagen');
            $extension = "." . $file_imagen->getClientOriginalExtension();
            $nom_imagen = time() . $extension;
            $file_imagen->move(public_path() . "/imgs/carrusel/", $nom_imagen);
            $nueva_imagen->imagen = $nom_imagen;
            $nueva_imagen->save();
            return redirect()->route('carrusels.index')->with('bien', 'Registro realizado con éxito');
        }

        return redirect()->route('carrusels.index')->with('error', 'Error. No se pudo guardar la imágen, intente nuevamente');
    }

    public function edit(Carrusel $carrusel)
    {
        return view('carrusels.edit', compact('carrusel'));
    }

    public function update(Carrusel $carrusel, Request $request)
    {
        if ($request->hasFile('imagen')) {
            // antiguo
            $antiguo = $carrusel->imagen;
            \File::delete(public_path() . '/imgs/carrusel/' . $antiguo);

            //obtener el archivo
            $file_imagen = $request->file('imagen');
            $extension = "." . $file_imagen->getClientOriginalExtension();
            $nom_imagen = time() . $extension;
            $file_imagen->move(public_path() . "/imgs/carrusel/", $nom_imagen);
            $carrusel->imagen = $nom_imagen;
            $carrusel->save();
            return redirect()->route('carrusels.index')->with('bien', 'Registro modificado con éxito');
        }

        return redirect()->route('carrusels.index')->with('error', 'Error. No se pudo guardar la imágen, intente nuevamente');
    }

    public function show(Carrusel $carrusel)
    {
        return 'mostrar cargo';
    }

    public function destroy(Carrusel $carrusel)
    {
        // antiguo
        $antiguo = $carrusel->imagen;
        \File::delete(public_path() . '/imgs/carrusel/' . $antiguo);
        $carrusel->delete();
        return redirect()->route('carrusels.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
    }
}
