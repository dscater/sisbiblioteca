<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model
{
    protected $table = 'datos_usuarios';
    protected $fillable = [
        'nombre',
        'paterno',
        'materno',
        'ci',
        'ci_exp',
        'genero',
        'dir',
        'email',
        'fono',
        'cel',
        'user_id',
        'familiar',
        'cel_f'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
