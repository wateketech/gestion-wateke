<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class ContactProfilePic extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_logos';
    protected $fillable = ['contact_id', 'value', 'label', 'primary'];
}
