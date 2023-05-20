<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Illuminate\Support\Facades\DB;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;


use App\Models\Contact as Contacts;
use App\Models\ContactIdType as IdTypes;
use App\Models\ContactEmailType as EmailTypes;
use App\Models\ContactPhoneType as PhoneTypes;
use App\Models\ContactInstantmessageType as InstantMessageTypes;
use App\Models\ContactRrssType as RrssTypes;
use App\Models\ContactWebType as WebTypes;
use App\Models\ContactBankAccountType as BankAccountTypes;
use App\Models\ContactDateType as DateTypes;
use App\Models\ContactPublishUsType as PublishUsTypes;




class Create extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'removeAccountCard'
    ];
    public $prueba;
    public $errorMessage;
    public $passStep = [];
    public $currentStep = 'general';

    protected $rules = [

    ];

    // GENERALS
    public $user_link_id; // si es o no un usuario ya registrado
    public $alias, $name, $middle_name, $first_lastname, $second_lastname, $about;
    public $id_types, $id_type;
    public $id_value;
    public $ids = [];
    public $main_profile_pic;
    public $profile_pics = [];

    // EMAILS
    public $email_types, $email_type;
    public $email_value, $email_is_personal, $email_about;
    public $emails = [];

    // PHONE AND CHATS
    public $phone_types, $phone_type;
    public $phone_value, $phone_is_personal, $phone_about;
    public $phones = [];
    public $instant_message_types, $instant_message_type;
    public $instant_message_value, $instant_message_is_personal, $instant_message_about;
    public $instant_messages = [];

    // RRSS AND WEBS
    public $rrss_types, $rrss_type;
    public $rrss_value, $rrss_is_personal, $rrss_about;
    public $rrss = [];
    public $web_types, $web_type;
    public $web_value, $web_is_personal, $web_about;
    public $webs = [];

    // ADDRESS

    // BANK ACCOUNTS
    public $bank_account_types, $bank_account_type;
    public $bank_account_card_number, $bank_account_card_holder, $bank_account_is_credit, $bank_account_about, $bank_account_expiration_date, $bank_account_expiration_year, $bank_account_expiration_month;
    public $bank_account_bank_name, $entity_bank_account_bank_title;
    public $bank_account_banks = [];
    public $bank_accounts = [];

    // OCUPATION

    // MORE
    public $date_types, $date_type;
    public $date_value;
    public $dates = [];

    public $publish_us_types, $publish_us_type;
    public $publish_us_value, $publish_us_about;
    public $publish_us = [];
    // es o no un usuario (!! crearlo !!)
    public $user_link_name, $user_link_email, $user_link_phone, $user_link_password, $user_link_about;

// ----------------------- VALIDACIONES --------------------------
    public function skip_validation($attribute, $value, $parameters, $validator) { return true; }
    public function cleanErrors(){    $this->resetValidation();     }
    public function cleanError($m){   $this->resetValidation($m);   }
// ----------------------- RENDER --------------------------
    public function mount(){
        $this->id_types = IdTypes::all()->where('enable', true);
        $this->email_types = EmailTypes::all()->where('enable', true);
        $this->phone_types = PhoneTypes::all()->where('enable', true);
        $this->instant_message_types = InstantMessageTypes::all()->where('enable', true);
        $this->rrss_types = RrssTypes::all()->where('enable', true);
        $this->web_types = WebTypes::all()->where('enable', true);
        $this->bank_account_types = BankAccountTypes::all()->where('enable', true);
        $this->date_types = DateTypes::all()->where('enable', true);
        $this->publish_us_types = PublishUsTypes::all()->where('enable', true);

        $this->id_type = $this->id_types->first()->id;
        $this->email_type = $this->email_types->first()->id;
        $this->phone_type = $this->phone_types->first()->id;
        $this->instant_message_type = $this->instant_message_types->first()->id;
        $this->rrss_type = $this->rrss_types->first()->id;
        $this->web_type = $this->web_types->first()->id;
        $this->bank_account_type = $this->bank_account_types->first()->id;
        $this->date_type = $this->date_types->first()->id;
        $this->publish_us_type = $this->publish_us_types->first()->id;
    }
    public function render()
    {
        return view('livewire.contacts.contacts.create');
    }

// ----------------------- flujo STEPS --------------------------

// -------------------------- STEP GENERALS --------------------------
    public function updatedEntityLogos(){
        // validar las imagenes
        /*
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
        */
    }
    public function removeLogo($index){
        // array_splice($this->entity_logos, $index, 1);
    }

    public function stepSubmit_general(){
        /*
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
        */
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'general';
        $this->currentStep = 'emails';
    }

// -------------------------- STEP EMAILS --------------------------

    public function stepSubmit_emails(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'emails';
        $this->currentStep = 'phone_chats';
    }
// -------------------------- STEP PHONE AND CHATS --------------------------
    public function stepSubmit_phone_chats(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'phone_chats';
        $this->currentStep = 'rrss_web';
    }
// -------------------------- STEP RRSS AND WEBS --------------------------
    public function stepSubmit_rrss_web(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'rrss_web';
        $this->currentStep = 'address';
    }
// -------------------------- STEP ADDRESS --------------------------
    public function stepSubmit_address(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'address';
        $this->currentStep = 'bank_accounts';
    }
// -------------------------- STEP BANK ACCOUNTS --------------------------
    public function stepSubmit_bank_accounts(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'bank_accounts';
        $this->currentStep = 'ocupation';
    }
// -------------------------- STEP OCUPATION --------------------------
    public function stepSubmit_ocupation_omit(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        // $this->passStep[] = 'ocupation';
        $this->currentStep = 'more';
    }
    public function stepSubmit_ocupation(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'ocupation';
        $this->currentStep = 'more';
    }
// -------------------------- STEP MORE --------------------------
    public function stepSubmit_more(){
        // $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'more';
        $this->currentStep = 'resumen';
    }
// -------------------------- STEP RESUMEN --------------------------
    public function stepSubmit_resumen(){
        // esto creo q no se va a usar
    }
// -------------------------- FINAL STEP  --------------------------
    public function store(){
        DB::beginTransaction();
        try {

            // .......


            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1] ,'message' => $e->errorInfo[2]]);
        }
    }






// -------------------------- REVIEW  --------------------------


public function remount_bank_accounts(){
        /*
        $this->bank_account_types = EntityBankAccountTypes::all();
        $this->bank_account_type = $this->entity_bank_account_types->first()->id;
        $this->bank_account_expiration_year = date("Y");
        $this->bank_account_expiration_month = date("n")+4;
        $this->bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->entity_bank_account_expiration_month, 1, $this->entity_bank_account_expiration_year));;
        $this->bank_account_card_number = '';
        $this->bank_account_card_holder = isset($this->entity_legal_name) ? $this->entity_legal_name : $this->entity_comercial_name ;
        $this->bank_account_is_credit = '';
        $this->bank_account_about = '';
        $this->bank_account_bank_name = '';
        $this->bank_account_bank_title = '';
        */
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
        /*
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
        $this->remount_bank_accounts();
        */
    }
    public function removeAccountCard($index){
        // array_splice($this->entity_bank_accounts, $index, 1);
    }
    public function editAccountCard(){

    }



}
