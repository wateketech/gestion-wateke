<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPublishUsType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_publish_us_types';
    protected $fillable = ['contact_id', 'type_id', 'value', 'about', 'enable'];

    public function publish_us(){
        return $this->hasMany('App\Models\ContactPublishUs', 'id');
    }
}
