<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prestamo extends Model
{
    protected $fillable = [
        'libro_id',
        'solicitud_id',
        'lector_id',
        'tipo',
        'observaciones',
        'descripcion',
        'fecha_registro',
        'fecha_devolucion',
        'estado'
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    public function solicitud()
    {
        return $this->belongsTo(SolicitudPrestamo::class, 'solicitud_id');
    }

    public function lector()
    {
        return $this->belongsTo(Lector::class, 'lector_id');
    }
}
