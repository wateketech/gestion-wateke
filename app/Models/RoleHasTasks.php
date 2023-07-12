<?php

namespace App\Models;

use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleHasTasks extends Model
{
    use MassCreateConcerns;
    use MassUpdateConcerns;
    use HasFactory;
    protected $table='role_has_tasks';
    protected $fillable = ['role_id', 'task_id', 'about'];
}
