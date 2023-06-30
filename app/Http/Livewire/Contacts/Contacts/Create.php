<?php

namespace App\Http\Livewire\Contacts\Contacts;

use App\Rules\UniqueWarning;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use Livewire\Component;

use App\Models\Gender as Genders;
use App\Models\ContactLinkUser;
use App\Models\User as Users;
use App\Models\Contact as Contacts;
use App\Models\AddressCountry as Countries;
use App\Models\AddressState as States;
use App\Models\ContactIdType as IdTypes;
use App\Models\ContactEmailType as EmailTypes;
use App\Models\ContactPhoneType as PhoneTypes;
use App\Models\ContactInstantmessageType as InstantMessageTypes;
use App\Models\ContactRrssType as RrssTypes;
use App\Models\ContactWebType as WebTypes;
use App\Models\ContactBankAccountType as BankAccountTypes;
use App\Models\ContactDateType as DateTypes;
use App\Models\ContactPublishUsType as PublishUsTypes;
use App\Models\ContactAddress as Address;


class Create extends Component
{
    use WithFileUploads;
    protected $listeners = [
        'existEmail',
        'existPhoneNumber',
        'existInstantMessage',
        'existWeb',
        'existRrss',
        'existPublisUs',
        'prueba',
        'updatePhoneNumber',
        'updateWebValue',
        'updateRrssValue',
        'updateCountry',
        'updateState',
        'updateCity',
        'removeAccountCard',
    ];
    public $prueba, $datos_prueba;

    public $errorMessage;
    public $allStep = [ 'general', 'emails', 'phones', 'chats', 'rrss', 'webs', 'address', 'ocupation', 'more', 'resumen', ];
    public $passStep = [];
    public $currentStep = 'webs';

    public $labels_type = ['Personal', 'Trabajo', 'Otro'];

    // GENERALS
    public $genders, $prefixs;
    public $alias, $name, $middle_name, $first_lastname, $second_lastname, $meta, $about;
    public $gender, $prefix;
    public $main_profile_pic = 0;
    public $profile_pics = [];

    // EMAILS
    public $email_types;
    public $emails = [];
    public $emails_max = 10;

    // PHONES
    public $phone_types;
    public $phones = [];
    public $phones_max = 8;

    // CHATS
    public $instant_message_types;
    public $instant_messages = [];
    public $instant_messages_max = 8;


    // RRSS
    public $rrss_types;
    public $rrss = [];
    public $rrss_max = 8;

    // WEBS
    public $web_types;
    public $webs = [];
    public $webs_max = 8;


    // ADDRESS
    //public $countries, $states, $cities;
    //public $contact_address = [];
    //public $address = [];
    //public $address_max = 3;
//
    //public $address_line = [];
    //public $address_line_max = 10;

    // BANK ACCOUNTS
    //public $bank_account_types, $bank_account_type;
    //public $bank_account_card_number, $bank_account_card_holder, $bank_account_is_credit, $bank_account_about, $bank_account_meta;
    //public $bank_account_expiration_date, $bank_account_expiration_year, $bank_account_expiration_month;
//
    //public $bank_account_bank_name, $bank_account_bank_title;
    //public $bank_id_in_bbdd;
    //public $bank_account_banks = [];
    //public $bank_accounts = [];

    // OCUPATION
    //public $ocupation_id, $ocupation_entity_id, $ocupation_about;
    // EN CONSTRUCCIÓN

    // MORE
    //public $date_types, $date_type;
    //public $date_value;
    //public $dates = [];
    //public $dates_max = 4;
//
    //public $publish_us_types, $publish_us_type;
    //public $publish_us_value, $publish_us_about;
    //public $publish_us = [];
    //public $publish_us_max = 8;
//
    //public $id_types;
    //public $ids = [];
    //public $id_max = 4;

    // RESUMEN
    // public $is_user_link = false;
    // public $user_link_roles;
    // private $user_link_password;
    // public $user_link_role, $user_link_name, $user_link_email, $user_link_phone, $user_link_password_public, $user_link_password_check, $user_link_about;



    // ----------------------- RENDER --------------------------
    public function mount()
    {
        $this->genders = Genders::all()->where('enable', true);
        $this->gender = $this->genders->first()->id;
        $this->updatedGender();
//
        $this->email_types = EmailTypes::all()->where('enable', true);
        $this->phone_types = PhoneTypes::all()->where('enable', true);
        $this->instant_message_types = InstantMessageTypes::all()->where('enable', true);
        $this->rrss_types = RrssTypes::all()->where('enable', true);
        $this->web_types = WebTypes::all()->where('enable', true);
        // $this->bank_account_types = BankAccountTypes::all()->where('enable', true);
        // $this->date_types = DateTypes::all()->where('enable', true);
        // $this->publish_us_types = PublishUsTypes::all()->where('enable', true);
        // $this->countries = Countries::all()->where('enable', true);
        // $this->id_types = IdTypes::all()->where('enable', true);
//
//
//
        $this->emails[] = ['type_id' => null, 'label' => '', 'value' => null, 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'is_primary' => true, 'about' => '', 'extension' => ''];
        $this->instant_messages[] = ['type_id' => $this->instant_message_types[0]->id, 'label' => '', 'is_primary' => true, 'value' => '', 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->dates[] = ['id_type' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->publish_us[] = ['id_type' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->ids[] = ['type_id' => $this->id_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];


        //$this->address[] = [
        //    'name' => 'Casa',
        //    'city_id' => '',
        //    'geolocation' => null,
        //    'zip_code' => '',
        //    'country_id' => null,
        //    'state_id' => null
        //];
        //$this->address_line[0][] = ['label' => 'Localidad', 'value' => ''];
        //$this->address_line[0][] = ['label' => 'Número', 'value' => ''];
        //$this->address_line[0][] = ['label' => 'Calle', 'value' => ''];
//
        //$this->remount_bank_accounts();
        //$this->datos_prueba();
    }
    public function render()
    {
        return view('livewire.contacts.contacts.create');
    }


// ----------------------- VALIDACIONES --------------------------

    public function uniqueWarningBD($table, $targetField, $value, $message = 'El campo ya es utilizado en base de datos'){
        $result = DB::table($table)->where($targetField, $value)->first();
        if ($result) {
            return $message;
        }
        return null;
    }

    public function validate_general($fieldName = null){
        $this->name = ucwords(strtolower(trim($this->name)));
        $this->middle_name = ucwords(strtolower(trim($this->middle_name)));
        $this->first_lastname = ucwords(strtolower(trim($this->first_lastname)));
        $this->second_lastname = ucwords(strtolower(trim($this->second_lastname)));

        $rules = [
            'name' => 'required|string|min:2|max:50|regex:/^[a-zA-Z ]+$/',
            'middle_name' => 'nullable|string|min:2|max:50|regex:/^[a-zA-Z ]+$/',
            'first_lastname' => 'required|string|min:2|max:50|regex:/^[a-zA-Z ]+$/',
            'second_lastname' => 'nullable|string|min:2|max:50|regex:/^[a-zA-Z ]+$/',
            // 'profile_pics' => 'max:5120|valid_image_mime',
        ];
        $messages = [
            '*.required' => 'El campo es obligatorio',
            '*.min' => 'El campo no puede tener menos de :min caracteres',
            '*.max' => 'El campo no puede tener más de :max caracteres',
            '*.regex' => 'El campo solo puede contener letras y espacios en blanco',
            '*.string' => 'El campo debe ser de tipo texto',
            '*.integer' => 'Este campo debe ser de tipo entero',
        ];


        if ($fieldName !== null){
            $this->validateOnly($fieldName, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }

    }
    public function validate_emails($fieldName = null, $index = '*'){
        if ($fieldName === 'value'){
            if ($index != '*'){
                $this->emails[$index]['value'] = strtolower(trim($this->emails[$index]['value']));
                $this->selectEmailType($index);
            }else{
                foreach ($this->emails as $i => $email) {
                    $this->emails[$i]['value'] = strtolower(trim($this->emails[$i]['value']));
                    $this->selectEmailType($i);
                }
            }
        }

        $rules = [
            'emails.' . $index . '.is_primary' => '',
            'emails.' . $index . '.type_id' => ['nullable', 'integer', Rule::in($this->email_types->pluck('id')->toArray()),],
            'emails.' . $index . '.label' => 'nullable|string|min:2|max:50',
            'emails.' . $index . '.about' => 'nullable|string|min:2',
            'emails.' . $index . '.value' => [ 'required', 'email', 'min:5', 'max:50',
                function ($attribute, $value, $fail) {
                    $emails = array_column($this->emails, 'value');
                    if (count($emails) != count(array_unique($emails))) {
                        $fail('Los emails no pueden repetirse');
                    }
                }
            ]
        ];
        $messages = [
            'emails.*.*.required' => 'El campo es obligatorio',
            'emails.*.*.email' => 'El campo debe ser un email válido',
            'emails.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'emails.*.*.min' => 'El campo no puede menos más de :min caracteres',
            'emails.*.*.unique' => 'Este email ya está en uso',
            'emails.*.*.string' => 'Este campo debe ser de tipo texto',
            'emails.*.*.integer' => 'Este campo debe ser de tipo entero',
        ];


        if ($index != '*' && $fieldName !== null){
            $field = 'emails.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
            // if ($fieldName === 'value') $this->selectEmailType($index);
        }else{
            $this->validate($rules, $messages);
            // foreach ($this->emails as $index => $email) { $this->selectEmailType($index); }
        }

    }
    public function validate_phones($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName === 'extension'){
            $this->phones[$index]['extension'] = trim(str_replace(' ', '', $this->phones[$index]['extension']));
        }

        $rules = [
            'phones.' . $index . '.is_primary' => '',
            'phones.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),],
            'phones.' . $index . '.about' => 'nullable|string|min:2',
            'phones.' . $index . '.extension' => ['integer',
                Rule::requiredIf(function () use ($index) {
                    return $index !== '*' && $this->phone_types->find($this->phones[$index]['type_id'])->label === 'Extensión';
                }),
                function ($attribute, $value, $fail) use ($index) {
                    // validar que el juego del value + ext no se repita en el front-end
                }],
            'phones.' . $index . '.value' => ['required', 'min:3', 'max:20',
                function ($attribute, $value, $fail) use ($index) {
                    $phones = array_column($this->phones, 'value');
                    if (count($phones) != count(array_unique($phones)) && $this->phone_types->find($this->phones[$index]['type_id'])->label != 'Extensión') {
                        $fail('Los números de teléfonos no pueden repetirse');
                    }
                }
            ]
        ];
        $messages = [
            'phones.*.*.required' => 'El campo es obligatorio',
            'phones.*.*.phone' => 'El campo debe ser un teléfono válido',
            'phones.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'phones.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'phones.*.*.unique' => 'Este teléfono ya está en uso',
            'phones.*.*.string' => 'Este campo debe ser de tipo texto',
            'phones.*.*.integer' => 'Este campo debe ser de tipo numerico',
        ];


        if ($index != '*' && $fieldName !== null && $fieldName !== 'extension'){
            $field = 'phones.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }

    }
    public function validate_chats($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'value') $this->instant_messages[$index]['value'] = strtolower(trim($this->instant_messages[$index]['value']));
            else if ($fieldName === 'label') $this->instant_messages[$index]['label'] = trim($this->instant_messages[$index]['label']);
        }


        $rules = [
            'instant_messages.' . $index . '.is_primary' => '',
            'instant_messages.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->instant_message_types->pluck('id')->toArray()),],
            'instant_messages.' . $index . '.label' => 'nullable|string|min:2|max:50',
            'instant_messages.' . $index . '.about' => 'nullable|string|min:2',
            'instant_messages.' . $index . '.value' => [ 'required', 'min:5', 'max:50',
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
        ];
        $messages = [
            'instant_messages.*.*.required' => 'El campo es obligatorio',
            'instant_messages.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'instant_messages.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'instant_messages.*.*.unique' => 'Este usuario ya está en uso',
            'instant_messages.*.*.string' => 'Este campo debe ser de tipo texto',
            'instant_messages.*.*.integer' => 'Este campo debe ser de tipo numerico',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'instant_messages.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }

    }
    public function validate_rrss($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'value') $this->rrss[$index]['value'] = strtolower(trim($this->rrss[$index]['value']));
        }

        $rules = [
            'rrss.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->rrss_types->pluck('id')->toArray()),],
            'rrss.' . $index . '.label' => 'nullable|string|min:2|max:50',
            'rrss.' . $index . '.about' => 'nullable|string|min:2',
            'rrss.' . $index . '.value' => [ 'required', 'min:5', 'max:50',
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
        ];
        $messages = [
            'rrss.*.*.required' => 'El campo es obligatorio',
            'rrss.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'rrss.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'rrss.*.*.unique' => 'Esta usuario ya está en uso por otro contacto',
            'rrss.*.*.string' => 'Este campo debe ser de tipo texto',
            'rrss.*.*.integer' => 'Este campo debe ser de tipo numerico',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'rrss.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }

    }
    public function validate_webs($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'value'){
                $this->webs[$index]['value'] = strtolower(trim($this->webs[$index]['value']));
                $cvalue = $this->webs[$index]['value'];

                if (substr($cvalue, 0, 2) === "//") $value = substr($cvalue, 2);
                else if (substr($cvalue, 0, 3) === "://") $cvalue = substr($cvalue, 3);
                else if (substr($cvalue, 0, 7) === "http://") $cvalue = substr($cvalue, 7);
                else if (substr($cvalue, 0, 8) === "https://") $cvalue = substr($cvalue, 8);

                $this->webs[$index]['value'] = $cvalue;

            }
        }


        $rules = [
            'webs.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->web_types->pluck('id')->toArray()),],
            'webs.' . $index . '.label' => 'nullable|string|min:2|max:50',
            'webs.' . $index . '.about' => 'nullable|string|min:2',
            'webs.' . $index . '.value' => [ 'required', 'min:5', 'max:50',
                function ($attribute, $value, $fail) {
                    $value = 'https://' . $value;
                    if (!filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('El campo debe ser una URL válida.');
                    }
                },
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
        ];
        $messages = [
            'webs.*.*.required' => 'El campo es obligatorio',
            'webs.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'webs.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'webs.*.*.unique' => 'Esta web ya está en uso por otro contacto',
            'webs.*.*.string' => 'Este campo debe ser de tipo texto',
            'webs.*.*.integer' => 'Este campo debe ser de tipo numerico',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'webs.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }

    }
    public function validate_address($fieldName = null, $index = '*'){

    }
    public function validate_ocupation($fieldName = null, $index = '*'){

    }
    public function validate_more($fieldName = null, $index = '*'){

    }

// -------------------------- STEPS -------------------------- //
    private function backStep($passStep, $currentStep, $time = 700){
        $this->currentStep = $currentStep;
    }
    private function nextStep($passStep, $currentStep, $time = 2000){
        if (!in_array($currentStep, $this->passStep)) {
            $this->dispatchBrowserEvent('coocking-time', ['time' => $time]);
        }
        $this->passStep[] = $passStep;
        $this->currentStep = $currentStep;
    }
    private function omitStep($currentStep, $time = 1000){
        $this->dispatchBrowserEvent('coocking-time', ['time' => $time]);
        $this->currentStep = $currentStep;
    }

// -------------------------- STEP GENERALS -------------------------- //

    public function updatedPrefix(){
        if ($this->prefix === '') $this->prefix = null;
    }
    public function updatedGender(){
        $this->prefixs = $this->genders->find($this->gender)->prefixs->where('enable', true);
        if ($this->prefix) $this->prefix = $this->prefixs->first()->id;
    }

    public function updatedProfilePics(){
        $this->validate([
            'profile_pics' => 'required|max:5120|valid_image_mime',
        ]);
        if ($this->getErrorBag()->any()) {
            $this->profile_pics = null;
        }
        foreach ($this->profile_pics as $pic) {
            $filePath = $pic->getRealPath();
            $image = Image::make($filePath);
            $image->fit(500, 500);
            $image->save($filePath);
        }
        $this->main_profile_pic = 0;

    }

    public function stepSubmit_general_omit(){
        // $this->name = null;
        // $this->middle_name = null;
        // $this->first_lastname = null;
        // $this->second_lastname = null;
        // $this->profile_pics = [];

        $this->omitStep('emails');
    }
    public function stepSubmit_general_next(){
        $this->validate_general();
        $this->nextStep('general', 'emails');
    }

// -------------------------- STEP EMAILS -------------------------- //

    public function selectEmailType($index){
        try {
            $email = $this->emails[$index]['value'];
            [$username, $domain] = explode('@', $email);
            $provider = explode('.', $domain)[0];

            $type = $this->email_types->firstWhere('value', $provider);
            if ($type) {
                $this->emails[$index]['type_id'] = $type->id;
            } else {
                $this->emails[$index]['type_id'] = null;
            }
        }catch (\Exception $e) {
        }
    }
    public function selectEmailIsPrimary($index){
        $this->emails = array_map(function ($email) {
            $email['is_primary'] = false;
            return $email;
        }, $this->emails);

        $this->emails[$index]['is_primary'] = true;
    }

    public function addEmail($index){
        $this->validate_emails(null, $index);

        if (count($this->emails) < $this->emails_max) {
            $this->emails[] = ['type_id' => null, 'label' => null, 'value' => '', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeEmail($index){
        $remove_primary = false;
        if ($this->emails[$index]['is_primary'])
            $remove_primary = true;

        unset($this->emails[$index]);
        $this->emails = array_values($this->emails);
        if ($remove_primary)
            $this->selectEmailIsPrimary(0);
    }


    public function stepSubmit_emails_back(){
        $this->backStep('emails', 'general');
    }
    public function stepSubmit_emails_omit(){
        // $this->emails = [];
        $this->omitStep('phones');
    }
    public function stepSubmit_emails_next(){
        $this->validate_emails();
        $this->nextStep('emails', 'phones');
    }
// -------------------------- STEP PHONES -------------------------- //
    public function updatePhoneNumber($index, $value, $value_meta){
        $this->phones[$index]['value'] = $value;
        $this->phones[$index]['value_meta'] = json_encode($value_meta, true);
        $this->validate_phones('value', $index);
    }
    public function selectPhoneIsPrimary($index){
        $this->phones = array_map(function ($phone) {
            $phone['is_primary'] = false;
            return $phone;
        }, $this->phones);

        $this->phones[$index]['is_primary'] = true;
    }

    public function addPhone($index){
        $this->validate_phones(null, $index);

        if (count($this->phones) < $this->phones_max) {
            $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'extension' => '', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        }
        $this->dispatchBrowserEvent('intl-tel-input', ['index' => $index + 1]);
    }
    public function removePhone($index){
        $remove_primary = false;
        if ($this->phones[$index]['is_primary'])
            $remove_primary = true;

        unset($this->phones[$index]);
        $this->phones = array_values($this->phones);
        if ($remove_primary)
            $this->selectPhoneIsPrimary(0);
    }


    public function stepSubmit_phones_back(){
        $this->backStep('phones', 'emails');
    }
    public function stepSubmit_phones_omit(){
        // $this->phones = [];
        $this->omitStep('chats');
    }
    public function stepSubmit_phones_next(){
        $this->validate_phones();
        $this->nextStep('phones', 'chats');
    }

// -------------------------- STEP CHATS -------------------------- //

    public function selectInstantMessageIsPrimary($index){
        $this->instant_messages = array_map(function ($instant_message) {
            $instant_message['is_primary'] = false;
            return $instant_message;
        }, $this->instant_messages);

        $this->instant_messages[$index]['is_primary'] = true;
    }

    public function addInstantMessages($index){
        $this->validate_chats(null, $index);

        if (count($this->instant_messages) < $this->instant_messages_max) {
            $this->instant_messages[] = ['type_id' => $this->phone_types[0]->id, 'label' => '', 'value' => '', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeInstantMessages($index){
    $remove_primary = false;
    if ($this->instant_messages[$index]['is_primary'])
        $remove_primary = true;

    unset($this->instant_messages[$index]);
    $this->instant_messages = array_values($this->instant_messages);
    if ($remove_primary)
        $this->selectInstantMessageIsPrimary(0);
    }

    public function stepSubmit_chats_back(){
        $this->backStep('chats', 'phones');
    }
    public function stepSubmit_chats_omit(){
        $this->instant_messages = [];
        $this->omitStep('rrss');
    }
    public function stepSubmit_chats_next(){
        $this->validate_chats();
        $this->nextStep('chats', 'rrss');
    }

// -------------------------- STEP RRSS -------------------------- //

    public function addRrss($index){
        $this->validate_rrss(null, $index);

        if (count($this->rrss) < $this->rrss_max) {
            $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeRrss($index){
        unset($this->rrss[$index]);
        $this->rrss = array_values($this->rrss);
    }


    public function stepSubmit_rrss_back(){
        $this->backStep('rrss', 'chats');
    }
    public function stepSubmit_rrss_omit(){
        $this->rrss = [];
        $this->omitStep('webs');
    }
    public function stepSubmit_rrss_next(){
        $this->validate_rrss();
        $this->nextStep('rrss', 'webs');
    }

// -------------------------- STEP WEBS -------------------------- //
    public function selectWebIsPrimary($index){
        // NO DISPONIBLE PARA CONTACTOS
    }

    public function addWeb($index){
        $this->validate_webs(null, $index);

        if (count($this->webs) < $this->webs_max) {
            $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '','label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeWeb($index){
        unset($this->webs[$index]);
        $this->webs = array_values($this->webs);
    }


    public function stepSubmit_webs_back(){
        $this->backStep('webs', 'rrss');
    }
    public function stepSubmit_webs_omit(){
        $this->webs = [];
        $this->omitStep('address');
    }
    public function stepSubmit_webs_next(){
        $this->validate_webs();
        $this->nextStep('webs', 'address');
    }

// -------------------------- STEP ADDRESS -------------------------- //














    public function stepSubmit_address_back(){
        $this->backStep('address', 'webs');
    }
    public function stepSubmit_address_omit(){
        $this->omitStep('ocupation');
    }
    public function stepSubmit_address_next(){
        $this->nextStep('address', 'ocupation');
    }
// -------------------------- STEP OCUPATION -------------------------- //
    public function stepSubmit_ocupation_back(){
        $this->backStep('ocupation', 'address');
    }
    public function stepSubmit_ocupation_omit(){
        $this->omitStep('more');
    }
    public function stepSubmit_ocupation_next(){
        $this->nextStep('ocupation', 'more');
    }
// -------------------------- STEP MORE -------------------------- //
    public function stepSubmit_more_back(){
        $this->backStep('more', 'ocupation');
    }
    public function stepSubmit_more_omit(){
        $this->omitStep('resumen');
    }
    public function stepSubmit_more_next(){
        $this->nextStep('more', 'resumen');
    }
// -------------------------- STEP RESUMEN -------------------------- //



// -------------------------- END - STEPS -------------------------- //








































    public function existEmail($index){
        // NO DISPONIBLE POR EL MOMENTO
        // $this->emails[$index]['meta']['is_valid'] =
    }
    public function existPhoneNumber($index){
        // NO DISPONIBLE POR EL MOMENTO
        // $this->emails[$index]['meta']['exist'] =
    }
    public function existInstantMessage($index){
        // NO DISPONIBLE POR EL MOMENTO
        // $this->instant_messages[$index]['meta']['is_valid'] =
    }
    public function existWeb($index){
        // NO DISPONIBLE POR EL MOMENTO
        // $this->webs[$index]['meta']['is_valid'] =
    }
    public function existRrss($index){
        // NO DISPONIBLE POR EL MOMENTO
        // $this->rrss[$index]['meta']['is_valid'] =

    }
    public function existPublisUs($index)
    {
        // NO DISPONIBLE POR EL MOMENTO
        // $this->publish_us[$index]['meta']['is_valid'] =
    }



    public function geolocation($index)
    {
        // procesar con API de GOOGLE
        // if (ya existe una geolocation){
        //      mostrar en la ubicacion
        // } else{
        //      hacer que la localice (usando el country/state/city escogido con su longitude y latitude)
        // $this->address[$index]['geolocation'] =
        // }
    }





























































    // -------------------------- STEP GENERALS --------------------------

    public function addId($index){
        $this->validate([
            'ids.*.type_id' => ['required', Rule::in($this->id_types->pluck('id')->toArray()),
            ],
            'ids.*.value' => 'required|string',
            'ids.' . $index . '.value' => [
                'required',
                function ($attribute, $value, $fail) {
                    $ids = array_column($this->ids, 'value');
                    if (count($ids) != count(array_unique($ids))) {
                        $fail('Los valores no pueden repetirse');
                    }
                },
                //new UniqueWarning('contact_ids', 'value', $this->ids[$index]['value'], 'Este id ya es usado por otro contacto'),
            ]
        ], [
                'ids.*.type_id.required' => 'El campo es obligatorio',
                'ids.*.value.required' => 'El campo es obligatorio',
            ]);
        if (count($this->ids) < $this->id_max) {
            $this->ids[] = ['type_id' => $this->id_types->first()->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeId($index){
        unset($this->ids[$index]);
        $this->ids = array_values($this->ids);
    }


    public function zstepSubmit_general(){
        $this->validate([
            'alias' => 'max:50',
            'about' => 'max:500',
            'ids.*.type_id' => ['required', 'integer', Rule::in($this->id_types->pluck('id')->toArray()),
            'ids.*.value' => ['required','string',
                function ($attribute, $value, $fail) {
                    $ids = array_column($this->ids, 'value');
                    if (count($ids) != count(array_unique($ids))) {
                        $fail('Los valores no pueden repetirse');
                    }
                }
            ],
            ],
        ], [
                // '*.array' => 'Error de Servidor : El campo debe ser un array',
                '*.required' => 'El campo es obligatorio',
                'ids.*.value.required' => 'El campo es obligatorio',
            ]);
    }


    // -------------------------- STEP ADDRESS --------------------------
    public function addAddress($index)
    {
        $this->validate([
            'address.' . $index . '.name' => 'required',
            'address.' . $index . '.country_id' => 'required',
            'address.' . $index . '.state_id' => [
                function ($attribute, $value, $fail) use ($index) {
                    $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                    if ($country && $country->states->count() > 0 && empty($value))
                        $fail('El campo es obligatorio.');
                }
            ],
            'address.' . $index . '.city_id' => [
                function ($attribute, $value, $fail) use ($index) {
                    $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                    $state = $country ? $country->states()->find($this->address[$index]['state_id']) : null;
                    if ($state && $state->cities->count() > 0 && empty($this->address[$index]['city_id']))
                        $fail('El campo es obligatorio.');
                }
            ],
            'address_line.' . $index . '.*.label' => 'required',
            'address_line.' . $index . '.*.value' => 'required',
            // 'address_line.' . $index . $index_l . '.label' => 'required',
            // 'address_line.' . $index . $index_l . '.value' => 'required',
        ], [
                'address.' . $index . '.*.required' => 'El campo es obligatorio',
                'address_line.' . $index . '.*.*.required' => 'El campo es obligatorio',
            ]);
        if (count($this->address) < $this->address_max) {
            $this->address[] = [
                'name' => '# ' . ($index + 2),
                'citie_id' => '1',
                'geolocation' => '',
                'zip_code' => '',
                'country_id' => null,
                'state_id' => null
            ];
            $this->address_line[$index + 1][] = ['label' => 'Localidad', 'value' => ''];
            $this->address_line[$index + 1][] = ['label' => 'Numero', 'value' => ''];
            $this->address_line[$index + 1][] = ['label' => 'Calle', 'value' => ''];
        }
        $this->dispatchBrowserEvent('init-select2-countries', ['index_add' => $index + 1]);
    }
    public function removeAddress($index)
    {
        unset($this->address_line[$index]);
        unset($this->address[$index]);
        $this->address_line = array_values($this->address_line);
        $this->address = array_values($this->address);
    }

    public function updateCountry($index_add, $value)
    {
        $this->address[$index_add]['country_id'] = $value;
        $this->address[$index_add]['state_id'] = null;
        $this->address[$index_add]['city_id'] = null;

        $states = Countries::where('enable', true)->find($value)->states->map(function ($state) {
            return ['id' => $state->id, 'text' => $state->name,];
        })->toArray();

        if (count($states) == 0) {
            $this->dispatchBrowserEvent('init-select2-states-disabled', ['index_add' => $index_add]);
        } else {
            $this->dispatchBrowserEvent('init-select2-states', ['index_add' => $index_add, 'states' => $states]);
        }
    }
    public function updateState($index_add, $value)
    {
        $this->address[$index_add]['state_id'] = $value;
        $this->address[$index_add]['city_id'] = null;

        $cities = Countries::find($this->address[$index_add]['country_id'])
            ->states->find($this->address[$index_add]['state_id'])
            ->cities->map(function ($city) {
                return ['id' => $city->id, 'text' => $city->name,];
            })->toArray();

        if (count($cities) == 0) {
            $this->dispatchBrowserEvent('init-select2-cities-disabled', ['index_add' => $index_add]);
        } else {
            $this->dispatchBrowserEvent('init-select2-cities', ['index_add' => $index_add, 'cities' => $cities]);
        }
    }
    public function updateCity($index_add, $value)
    {
        $this->address[$index_add]['city_id'] = $value;
    }



    public function addAddressLine($index_l, $index_add)
    {
        $this->validate([
            'address_line.' . $index_add . '.*.label' => 'required',
            'address_line.' . $index_add . '.*.value' => 'required',
            // 'address_line.' . $index_add . $index_l . '.label' => 'required',
            // 'address_line.' . $index_add . $index_l . '.value' => 'required',
        ], [
                'address_line.' . $index_add . '.*.*.required' => 'El campo es obligatorio',
            ]);
        if (count($this->address_line[$index_add]) < $this->address_line_max) {
            $this->address_line[$index_add][] = ['label' => '', 'value' => ''];
        }
    }
    public function removeAddressLine($index_l, $index_add)
    {
        unset($this->address_line[$index_add][$index_l]);
        $this->address_line[$index_add] = array_values($this->address_line[$index_add]);
    }


    public function zzstepSubmit_address_omit()
    {
        $this->address = [];
        $this->address_line = [];
        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->currentStep = 'bank_accounts';
    }
    public function zstepSubmit_address()
    {
        $this->validate([
            'address.*.name' => 'required',
            'address.*.country_id' => 'required',
            'address.*.state_id' => [
                function ($attribute, $value, $fail) {
                    foreach ($this->address as $index => $address) {
                        $country = Countries::where('enable', true)->find($address['country_id']);
                        if ($country && $country->states->count() > 0 && empty($value)) {
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
                        if ($state && $state->cities->count() > 0 && empty($address['city_id'])) {
                            $fail('El campo es requerido si está disponible');
                        }
                    }
                }
            ],
            'address_line.*.*.label' => 'required',
            'address_line.*.*.value' => 'required',
        ], [
                '*.*.*.required' => 'El campo es obligatorio',
                'address.*.*.required' => 'El campo es obligatorio',
                'address_line.*.*.*.required' => 'El campo es obligatorio',
            ]);

        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->passStep[] = 'address';
        $this->currentStep = 'bank_accounts';
        $this->dispatchBrowserEvent('init-select2-countries', ['index_add' => 0]);
        $this->remount_bank_accounts();
    }

    // -------------------------- STEP BANK ACCOUNTS --------------------------
    public function remount_bank_accounts()
    {
        $this->bank_account_types = BankAccountTypes::all();
        $this->bank_account_type = $this->bank_account_types->first()->id;
        $this->bank_account_expiration_year = date("Y");
        $this->bank_account_expiration_month = date("n") + 4;
        $this->bank_account_expiration_date = date('Y-m-d', mktime(0, 0, 0, $this->bank_account_expiration_month, 1, $this->bank_account_expiration_year));
        $this->bank_account_card_number = '';
        $this->bank_account_card_holder = $this->name . ' ' . $this->first_lastname;
        $this->bank_account_is_credit = 'true';
        $this->bank_account_about = '';
        $this->bank_account_meta = "{\"is_valid\":null}";

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

    public function addAccountCard()
    {
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
        ], [
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
            'meta' => $this->bank_account_meta,
        ]);
        $this->remount_bank_accounts();
    }
    public function removeAccountCard($index)
    {
        array_splice($this->bank_accounts, $index, 1);
        // array_splice($this->bank_account_banks, $index, 1);
    }
    public function editAccountCard($index)
    {
        // NO DISPONIBLE
    }

    public function stepSubmit_bank_accounts()
    {
        $this->validate([
            'bank_accounts' => 'required'
        ], [
                '*.required' => 'Necesita añadir almenos una cuenta bancaria, caso contrario omita la sección.',
            ]);


        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->passStep[] = 'bank_accounts';
        $this->currentStep = 'ocupation';
    }
    public function stepSubmit_bank_accounts_omit()
    {
        $this->bank_accounts = [];
        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->currentStep = 'ocupation';
    }
    // -------------------------- STEP OCUPATION --------------------------
    public function stepSubmit_ocupation()
    {
        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->passStep[] = 'ocupation';
        $this->currentStep = 'more';
    }
    public function zzstepSubmit_ocupation_omit()
    {
        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->currentStep = 'more';
    }
    // -------------------------- STEP MORE --------------------------
    public function addDate($index)
    {
        if (count($this->dates) >= 1) {
            $this->validate([
                'dates.' . $index . '.value' => [
                    'required',
                    'date',
                    // 'before_or_equal:' . Carbon::now()->subYears(1)->format('Y-m-d'),
                    // 'after_or_equal:' . Carbon::now()->subYears(118)->format('Y-m-d'),
                ],
                'dates.' . $index . '.type_id' => [
                    'required',
                    'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
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
            ], [
                    'dates.*.value.before_or_equal' => 'La fecha debe estar en un rango coherente.',
                    'dates.*.value.after_or_equal' => 'La fecha debe estar en un rango coherente.',
                    'dates.*.value.date' => 'El campo debe ser una fecha válida',
                    '*.required' => 'El campo es obligatorio',
                    'dates.*.*.required' => 'El campo es obligatorio',
                ]);
        }
        if (count($this->dates) < $this->dates_max) {
            $this->dates[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }

    public function removeDate($index)
    {
        unset($this->dates[$index]);
        $this->dates = array_values($this->dates);
    }



    public function updatePublishUsValue($index, $value)
    {
        if (substr($value, 0, 2) === "//")
            $value = substr($value, 2);
        else if (substr($value, 0, 3) === "://")
            $value = substr($value, 3);
        else if (substr($value, 0, 7) === "http://")
            $value = substr($value, 7);
        else if (substr($value, 0, 8) === "https://")
            $value = substr($value, 8);

        $this->publish_us[$index]['value'] = $value;
    }
    public function addPublishUs($index)
    {
        if (count($this->publish_us) >= 1) {
            $this->validate([
                'publish_us.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
                'publish_us.' . $index . '.value' => [
                    'required',
                    // 'url',
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
            ], [
                    'publish_us.*.value.url' => 'El campo debe ser una url válida',
                    '*.required' => 'El campo es obligatorio',
                    'publish_us.*.*.required' => 'El campo es obligatorio',
                ]);
        }
        if (count($this->publish_us) < $this->publish_us_max) {
            $this->publish_us[] = ['type_id' => $this->publish_us_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }

    public function removePublishUs($index)
    {
        unset($this->publish_us[$index]);
        $this->publish_us = array_values($this->publish_us);
    }


    public function zzstepSubmit_more_omit()
    {
        $this->dates = [];
        $this->publish_us = [];
        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->currentStep = 'resumen';
    }
    public function zstepSubmit_more()
    {
        $this->validate([
            'dates' => 'array',
            'dates.*.value' => [
                'required',
                'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('d-m-Y'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('d-m-Y'),
            ],
            'dates.*.type_id' => [
                'required',
                'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
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
            'publish_us.*.type_id' => ['required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.*.value' => [
                'required',
                // 'url',
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
        ], [
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

        $this->dispatchBrowserEvent('coocking-time', ['time' => 2000]);
        $this->passStep[] = 'more';
        $this->currentStep = 'resumen';
    }
    // -------------------------- STEP RESUMEN --------------------------

    public function UpdatedIsUserLink()
    {
        $primary_email = null;
        $existing_emails = DB::table('users')->select('email')->get()->pluck('email')->toArray();
        foreach ($this->emails as $email) {
            if ($email['is_primary'] == 1) {
                $email_value = $email['value'];
                if (!in_array($email_value, $existing_emails)) {
                    $primary_email = $email_value;
                    break;
                }
                foreach ($this->emails as $next_email) {
                    if ($next_email['value'] != $email_value && !in_array($next_email['value'], $existing_emails)) {
                        $primary_email = $next_email['value'];
                        break 2;
                    }
                }
            }
        }
        if (!$primary_email) {
            $this->dispatchBrowserEvent('error-user-exist');
            $this->is_user_link = false;
        }

        $this->user_link_roles = \Spatie\Permission\Models\Role::all(); // ->where('enable', true);
        // Validar en dependencia del rol que cree el contacto sera los roles que este pueda establecer al contacto


        $primary_phone = array_column(array_filter($this->phones, function ($phone) {
            return $phone['is_primary'] == 1;
        }), 'value');


        if ($this->is_user_link) {
            $this->user_link_name = $this->name . ' ' . $this->first_lastname;
            $this->user_link_email = $primary_email;
            $this->user_link_phone = reset($primary_phone);
            $this->user_link_role = '1';
        } else {
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
    public function store()
    {
        $picsError = false;
        $linkUserError = false;

        DB::beginTransaction();
        try {
            if ($this->is_user_link) {
                $this->validate([
                    'user_link_password_public' => 'required|min:6',
                    'user_link_password_check' => 'required|same:user_link_password_public',
                ], [
                        '*.required' => 'El campo es obligatorio',
                        '*.same' => 'Las contraseñas no coinciden'
                    ]);
                $this->user_link_password = Hash::make($this->user_link_password_public);
            }


            // CREATE CONTACT
            $contact = Contacts::create([
                'alias' => $this->alias,
                'name' => $this->name,
                'middle_name' => $this->middle_name,
                'first_lastname' => $this->first_lastname,
                'second_lastname' => $this->second_lastname,
                'gender_id' => $this->gender,
                'prefix_id' => $this->prefix,
                'meta' => $this->meta,
                'about' => $this->about,
            ]);

            // CREATE AND LINK USER ACCOUNT
            if ($this->is_user_link) {

                $user = Users::factory()->create([
                    'name' => $this->user_link_name,
                    'email' => $this->user_link_email,
                    'password' => $this->user_link_password,
                    'phone' => $this->user_link_phone,
                    'about' => $this->user_link_about,
                    'enable' => true
                ])->assignRole($this->user_link_role);

                // LINK USER CONTACT
                ContactLinkUser::create([
                    'contact_id' => $contact->id,
                    'user_id' => $user->id,
                ]);
            }



            // CREATE N ASSIGN RELATIONALS TABLES
            $contact->ids()->createMany($this->ids);
            $contact->emails()->createMany($this->emails);
            $contact->phones()->createMany($this->phones);
            $contact->instant_messages()->createMany($this->instant_messages);
            $contact->webs()->createMany($this->webs);
            $contact->rrss()->createMany($this->rrss);
            $contact->dates()->createMany($this->dates);
            $contact->publish_us()->createMany($this->publish_us);

            $address = $contact->address()->createMany($this->address);
            for ($i = 0; $i < count($address); $i++) {
                $address[$i]->lines()->createMany($this->address_line[$i]);
            }

            // PROXIMAMENTE ANALSAR COMO SE ALMACENARAN LOS BANCOS Y SU RELACION CON LAS CUENTAS BANCARIAS (ya que abrían bancos que no serian entidad y otros q si )
            $contact->bank_accounts()->createMany($this->bank_accounts);

            // implementar datos laborales


            DB::beginTransaction();
            $link_pics = [];
            $storename = 'app/public/images/contacts_profile_pics/';
            try {
                foreach ($this->profile_pics as $index => $pic) {
                    $timestamp = str_replace(array(' ', ':', '-'), '', now());
                    $filename = $timestamp . "_" . $contact->id . "-" . $pic->getFilename();
                    $imageSize = getimagesize($pic->path());

                    $pic->storeAs($storename, $filename);
                    $link_pics[] = $contact->pics()->create([
                        'label' => null,
                        'name' => $filename,
                        'store' => $storename,
                        'is_primary' => ($this->main_profile_pic == $index ? 1 : 0),
                        'meta' => json_encode([
                            'width' => $imageSize[0],
                            'height' => $imageSize[1],
                            'mime_type' => $pic->getMimeType(),
                            'size' => $pic->getSize(),
                            'client_original_name' => $pic->getClientOriginalName(),
                            'client_mime_type' => $pic->getClientMimeType(),
                            'client_original_extension' => $pic->getClientOriginalExtension(),
                            'error' => $pic->getError(),
                            'is_valid' => $pic->isValid(),
                            'is_file' => $pic->isFile(),
                            'is_readable' => $pic->isReadable(),
                            'is_writable' => $pic->isWritable(),
                            'file_info' => $pic->getFileInfo()
                            ])
                        ]);


                }
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();

                $picsError = true;
                // throw $e;            hacer que la transaccion completa se vea afectada
            }

            DB::commit();


            if ($picsError){
                // If there was an error creating the database record, delete the image from the file system
                foreach ($this->profile_pics as $index => $pic) {
                    $timestamp = str_replace(array(' ', ':', '-'), '', now());
                    $filename = $timestamp . "_" . $contact->id . "-" . $pic->getFilename();
                    $path = 'app/public/images/contacts_profile_pics/' . $filename;
                    if (Storage::exists($path)) Storage::delete($path);
                }
                if (count($link_pics) != 0){
                    foreach ($this->link_pics as $pic) {
                        $path = $pic->store . $pic->name;
                        if (Storage::exists($path)) Storage::delete($path);
                    }
                }
                $this->dispatchBrowserEvent('pics-error');
            }
            // if ($linkUserError) $this->dispatchBrowserEvent('pics-error');
            else $this->dispatchBrowserEvent('show-created-success');

        } catch (\Illuminate\Database\QueryException $e) {
            DB::rollBack();
            $this->dispatchBrowserEvent('ddbb-error', ['code' => $e->errorInfo[1], 'message' => $e->errorInfo[2]]);
        }






    }


    // -------------------------- DATOS DE PRUEBA  --------------------------
    private function datos_prueba()
    {
        // GENERALS
        $this->alias = 'El bebe';
        $this->name = 'Alberto';
        $this->middle_name = 'de Jesús';
        $this->first_lastname = 'Licea';
        $this->second_lastname = 'Vallejo';
        $this->about = 'Una pequeña descripción del contacto en cuestión.';
        $this->gender = 1;
        $this->prefix = 5;
        $this->ids = [
            ['type_id' => 1, 'value' => '00090120123'],
            ['type_id' => 2, 'value' => 'A1234567'],
        ];
        // $this->main_profile_pic = 0;
        // $this->profile_pics = [];

        // EMAILS
        $this->emails = [
            ['type_id' => '1', 'is_primary' => false, 'label' => 'Personal', 'value' => 'albertolicea00@outlook.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '3', 'is_primary' => true, 'label' => 'Personal', 'value' => 'albertolicea00@icloud.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '2', 'is_primary' => false, 'label' => 'Trabajo', 'value' => 'albertolicea00@gmail.com', 'about' => '', 'meta' => "{\"is_valid\":false}"],
        ];

        // PHONE AND CHATS
        $this->phones = [
            ['type_id' => 2, 'value' => '32292629', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32292629\",\"number\":\"+5332292629\",\"call_number\":\"+5332292629\",\"clean_number\":\"32292629\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 3, 'value' => '32271900', 'is_primary' => true, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32271900\",\"number\":\"+5332271900\",\"call_number\":\"+5332271900\",\"clean_number\":\"32271900\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 1, 'value' => '5615459878', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+1 5615459878\",\"number\":\"+15615459878\",\"call_number\":\"+15615459878\",\"clean_number\":\"5615459878\",\"country_code\":null,\"country_dial_code\":\"1\",\"country_iso2\":\"us\",\"country_name\":\"United States\"}"],
            ['type_id' => 6, 'value' => '354771264', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":false,\"value\":\"+53 54771264\",\"number\":\"+5354771264\",\"call_number\":\"+5354771264\",\"clean_number\":\"54771264\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
        ];
        $this->instant_messages = [
            ['type_id' => 2, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 1, 'label' => 'Personal', 'value' => '+5354771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"],
            ['type_id' => 3, 'label' => 'Trabajo', 'value' => 'soporteit@wateke.travel', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'label' => 'Ventas', 'value' => '+54771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];


        // RRSS AND WEBS
        $this->webs = [
            ['type_id' => 1, 'value' => 'albertos-blog.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'alberto.licea', 'about' => '', 'meta' => "{\"is_valid\":null}"],
            ['type_id' => 6, 'value' => 'wateke.travel', 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];
        $this->rrss = [
            ['type_id' => 4, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];


        // ADDRESS
        $this->address = [
            ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 1", 'state_id' => "286", 'zip_code' => "70100"],
            ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 2", 'state_id' => "286", 'zip_code' => "70100"],
        ];
        $this->address_line = [
            [
                ['label' => "Localidad", 'value' => "Centro"],
                ['label' => "Número", 'value' => "364"],
                ['label' => "Calle", 'value' => "Bembeta"],
                ['label' => "entre", 'value' => "Cielo"],
                ['label' => "y", 'value' => "20 de Mayo"],
            ],
            [
                ['label' => "Localidad", 'value' => "Centro"],
                ['label' => "Número", 'value' => "568"],
                ['label' => "Calle", 'value' => "Bembeta"],
                ['label' => "entre", 'value' => "Cielo"],
                ['label' => "y", 'value' => "20 de Mayo"],
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
            ['type_id' => 4, 'card_holder' => 'Alberto Licea', 'card_number' => "1234123412341234", 'is_credit' => true, 'about' => '', 'expiration_date' => date('Y-m-d', mktime(0, 0, 0, 11, 1, 24))],
            ['type_id' => 1, 'card_holder' => 'Alberto Licea', 'card_number' => "9087569325412563", 'is_credit' => false, 'about' => '', 'expiration_date' => date('Y-m-d', mktime(0, 0, 0, 7, 1, 25))],
            ['type_id' => 2, 'card_holder' => 'Alberto Licea', 'card_number' => "9562885966531257", 'is_credit' => false, 'about' => '', 'expiration_date' => date('Y-m-d', mktime(0, 0, 0, 3, 1, 24))],
        ];

        // OCUPATION

        // MORE
        $this->dates = [
            ['type_id' => '1', 'value' => '2000-05-16'],
            ['type_id' => '2', 'value' => '2011-04-25'],
        ];
        $this->publish_us = [
            ['type_id' => '1', 'value' => 'albertosblog.com', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '3', 'value' => 'tut12app.com', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => '2', 'value' => 'albertolicea00.com', 'meta' => "{\"is_valid\":true}"],
        ];





    }

}
