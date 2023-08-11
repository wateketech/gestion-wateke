<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactRrss extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_rrss';
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'is_primary', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\ContactRrssType', 'id', 'type_id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
