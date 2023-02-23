<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    use HasFactory;
    protected $table='user_tasks';
    protected $fillable = ['user_id', 'task_id', 'value', 'manually_time'];
    public function usuario()
    {
        return $this->hasMany('App\Models\User', 'id');
    }
    public function metrica()
    {
        return $this->hasMany('App\Models\Task', 'id');
    }
}
