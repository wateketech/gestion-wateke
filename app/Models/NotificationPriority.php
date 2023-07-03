<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotificationPriority extends Model
{
    use HasFactory;
    protected $table='notification_prioritys';
    protected $fillable = ['name', 'about', 'enable'];

    public function notifications(){
        return $this->hasMany('App\Models\Notification', 'id');
    }


}
