<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCity extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='cities';
    protected $fillable = ['id', 'name', 'state_id', 'state_code', 'state_name', 'country_id', 'country_code', 'country_name', 'latitude', 'longitude', 'wikiDataId', 'enable'];

    public function country(){
        return $this->belongsTo('App\Models\AddressCountry', 'id');
    }
    public function state(){
        return $this->belongsTo('App\Models\AddressState', 'id');
    }

}
