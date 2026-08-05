<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use App\Models\NotificacionUser;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificacions = NotificacionUser::where("user_id", auth()->user()->id)->get();
        return view('notificacions.index', compact('notificacions'));
    }

    public function usuario()
    {
        $agenteInteligente = new AgenteInteligenteController();
        $agenteInteligente->generarNotificaciones();

        $notificaciones = NotificacionUser::with([
            "notificacion",
            // "notificacion.prestamo.libro",
            // "notificacion.prestamo.lector",
            // "notificacion.prestamo.solicitud",
        ])->where('user_id', auth()->user()->id)
            ->where('visto', 0)
            ->orderBy("created_at", "desc")
            ->get();

        return response()->json($notificaciones);
    }

    public function show(Notificacion $notificacion)
    {

        $notificacion_user = NotificacionUser::where('notificacion_id', $notificacion->id)
            ->where('user_id', auth()->user()->id)
            ->first();
        if ($notificacion_user) {
            $notificacion_user->visto = 1;
            $notificacion_user->save();
        }

        return view('notificacions.show', compact('notificacion'));
    }
}
