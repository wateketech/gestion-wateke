<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{
    use HasFactory;
    protected $table='notifications_types';
    protected $fillable = ['label', 'color', 'icon', 'enable'];

    public function notifications(){
        return $this->hasMany('App\Models\Notification', 'id');
    }
}




