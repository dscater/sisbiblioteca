<?php

namespace App\Http\Controllers;

use App\Models\DatosUsuario;
use App\Models\Notificacion;
use App\Models\Prestamo;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AgenteInteligenteController extends Controller
{
    public function generarNotificaciones()
    {
        // Array para almacenar las notificaciones_generadas
        $notificaciones_generadas = array();

        // Generar notificaciones para cada tipo de registro
        $notificiones = $this->detectarEventos();

        if (!empty($notificiones)) {
            foreach ($notificiones as $notificacion) {
                // inicializar la notificacion
                $notificacion_generada = Notificacion::create([
                    "tipo_notificacion" => $notificacion['tipo_notificacion'],
                    "descripcion" => $notificacion['descripcion'],
                    "modulo" => $notificacion['modulo'],
                    "registro_id" => $notificacion['registro_id'],
                    "fecha" => $notificacion['fecha'],
                    "hora" => $notificacion['hora'],
                ]);

                $notificacion = $this->generarNotificacion($notificacion_generada);
                if ($notificacion) {
                    $notificaciones_generadas[] = $notificacion;
                }
            }
        }
        return $notificaciones_generadas;
    }

    // Obtener eventos/notificiones
    private function detectarEventos()
    {
        // segun la fecha actual
        $fecha_actual = Carbon::now()->format('Y-m-d');
        $notificaciones = [];

        // buscar en los prestamos proximos a vencer
        $prestamos = Prestamo::where("estado", 1)
            ->where("fecha_devolucion", "=", $fecha_actual)
            ->where("solicitud_id", "!=", null)
            ->where("lector_id", "!=", null)
            ->get();
        if (count($prestamos) > 0) {
            foreach ($prestamos as $item) {

                // verificar si ya existe la notificacion para este prestamo
                $notificacion_existente = Notificacion::where("tipo_notificacion", "PRESTAMO VENCIDO")
                    ->where("registro_id", $item->id)
                    ->where("fecha", $fecha_actual)
                    ->get()->first();
                if (!$notificacion_existente) {
                    $notificaciones[] = [
                        "tipo_notificacion" => "PRESTAMO VENCIDO",
                        "descripcion" => "SE NOTIFICA QUE EL PRESTAMO DEL LIBRO " . $item->libro->titulo . " DEL LECTOR " . $item->lector->nombre . " " . $item->lector->apellidos . " CON C.I. " . $item->lector->ci . " YA VENCIO SU FECHA DE DEVOLUCION",
                        "fecha" => $fecha_actual,
                        "hora" => date("H:i:s"),
                        "modulo" => "Prestamo",
                        "registro_id" => $item->id
                    ];
                }
            }
        }
        // prestamos que pasaron
        $prestamos_pasados = Prestamo::where("estado", 1)
            ->where("fecha_devolucion", ">", $fecha_actual)
            ->where("solicitud_id", "!=", null)
            ->where("lector_id", "!=", null)
            ->get();
        if (count($prestamos_pasados) > 0) {
            foreach ($prestamos_pasados as $item) {
                // verificar si ya existe la notificacion para este prestamo
                $notificacion_existente = Notificacion::where("tipo_notificacion", "PRESTAMO PENDIENTE")
                    ->where("registro_id", $item->id)
                    ->where("fecha", $fecha_actual)
                    ->get()->first();
                if (!$notificacion_existente) {
                    $notificaciones[] = [
                        "tipo_notificacion" => "PRESTAMO PENDIENTE",
                        "descripcion" => "SE NOTIFICA QUE EL PRESTAMO DEL LIBRO " . $item->libro->titulo . " DEL LECTOR " . $item->lector->nombre . " " . $item->lector->apellidos . " CON C.I. " . $item->lector->ci . " AUN NO HA SIDO DEVUELTO",
                        "fecha" => $fecha_actual,
                        "hora" => date("H:i:s"),
                        "modulo" => "Prestamo",
                        "registro_id" => $item->id
                    ];
                }
            }
        }
        return $notificaciones;
    }

    // Generar una notificación para un evento dado
    private function generarNotificacion($notificacion, $tipos = ["ADMINISTRADOR", "AUXILIAR"])
    {
        // obtener los usuarios que recibiran la notificación
        $usuarios = User::whereIn("tipo", $tipos)->get();
        // Log::debug($usuarios);
        foreach ($usuarios as $item) {
            $notificacion->notificacion_users()->create([
                "user_id" => $item->id,
            ]);
        }
        return $notificacion;
    }
}
