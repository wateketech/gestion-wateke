<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;

class AllContacts extends Component
{
    public $entity_types;
    public function mount(){
        $this->entity_types = EntityTypes::all();
    }
    public function render()
    {
        return view('livewire.contacts.contacts.all-contacts');
    }
}
