<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Model;

class EntityLogo extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_logos';
    protected $fillable = ['entity_id', 'value', 'label', 'primary'];
}
