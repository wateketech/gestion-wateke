<?php

namespace App\Http\Livewire\Contacts\Entity;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;

use App\Models\Entity as Entitys;
use App\Models\EntityType as EntityTypes;
use App\Models\EntityIdType as EntityIdTypes;

use Symfony\Component\Mime\Message;
class Create extends Component
{
    use WithFileUploads;
    public $prueba;
    public $errorMessage;
    public $currentStep = 'entity_type';

    public function skip_validation($attribute, $value, $parameters, $validator) { return true; }
    protected $rules = [

    ];


    // -------- entidades --------
    public $entity_types, $entity_type;

    public $entity_alias, $entity_legal_name, $entity_comercial_name, $entity_about;
    public $entity_type_ids, $entity_id_type, $entity_id_value;
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
        $this->entity_id_type = $this->entity_type_ids->first()->id;
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
        $this->validate([
            'entity_logos' => 'max:5120|valid_image_mime',
            'entity_id_type' => 'required',
            'entity_id_value' => 'required',
            'entity_legal_name' => 'nullable|required_without_all:entity_comercial_name',
            'entity_comercial_name' => 'nullable|required_without_all:entity_legal_name',
            'entity_about' => 'nullable',
            'entity_alias' => 'nullable',

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
        DB::beginTransaction();
        try {
            $entity = Entitys::create([
                'alias' => $this->entity_alias,
                'legal_name' => $this->entity_legal_name,
                'comercial_name' => $this->entity_comercial_name,
                'about' => $this->entity_about,
                'entity_type_id' => $this->entity_type->id,
            ]);

            $id = \App\Models\EntityId::create([
                'type_id' => $this->entity_id_type,
                'entity_id' => $entity->id,
                'value' => $this->entity_id_value,
            ]);


            $entity->entity_id()->save($id);


            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1] ,'message' => $e->errorInfo[2]]);
        }
    }
}
