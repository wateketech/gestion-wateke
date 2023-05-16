<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    protected $table='contacts';
    protected $fillable = ['alias', 'name', 'middle_name', 'first_lastname', 'second_lastname', 'about', 'enable'];

    public function user(){
        return $this->hasOne('App\Models\User', 'id');
    }
}
