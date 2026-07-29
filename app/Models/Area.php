<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    protected $fillable = [
        'nombre',
        'descripcion'
    ];

    public function libros()
    {
        return $this->hasMany(Libro::class, 'area_id');
    }
}
