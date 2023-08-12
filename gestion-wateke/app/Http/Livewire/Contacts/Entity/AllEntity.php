<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;

class AllEntity extends Component
{
    public $route;
    public $valid_routes;
    public $entity_types;
    public function mount($route = null){
        $this->route = $route;
        $this->entity_types = EntityTypes::all();
        $this->valid_routes = collect($this->entity_types->pluck('route')->toArray());
        $this->valid_routes->push('grupos-cadenas-hoteleras', 'agencias', '');
        if (! $this->valid_routes->contains($route)) {
            abort(404);
        }

    }
    public function render()
    {
        return view('livewire.contacts.entity.all-entity');
    }

}
