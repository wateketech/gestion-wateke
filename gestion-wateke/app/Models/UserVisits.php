<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserVisits extends Model
{
    use HasFactory;
    protected $table='user_visits';
    protected $fillable = ['visit_id', 'start', 'longitude', 'latitude', 'end', 'about'];
}
