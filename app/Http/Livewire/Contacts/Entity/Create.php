<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;

class Create extends Component
{
    public $prueba = 1;
    public $currentStep = 1;
    public $entity_types = [
        // bbdd_table_name => visual_name
        ['model' => 'management_group',
            'visual_name' => 'Grupo de Gestion', 'visuals_name' => 'Grupos de Gestion',
            'icon' => ''
        ],
        ['model' => 'agency_wholesale',
            'visual_name' => 'Agencia Mayorista', 'visuals_name' => 'Agencias Mayoristas',
            'icon' => ''
        ],
        ['model' => 'agency_retail',
            'visual_name' => 'Agencia Minorista', 'visuals_name' => 'Agencias Minoristas',
            'icon' => ''
        ],
        ['model' => 'restaurant',
            'visual_name' => 'Restaurante', 'visuals_name' => 'Restaurantes',
            'icon' => ''
        ],
        ['model' => 'hotel_group',
            'visual_name' => 'Grupo Hotelero', 'visuals_name' => 'Grupos Hoteleros',
            'icon' => ''
        ],
        ['model' => 'hotel',
            'visual_name' => 'Hotel', 'visuals_name' => 'Hoteles',
            'icon' => ''
        ],
        ['model' => 'hostel',
            'visual_name' => 'Hostal', 'visuals_name' => 'Hostales',
            'icon' => ''
        ],
        ['model' => 'paladar',
            'visual_name' => 'Paladar', 'visuals_name' => 'Paladares',
            'icon' => ''
        ],
    ];
    // -------- entidades --------
    public $entity_type;

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------





// ----------------------- VALIDACIONES --------------------------
// ----------------------- RENDER --------------------------
    public function mount(){
        $json = file_get_contents('https://raw.githubusercontent.com/wateketech/gestion-wateke/main/database/data/entity_types.json');
        dd($json);
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
