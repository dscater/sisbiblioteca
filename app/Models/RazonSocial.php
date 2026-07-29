<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RazonSocial extends Model
{
    protected $fillable = [
        'nombre',
        'alias',
        'ciudad',
        'dir',
        'fono',
        'cel',
        'casilla',
        'correo',
        'logo',
        'web',
        'actividad_economica'
    ];
}
