<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ubicacion extends Model
{
    protected $fillable = [
        'estante',
        'balda'
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'ubicacion_id');
    }
}
