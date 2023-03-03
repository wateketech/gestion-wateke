<?php

namespace App\Http\Livewire\Contacts\Entidad\Layouts;

use Livewire\Component;

class Redsocial extends Component
{
    public $url, $about;

    public function render()
    {
        return view('livewire.contacts.entidad.layouts.redsocial');
    }
}
