<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasTasks extends Model
{
    use MassAssignmentConcerns;
    use HasFactory;
    protected $table='user_has_tasks';
    protected $fillable = ['user_id', 'task_id', 'about'];
}
