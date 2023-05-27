<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddressCountry extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='countries';
    protected $fillable = ['id', 'name', 'iso3', 'iso2', 'numeric_code', 'phone_code', 'capital', 'currency', 'currency_name', 'currency_symbol', 'tld', 'native', 'region', 'subregion', 'timezones', 'translations', 'latitude', 'longitude', 'emoji', 'emojiU', 'enable'];

    public function states(){
        return $this->hasMany('App\Models\ContactBankAccountType', 'id');
    }

}
