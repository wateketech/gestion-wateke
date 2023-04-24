<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;

class AllEntity extends Component
{
    public $entity_types;
    public function mount(){
        $this->entity_types = json_decode(file_get_contents('https://raw.githubusercontent.com/wateketech/gestion-wateke/main/database/data/entity_types.json'), true);
    }
    public function render()
    {
        return view('livewire.contacts.entity.all-entity');
    }

}
