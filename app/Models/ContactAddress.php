<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_address';
    protected $fillable = ['contact_id', 'name', 'city_id', 'state_id', 'country_id', 'geolocation', 'zip_code', 'enable'];

    public function country(){
        return $this->hasOne('App\Models\AddressCountry', 'id', 'country_id');
    }
    public function state(){
        return $this->hasOne('App\Models\AddressState', 'id', 'state_id');
    }
    public function city(){
        return $this->hasOne('App\Models\AddressCity', 'id', 'city_id');
    }
    public function lines(){
        return $this->hasMany('App\Models\ContactAddressLine', 'address_id');
    }
    public function contacts(){
        return $this->belongsTo('App\Models\Contacts', 'id'); // or HasMany
    }
}
