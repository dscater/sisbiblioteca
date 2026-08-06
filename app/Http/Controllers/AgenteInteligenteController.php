<?php

namespace App\Http\Controllers;

use App\Models\DatosUsuario;
use App\Models\Notificacion;
use App\Models\Prestamo;
use App\Models\RazonSocial;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
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
        $fecha_manana = Carbon::today()->addDay()->format('Y-m-d');
        $notificaciones = [];

        // ===========================
        // DEVOLUCIONES PARA MAÑANA
        // ===========================
        $prestamosManana = Prestamo::where('estado', 1)
            ->whereDate('fecha_devolucion', $fecha_manana)
            ->where('tipo', "EGRESO")
            ->where('estado', 1)
            ->whereNotNull('lector_id')
            ->get();

        foreach ($prestamosManana as $prestamo) {
            $existe = Notificacion::where('tipo_notificacion', 'DEVOLUCION MAÑANA')
                ->where('registro_id', $prestamo->id)
                ->whereDate('fecha', $fecha_actual)
                ->exists();

            if (!$existe) {
                $notificaciones[] = [
                    "tipo_notificacion" => "DEVOLUCION MAÑANA",
                    "descripcion" => "EL LIBRO '{$prestamo->libro->titulo}' DEBE SER DEVUELTO MAÑANA.",
                    "fecha" => $fecha_actual,
                    "hora" => now()->format('H:i:s'),
                    "modulo" => "Prestamo",
                    "registro_id" => $prestamo->id,
                ];

                $this->enviarCorreoRecordatorio($prestamo);
            }
        }


        // ===========================
        // DEVOLUCIONES HOY
        // ===========================
        // Log::debug("Detectando devoluciones para hoy: " . $fecha_actual);
        $prestamos = Prestamo::where("estado", 1)
            ->where("fecha_devolucion", "=", $fecha_actual)
            ->where('tipo', "EGRESO")
            ->where('estado', 1)
            ->where("lector_id", "!=", null)
            ->get();
        // Log::debug($prestamos);
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
                    $this->enviarCorreoRecordatorio($item);
                }
            }
        }


        // ================================
        // DEVOLUCIONES VENCIDOS/PASADOS
        // ================================
        $prestamos_pasados = Prestamo::where("estado", 1)
            ->where("fecha_devolucion", ">", $fecha_actual)
            ->where('tipo', "EGRESO")
            ->where('estado', 1)
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
                    $this->enviarCorreoRecordatorio($item);
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

    private function enviarCorreoRecordatorio($prestamo)
    {
        $datos = [
            'nombre' => $prestamo->lector->nombre,
            'apellidos' => $prestamo->lector->apellidos,
            'ci' => $prestamo->lector->ci,
            'titulo' => $prestamo->libro->titulo,
            'volumen' => $prestamo->libro->volumen->nombre,
            'edicion' => $prestamo->libro->edicion->nombre,
            'autor' => $prestamo->libro->autor->nombre,
            'codigo_solicitud' => $prestamo->solicitud ? $prestamo->solicitud->codigo : null,
            'fecha_solicitud' => $prestamo->solicitud ? $prestamo->solicitud->fecha : null,
            'fecha_devolucion' => $prestamo->fecha_devolucion,
            "tipo" => $prestamo->solicitud ? "PORTAL" : "SISTEMA",
        ];


        $servidor_correo = [
            "driver" => "smtp",
            "host" => "smtp.gmail.com",
            "puerto" => 587,
            "encriptado" => "tls",
            "correo" => "kingceroci.as@gmail.com",
            "password" => "jywnmsqrvdhpkgvk",
            "address" => "kingceroci.as@gmail.com",
            "nombre" => RazonSocial::first()->nombre,
        ];

        Config::set(
            [
                'mail.default' => $servidor_correo["driver"],
                'mail.mailers.smtp.host' => $servidor_correo["host"],
                'mail.mailers.smtp.port' => $servidor_correo["puerto"],
                'mail.mailers.smtp.encryption' => $servidor_correo["encriptado"],
                'mail.mailers.smtp.username' => $servidor_correo["correo"],
                'mail.mailers.smtp.password' => $servidor_correo["password"],
                'mail.from.address' => $servidor_correo["correo"],
                'mail.from.name' => $servidor_correo["nombre"],
            ]
        );

        // Enviar correo electrónico
        \Mail::to($prestamo->lector->user->name)->send(new \App\Mail\RecordatorioMail($datos));
        Log::debug("Correo enviado a: " . $prestamo->lector->user->name);
    }
}
