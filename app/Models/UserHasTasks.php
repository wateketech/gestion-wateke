<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHasTasks extends Model
{
    use MassCreateConcerns;
    use MassUpdateConcerns;
    use HasFactory;
    protected $table='user_has_tasks';
    protected $fillable = ['user_id', 'task_id', 'about'];
}
