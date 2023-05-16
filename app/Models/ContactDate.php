<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDate extends Model
{
    use HasFactory;
    protected $table='contact_dates';
    protected $fillable = ['contact_id', 'type_id', 'value'];

    public function type(){
        return $this->belongsTo('App\Models\ContactDateType', 'id');
    }
}
