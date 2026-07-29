<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lector extends Model
{
    protected $fillable = [
        'user_id',
        'nombre',
        'apellidos',
        'ci',
        'ci_exp',
        'cel',
        'dir',
        'correo',
        'contrasenia',
        'fecha_registro'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function solicituds()
    {
        return $this->hasMany(SolicitudPrestamo::class, 'lector_id');
    }

    public function prestamos()
    {
        return $this->hasMany(Prestamo::class, 'lector_id');
    }
}
