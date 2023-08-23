<?php

namespace App\Models;

use App\Traits\MassAssignmentConcerns;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactGroup extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='contact_groups';
    protected $fillable = ['name', 'icon', 'color', 'enable', 'meta',];

    public function contacts()
    {
        return $this->hasMany('App\Models\ContactHasGroup', 'group_id', 'id')->with('contact');
    }
    public function has_contacts()
    {
        return $this->hasMany('App\Models\ContactHasGroup', 'group_id', 'id');
    }
}
