<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class Entidad extends Component
{
    public $view = 'main';
    public $nombre = 'hola';

    public function render()
    {
        return view('livewire.contacts.entidad');
    }
}
