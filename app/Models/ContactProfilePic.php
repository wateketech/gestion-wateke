<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class ContactProfilePic extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='contact_profile_pics';
    protected $fillable = ['contact_id', 'label', 'name', 'store', 'meta', 'label', 'is_primary', 'enable'];
    public function contact(){
        return $this->belongsTo('App\Models\Contact', 'id');
    }
}
