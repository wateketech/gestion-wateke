<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCity extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='cities';
    protected $fillable = ['id', 'name', 'state_id', 'state_code', 'state_name', 'country_id', 'country_code', 'country_name', 'latitude', 'longitude', 'wikiDataId', 'enable'];

    public function country(){
        return $this->hasOne('App\Models\AddressCountry', 'id', 'country_id');
    }
    public function state(){
        return $this->hasOne('App\Models\AddressState', 'id', 'state_id');
    }

}
