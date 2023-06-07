<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;

use App\Models\AddressCountry as Countries;
use App\Models\AddressState as States;
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
        'existEmail', 'existPhoneNumber', 'existInstantMessage', 'existWeb', 'existRrss', 'existPublisUs',
        'prueba',
        'updatePhoneNumber', 'updateWebValue', 'updateRrssValue',
        'updateCountry', 'updateState', 'updateCity',
        'removeAccountCard',
    ];
    public $prueba, $datos_prueba;
//    public $available_id_types = [];

    public $errorMessage;
    public $passStep = [];
    public $currentStep = 'bank_accounts' ; //'general';

    protected $rules = [

    ];

    public $labels_type = ['Personal', 'Trabajo'];
    // GENERALS
    public $alias, $name, $middle_name, $first_lastname, $second_lastname, $about;
    public $id_types;
    public $ids = [];
    public $id_max = 4;
    public $main_profile_pic;
    public $profile_pics = [];

    // EMAILS
    public $email_types;
    public $emails = [];
    public $emails_max = 10;

    // PHONE AND CHATS
    public $phone_types;
    public $phones = [];
    public $phones_max = 8;

    public $instant_message_types;
    public $instant_messages = [];
    public $instant_messages_max = 8;


    // RRSS AND WEBS
    public $rrss_types;
    public $rrss = [];
    public $rrss_max = 8;

    public $web_types;
    public $webs = [];
    public $webs_max = 8;


    // ADDRESS
    public $countries, $states, $cities;
    public $contact_address = [];
    public $address = [];
    public $address_max = 3;

    public $address_line = [];
    public $address_line_max = 10;

    public $prueba_address_seeder = [
        [ 'name' => 'Cuba', 'id' => 1],
        [ 'name' => 'España', 'id' => 2],
        [ 'name' => 'Guatemala', 'id' => 3],
        ];


    public $aaa;


    // BANK ACCOUNTS
    public $bank_account_types, $bank_account_type;
    public $bank_account_card_number, $bank_account_card_holder, $bank_account_is_credit, $bank_account_about;
    public $bank_account_expiration_date, $bank_account_expiration_year, $bank_account_expiration_month;
    public $bank_account_bank_name, $bank_account_bank_title;
    public $bank_id_in_bbdd;
    public $bank_account_banks = [];
    public $bank_accounts = [];

    // OCUPATION
    public $ocupation_id, $ocupation_entity_id, $ocupation_about;


    // MORE
    public $date_types, $date_type;
    public $date_value;
    public $dates = [];
    public $dates_max = 4;

    public $publish_us_types, $publish_us_type;
    public $publish_us_value, $publish_us_about;
    public $publish_us = [];
    public $publish_us_max = 8;


    // RESUMEN
    public $is_user_link = false;
    public $user_link_roles;
    private $user_link_password;
    public $user_link_role, $user_link_name, $user_link_email, $user_link_phone, $user_link_password_public, $user_link_password_check, $user_link_about;



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
        $this->countries = Countries::all()->where('enable', true);


        $this->ids[] = ['type_id' => $this->id_types[0]->id, 'value' => ''];
        $this->emails[] = ['type_id' => $this->email_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => true, 'about' => '',  ];
        $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'is_primary' => true, 'about' => '',  ];
        $this->instant_messages[] = ['type_id' => $this->instant_message_types[0]->id, 'label' => $this->labels_type[0], 'is_primary' => true, 'value' => '', 'about' => '',  ];
        $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'about' => '',  ];
        $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '', 'about' => '',  ];
        $this->dates[] = ['id_type' => $this->date_types[0]->id, 'value' => ''];
        // $this->publish_us[] = ['id_type' => $this->date_types[0]->id, 'value' => ''];


        $this->address[] = ['name' => 'Casa', 'city_id' => '', 'geolocation' => '', 'zip_code' => '',
                'country_id' => null, 'state_id' => null ];
        $this->address_line[0][] = ['address_id' => 1, 'label' => 'Localidad', 'value' => ''];
        $this->address_line[0][] = ['address_id' => 1, 'label' => 'Número', 'value' => ''];
        $this->address_line[0][] = ['address_id' => 1, 'label' => 'Calle', 'value' => ''];

        $this->remount_bank_accounts();
        $this->datos_prueba();
    }
    public function render(){
        return view('livewire.contacts.contacts.create');
    }




// -------------------------- STEP GENERALS --------------------------
    public function addId($index){
        $this->validate([
            'ids.*.type_id' => [ 'required', Rule::in($this->id_types->pluck('id')->toArray()),],
            'ids.*.value' => 'required|string',
            'ids.'.$index.'.value' => ['required',
            function ($attribute, $value, $fail) {
                    $ids = array_column($this->ids, 'value');
                    if (count($ids) != count(array_unique($ids))) {
                        $fail('Los valores no pueden repetirse');
                    }
                }
            ]
            ],[
                'ids.*.type_id.required' => 'El campo es obligatorio',
                'ids.*.value.required' => 'El campo es obligatorio',
            ]);
        if (count($this->ids) < $this->id_max) {
            $this->ids[] = ['type_id' => $this->id_types->first()->id, 'value' => ''];
        }
    }
    public function removeId($index){
        unset($this->ids[$index]);
        $this->ids = array_values($this->ids);
    }
    public function updatedProfilePics(){
        // $this->dispatchBrowserEvent('coocking-time-profile-img', ['time'=> 2000]);
        $this->validate([
            'profile_pics' => 'required|max:5120|valid_image_mime',
        ]);
        if ($this->getErrorBag()->any()) {
            $this->profile_pics = null;
        }
        foreach ($this->profile_pics as $pic) {
            $filePath = $pic->getRealPath();
            $image = Image::make($filePath);
            $image->fit(800, 800);
            $image->save($filePath);
        }
        $this->main_profile_pic = 0;

    }
    public function stepSubmit_general(){
        $this->validate([
            'alias' => 'max:50',
            'name' => 'required|max:50',
            'middle_name' => 'max:50',
            'first_lastname' => 'required|max:50',
            'second_lastname' => 'max:50',
            'about' => 'max:500',
            'profile_pics' => 'max:5120|valid_image_mime',
            // 'main_profile_pic' => ['required', 'integer', 'numeric', 'min:0', 'max:' . count($this->profile_pics)],
            'ids' => 'required',
            'ids.*.value' => ['required', 'string',
                function ($attribute, $value, $fail) {
                        $ids = array_column($this->ids, 'value');
                        if (count($ids) != count(array_unique($ids))) {
                            $fail('Los valores no pueden repetirse');
                        }
                    }
                ],
            'ids.*.type_id' => [ 'required','integer', Rule::in($this->id_types->pluck('id')->toArray()),],
        ],[
            // '*.array' => 'Error de Servidor : El campo debe ser un array',
            '*.required' => 'El campo es obligatorio',
            'ids.*.value.required' => 'El campo es obligatorio',
            '*.max' => 'El campo no puede tener más de :max caracteres',
            '*.min' => 'El campo no puede menos más de :min caracteres',
        ]);
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'general';
        $this->currentStep = 'emails';
    }

// -------------------------- STEP EMAILS --------------------------

    public function existEmail($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function selectEmailIsPrimary($index){
        $this->emails = array_map(function ($email) {
            $email['is_primary'] = false;
            return $email;
        }, $this->emails);

        $this->emails[$index]['is_primary'] = true;
    }
    public function addEmail($index){
        $this->validate([
            'emails.*.is_primary' => '',
            'emails.*.type_id' => [ 'required','integer', Rule::in($this->email_types->pluck('id')->toArray()),],
            'emails.*.label' => ['required', Rule::in($this->labels_type),],
            'emails.*.about' => '',
            'emails.' . $index . '.value' => ['required', 'email',
                function ($attribute, $value, $fail) {
                        $emails = array_column($this->emails, 'value');
                        if (count($emails) != count(array_unique($emails))) {
                            $fail('Los emails no pueden repetirse');
                        }
                    }
                ]
            ],[
                '*.required' => 'El campo es obligatorio',
                'emails.*.*.required' => 'El campo es obligatorio',
                'emails.*.*.email' => 'El campo debe ser un email',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        if (count($this->emails) < $this->emails_max) {
            $this->emails[] = ['type_id' => $this->email_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => false, 'about' => '',  ];
        }
    }

    public function removeEmail($index){
        $remove_primary = false;
        if ($this->emails[$index]['is_primary']) $remove_primary = true ;

        unset($this->emails[$index]);
        $this->emails = array_values($this->emails);
        if ($remove_primary) $this->selectEmailIsPrimary(0);
    }
    public function stepSubmit_emails(){
        $this->validate([
            'emails' => 'required',
            'emails.*.is_primary' => '',
            'emails.*.type_id' => [ 'required','integer', Rule::in($this->email_types->pluck('id')->toArray()),],
            'emails.*.label' => ['required', Rule::in($this->labels_type),],
            'emails.*.about' => '',
            'emails.*.value' => ['required', 'email',
                function ($attribute, $value, $fail) {
                        $emails = array_column($this->emails, 'value');
                        if (count($emails) != count(array_unique($emails))) {
                            $fail('Los emails no pueden repetirse');
                        }
                    }
                ]
            ],[
                // '*.array' => 'Error de Servidor : El campo debe ser un array',
                '*.required' => 'El campo es obligatorio',
                'emails.*.*.required' => 'El campo es obligatorio',
                'emails.*.*.email' => 'El campo debe ser un email',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'emails';
        $this->currentStep = 'phone_chats';
    }
// -------------------------- STEP PHONE AND CHATS --------------------------

    public function existPhoneNumber($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function updatePhoneNumber($index, $value, $value_meta){
        $this->phones[$index]['value'] = $value;
        $this->phones[$index]['value_meta'] = json_encode($value_meta, true);
    }

    public function selectPhoneIsPrimary($index){
        $this->phones = array_map(function ($phone) {
            $phone['is_primary'] = false;
            return $phone;
        }, $this->phones);

        $this->phones[$index]['is_primary'] = true;
    }
    public function addPhone($index){
        $this->validate([
            'phones.*.is_primary' => '',
            'phones.*.type_id' => [ 'required','integer', Rule::in($this->phone_types->pluck('id')->toArray()),],
            'phones.*.about' => '',
            'phones.' . $index . '.value' => ['required',
                function ($attribute, $value, $fail) {
                        $phones = array_column($this->phones, 'value');
                        if (count($phones) != count(array_unique($phones))) {
                            $fail('Los números de teléfonos no pueden repetirse');
                        }
                    }
                ]
            ],[
                '*.required' => 'El campo es obligatorio',
                'phones.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        if (count($this->phones) < $this->phones_max) {
            $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'is_primary' => false, 'about' => '',  ];
        }
        $this->dispatchBrowserEvent('intl-tel-input', ['index' => $index + 1]);
    }
    public function removePhone($index){
        $remove_primary = false;
        if ($this->phones[$index]['is_primary']) $remove_primary = true ;

        unset($this->phones[$index]);
        $this->phones = array_values($this->phones);
        if ($remove_primary) $this->selectPhoneIsPrimary(0);
    }


    public function existInstantMessage($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function selectInstantMessageIsPrimary($index){
        $this->instant_messages = array_map(function ($instant_message) {
            $instant_message['is_primary'] = false;
            return $instant_message;
        }, $this->instant_messages);

        $this->instant_messages[$index]['is_primary'] = true;
    }
    public function addInstantMessages($index){
        $this->validate([
            'instant_messages.*.is_primary' => '',
            'instant_messages.*.type_id' => [ 'required', Rule::in($this->instant_message_types->pluck('id')->toArray()),],
            'instant_messages.*.label' => ['required', Rule::in($this->labels_type),],
            'instant_messages.*.about' => '',
            'instant_messages.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $instantMessages = collect($this->instant_messages);
                        $duplicates = $instantMessages->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('type_id', $instantMessages->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las cuentas no pueden repetirse con un mismo proveedor');
                        }
                    }
                ],
            ],[
                '*.required' => 'El campo es obligatorio',
                'instant_messages.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        if (count($this->instant_messages) < $this->instant_messages_max) {
            $this->instant_messages[] = ['type_id' => $this->phone_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => false, 'about' => '',  ];
        }
    }
    public function removeInstantMessages($index){
        $remove_primary = false;
        if ($this->instant_messages[$index]['is_primary']) $remove_primary = true ;

        unset($this->instant_messages[$index]);
        $this->instant_messages = array_values($this->instant_messages);
        if ($remove_primary) $this->selectInstantMessageIsPrimary(0);
    }


    public function stepSubmit_phone_chats(){
        $this->validate([
            'phones' => 'array',
            'phones.*.is_primary' => '',
            'phones.*.type_id' => [ 'required','integer', Rule::in($this->phone_types->pluck('id')->toArray()),],
            'phones.*.about' => '',
            'phones.*.value' => ['required',
                function ($attribute, $value, $fail) {
                        $phones = array_column($this->phones, 'value');
                        if (count($phones) != count(array_unique($phones))) {
                            $fail('Los números de teléfonos no pueden repetirse');
                        }
                    }
                ],
            'instant_messages' => 'array',
            'instant_messages.*.is_primary' => '',
            'instant_messages.*.type_id' => [ 'required','integer', Rule::in($this->instant_message_types->pluck('id')->toArray()),],
            'instant_messages.*.label' => ['required', Rule::in($this->labels_type),],
            'instant_messages.*.about' => '',
            'instant_messages.*.value' => ['required',
                function ($attribute, $value, $fail) {
                    $instantMessages = collect($this->instant_messages);
                    $duplicates = $instantMessages->filter(function ($item) use ($value) {
                            return $item['value'] == $value;
                        })->where('type_id', $instantMessages->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las cuentas no pueden repetirse con un mismo proveedor');
                        }
                    }
                ],
            ],[
                '*.array' => 'Error de Servidor : El campo debe ser un array',
                '*.required' => 'El campo es obligatorio',
                'instant_messages.*.*.required' => 'El campo es obligatorio',
                'phones.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);


        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'phone_chats';
        $this->currentStep = 'rrss_web';
    }
// -------------------------- STEP RRSS AND WEBS --------------------------

    public function existWeb($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function updateWebValue($index, $value){
        if (substr($value, 0, 2) === "//") $value = substr($value, 2);
        else if (substr($value, 0, 3) === "://") $value = substr($value, 3);
        else if (substr($value, 0, 7) === "http://") $value = substr($value, 7);
        else if (substr($value, 0, 8) === "https://") $value = substr($value, 8);

        $this->webs[$index]['value'] = $value;
    }
    public function selectWebIsPrimary($index){
        // NO DISPONIBLE PARA CONTACTOS
    }
    public function addWeb($index){
        $this->validate([
            'webs.*.type_id' => [ 'required','integer', Rule::in($this->web_types->pluck('id')->toArray()),],
            'webs.*.about' => '',
            'webs.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $webs = collect($this->webs);
                        $duplicates = $webs->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('type_id', $webs->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las webs no pueden repetirse con un mismo tipo');
                        }
                    }
                ]
            ],[
                '*.required' => 'El campo es obligatorio',
                'webs.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        if (count($this->webs) < $this->webs_max) {
            $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '', 'about' => '',  ];
        }
    }
    public function removeWeb($index){
        unset($this->webs[$index]);
        $this->webs = array_values($this->webs);
    }


    public function existRrss($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function updateRrssValue($index, $value, $value_meta){
        // IMPLEMENTAR COMO VERIFICAR EL VALUE DEL WEB (quisas no haga falta)
    }
    public function selectRrssIsPrimary($index){
        // NO DISPONIBLE PARA CONTACTOS
    }
    public function addRrss($index){
        $this->validate([
            'rrss.*.type_id' => [ 'required', Rule::in($this->rrss_types->pluck('id')->toArray()),],
            'rrss.*.about' => '',
            'rrss.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $rrss = collect($this->rrss);
                        $duplicates = $rrss->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('type_id', $rrss->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las redes sociales no pueden repetirse con un mismo tipo');
                        }
                    }
                ],
            ],[
                '*.required' => 'El campo es obligatorio',
                'rrss.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        if (count($this->rrss) < $this->rrss_max) {
            $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'about' => '',  ];
        }
    }
    public function removeRrss($index){
        unset($this->rrss[$index]);
        $this->rrss = array_values($this->rrss);
    }

    public function stepSubmit_rrss_web(){
        $this->validate([
            'webs' => 'array',
            'webs.*.type_id' => [ 'required','integer', Rule::in($this->web_types->pluck('id')->toArray()),],
            'webs.*.about' => '',
            'webs.*.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $webs = collect($this->webs);
                        $duplicates = $webs->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $webs->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las webs no pueden repetirse con un mismo tipo');
                        }
                    }
                ],
            'rrss' => 'array',
            'rrss.*.type_id' => [ 'required', Rule::in($this->rrss_types->pluck('id')->toArray()),],
            'rrss.*.about' => '',
            'rrss.*.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $rrss = collect($this->rrss);
                        $duplicates = $rrss->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('type_id', $rrss->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las redes sociales no pueden repetirse con un mismo tipo');
                        }
                    }
                ],
            ],[
                '*.array' => 'Error de Servidor : El campo debe ser un array',
                'webs.*.*.required' => 'El campo es obligatorio',
                'rrss.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'rrss_web';
        $this->currentStep = 'address';
    }
// -------------------------- STEP ADDRESS --------------------------
    public function addAddress($index){
        $this->validate([
            'address.' . $index . '.name' => 'required',
            'address.' . $index . '.country_id' => 'required',
            'address.' . $index . '.state_id' => [
                    function ($attribute, $value, $fail) use ($index) {
                        $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                        if ($country && $country->states->count() > 0 && empty($value)) $fail('El campo es obligatorio.');
                    }
                ],
            'address.' . $index . '.city_id' => [
                    function ($attribute, $value, $fail) use ($index) {
                        $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                        $state = $country ? $country->states()->find($this->address[$index]['state_id']) : null;
                        if ($state && $state->cities->count() > 0 && empty($this->address[$index]['city_id'])) $fail('El campo es obligatorio.');
                    }
                ],
            'address_line.' . $index . '.*.label' => 'required',
            'address_line.' . $index . '.*.value' => 'required',
            // 'address_line.' . $index . $index_l . '.label' => 'required',
            // 'address_line.' . $index . $index_l . '.value' => 'required',
                ],[
            'address.' . $index . '.*.required' => 'El campo es obligatorio',
            'address_line.' . $index . '.*.*.required' => 'El campo es obligatorio',
        ]);
        if (count($this->address) < $this->address_max) {
            $this->address[] = ['name' => '# ' . ($index + 2), 'citie_id' => '1', 'geolocation' => '', 'zip_code' => '',
                'country_id' => null, 'state_id' => null ];
            $this->address_line[$index + 1][] = ['address_id' => 1, 'label' => 'Localidad', 'value' => ''];
            $this->address_line[$index + 1][] = ['address_id' => 1, 'label' => 'Numero', 'value' => ''];
            $this->address_line[$index + 1][] = ['address_id' => 1, 'label' => 'Calle', 'value' => ''];
        }
        $this->dispatchBrowserEvent('init-select2-countries', ['index_add' => $index + 1]);
    }
    public function removeAddress($index){
        unset($this->address_line[$index]);
        unset($this->address[$index]);
        $this->address_line = array_values($this->address_line);
        $this->address = array_values($this->address);
    }
    public function geolocation($index){
        // procesar con API de GOOGLE
            // if (ya existe una geolocation){
            //      mostrar en la ubicacion
            // } else{
            //      hacer que la localice (usando el country/state/city escogido con su longitude y latitude)
            // }
    }

    public function updateCountry($index_add ,$value){
        $this->address[$index_add]['country_id'] = $value;
        $this->address[$index_add]['state_id'] = null;
        $this->address[$index_add]['city_id'] = null;

        $states = Countries::where('enable', true)->find($value)->states->map(function ($state) {
                        return ['id' => $state->id, 'text' => $state->name,];
                    })->toArray();

        if (count($states) == 0){
            $this->dispatchBrowserEvent('init-select2-states-disabled', ['index_add' => $index_add]);
        }else{
            $this->dispatchBrowserEvent('init-select2-states', ['index_add' => $index_add, 'states' => $states ]);
        }
    }
    public function updateState($index_add ,$value){
        $this->address[$index_add]['state_id'] = $value;
        $this->address[$index_add]['city_id'] = null;

        $cities = Countries::find($this->address[$index_add]['country_id'])
                    ->states->find($this->address[$index_add]['state_id'])
                    ->cities->map(function ($city) {
                        return ['id' => $city->id, 'text' => $city->name,];
                    })->toArray();

        if (count($cities) == 0){
            $this->dispatchBrowserEvent('init-select2-cities-disabled', ['index_add' => $index_add]);
        }else{
            $this->dispatchBrowserEvent('init-select2-cities', ['index_add' => $index_add, 'cities' => $cities ]);
        }
    }
    public function updateCity($index_add ,$value){
        $this->address[$index_add]['city_id'] = $value;
    }



    public function addAddressLine($index_l, $index_add){
        $this->validate([
            'address_line.' . $index_add . '.*.label' => 'required',
            'address_line.' . $index_add . '.*.value' => 'required',
            // 'address_line.' . $index_add . $index_l . '.label' => 'required',
            // 'address_line.' . $index_add . $index_l . '.value' => 'required',
                ],[
            'address_line.' . $index_add . '.*.*.required' => 'El campo es obligatorio',
        ]);
        if (count($this->address_line[$index_add]) < $this->address_line_max) {
            $this->address_line[$index_add][] = ['address_id' => 1, 'label' => '', 'value' => ''];
        }
    }
    public function removeAddressLine($index_l, $index_add){
        unset($this->address_line[$index_add][$index_l]);
        $this->address_line[$index_add] = array_values($this->address_line[$index_add]);
    }
    public function stepSubmit_address(){
        $this->validate([
            'address.*.name' => 'required',
            'address.*.country_id' => 'required',
            'address.*.state_id' => [
                    function ($attribute, $value, $fail){
                        foreach ($this->address as $index => $address) {
                            $country = Countries::where('enable', true)->find($address['country_id']);
                            if ($country && $country->states->count() > 0 && empty($value)){
                                $fail('El campo es requerido si está disponible');
                            }
                        }
                    }
                ],
            'address.*.city_id' => [
                    function ($attribute, $value, $fail) {
                        foreach ($this->address as $index => $address) {
                            $country = Countries::where('enable', true)->find($address['country_id']);
                            $state = $country ? $country->states()->find($address['state_id']) : null;
                            if ($state && $state->cities->count() > 0 && empty($address['city_id'])){
                                $fail('El campo es requerido si está disponible');
                            }
                        }
                    }
                ],
            'address_line.*.*.label' => 'required',
            'address_line.*.*.value' => 'required',
        ],[
            '*.*.*.required' => 'El campo es obligatorio',
            'address.*.*.required' => 'El campo es obligatorio',
            'address_line.*.*.*.required' => 'El campo es obligatorio',
        ]);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'address';
        $this->currentStep = 'bank_accounts';
        $this->dispatchBrowserEvent('init-select2-countries', ['index_add' => 0]);
        $this->remount_bank_accounts();
    }
// -------------------------- STEP BANK ACCOUNTS --------------------------
    public function remount_bank_accounts(){
        $this->bank_account_types = BankAccountTypes::all();
        $this->bank_account_type = $this->bank_account_types->first()->id;
        $this->bank_account_expiration_year = date("Y");
        $this->bank_account_expiration_month = date("n")+4;
        $this->bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->bank_account_expiration_month, 1, $this->bank_account_expiration_year));;
        $this->bank_account_card_number = '';
        $this->bank_account_card_holder = $this->name . ' ' .$this->first_lastname ;
        $this->bank_account_is_credit = 'true';
        $this->bank_account_about = '';
        $this->bank_account_bank_name = '';
        $this->bank_account_bank_title = '';
        $this->bank_id_in_bbdd = null;
    }

    // public function updatedBankAccountCardNumber(){
    //     foreach ($this->bank_account_types as $type){
    //         if (!isset($type->regEx)) {
    //             continue;
    //         }
    //         foreach (json_decode($type->regEx) as $regEx){
    //             if (!preg_match($regEx, $this->bank_account_card_number)){
    //                 // dd($type->id);
    //                 $this->bank_account_type = $type->id;
    //             }
    //         }
    //     }
    // }

    public function addAccountCard(){
        $bank_account_card_number = preg_replace('/\D/', '', $this->bank_account_card_number);
        $this->bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->bank_account_expiration_month, 1, $this->bank_account_expiration_year));

        $this->validate([
            'bank_account_card_number' => 'required|max:25|min:25',
            'bank_account_card_holder' => 'required',
            'bank_account_is_credit' => 'required',
            'bank_account_expiration_date' => 'required|date',
            'bank_account_expiration_year' => 'required',
            'bank_account_expiration_month' => 'required',
            'bank_account_about' => 'nullable',
            // 'bank_account_bank_name' => 'required',
            // 'bank_account_bank_title' => 'nullable',
        ],[
            '*.required' => 'El campo es obligatorio',
            'bank_account_card_number.max' => 'La Numeración debe tener 16 digitos',
            'bank_account_card_number.min' => 'La Numeración debe tener 16 digitos',
        ]);

        // hacer en algun lado la validacion por si ya existe el banco sugerirlo
        // array_push($this->bank_account_banks, [
        //         'name' => $this->bank_account_bank_name,
        //         'title' => $this->bank_account_bank_title,
        //     ]);

        array_push($this->bank_accounts, [
                // 'contact_id' => ,
                'type_id' => $this->bank_account_type,
                // 'bank_id_in_bbdd' => isset($this->bank_id_in_bbdd) ? $this->bank_id_in_bbdd : null,
                'card_number' => $bank_account_card_number,
                'card_holder' => $this->bank_account_card_holder,
                'expiration_date' => $this->bank_account_expiration_date,
                'is_credit' => $this->bank_account_is_credit,
                'about' => $this->bank_account_about,
            ]);
        $this->remount_bank_accounts();
    }
    public function removeAccountCard($index){
        array_splice($this->bank_accounts, $index, 1);
        // array_splice($this->bank_account_banks, $index, 1);
    }
    public function editAccountCard($index){
        // NO DISPONIBLE
    }

    public function stepSubmit_bank_accounts(){
        $this->validate([
            'bank_accounts' => 'required'
        ],[
            '*.required' => 'Necesita añadir almenos una cuenta bancaria, caso contrario omita la sección.',
        ]);


        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'bank_accounts';
        $this->currentStep = 'ocupation';
    }
    public function stepSubmit_bank_accounts_omit(){
        $this->bank_accounts = [];
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->currentStep = 'ocupation';
    }
// -------------------------- STEP OCUPATION --------------------------
    public function stepSubmit_ocupation_omit(){
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->currentStep = 'more';
    }
    public function stepSubmit_ocupation(){
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'ocupation';
        $this->currentStep = 'more';
    }
// -------------------------- STEP MORE --------------------------
    public function addDate($index){
        if (count($this->dates) >= 1 ) {
        $this->validate([
            'dates.' . $index . '.value' => ['required', 'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('Y-m-d'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('Y-m-d'),
            ],
            'dates.' . $index . '.type_id' => [ 'required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
                    function ($attribute, $value, $fail) {
                        // Obtener los valores de type_id de todos los elementos de dates
                        $types_id = array_column($this->dates, 'type_id');

                        // Obtener el índice del elemento actual que se está validando
                        $index = str_replace('dates.', '', $attribute);
                        $index = str_replace('.type_id', '', $index);

                        // Eliminar el elemento actual de la matriz de type_id
                        unset($types_id[$index]);

                        // Verificar si el valor de type_id se repite en la matriz de type_id restante
                        if (in_array($value, $types_id)) {
                            $fail('El motivo de la fecha no puede repetirse.');
                        }
                    }
                ],
            ],[
                'dates.*.value.before_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.after_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.date' => 'El campo debe ser una fecha válida',
                '*.required' => 'El campo es obligatorio',
                'dates.*.*.required' => 'El campo es obligatorio',
            ]);
        }
        if (count($this->dates) < $this->dates_max) {
            $this->dates[] = ['type_id' => $this->date_types[0]->id, 'value' => '', ];
        }
    }

    public function removeDate($index){
        unset($this->dates[$index]);
        $this->dates = array_values($this->dates);
    }


    public function existPublisUs($index){
        // NO DISPONIBLE POR EL MOMENTO
    }
    public function addPublishUs($index){
        if (count($this->publish_us) >= 1 ) {
        $this->validate([
            'publish_us.' . $index . '.type_id' => [ 'required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.' . $index . '.value' => [ 'required', 'url',
                    function ($attribute, $value, $fail) {
                        $url = collect($this->publish_us);
                        $duplicates = $url->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $url->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las url no pueden repetirse con un mismo tipo');
                        }
                    }
                ]
            ],[
                'publish_us.*.value.url' => 'El campo debe ser una url válida',
                '*.required' => 'El campo es obligatorio',
                'publish_us.*.*.required' => 'El campo es obligatorio',
            ]);
        }
        if (count($this->publish_us) < $this->publish_us_max) {
            $this->publish_us[] = ['type_id' => $this->publish_us_types[0]->id, 'value' => '', ];
        }
    }

    public function removePublishUs($index){
        unset($this->publish_us[$index]);
        $this->publish_us = array_values($this->publish_us);
    }


    public function stepSubmit_more(){
        $this->validate([
            'dates' => 'array',
            'dates.*.value' => ['required', 'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('d-m-Y'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('d-m-Y'),
                ],
            'dates.*.type_id' => [ 'required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
                    function ($attribute, $value, $fail) {
                        $types_id = array_column($this->dates, 'type_id');
                        $index = str_replace('dates.', '', $attribute);
                        $index = str_replace('.type_id', '', $index);
                        unset($types_id[$index]);
                        if (in_array($value, $types_id)) {
                            $fail('El motivo de la fecha no puede repetirse.');
                        }
                    }
                ],
            'publish_us' => 'array',
            'publish_us.*.type_id' => [ 'required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.*.value' => [ 'required', 'url',
                    function ($attribute, $value, $fail) {
                        $url = collect($this->publish_us);
                        $duplicates = $url->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('type_id', $url->pluck('type_id')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las url no pueden repetirse con un mismo tipo');
                        }
                    }
                ]
            ],[
                '*.array' => 'Error de Servidor : El campo debe ser un array',
                'dates.*.value.before_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.after_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.date' => 'El campo debe ser una fecha válida',
                '*.required' => 'El campo es obligatorio',
                'dates.*.*.required' => 'El campo es obligatorio',
                'publish_us.*.value.url' => 'El campo debe ser una url válida',
                '*.required' => 'El campo es obligatorio',
                'publish_us.*.*.required' => 'El campo es obligatorio',
            ]);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 2000]);
        $this->passStep[] = 'more';
        $this->currentStep = 'resumen';
    }
// -------------------------- STEP RESUMEN --------------------------

    public function UpdatedIsUserLink(){
        $this->user_link_roles = \Spatie\Permission\Models\Role::all(); // ->where('enable', true);

        $primary_emails = array_column(array_filter($this->emails, function($email) {
                                return $email['is_primary'] == 1;
                            }), 'value');
        $primary_phones = array_column(array_filter($this->phones, function($phone) {
            return $phone['is_primary'] == 1;
        }), 'value');
        $primary_email = reset($primary_emails);
        $primary_phone = reset($primary_phones);

        if($this->is_user_link){
            $this->user_link_name = $this->name . ' ' . $this->first_lastname  ;
            $this->user_link_email =  $primary_email ;
            $this->user_link_phone = $primary_phone;
            $this->user_link_role = '1';
        }else{
            $this->user_link_name = null;
            $this->user_link_email = null;
            $this->user_link_phone = null;
            $this->user_link_about = null;
            $this->user_link_role = null;
            $this->user_link_password = null;
            $this->user_link_password_public = null;
            $this->user_link_password_check = null;
        }
    }
    public function stepSubmit_resumen()
    {
        // esto creo q no se va a usar
    }
// -------------------------- FINAL STEP  --------------------------
    public function store(){
        DB::beginTransaction();
        try {
            if($this->is_user_link){

                $this->validate([
                    'user_link_password_public' => 'required|min:6',
                    'user_link_password_check' => 'required|same:user_link_password_public',
                ],[
                    '*.required' => 'El campo es obligatorio',
                    '*.same' => 'Las contraseñas no coinciden'
                ]);
                $this->user_link_password = Hash::make($this->user_link_password_public);
            }

            // .......


            DB::commit();
        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1] ,'message' => $e->errorInfo[2]]);
        }
    }


// -------------------------- DATOS DE PRUEBA  --------------------------
    private function datos_prueba(){
    // GENERALS
        $this->alias = 'El bebe';
        $this->name = 'Alberto';
        $this->middle_name = 'de Jesús';
        $this->first_lastname = 'Licea';
        $this->second_lastname = 'Vallejo';
        $this->about = 'Nada ';
        $this->ids = [
            [ 'type_id' => 1, 'value' => '00090120123'],
            [ 'type_id' => '2', 'value' => 'A1234567'],
            ];
        // $this->main_profile_pic = 0;
        // $this->profile_pics = [];

    // EMAILS
        $this->emails = [
            [ 'type_id' => '1', 'is_primary' => false, 'label' => 'Personal',  'value' => 'albertolicea00@outlook.com', 'about' => ''],
            [ 'type_id' => '3', 'is_primary' => true, 'label' => 'Personal',  'value' => 'albertolicea00@icloud.com', 'about' => ''],
            [ 'type_id' => '2', 'is_primary' => false, 'label' => 'Trabajo',  'value' => 'albertolicea00@gmail.com', 'about' => ''],
            ];

    // PHONE AND CHATS
        $this->phones = [
            [ 'type_id' => 2, 'value' => '+53 32292629', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32292629\",\"number\":\"+5332292629\",\"call_number\":\"+5332292629\",\"clean_number\":\"32292629\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            [ 'type_id' => 3, 'value' => '+53 32271900', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32271900\",\"number\":\"+5332271900\",\"call_number\":\"+5332271900\",\"clean_number\":\"32271900\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            [ 'type_id' => 1, 'value' => '+1 5615459878', 'is_primary' => true, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+1 5615459878\",\"number\":\"+15615459878\",\"call_number\":\"+15615459878\",\"clean_number\":\"5615459878\",\"country_code\":null,\"country_dial_code\":\"1\",\"country_iso2\":\"us\",\"country_name\":\"United States\"}"],
            [ 'type_id' => 6, 'value' => '+53 54771264', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 54771264\",\"number\":\"+5354771264\",\"call_number\":\"+5354771264\",\"clean_number\":\"54771264\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ];
        $this->instant_messages = [
            ['type_id' => 2, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => true, 'about' => ''] ,
            ['type_id' => 1, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => false, 'about' => ''] ,
            ['type_id' => 3, 'label' => 'Trabajo', 'value' => 'soporteit@wateke.travel', 'is_primary' => false, 'about' => ''] ,
            ];

        // RRSS AND WEBS
        $this->webs = [
            ['type_id' => 1, 'value' => 'albertos-blog.com',  'about' => ''],
            ['type_id' => 2, 'value' => 'alberto.licea',  'about' => ''],
            ['type_id' => 6, 'value' => 'wateke.travel',  'about' => ''] ,
            ];
        $this->rrss = [
            ['type_id' => 4, 'value' => 'albertolicea00', 'about' => ''] ,
            ['type_id' => 1, 'value' => 'albertolicea00', 'about' => ''] ,
            ['type_id' => 2, 'value' => 'albertolicea00', 'about' => ''] ,
            ];


        // ADDRESS
        $this->address = [
            ['city_id' => "21825", 'country_id' => "56", 'geolocation' => "", 'name' => "Casa", 'state_id' => "286", 'zip_code' => "70100" ],
            ];
        $this->address_line = [
            [
                [ 'address_id' => 1, 'label' => "Número", 'value' => "364"],
                [ 'address_id' => 1, 'label' => "Calle", 'value' => "Bembeta"],
                [ 'address_id' => 1, 'label' => "entre", 'value' => "Cielo"],
                [ 'address_id' => 1, 'label' => "y", 'value' => "20 de Mayo"],
            ]
            ];




        // BANK ACCOUNTS
        // $this->bank_account_types = '';
        // $this->bank_account_type = '';
        // $this->bank_account_card_number = '';
        // $this->bank_account_card_holder = '';
        // $this->bank_account_is_credit = '';
        // $this->bank_account_about = '';
        // $this->bank_account_expiration_date = '';
        // $this->bank_account_expiration_year = '';
        // $this->bank_account_expiration_month = '';
        // $this->bank_account_bank_name = '';
        // $this->bank_account_bank_title = '';
        // $this->bank_account_banks = '';
        $this->bank_accounts = [
            [ 'type_id' => 4, 'card_holder' => 'Alberto Licea', 'card_number' => "1234123412341234", 'is_credit' => false, 'about'=>''],
            [ 'type_id' => 3, 'card_holder' => 'Alberto Licea', 'card_number' => "9087569325412563", 'is_credit' => false, 'about'=>''],
            [ 'type_id' => 2, 'card_holder' => 'Alberto Licea', 'card_number' => "9562885966531257", 'is_credit' => false, 'about'=>''],
            ];

        // OCUPATION

        // MORE
        $this->dates = [
            [ 'type_id' => '1', 'value' => '2000-05-16'],
            [ 'type_id' => '2', 'value' => '2011-04-25'],
            ];
        $this->publish_us = [
            [ 'type_id' => '1', 'label' => 'Personal',  'value' => 'http://albertosblog.com'],
            [ 'type_id' => '3', 'label' => 'Personal',  'value' => 'http://tut12app.com'],
            [ 'type_id' => '2', 'label' => 'Trabajo',  'value' => 'http://albertolicea00.com'],
            ];





    }

}
