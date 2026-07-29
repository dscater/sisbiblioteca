<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudPrestamo extends Model
{
    protected $fillable = [
        'codigo',
        'libro_id',
        'lector_id',
        'fecha_solicitud',
        'fecha_fin',
        'observacion',
        'fecha_registro',
        'estado_solicitud'
    ];

    public function libro()
    {
        return $this->belongsTo(Libro::class, 'libro_id');
    }

    public function lector()
    {
        return $this->belongsTo(Lector::class, 'lector_id');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'solicitud_id');
    }

    /* *************
        METODOS
    ************** */
    public static function ultimoCodigo()
    {
        $existe_ultimo = SolicitudPrestamo::orderBy('id', 'ASC')->get()->last();
        if ($existe_ultimo) {
            $codigo_str = $existe_ultimo->codigo;
            $array_codigo = \explode('-', $codigo_str);
            $numero_codigo = (int)$array_codigo[1];
            $numero_codigo = $numero_codigo + 1;
            $nuevo_codigo = 'P-';

            if ($numero_codigo < 10) {
                $nuevo_codigo = 'P-0000' . $numero_codigo;
            } elseif ($numero_codigo < 100) {
                $nuevo_codigo = 'P-000' . $numero_codigo;
            } elseif ($numero_codigo < 1000) {
                $nuevo_codigo = 'P-00' . $numero_codigo;
            } elseif ($numero_codigo < 10000) {
                $nuevo_codigo = 'P-0' . $numero_codigo;
            } else {
                $nuevo_codigo = 'P-' . $numero_codigo;
            }

            return $nuevo_codigo;
        }
        return 'P-00001';
    }

    public static function verificaSolicitudes()
    {
        $solicituds = SolicitudPrestamo::where('estado_solicitud', 'PENDIENTE')
            ->get();
        foreach ($solicituds as $solicitud) {
            if (date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($solicitud->fecha_fin))) {
                $solicitud->estado_solicitud = 'VENCIDO';
                $solicitud->save();
            }
        }

        return true;
    }

    public static function verificaSolititudesLector($lector_id)
    {
        $solicituds = SolicitudPrestamo::where('estado_solicitud', 'PENDIENTE')
            ->where('lector_id', $lector_id)
            ->get();

        foreach ($solicituds as $solicitud) {
            if (date('Y-m-d H:i:s') > date('Y-m-d H:i:s', strtotime($solicitud->fecha_fin))) {
                $solicitud->estado_solicitud = 'VENCIDO';
                $solicitud->save();
            }
        }

        return true;
    }
}
