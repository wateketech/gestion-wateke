<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contacts';
    protected $fillable = ['alias', 'name', 'middle_name', 'first_lastname', 'second_lastname', 'about', 'enable'];

    public function bank_accounts(){
        return $this->hasMany('App\Models\ContactBankAccount', 'contact_id');
    }
    public function dates(){
        return $this->hasMany('App\Models\ContactDate', 'contact_id');
    }
    public function emails(){
        return $this->hasMany('App\Models\ContactEmail', 'contact_id');
    }
    public function ids(){
        return $this->hasMany('App\Models\ContactId', 'contact_id');
    }
    public function instant_messages(){
        return $this->hasMany('App\Models\ContactInstantMessage', 'contact_id');
    }
    public function user(){
        return $this->hasOne('App\Models\ContactLinkUser', 'contact_id');
    }
    public function phones(){
        return $this->hasMany('App\Models\ContactPhone', 'contact_id');
    }
    public function pics(){
        return $this->hasMany('App\Models\ContactProfilePic', 'contact_id');
    }
    public function publish_us(){
        return $this->hasMany('App\Models\ContactPublishUs', 'contact_id');
    }
    public function rrss(){
        return $this->hasMany('App\Models\ContactRrss', 'contact_id');
    }
    public function webs(){
        return $this->hasMany('App\Models\ContactWeb', 'contact_id');
    }
}
