<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactId extends Model
{
    protected $table='contact_ids';
    protected $fillable = ['contact_id', 'type_id', 'value', 'enable'];

    public function type(){
        return $this->belongsTo('App\Models\ContactIdType', 'id');
    }
}
