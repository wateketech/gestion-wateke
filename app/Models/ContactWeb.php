<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactWeb extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_webs';
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'is_primary', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactWebType', 'id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
