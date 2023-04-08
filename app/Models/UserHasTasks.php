<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebEnt extends Model
{
    use HasFactory;
    protected $table='user_has_tasks';
    protected $fillable = ['user_id', 'task_id', 'about'];
}
