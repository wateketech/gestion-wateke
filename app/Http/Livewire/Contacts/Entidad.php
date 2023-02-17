<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;
use App\Models\Entidad as BD;

class Entidad extends Component
{
    public $view = 'main';
    public $nombre = 'hola';

    public function render()
    {
        $entidades = BD::all();
        return view('livewire.contacts.entidad', compact('entidades'));
    }
}
