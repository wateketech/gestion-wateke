<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;

class Create extends Component
{
    public $prueba = 1;
    public $currentStep = 1;
    public $entity_types = [

    ];
    // -------- entidades --------
    public $entity_type;

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------





// ----------------------- VALIDACIONES --------------------------
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->entity_types = file_get_contents('https://raw.githubusercontent.com/wateketech/gestion-wateke/main/database/data/entity_types.json');
    }
    public function render()
    {
        return view('livewire.contacts.entity.create');
    }

// ----------------------- flujo STEPS --------------------------
    public function stepSubmit_1(){
        $this->currentStep = 2;
    }
    public function stepSubmit_2(){
        $this->currentStep = 3;
    }
    public function stepSubmit_3(){
        $this->currentStep = 4;
    }
    public function stepSubmit_4(){
        $this->currentStep = 0;
    }

    // final step
    public function store(){

    }
}
