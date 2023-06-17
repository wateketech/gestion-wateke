<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactAddress extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_address';
    protected $fillable = ['contact_id', 'name', 'city_id', 'state_id', 'country_id', 'geolocation', 'zip_code', 'enable'];

    public function country(){
        return $this->belongsTo('App\Models\AddressCountry', 'id');
    }
    public function state(){
        return $this->belongsTo('App\Models\AddressState', 'id');
    }
    public function city(){
        return $this->belongsTo('App\Models\AddressCity', 'id');
    }
    public function lines(){
        return $this->hasMany('App\Models\ContactAddressLine', 'address_id');
    }
    public function contacts(){
        return $this->belongsTo('App\Models\Contacts', 'id'); // or HasMany
    }
}
