<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;

class Create extends Component
{
    public $prueba = 1;
    public $currentStep = 1;

    // -------- entidades --------
    public $entity_types, $entity_type, $entity_type_id;

    public $name;

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------





// ----------------------- VALIDACIONES --------------------------
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->entity_types = json_decode(file_get_contents('https://raw.githubusercontent.com/wateketech/gestion-wateke/main/database/data/entity_types.json'), true);
    }
    public function render()
    {
        return view('livewire.contacts.entity.create');
    }

// ----------------------- flujo STEPS --------------------------
    public function updatedEntityTypeId()
    {
        $this->entity_type = $this->entity_types[intVal($this->entity_type_id)];
        $this->stepSubmit_1();
    }
    public function stepSubmit_1(){
        $this->validate([
            'entity_type' => 'required',
        ],[
            'entity_type.required' => 'El campo es obligatorio'
        ]);
        $this->currentStep = 2;
    }
    public function stepSubmit_2(){
        $this->validate([
            'entity_type' => 'required',
        ],[
            '*.required' => 'El campo es obligatorio'
        ]);
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
