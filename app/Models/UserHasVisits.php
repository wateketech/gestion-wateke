<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasVisits extends Model
{
    use HasFactory;
    protected $table='user_has_visits';
    protected $fillable = ['entity_id', 'user_id', 'deaddate', 'about'];
}
