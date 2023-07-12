<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\MassCreateConcerns;
use App\Traits\MassUpdateConcerns;

class EntityBankAccountType extends Model
{
    use HasFactory;
    use MassCreateConcerns;
    use MassUpdateConcerns;
    protected $table='entity_bank_account_types';
    protected $fillable = ['label', 'logo', 'color', 'regEx', 'enable'];

    public function accounts(){
        return $this->hasMany('App\Models\EntityBankAccount', 'id');
    }
}
