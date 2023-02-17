<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
    use HasFactory;
    protected $table='entidad';
    protected $fillable = ['nombre', 'num_oficina', 'nombre_fiscal', 'nif', 'es_minorista', 'es_central', 'iata', 'rp', 'gds', 'observ', 'direccion_id', 'grupo_gestion_id'];

    public function correo_ent()
    {
        return $this->hasMany('App\CorreoEnt', 'entidad_id');
    }
    public function telefono_ent()
    {
        return $this->hasMany('App\TelefonoEnt', 'entidad_id');
    }
    public function red_social_ent()
    {
        return $this->hasMany('App\RedSocialEnt', 'entidad_id');
    }


    public function web_ent()
    {
        return $this->hasMany('App\WebEnt', 'entidad_id');
    }
    public function nos_publica_ent()
    {
        return $this->hasMany('App\NosPublica', 'entidad_id');
    }
    public function cuenta_bancaria_ent()
    {
        return $this->hasMany('App\CuentaBancariaEnt', 'entidad_id');
    }




}
