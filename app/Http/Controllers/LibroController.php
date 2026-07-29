<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Libro;
use App\Models\Area;
use App\Models\Autor;
use App\Models\Edicion;
use App\Models\Editorial;
use App\Models\Volumen;
use App\Models\Lugar;
use App\Models\Ubicacion;
use App\Models\Prestamo;

class LibroController extends Controller
{
    public function index()
    {
        $libros = Libro::where('status', 1)->get();
        return view('libros.index', compact('libros'));
    }

    public function create()
    {
        $areas = Area::all();
        $autors = Autor::all();
        $edicions = Edicion::all();
        $editorials = Editorial::all();
        $volumens = Volumen::all();
        $lugars = Lugar::all();
        $ubicacions = Ubicacion::all();
        return view('libros.create', compact('areas', 'autors', 'edicions', 'editorials', 'volumens', 'lugars', 'ubicacions'));
    }

    public function store(Request $request)
    {
        $request['nro_inventario'] = Libro::nroInventario();
        $request['status'] = 1;
        $request['fecha_registro'] = date('Y-m-d');
        $request['vistos'] =  0;
        // return $request->precio;
        $nuevo_libro = new libro(array_map('mb_strtoupper', $request->except(['portada', 'contraportada'])));
        if ($nuevo_libro->precio == "") {
            $nuevo_libro->precio = null;
        }

        if ($request->hasFile('portada')) {
            //obtener el archivo
            $file_portada = $request->file('portada');
            $extension = "." . $file_portada->getClientOriginalExtension();
            $nom_portada = $nuevo_libro->titulo . '_P' . time() . $extension;
            $file_portada->move(public_path() . "/imgs/libros/", $nom_portada);
            $nuevo_libro->portada = $nom_portada;
        }

        if ($request->hasFile('contraportada')) {
            //obtener el archivo
            $file_contraportada = $request->file('contraportada');
            $extension = "." . $file_contraportada->getClientOriginalExtension();
            $nom_contraportada = $nuevo_libro->titulo . '_CP' . time() . $extension;
            $file_contraportada->move(public_path() . "/imgs/libros/", $nom_contraportada);
            $nuevo_libro->contraportada = $nom_contraportada;
        }
        $nuevo_libro->save();

        // INICIAR EL REGISTRO DE "PRESTAMO"
        Prestamo::create([
            'libro_id' => $nuevo_libro->id,
            'solicitud_id' => null,
            'lector_id' => null,
            'tipo' => 'INGRESO',
            'observaciones' => 'REGISTRO',
            'fecha_registro' => $nuevo_libro->fecha_registro
        ]);

        return redirect()->route('libros.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Libro $libro)
    {
        $areas = Area::all();
        $autors = Autor::all();
        $edicions = Edicion::all();
        $editorials = Editorial::all();
        $volumens = Volumen::all();
        $lugars = Lugar::all();
        $ubicacions = Ubicacion::all();
        return view('libros.edit', compact('libro', 'areas', 'autors', 'edicions', 'editorials', 'volumens', 'lugars', 'ubicacions'));
    }

    public function update(Libro $libro, Request $request)
    {
        if (!isset($request->precio)) {
            $request->precio = NULL;
        }
        $libro->update(array_map('mb_strtoupper', $request->except(['portada', 'contraportada', 'precio'])));
        $libro->precio = $request->precio;
        if ($libro->precio == "") {
            $libro->precio = null;
        }

        if ($request->hasFile('portada')) {
            // antiguo
            $antiguo = $libro->portada;
            \File::delete(public_path() . '/imgs/libros/' . $antiguo);

            //obtener el archivo
            $file_portada = $request->file('portada');
            $extension = "." . $file_portada->getClientOriginalExtension();
            $nom_portada = $libro->titulo . '_P' . time() . $extension;
            $file_portada->move(public_path() . "/imgs/libros/", $nom_portada);
            $libro->portada = $nom_portada;
        }

        if ($request->hasFile('contraportada')) {
            // antiguo
            $antiguo = $libro->contraportada;
            \File::delete(public_path() . '/imgs/libros/' . $antiguo);

            //obtener el archivo
            $file_contraportada = $request->file('contraportada');
            $extension = "." . $file_contraportada->getClientOriginalExtension();
            $nom_contraportada = $libro->titulo . '_P' . time() . $extension;
            $file_contraportada->move(public_path() . "/imgs/libros/", $nom_contraportada);
            $libro->contraportada = $nom_contraportada;
        }

        $libro->save();

        return redirect()->route('libros.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Libro $libro)
    {
        return 'mostrar cargo';
    }

    public function destroy(Libro $libro)
    {
        $libro->status = 0;
        $libro->save();
        return redirect()->route('libros.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function getInfo(Request $request)
    {
        $id = $request->id;
        $libro = Libro::find($id);
        return response()->JSON([
            'sw' => true,
            'libro' => $libro,
            'area' => $libro->area,
            'autor' => $libro->autor,
            'edicion' => $libro->edicion,
            'volumen' => $libro->volumen,
            'lugar' => $libro->lugar,
            'editorial' => $libro->editorial,
        ]);
    }
}
