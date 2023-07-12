<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassAssignmentConcerns;

class EntityBankAccountType extends Model
{
    use HasFactory;
    use MassAssignmentConcerns;
    protected $table='entity_bank_account_types';
    protected $fillable = ['label', 'logo', 'color', 'regEx', 'enable'];

    public function accounts(){
        return $this->hasMany('App\Models\EntityBankAccount', 'id');
    }
}
