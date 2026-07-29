<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\DatosUsuario;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        $usuarios = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->get();
        return view('users.index', compact('usuarios'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(UserStoreRequest $request)
    {
        $usuario = new DatosUsuario(array_map('mb_strtoupper', $request->all()));
        $nombre_usuario = UserController::nombreUsuario($request->nombre, $request->paterno);

        $comprueba = User::where('name', $nombre_usuario)->get()->first();
        $cont = 1;
        while ($comprueba) {
            $nombre_usuario = $nombre_usuario . $cont;
            $comprueba = User::where('name', $nombre_usuario)->get()->first();
            $cont++;
        }

        $nuevo_usuario = new User();
        $nuevo_usuario->name = $nombre_usuario;
        $nuevo_usuario->password = Hash::make($request->ci);
        $nuevo_usuario->tipo = $request->tipo;
        $nuevo_usuario->foto = 'user_default.png';
        $nuevo_usuario->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $usuario->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $nuevo_usuario->foto = $nom_foto;
        }
        $nuevo_usuario->save();
        $nuevo_usuario->datosUsuario()->save($usuario);
        return redirect()->route('users.index')->with('bien', 'Usuario registrado con éxito');
    }

    public function edit(DatosUsuario $usuario)
    {
        return view('users.edit', compact('usuario'));
    }

    public function update(DatosUsuario $usuario, UserUpdateRequest $request)
    {
        $usuario->update(array_map('mb_strtoupper', $request->except('foto')));
        $usuario->user->tipo = $request->tipo;
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $usuario->user->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/users/' . $antiguo);
            }
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $usuario->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/users/", $nom_foto);
            $usuario->user->foto = $nom_foto;
        }
        $usuario->user->save();
        return redirect()->route('users.index')->with('bien', 'Usuario modificado con éxito');
    }

    public function show(DatosUsuario $usuario)
    {
        return 'mostrar usuario';
    }

    public function destroy(User $user)
    {
        $user->estado = 0;
        $user->save();
        return redirect()->route('users.index')->with('bien', 'Registro eliminado correctamente');
    }


    public static function nombreUsuario($nom, $apep)
    {
        //determinando el nombre de usuario inicial del 1er_nombre+apep+tipoUser
        $nombre_user = substr(mb_strtoupper($nom), 0, 1); //inicial 1er_nombre
        $nombre_user .= mb_strtoupper($apep);

        return $nombre_user;
    }

    // VISTA CONFIGURACIÓN DE USUARIO
    public function config(User $user)
    {
        return view('users.config', compact('user'));
    }

    // NUEVA CONTRASEÑA POR USUARIOS
    public function cuenta_update(Request $request, User $user)
    {
        if ($request->oldPassword) {
            if (Hash::check($request->oldPassword, $user->password)) {
                if ($request->newPassword == $request->password_confirm) {
                    $user->password = Hash::make($request->newPassword);
                    $user->save();
                    return redirect()->route('users.config', $user->id)->with('bien', 'Contraseña actualizada con éxito');
                } else {
                    return redirect()->route('users.config', $user->id)->with('error', 'Error al confirmar la nueva contraseña');
                }
            } else {
                return redirect()->route('users.config', $user->id)->with('error', 'La contraseña (Antigua contraseña) no coincide con nuestros registros');
            }
        }
    }

    // NUEVA FOTO POR USUARIOS
    public function cuenta_update_foto(Request $request, User $user)
    {
        if ($request->ajax()) {
            if ($request->hasFile('foto')) {
                $archivo_img = $request->file('foto');
                $extension = '.' . $archivo_img->getClientOriginalExtension();
                $codigo = $user->name;
                $path = public_path() . '/imgs/users/' . $user->foto;
                if ($user->foto != 'user_default.png') {
                    \File::delete($path);
                }
                // SUBIENDO FOTO AL SERVIDOR
                if ($user->empleado) {
                    $name_foto = $codigo . $user->empleado->nombre . time() . $extension; //determinar el nombre de la imagen y su extesion
                } else {
                    $name_foto = $codigo . time() . $extension; //determinar el nombre de la imagen y su extesion
                }
                $name_foto = str_replace(' ', '_', $name_foto);
                $archivo_img->move(public_path() . '/imgs/users/', $name_foto); //mover el archivo a la carpeta de destino

                $user->foto = $name_foto;
                $user->save();
                session(['bien' => 'Foto actualizado con éxito']);
                return response()->JSON([
                    'msg' => 'actualizado'
                ]);
            }
        }
    }
}
