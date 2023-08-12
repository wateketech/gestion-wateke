<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CuentaBancaria extends Model
{
    use HasFactory;
    protected $table='cuenta_bancaria';
    protected $fillable = ['cuenta', 'observ', 'entidad_id'];


}
