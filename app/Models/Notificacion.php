<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = [
        "tipo_notificacion",
        "descripcion",
        "fecha",
        "hora",
        "modulo",
        "registro_id",
    ];

    protected $appends = ["fecha_t", "fecha_hora_t", "hace", "url"];


    public function getUrlAttribute()
    {
        return route("notificacions.show", $this->id);
    }
    public function getFechaTAttribute()
    {
        return date("d/m/Y", strtotime($this->fecha));
    }

    public function getFechaHoraTAttribute()
    {
        return date("d/m/Y H:i", strtotime($this->fecha . ' ' . $this->hora));
    }

    public function getHaceAttribute()
    {
        $tiempo = $this->created_at
            ->locale('es')
            ->diffForHumans();
        return $tiempo;
    }

    public function prestamo()
    {
        return $this->belongsTo(Prestamo::class, 'registro_id');
    }

    public function notificacion_users()
    {
        return $this->hasMany(NotificacionUser::class, 'notificacion_id');
    }
}
