<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDate extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_dates';
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactDateType', 'id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
