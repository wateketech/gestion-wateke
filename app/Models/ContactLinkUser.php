<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactLinkUser extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_link_user';
    protected $fillable = ['contact_id', 'user_id', 'enable', 'meta',];

    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'contact_id', 'id');
    }
    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }
}
