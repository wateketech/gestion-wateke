<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class EntityType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_types';
    protected $fillable = ['model', 'visual_name_s', 'visual_name_p', 'icon', 'color'];
}
