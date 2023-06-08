<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityHasAddress extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_has_address';
    protected $fillable = ['entity_id', 'name', 'city_id', 'state_id', 'country_id', 'geolocation', 'zip_code', 'enable'];

    public function country(){
        return $this->belongsTo('App\Models\AddressCountry', 'id');
    }
    public function state(){
        return $this->belongsTo('App\Models\AddressState', 'id');
    }
    public function city(){
        return $this->belongsTo('App\Models\AddressCity', 'id');
    }
    public function entitys(){
        return $this->belongsTo('App\Models\Entitys', 'id'); // or HasMany
    }
}
