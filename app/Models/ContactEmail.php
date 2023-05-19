<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactEmail extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_emails';
    protected $fillable = ['contact_id', 'type_id', 'value', 'about', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactEmailType', 'id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}