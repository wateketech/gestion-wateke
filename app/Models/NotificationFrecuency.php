<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $table='notifications_frecuency';
    protected $fillable = ['name', 'about', 'enable'];

    public function notifications(){
        return $this->hasMany('App\Models\Notification', 'id');
    }


}
