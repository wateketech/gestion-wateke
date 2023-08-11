<?php

namespace App\Http\Livewire\Contacts\Entity;
use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;

use App\Models\Entity as Entitys;
use App\Models\EntityType as EntityTypes;
use App\Models\EntityIdType as EntityIdTypes;
use App\Models\EntityBankAccountType as EntityBankAccountTypes;

use Symfony\Component\Mime\Message;
class Create extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'removeAccountCard'
    ];
    public $prueba;
    public $errorMessage;
    public $passStep = [];
    public $currentStep = 'entity_type'; //entity_bank_accounts

    protected $rules = [

    ];


    // -------- entidades --------
    public $entity_types, $entity_type;
        // --- //
    public $entity_alias, $entity_legal_name, $entity_comercial_name, $entity_about;
        // --- //
    public $entity_id_types, $entity_id_type;
    public $entity_id_value;
        // --- //
    public $entity_dates_value, $entity_date_label;
        // --- //
    public $entity_main_logo;
    public $entity_logos = [];
        // --- //

    public $entity_bank_account_types, $entity_bank_account_type;
    public $entity_bank_account_card_number, $entity_bank_account_card_holder, $entity_bank_account_is_credit, $entity_bank_account_about;
    public $entity_bank_account_expiration_date, $entity_bank_account_expiration_year, $entity_bank_account_expiration_month;
    public $entity_bank_account_bank_name, $entity_bank_account_bank_title;
    public $entity_bank_accounts = [];
    public $entity_bank_account_banks = [];

        // --- //

    // -------- hoteles --------
    // -------- agencias --------
    // -------- RESTAURANTES --------


// ----------------------- VALIDACIONES --------------------------
    public function skip_validation($attribute, $value, $parameters, $validator) { return true; }
    public function cleanErrors(){   $this->resetValidation(); }
    public function cleanError($m){   $this->resetValidation($m);   }
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->entity_types = EntityTypes::all();
        $this->entity_id_types = EntityIdTypes::all();
        $this->entity_id_type = $this->entity_id_types->first()->id;
        $this->remount_entity_bank_accounts();
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
        $this->dispatchBrowserEvent('cocking-time', ['time'=> 2000]);
        $this->passStep[] = 'entity_type';
        $this->currentStep = 'entity_general';
    }
// -------------------------- STEP GENERALS --------------------------
    public function updatedEntityLogos(){
        // validar las imagenes
        $this->validate([
            'entity_logos' => 'required|max:5120|valid_image_mime',
        ]);
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        foreach ($this->entity_logos as $logo) {
            $filePath = $logo->getRealPath();
            $image = Image::make($filePath);
            $image->fit(800, 800);
            $image->save($filePath);
        }
        $this->entity_main_logo = 0;
    }
    public function removeLogo($index){
        array_splice($this->entity_logos, $index, 1);
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

        $this->dispatchBrowserEvent('coocking-time', ['time' => 3000]);
        $this->passStep[] = 'entity_general';
        $this->currentStep = "entity_bank_accounts";
        $this->entity_bank_account_card_holder = isset($this->entity_legal_name) ? $this->entity_legal_name : $this->entity_comercial_name;
    }
// -------------------------- STEP BANK ACCOUNTS --------------------------
    public function stepSubmit_entity_bank_accounts(){


        // dd($this->entity_bank_accounts);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 3000]);
        $this->passStep[] = 'entity_bank_accounts';
        $this->currentStep = 4;
    }
// -------------------------- STEP  --------------------------


public function remount_entity_bank_accounts(){
        $this->entity_bank_account_types = EntityBankAccountTypes::all();
        $this->entity_bank_account_type = $this->entity_bank_account_types->first()->id;
        $this->entity_bank_account_expiration_year = date("Y");
        $this->entity_bank_account_expiration_month = date("n")+4;
        $this->entity_bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->entity_bank_account_expiration_month, 1, $this->entity_bank_account_expiration_year));;
        $this->entity_bank_account_card_number = '';
        $this->entity_bank_account_card_holder = isset($this->entity_legal_name) ? $this->entity_legal_name : $this->entity_comercial_name ;
        $this->entity_bank_account_is_credit = '';
        $this->entity_bank_account_about = '';
        $this->entity_bank_account_bank_name = '';
        $this->entity_bank_account_bank_title = '';
    }

    // public function updatedEntityBankAccountCardNumber(){
    //     foreach ($this->entity_bank_account_types as $type){
    //         if (!isset($type->regEx)) {
    //             continue;
    //         }
    //         foreach (json_decode($type->regEx) as $regEx){
    //             if (!preg_match($regEx, $this->entity_bank_account_card_number)){
    //                 // dd($type->id);
    //                 $this->entity_bank_account_type = $type->id;
    //             }
    //         }
    //     }
    // }
    public function addAccountCard(){
        $entity_bank_account_card_number = preg_replace('/\D/', '', $this->entity_bank_account_card_number);
        $this->entity_bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->entity_bank_account_expiration_month, 1, $this->entity_bank_account_expiration_year));

        $this->validate([
            'entity_bank_account_card_number' => 'required|max:25|min:25',
            'entity_bank_account_card_holder' => 'required',
            'entity_bank_account_is_credit' => 'required',
            'entity_bank_account_expiration_date' => 'required|date',
            'entity_bank_account_expiration_year' => 'required',
            'entity_bank_account_expiration_month' => 'required',
            'entity_bank_account_about' => 'nullable',
            'entity_bank_account_bank_name' => 'required',
            'entity_bank_account_bank_title' => 'nullable',
        ],[
            '*.required' => 'El campo es obligatorio',
            'entity_bank_account_card_number.max' => 'La Numeración debe tener 16 digitos',
            'entity_bank_account_card_number.min' => 'La Numeración debe tener 16 digitos',
        ]);

        // hacer en algun lado la validacion por si ya existe el banco sugerirlo

        // falta otra lista para los bancos
        array_push($this->entity_bank_account_banks, [
                'name' => $this->entity_bank_account_bank_name,
                'title' => $this->entity_bank_account_bank_title,
            ]);

        array_push($this->entity_bank_accounts, [
                // 'entity_id' => ,
                'type_id' => $this->entity_bank_account_type,
                // 'bank_id' => ,
                // 'bank_id_in_bbdd' => ,
                'card_number' => $entity_bank_account_card_number,
                'card_holder' => $this->entity_bank_account_card_holder,
                'expiration_date' => $this->entity_bank_account_expiration_date,
                'is_credit' => $this->entity_bank_account_is_credit,
                'about' => $this->entity_bank_account_about,
            ]);
        $this->remount_entity_bank_accounts();
    }
    public function removeAccountCard($index){
        array_splice($this->entity_bank_accounts, $index, 1);
    }
    public function editAccountCard(){

    }

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
