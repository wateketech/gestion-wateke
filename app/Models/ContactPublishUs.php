<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPublishUs extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_publish_us';
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'about', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\ContactPublishUsType', 'id', 'type_id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
