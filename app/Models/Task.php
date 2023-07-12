<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class Task extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='tasks';

    protected $fillable = ['name', 'type_value', 'average', 'type_frec', 'about', 'enable', 'permanent'];

    public function setAboutAttribute($value)
    {
        $this->attributes['about'] = ucfirst($value);
    }
}
