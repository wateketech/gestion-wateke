<?php

namespace App\Http\Livewire\Contacts\Entity;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\TemporaryUploadedFile;
use Livewire\Component;

use App\Models\EntityType as EntityTypes;
use App\Models\EntityIdType as EntityIdTypes;

class Create extends Component
{
    use WithFileUploads;
    public $prueba;
    public $currentStep = 'entity_type';

    public function skip_validation($attribute, $value, $parameters, $validator) { return true; }
    protected $rules = [

    ];


    // -------- entidades --------
    public $entity_types, $entity_type;

    public $entity_alias, $entity_legal_name, $entity_comercial_name, $entity_about;
    public $entity_type_ids, $entity_id_label, $entity_id_value;
    public $entity_dates_value, $entity_date_label;
    public $entity_logos = [];

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------


// ----------------------- VALIDACIONES --------------------------
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->entity_types = EntityTypes::all();
        $this->entity_type_ids = EntityIdTypes::all();
        $this->entity_id_label = $this->entity_type_ids->first()->id;
    }
    public function render()
    {
        return view('livewire.contacts.entity.create');
    }

// ----------------------- flujo STEPS --------------------------
// -------------------------- STEP TYPE --------------------------
    public function updatedEntityType(){
        $this->entity_type = $this->entity_types->find($this->entity_type);
        $this->stepSubmit_entity_type();
    }
    public function stepSubmit_entity_type(){
        $this->validate([
            'entity_type' => 'required',
        ],[
            'entity_type.required' => 'El campo es obligatorio'
        ]);
        $this->currentStep = 'entity_general';
    }
// -------------------------- STEP GENERALS --------------------------
    public function updatedEntityIdLabel(){
        $this->entity_id_label = $this->entity_type_ids->find($this->entity_id_label)->id;
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
    public function stepSubmit_entity_general(){
        // entity_id_label
        // entity_id_value
        // entity_alias
        // entity_comercial_name
        // entity_about
        $this->validate([
            'entity_logos' => 'max:5120|valid_image_mime',
            'entity_id_value' => 'required',
            'entity_legal_name' => 'nullable|required_without_all:entity_comercial_name',
            'entity_comercial_name' => 'nullable|required_without_all:entity_legal_name',
        ],[
            '*.required' => 'El campo es obligatorio',
            'entity_legal_name.required_without_all' => 'Sin un Nombre Comercial este campo es requerido',
            'entity_comercial_name.required_without_all' => 'Sin un Nombre Fiscal este campo es requerido'
        ]);
        $this->currentStep = 3;
    }
// -------------------------- STEP  --------------------------
    public function stepSubmit_3(){
        $this->currentStep = 4;
    }
// -------------------------- STEP  --------------------------
    public function stepSubmit_4(){
        $this->currentStep = 0;
    }


// -------------------------- STEP  --------------------------
    // final step
    public function store(){

    }
}
