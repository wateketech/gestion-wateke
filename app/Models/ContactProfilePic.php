<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class ContactProfilePic extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_profile_pics';
    protected $fillable = ['contact_id', 'value', 'label', 'primary', 'enable'];
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
