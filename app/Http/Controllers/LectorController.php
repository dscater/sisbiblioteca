<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\Models\Lector;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\NuevoLectorRequest;
use App\Http\Requests\NuevoLectorStoreRequest;

class LectorController extends Controller
{
    public function registrar_lector(NuevoLectorRequest $request)
    {
        $lector = new Lector([
            'nombre' => mb_strtoupper($request->nombre),
            'apellidos' => mb_strtoupper($request->apellidos),
            'ci' => $request->ci,
            'ci_exp' => $request->ci_exp,
            'cel' => $request->cel,
            'dir' => mb_strtoupper($request->dir),
            'correo' => $request->correo,
            'contrasenia' => $request->password,
            'fecha_registro' => date('Y-m-d')
        ]);

        $usuario = User::create([
            'name' => $request->correo,
            'password' => Hash::make($request->password),
            'tipo' => 'LECTOR',
            'foto' => 'user_default.png',
            'estado' => 1,
        ]);

        $usuario->lector()->save($lector);

        Session::put('logeado', true);
        Session::put('user_id', $usuario->id);
        Session::put('lector_id', $lector->id);
        Session::put('lector', $lector->nombre . ' ' . $lector->apellidos);
        Session::put('correo', $lector->correo);
        Session::put('ci', $lector->ci);
        Session::put('cel', $lector->cel);

        // return redirect()->route('inicio')->with('bien', 'Registro realizado correctamente');
        return redirect()->back()->with('bien', 'Registro realizado correctamente');
    }

    public function lector_login(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|string',
        ]);

        $name = $request->name;
        $password = $request->password;

        $users = User::where('name', $name)->get();

        foreach ($users as $user) {
            if (Hash::check($password, $user->password)) {
                Session::put('logeado', true);
                Session::put('user_id', $user->id);
                Session::put('lector_id', $user->lector->id);
                Session::put('lector', $user->lector->nombre . ' ' . $user->lector->apellidos);
                Session::put('correo', $user->lector->correo);
                Session::put('ci', $user->lector->ci);
                Session::put('cel', $user->lector->cel);
                return redirect()->back()->with('bien', 'Bienvenido ' . Session::get('lector'));
            }
        }

        return redirect()->back()->with('name_error', $name);
    }

    public function cerrar_session_lector(Request $request)
    {
        Session::flush();
        return redirect()->route('inicio');
    }

    public function compruebaSesion(Request $request)
    {
        if ($request->ajax()) {
            if (Session::get('logeado')) {
                return response()->JSON(true);
            }
        }
        return response()->JSON(false);
    }

    public function index()
    {
        $lectors = Lector::select('lectors.*')
            ->join('users', 'users.id', '=', 'lectors.user_id')
            ->where('users.estado', 1)
            ->get();
        return view('lectors.index', compact('lectors'));
    }

    public function getInfoLector(Request $request)
    {
        $id = $request->id;
        $lector = Lector::where('id', $id)->get()->first();

        return response()->JSON([
            'sw' => true,
            'lector' => $lector
        ]);
    }

    public function create()
    {
        return view('lectors.create');
    }

    public function store(NuevoLectorStoreRequest $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $nuevo_lector = new Lector(array_map('mb_strtoupper', $request->except('correo')));
        $nuevo_lector->correo = $request->correo;
        $nuevo_lector->contrasenia = $request->password;

        $nuevo_user = User::create([
            'name' => $nuevo_lector->correo,
            'password' => Hash::make($request->password),
            'tipo' => 'LECTOR',
            'foto' => 'user_default.png',
            'estado' => 1
        ]);
        $nuevo_user->lector()->save($nuevo_lector);
        return redirect()->route('lectors.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Lector $lector)
    {
        return view('lectors.edit', compact('lector'));
    }

    public function update(Lector $lector, Request $request)
    {
        $lector->update(array_map('mb_strtoupper', $request->except('correo')));
        $lector->correo = $request->correo;
        $lector->contrasenia = $request->password;
        $lector->save();

        $lector->user->password = Hash::make($request->password);
        $lector->user->save();

        return redirect()->route('lectors.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Lector $lector)
    {
        return 'mostrar cargo';
    }

    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
        return redirect()->route('lectors.index')->with('bien', 'Registro eliminado correctamente');
    }

    public function reasigna_contrasenia(Lector $lector,  Request $request)
    {
        $password = $request->password;
        $lector->user->password = Hash::make($password);
        $lector->user->save();
        $lector->contrasenia = $password;
        $lector->save();

        return redirect()->route('lectors.index')->with('bien', 'Contraseña reasignada correctamente');
    }
}
