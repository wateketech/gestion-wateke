<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInstantMessageType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_instant_message_types';
    protected $fillable = ['label', 'regEx', 'enable'];

    public function instant_messages(){
        return $this->hasMany('App\Models\InstantMessage', 'id');
    }
}
