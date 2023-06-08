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
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'is_personal', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactRrssType', 'id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
