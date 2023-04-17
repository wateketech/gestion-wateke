<?php

namespace App\Http\Livewire\Account\Profile\Layouts;

use Livewire\Component;

class CreateVisit extends Component
{
    public $prueba = 0;



    protected $listeners = [
        'createVisit' => "showCreateVisit",
    ];

    public function showCreateVisit(){
        $this->prueba = 1;
    }

    public function render()
    {
        return view('livewire.account.profile.layouts.create-visit');
    }
}
