<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasNotifications extends Model
{
    use HasFactory;
    protected $table='user_has_notifications';
    protected $fillable = ['notification_id', 'user_id', 'viewed', 'about'];
}
