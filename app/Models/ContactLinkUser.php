<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLinkUser extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_link_user';
    protected $fillable = ['contact_id', 'user_id', 'enable', 'meta',];

    public function contact(){
        return $this->hasOne('App\Models\Contact', 'id');
    }
    public function user(){
        return $this->hasOne('App\Models\User', 'id');
    }
}
