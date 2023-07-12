<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressState extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='states';
    protected $fillable = ['id', 'name', 'country_id', 'country_code', 'country_name', 'state_code', 'type', 'latitude', 'longitude', 'enable'];

    public function country(){
        return $this->hasOne('App\Models\AddressCountry', 'id', 'country_id');
    }
    public function cities(){
        return $this->hasMany('App\Models\AddressCity', 'state_id');
    }

}

