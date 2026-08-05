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
    protected $appends = ["url_logo", "logo_b64"];

    public function getUrlLogoAttribute()
    {
        return asset("imgs/" . $this->logo);
    }

    public function getLogoB64Attribute()
    {
        $path = public_path("imgs/" . $this->logo);
        if (file_exists($path)) {
            $type = pathinfo($path, PATHINFO_EXTENSION);
            $data = file_get_contents($path);
            $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
            return $base64;
        }
        return "";
    }
}
