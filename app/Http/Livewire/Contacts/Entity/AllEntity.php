<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;

class AllEntity extends Component
{
    public $entity_types;
    public function mount(){
        $this->entity_types = EntityTypes::all();
    }
    public function render()
    {
        return view('livewire.contacts.entity.all-entity');
    }

}
