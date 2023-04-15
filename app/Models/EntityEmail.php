<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntityEmail extends Model
{
    use HasFactory;
    protected $table='entity_emails';
    protected $fillable = ['label', 'email', 'entity_id'];
}
