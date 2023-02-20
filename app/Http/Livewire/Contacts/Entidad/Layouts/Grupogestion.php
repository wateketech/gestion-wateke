<?php

namespace App\Http\Livewire\Contacts\Entidad\Layouts;

use Livewire\Component;
use App\Models\GrupoGestion as GrupoGestiones;

class Grupogestion extends Component
{
    public $grupog_id, $grupog_name;

    public function mount(){
        $this->grupogestiones = GrupoGestiones::select('id', 'nombre')->get();
        // $this->grupog_id = $this->grupogs[0]['id'];
    }

    public function render()
    {
        return view('livewire.contacts.entidad.layouts.grupogestion');
    }
}
