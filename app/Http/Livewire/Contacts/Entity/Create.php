<?php

namespace App\Http\Livewire\Contacts\Entity;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\TemporaryUploadedFile;
use Livewire\Component;

use App\Models\EntityType as EntityTypes;

class Create extends Component
{
    use WithFileUploads;
    public $prueba;
    public $currentStep = 1;

    // -------- entidades --------
    public $entity_types, $entity_type;

    public $entity_alias, $entity_legal_name, $entity_comercial_name, $entity_about, $entity_type_id;
    public $entity_id_value, $entity_id_label;
    public $entity_dates_value, $entity_date_label;
    public $entity_logos = [];

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------


// ----------------------- VALIDACIONES --------------------------
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->entity_types = EntityTypes::all();
    }
    public function render()
    {
        return view('livewire.contacts.entity.create');
    }

// ----------------------- flujo STEPS --------------------------
    public function updatedEntityType()
    {
        $this->entity_type = EntityTypes::find($this->entity_type);
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
    public function updatedEntityLogos(){
        // validar las imagenes
        $this->validate([
            'entity_logos' => 'required|max:5120|valid_image_mime',
        ]);

        foreach ($this->entity_logos as $logo) {
            $filePath = $logo->getRealPath();
            $image = Image::make($filePath);
            $image->fit(800, 800);
            $image->save($filePath);
        }
    }
    public function stepSubmit_2(){
        // entity_id_label
        // entity_id_value
        // entity_alias
        // entity_comercial_name
        // entity_about
        $this->validate([
            'entity_logos' => 'max:5120|valid_image_mime',
            'entity_legal_name' => 'required',
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
