<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactHasGroup extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contacts_has_groups';
    protected $fillable = ['contact_id', 'group_id'];

    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'contact_id', 'id');
    }
    public function group(){
        return $this->belongsToMany('App\Models\ContactGroup', 'contact_groups', 'group_id', 'id');
    }
}
