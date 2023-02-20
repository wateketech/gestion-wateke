<?php

namespace App\Http\Livewire\Contacts\Entidad\Layouts;

use Livewire\Component;
use App\Models\Gds as Gdss;

class Gds extends Component
{
    public $gds_id, $gds_name;

    public function mount(){
        $this->gdss = Gdss::select('id', 'nombre')->get();
        // $this->grupog_id = $this->grupogs[0]['id'];
    }
    public function render()
    {
        return view('livewire.contacts.entidad.layouts.gds');
    }
}
