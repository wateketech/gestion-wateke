<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasNotification extends Model
{
    use HasFactory;
    protected $table='user_has_notifications';
    protected $fillable = ['notification_id', 'user_id', 'about', 'meta', 'read_at',];




    public function notification(){
        return $this->belongsTo('App\Models\Notification')->withDefault();
    }

    public function user(){
        return $this->belongsTo('App\Models\User')->withDefault();
    }

}
