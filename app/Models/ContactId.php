<?php

namespace App\Models;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactId extends Model
{
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_ids';
    protected $fillable = ['contact_id', 'type_id', 'value', 'meta', 'enable'];

    public function type(){
        return $this->hasOne('App\Models\ContactIdType', 'id', 'type_id');
    }
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
