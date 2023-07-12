<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPhoneType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_phone_types';
    protected $fillable = ['label', 'enable'];

    public function phones(){
        return $this->hasMany('App\Models\ContactPhone', 'id');
    }
}
