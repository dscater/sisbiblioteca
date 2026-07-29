<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Libro extends Model
{
    protected $fillable = [
        'nro_inventario',
        'fecha_ingreso',
        'area_id',
        'autor_id',
        'titulo',
        'edicion_id',
        'volumen_id',
        'lugar_id',
        'editorial_id',
        'fecha_anio',
        'nro_paginas',
        'isbn',
        'descriptores',
        'resumen',
        'procedencia',
        'precio',
        'signatura',
        'estado',
        'portada',
        'contraportada',
        'tipo',
        'ubicacion_id',
        'portal',
        'observaciones',
        'vistos',
        'fecha_registro',
        'status'
    ];

    public function area()
    {
        return $this->belongsTo(Area::class, 'area_id');
    }

    public function autor()
    {
        return $this->belongsTo(Autor::class, 'autor_id');
    }

    public function edicion()
    {
        return $this->belongsTo(Edicion::class, 'edicion_id');
    }

    public function volumen()
    {
        return $this->belongsTo(Volumen::class, 'volumen_id');
    }

    public function lugar()
    {
        return $this->belongsTo(Lugar::class, 'lugar_id');
    }

    public function editorial()
    {
        return $this->belongsTo(Editorial::class, 'editorial_id');
    }

    public function ubicacion()
    {
        return $this->belongsTo(Ubicacion::class, 'ubicacion_id');
    }

    public function solicituds()
    {
        return $this->hasMany(SolicitudPrestamo::class, 'libro_id');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'libro_id');
    }

    /**********************************
                FUNCIONES
     ***********************************/
    public static function nroInventario()
    {
        $existe_ultimo = Libro::orderBy('id', 'ASC')->get()->last();
        if ($existe_ultimo) {
            return (int)$existe_ultimo->nro_inventario + 1;
        }
        return 1;
    }

    public static function verificaDisponible($libro)
    {
        $prestamo_egreso = Prestamo::where('libro_id', $libro->id)
            ->where('estado', 1)
            ->where('tipo', 'EGRESO')
            ->orderBy('id', 'ASC')
            ->get()
            ->last();
        $prestamo_solicitud = SolicitudPrestamo::where('libro_id', $libro->id)
            ->where('estado_solicitud', 'PENDIENTE')
            ->orderBy('id', 'ASC')
            ->get()
            ->last();

        if ($prestamo_egreso || $prestamo_solicitud) {
            return true;
        }

        return false;
    }
}
