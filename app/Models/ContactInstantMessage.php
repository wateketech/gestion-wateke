<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInstantMessage extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_instant_messages';
    protected $fillable = ['contact_id', 'type_id', 'value', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactInstantMessageType', 'id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
