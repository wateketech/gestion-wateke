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
    public $prueba = 'hola';

    public $errorMessage;
    public $allStep = [
        0 => ['name' => 'general', 'is_filled' => false, 'next_step' => 'emails', 'pass_step' => null],
        1 => ['name' => 'emails', 'is_filled' => false, 'next_step' => 'phones', 'pass_step' => 'general'],
        2 => ['name' => 'phones', 'is_filled' => false, 'next_step' => 'chats', 'pass_step' => 'emails'],
        3 => ['name' => 'chats', 'is_filled' => false, 'next_step' => 'rrss', 'pass_step' => 'phones'],
        4 => ['name' => 'rrss', 'is_filled' => false, 'next_step' => 'webs', 'pass_step' => 'chats'],
        5 => ['name' => 'webs', 'is_filled' => false, 'next_step' => 'address', 'pass_step' => 'rrss'],
        6 => ['name' => 'address', 'is_filled' => false, 'next_step' => 'ocupation', 'pass_step' => 'webs'],
        7 => ['name' => 'ocupation', 'is_filled' => false, 'next_step' => 'more', 'pass_step' => 'address'],
        8 => ['name' => 'more', 'is_filled' => false, 'next_step' => 'resumen', 'pass_step' => 'ocupation'],
        9 => ['name' => 'resumen', 'is_filled' => false, 'next_step' => null, 'pass_step' => 'more'],
    ];
    public $passStep = [];
    public $currentStep = 'resumen';
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
    public $countries, $states, $cities;
    public $contact_address = [];
    public $address = [];
    public $address_max = 2;

    public $address_line = [];
    public $address_line_max = 5;



    // MORE
    public $date_types, $date_type;
    public $date_value;
    public $dates = [];
    public $dates_max = 3;

    public $publish_us_types, $publish_us_type;
    public $publish_us_value, $publish_us_about;
    public $publish_us = [];
    public $publish_us_max = 8;

    public $id_types;
    public $ids = [];
    public $id_max = 4;

    public $bank_accounts = [];

    // RESUMEN
    public $is_user_link = false;
    public $user_link_roles;
    private $user_link_password;
    public $user_link_role, $user_link_name, $user_link_email, $user_link_phone, $user_link_password_public, $user_link_password_check, $user_link_about;



    // ----------------------- RENDER --------------------------
    public function mount()
    {
        $this->genders = Genders::all()->where('enable', true);
        $this->gender = $this->genders->first()->id;
        $this->updatedGender();

        $this->email_types = EmailTypes::all()->where('enable', true);
        $this->phone_types = PhoneTypes::all()->where('enable', true);
        $this->instant_message_types = InstantMessageTypes::all()->where('enable', true);
        $this->rrss_types = RrssTypes::all()->where('enable', true);
        $this->web_types = WebTypes::all()->where('enable', true);
        $this->countries = Countries::all()->where('enable', true);
        $this->date_types = DateTypes::all()->where('enable', true);
        $this->publish_us_types = PublishUsTypes::all()->where('enable', true);
        $this->id_types = IdTypes::all()->where('enable', true);



        $this->emails[] = ['type_id' => null, 'label' => '', 'value' => null, 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'is_primary' => true, 'about' => '', 'extension' => ''];
        $this->instant_messages[] = ['type_id' => $this->instant_message_types[0]->id, 'label' => '', 'is_primary' => true, 'value' => '', 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        $this->dates[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->publish_us[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->ids[] = ['type_id' => $this->id_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];


        $this->address[] = [
            'name' => 'Casa',
            'city_id' => null,
            'geolocation' => null,
            'zip_code' => '',
            'country_id' => null,
            'state_id' => null
        ];
        // $this->address_line[0][] = ['label' => 'Localidad', 'value' => ''];
        $this->address_line[0][] = ['label' => 'Número', 'value' => ''];
        $this->address_line[0][] = ['label' => 'Calle', 'value' => ''];


        // $this->fakedata();
    }
    public function render()
    {
        return view('livewire.contacts.contacts.create');
    }

// ----------------------- FUNCTIONS --------------------------

    public function cleanURL($value){
        $cvalue = strtolower(trim($value));

        if (substr($cvalue, 0, 8) === "https://") $cvalue = substr($cvalue, 8);
        else if (substr($cvalue, 0, 7) === "http://") $cvalue = substr($cvalue, 7);
        else if (substr($cvalue, 0, 3) === "://") $cvalue = substr($cvalue, 3);
        else if (substr($cvalue, 0, 2) === "//") $cvalue = substr($cvalue, 2);

        return $cvalue;
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
            'phones.' . $index . '.value' => ['required',
                                            //'regex:/^(\+?\d{1,3}[-. ]?)?(\(?\d{3}\)?[-. ]?)?\d{3}[-. ]?\d{4}$/',
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
            //'phones.*.*.regex' => 'Este campo debe ser un teléfono válido',
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
            if ($fieldName === 'value') $this->webs[$index]['value'] = $this->cleanURL($this->webs[$index]['value']);
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
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'zip_code') $this->address[$index]['zip_code'] = trim($this->address[$index]['zip_code']);
            else if ($fieldName === 'name') $this->address[$index]['name'] = trim($this->address[$index]['name']);
        }

        $rules = [
            'address.' . $index . '.name' => 'required',
            'address.' . $index . '.country_id' => 'required',
            'address.' . $index . '.state_id' => [
                function ($attribute, $value, $fail) use ($index) {
                    if ($index != '*'){
                        $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                        if ($country && $country->states->count() > 0 && empty($value))
                            $fail('El campo es obligatorio.');
                    }else{
                        foreach ($this->address as $index => $address) {
                            $country = Countries::where('enable', true)->find($address['country_id']);
                            if ($country && $country->states->count() > 0 && empty($value)) {
                                $fail('El campo es requerido si está disponible');
                            }
                        }
                    }
                }
            ],
            'address.' . $index . '.city_id' => [
                function ($attribute, $value, $fail) use ($index) {
                    if ($index != '*'){
                        $country = Countries::where('enable', true)->find($this->address[$index]['country_id']);
                        $state = $country ? $country->states()->find($this->address[$index]['state_id']) : null;
                        if ($state && $state->cities->count() > 0 && empty($this->address[$index]['city_id']))
                            $fail('El campo es obligatorio.');
                    }else{
                        foreach ($this->address as $index => $address) {
                            $country = Countries::where('enable', true)->find($address['country_id']);
                            $state = $country ? $country->states()->find($address['state_id']) : null;
                            if ($state && $state->cities->count() > 0 && empty($address['city_id'])) {
                                $fail('El campo es requerido si está disponible');
                            }
                        }
                    }
                }
            ],
        ];
        $messages = [
            'address.*.*.required' => 'El campo es obligatorio',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'address.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }
    }
    public function validate_address_lines($fieldName = null, $index_a = '*', $index_l = '*'){
        if ($fieldName !== null){
            if ($index_a != '*' && $index_l != '*' ){
                if ($fieldName === 'label') $this->address_line[$index_a][$index_l]['label'] = trim($this->address_line[$index_a][$index_l]['label']);
                else if ($fieldName === 'value') $this->address_line[$index_a][$index_l]['value'] = trim($this->address_line[$index_a][$index_l]['value']);
            }
        }

        $rules = [
            'address_line.' . $index_a . '.' . $index_l . '.label' => 'required',
            'address_line.' . $index_a . '.' . $index_l . '.value' => 'required',
        ];
        $messages =[
            'address_line.*.*.*.required' => 'El campo es obligatorio',
        ];

        if ($fieldName !== null){
            if ($index_a != '*' && $index_l != '*' ){
                $field = 'address_line.' . $index_a . '.' . $index_l . '.' . $fieldName;
                $this->validateOnly($field, $rules, $messages);
            }
            else if($index_a != '*'){
                $field = 'address_line.' . $index_a . '.*.' . $fieldName;
                $this->validateOnly($field, $rules, $messages);
            }
        }else{
            $this->validate($rules, $messages);
        }
    }

    public function validate_ocupation($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){}

        $rules = [
        ];
        $messages = [
        ];

        if ($index != '*' && $fieldName !== null){}
        else{}
    }

    public function validate_dates($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){}

        $rules = [
            'dates.' . $index . '.value' => ['required', 'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('Y-m-d'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('Y-m-d'),
            ],
            'dates.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
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
        ];
        $messages = [
            'dates.*.*.required' => 'El campo es obligatorio',
            'dates.*.*.string' => 'Este campo debe ser de tipo texto',
            'dates.*.*.integer' => 'Este campo debe ser de tipo numerico',
            'dates.*.*.date' => 'El campo debe ser una fecha válida',
            'dates.*.*.before_or_equal' => 'La fecha debe estar en un rango coherente.',
            'dates.*.*.after_or_equal' => 'La fecha debe estar en un rango coherente.',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'dates.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }
    }
    public function validate_publish_us($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'value') $this->publish_us[$index]['value'] = $this->cleanURL($this->publish_us[$index]['value']);
        }

        $rules = [
            'publish_us.' . $index . '.type_id' => ['required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.' . $index . '.value' => [ 'required', 'min:5', 'max:50',
                function ($attribute, $value, $fail) {
                    $value = 'https://' . $value;
                    if (!filter_var($value, FILTER_VALIDATE_URL)) {
                        $fail('El campo debe ser una URL válida.');
                    }
                },
                function ($attribute, $value, $fail) {
                    $url = collect($this->publish_us);
                    $duplicates = $url->filter(function ($item) use ($value) {
                        return $item['value'] == $value;
                    })->where('id_type', $url->pluck('type_id')->first())->count();

                    if ($duplicates > 1) {
                        $fail('Las url no pueden repetirse con un mismo tipo');
                    }
                }
            ],
        ];
        $messages = [
            'publish_us.*.*.required' => 'El campo es obligatorio',
            'publish_us.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'publish_us.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'publish_us.*.*.unique' => 'Este sitio ya está en uso por otro contacto',
            'publish_us.*.*.string' => 'Este campo debe ser de tipo texto',
            'publish_us.*.*.integer' => 'Este campo debe ser de tipo numerico',
            'publish_us.*.*.url' => 'El campo debe ser una url válida',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'publish_us.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }
    }
    public function validate_ids($fieldName = null, $index = '*'){
        if ($index != '*' && $fieldName !== null){
            if ($fieldName === 'value') $this->ids[$index]['value'] = ucwords(strtoupper(trim($this->ids[$index]['value'])));
        }

        $rules = [
            'ids.' . $index . '.type_id' => ['required', Rule::in($this->id_types->pluck('id')->toArray()),],
            'ids.' . $index . '.value' => [ 'required', 'string', 'min:5', 'max:20',
                Rule::unique('contact_ids', 'value', 'type_id'),
                function ($attribute, $value, $fail) {
                    $ids = array_column($this->ids, 'value');
                    if (count($ids) != count(array_unique($ids))) {
                        $fail('Los valores no pueden repetirse');
                    }
                },
            ]
        ];
        $messages = [
            'ids.*.*.required' => 'El campo es obligatorio',
            'ids.*.*.max' => 'El campo no puede tener más de :max caracteres',
            'ids.*.*.min' => 'El campo no puede tener menos de :min caracteres',
            'ids.*.*.unique' => 'Esta identificación ya está en uso por otro contacto',
            'ids.*.*.string' => 'Este campo debe ser de tipo texto',
            'ids.*.*.integer' => 'Este campo debe ser de tipo numerico',
            'ids.*.*.url' => 'El campo debe ser una url válida',
        ];

        if ($index != '*' && $fieldName !== null){
            $field = 'ids.' . $index . '.' . $fieldName;
            $this->validateOnly($field, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }
    }






    public function validate_bank_accounts($fieldName = null, $index = '*'){

    }
    public function validate_bank_account_banks($fieldName = null, $index = '*'){

    }

    public function validate_extra($fieldName = null){
        if ($fieldName !== null){
            if ($fieldName === 'alias') $this->alias = ucwords(strtolower(trim($this->alias)));
        }

        $rules =[
            'alias' => 'nullable|min:1|max:50',
            'about' => 'nullable|min:3|max:250',
        ];
        $messages = [
            '*.required' => 'El campo es obligatorio',
            '*.max' => 'El campo no puede tener más de :max caracteres',
            '*.min' => 'El campo no puede tener menos de :min caracteres',
            '*.unique' => 'Esta usuario ya está en uso por otro contacto',
            '*.string' => 'Este campo debe ser de tipo texto',
        ];


        if ($fieldName !== null){
            $this->validateOnly($fieldName, $rules, $messages);
        }else{
            $this->validate($rules, $messages);
        }
    }

// -------------------------- STEPS -------------------------- //
    private function backStep($passStep, $currentStep, $time = 700){
        $this->currentStep = $currentStep;
    }
    private function nextStep($passStep, $currentStep, $time = 2000){
        if (!in_array($currentStep, $this->passStep)) {
            // $this->dispatchBrowserEvent('coocking-time', ['time' => $time]);
        }
        $this->passStep[] = $passStep;
        $this->currentStep = $currentStep;
    }
    private function omitStep($currentStep, $time = 1000){
        // $this->dispatchBrowserEvent('coocking-time', ['time' => $time]);
        $this->currentStep = $currentStep;
    }
    public function continueStep($time = 600){
        // $this->dispatchBrowserEvent('coocking-time', ['time' => $time]);
        $unmakedTab = array_filter($this->allStep, function($step) {
            return array_search($step['name'], $this->passStep) === false;
        });
        $unmakedTab = array_values($unmakedTab);
        //$unmakedTab = array_diff($this->allStep, $this->passStep);

        $this->currentStep = reset($unmakedTab)['name'];
        //dd(reset($unmakedTab)['name']);
    }
    public function canOmitStep($currentStep = null){
        if ($currentStep === null) $currentStep = $this->currentStep;

        return false;
    }
    public function canContinueStep($currentStep = null){
        $can_continue = false;
        if ($currentStep === null) $currentStep = $this->currentStep;

        $next_step = $this->getNextStep($currentStep)['name'];
        if (in_array($next_step, $this->passStep)) $can_continue = true;

        return $can_continue;
        // return false;
    }
    public function getNextStep($currentStep = null){
        if ($currentStep === null) $currentStep = $this->currentStep;
        // $current_step_key = array_search($currentStep, array_column($this->allStep, 'name'));
        $current_step_key = null;
        foreach ($this->allStep as $key => $value) {
            if ($value['name'] === $currentStep) {
                $current_step_key = $key;
                break;
            }
        }

        $next_step_key = $current_step_key + 1;
        $next_step = $this->allStep[$next_step_key];

        return $next_step;
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
        // if (strlen($this->name) === 0 &&
        //     strlen($this->middle_name) === 0 &&
        //     strlen($this->first_lastname) === 0 &&
        //     strlen($this->second_lastname) === 0 &&
        // ){
        //    $this->stepSubmit_general_omit();
        // }
        // else{
            $this->validate_general();
            $this->nextStep('general', 'emails');
        // }
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
        // if (count($this->emails) === 0) $this->stepSubmit_emails_omit();
        // else{
            $this->validate_emails();
            $this->nextStep('emails', 'phones');
        // }
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
        if (count($this->phones) >= 1) $this->validate_phones(null, $index);

        if (count($this->phones) < $this->phones_max) {
            if (count($this->phones)  === 0 ) {
                $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'extension' => '', 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":null}"];
            }else{
                $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'extension' => '', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"];
            }
        }
        $this->dispatchBrowserEvent('intl-tel-input', ['index' => $index + 1]);
    }
    public function removePhone($index){
        if (count($this->phones) >= 1){
            $remove_primary = false;
            if ($this->phones[$index]['is_primary']) $remove_primary = true;
        }

        unset($this->phones[$index]);
        $this->phones = array_values($this->phones);
        if (count($this->phones) >= 1){
            if ($remove_primary) $this->selectPhoneIsPrimary(0);
        }
        // refrescar componente visual
        $this->dispatchBrowserEvent('intl-tel-input-remove-phone', ['phones' => $this->phones]);
    }


    public function stepSubmit_phones_back(){
        $this->backStep('phones', 'emails');
    }
    public function stepSubmit_phones_omit(){
        $this->phones = [];
        $this->omitStep('chats');
    }
    public function stepSubmit_phones_next(){
        if (count($this->phones) === 0) $this->stepSubmit_phones_omit();
        else{
            $this->validate_phones();
            $this->nextStep('phones', 'chats');
        }
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
        if (count($this->instant_messages) >= 1) $this->validate_chats(null, $index);

        if (count($this->instant_messages) < $this->instant_messages_max) {
            if (count($this->instant_messages)  === 0 ) {
                $this->instant_messages[] = ['type_id' => $this->phone_types[0]->id, 'label' => '', 'value' => '', 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":null}"];
            }else{
                $this->instant_messages[] = ['type_id' => $this->phone_types[0]->id, 'label' => '', 'value' => '', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"];
            }
        }
    }
    public function removeInstantMessages($index){
        if (count($this->instant_messages) >= 1){
            $remove_primary = false;
            if ($this->instant_messages[$index]['is_primary']) $remove_primary = true;
        }

        unset($this->instant_messages[$index]);
        $this->instant_messages = array_values($this->instant_messages);
        if (count($this->instant_messages) >= 1){
            if ($remove_primary) $this->selectInstantMessageIsPrimary(0);
        }
    }

    public function stepSubmit_chats_back(){
        $this->backStep('chats', 'phones');
    }
    public function stepSubmit_chats_omit(){
        $this->instant_messages = [];
        $this->omitStep('rrss');
    }
    public function stepSubmit_chats_next(){
        if (count($this->instant_messages) === 0) $this->stepSubmit_chats_omit();
        else{
            $this->validate_chats();
            $this->nextStep('chats', 'rrss');
        }
    }

// -------------------------- STEP RRSS -------------------------- //

    public function addRrss($index){
        if (count($this->rrss) >= 1) $this->validate_rrss(null, $index);

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
        if (count($this->rrss) === 0) $this->stepSubmit_rrss_omit();
        else{
            $this->validate_rrss();
            $this->nextStep('rrss', 'webs');
        }
    }

// -------------------------- STEP WEBS -------------------------- //
    public function selectWebIsPrimary($index){
        // NO DISPONIBLE PARA CONTACTOS
    }

    public function addWeb($index){
        if (count($this->webs) >= 1) $this->validate_webs(null, $index);

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
        if (count($this->webs) === 0) $this->stepSubmit_webs_omit();
        else{
            $this->validate_webs();
            $this->nextStep('webs', 'address');
        }
    }

// -------------------------- STEP ADDRESS -------------------------- //
    public function updateCountry($index_add, $value){
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
        $this->validate_address('country_id', $index_add);
    }
    public function updateState($index_add, $value){
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
        $this->validate_address('state_id', $index_add);
    }
    public function updateCity($index_add, $value){
        $this->address[$index_add]['city_id'] = $value;
        $this->validate_address('city_id', $index_add);
    }


    public function addAddress($index){
        if (count($this->address) >= 1){
            $this->validate_address(null, $index);
            $this->validate_address_lines(null, $index);
        }

        if (count($this->address) < $this->address_max) {
            $this->address[] = [
                'name' => '# ' . ($index + 2),
                'citie_id' => null,
                'geolocation' => null,
                'zip_code' => '',
                'country_id' => null,
                'state_id' => null
            ];
            // $this->address_line[$index + 1][] = ['label' => 'Localidad', 'value' => ''];
            $this->address_line[$index + 1][] = ['label' => 'Número', 'value' => ''];
            $this->address_line[$index + 1][] = ['label' => 'Calle', 'value' => ''];
        }
        $this->dispatchBrowserEvent('init-select2-countries', ['index_add' => $index + 1]);
    }
    public function removeAddress($index){
        unset($this->address_line[$index]);
        unset($this->address[$index]);
        $this->address_line = array_values($this->address_line);
        $this->address = array_values($this->address);

        // refrescar componente visual
        $this->dispatchBrowserEvent('select2-remove-address', ['address' => $this->address]);
    }


    public function addAddressLine($index_l, $index_add){
        $this->validate_address_lines(null, $index_l, $index_add);

        if (count($this->address_line[$index_add]) < $this->address_line_max) {
            $this->address_line[$index_add][] = ['label' => '', 'value' => ''];
        }
    }
    public function removeAddressLine($index_l, $index_add){
        unset($this->address_line[$index_add][$index_l]);
        $this->address_line[$index_add] = array_values($this->address_line[$index_add]);
    }

    public function stepSubmit_address_back(){
        $this->backStep('address', 'webs');
    }
    public function stepSubmit_address_omit(){
        $this->address = [];
        $this->address_line = [];
        $this->omitStep('ocupation');
    }
    public function stepSubmit_address_next(){
        if (count($this->address) === 0) $this->stepSubmit_address_omit();
        else{
            $this->validate_address();
            $this->validate_address_lines();
            $this->nextStep('address', 'ocupation');
        }
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

    public function addDate($index){
        if (count($this->dates) >= 1) $this->validate_dates(null, $index);

        if (count($this->dates) < $this->dates_max) {
            $this->dates[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeDate($index){
        unset($this->dates[$index]);
        $this->dates = array_values($this->dates);
    }


    public function addPublishUs($index){
        if (count($this->publish_us) >= 1) $this->validate_publish_us(null, $index);

        if (count($this->publish_us) < $this->publish_us_max) {
            $this->publish_us[] = ['type_id' => $this->publish_us_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removePublishUs($index){
        unset($this->publish_us[$index]);
        $this->publish_us = array_values($this->publish_us);
    }


    public function addId($index){
        if (count($this->ids) >= 1) $this->validate_ids(null, $index);

        if (count($this->ids) < $this->id_max) {
            $this->ids[] = ['type_id' => $this->id_types->first()->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        }
    }
    public function removeId($index){
        unset($this->ids[$index]);
        $this->ids = array_values($this->ids);
    }


    public function stepSubmit_more_back(){
        $this->backStep('more', 'ocupation');
    }
    public function stepSubmit_more_omit(){
        $this->dates = [];
        $this->publish_us = [];
        $this->ids = [];
        // $this->bank_accounts = [];
        // $this->bank_account_banks = [];
        $this->about = null;
        $this->alias = null;
        $this->omitStep('resumen');
    }
    public function stepSubmit_more_next(){
        if (count($this->dates) === 0 &&
            count($this->publish_us) === 0 &&
            count($this->ids) === 0 &&
            strlen($this->about) === 0 &&
            strlen($this->alias) === 0
        ){
            $this->stepSubmit_more_omit();
        }
        else{
            $this->validate_dates();
            $this->validate_publish_us();
            $this->validate_ids();
            //$this->validate_bank_accounts();
            //$this->validate_bank_account_banks();
            $this->validate_extra();
            $this->nextStep('more', 'resumen');
        }
    }
// -------------------------- STEP RESUMEN -------------------------- //
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

    public function stepSubmit_resumen_back(){
        $this->backStep('resumen', 'more');
    }
    public function stepSubmit_resumen_review(){
        $this->backStep('resumen', 'general');
    }
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

    public function existAdress($index)
    {
        // si ya existe la direccion hacer merge entre ellas, coger el id de las ya creadas y duplicarlas
        // sugerencia de direcciones por maxima coincidencia y redundancia en bbdd (a las q mas se repitan y a los patrones iguales)
    }
    public function existAdressLine($index)
    {
        // si ya existe la direccion hacer merge entre ellas, coger el id de las ya creadas y duplicarlas
        // sugerencia de direcciones por maxima coincidencia y redundancia en bbdd (a las q mas se repitan y a los patrones iguales)
    }




































    // -------------------------- STEP RESUMEN --------------------------


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
            // $contact->emails()->createMany($this->emails);
            // $contact->phones()->createMany($this->phones);
            // $contact->instant_messages()->createMany($this->instant_messages);
            // $contact->webs()->createMany($this->webs);
            // $contact->rrss()->createMany($this->rrss);
            // $contact->dates()->createMany($this->dates);
            // $contact->publish_us()->createMany($this->publish_us);
//
            // $address = $contact->address()->createMany($this->address);
            // for ($i = 0; $i < count($address); $i++) {
            //     $address[$i]->lines()->createMany($this->address_line[$i]);
            // }

            // PROXIMAMENTE ANALSAR COMO SE ALMACENARAN LOS BANCOS Y SU RELACION CON LAS CUENTAS BANCARIAS (ya que abrían bancos que no serian entidad y otros q si )
            // $contact->bank_accounts()->createMany($this->bank_accounts);

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










    private function fakedata(){
        // $this->emails[] = ['type_id' => null, 'label' => '', 'value' => null, 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->phones[] = ['type_id' => $this->phone_types[0]->id, 'value_meta' => '{}', 'value' => '', 'is_primary' => true, 'about' => '', 'extension' => ''];
        // $this->instant_messages[] = ['type_id' => $this->instant_message_types[0]->id, 'label' => '', 'is_primary' => true, 'value' => '', 'about' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->rrss[] = ['type_id' => $this->rrss_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->webs[] = ['type_id' => $this->web_types[0]->id, 'value' => '', 'label' => null, 'about' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->dates[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->publish_us[] = ['type_id' => $this->date_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];
        // $this->ids[] = ['type_id' => $this->id_types[0]->id, 'value' => '', 'meta' => "{\"is_valid\":null}"];


        $this->emails = [];
        $this->phones = [];
        $this->instant_messages = [];
        $this->rrss = [];
        $this->webs = [];
        $this->dates = [];
        $this->publish_us = [];
        $this->ids = [];



        $this->alias = 'El bebe';
        $this->name = 'Alberto';
        $this->middle_name = 'de Jesús';
        $this->first_lastname = 'Licea';
        $this->second_lastname = 'Vallejo';
        $this->about = 'Una pequeña descripción del contacto en cuestión.';
        // $this->gender = 1;
        // $this->prefix = 5;
        //$this->ids = [
        //    ['type_id' => 1, 'value' => '00090120123'],
        //    ['type_id' => 2, 'value' => 'A1234567'],
        //];



        // $this->address = [
        //     ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 1", 'state_id' => "286", 'zip_code' => "70100"],
        //     ['city_id' => "21825", 'country_id' => "56", 'geolocation' => null, 'name' => "Casa 2", 'state_id' => "286", 'zip_code' => "70100"],
        // ];
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





        $this->emails = [
            ['type_id' => '1', 'is_primary' => false, 'label' => null, 'value' => 'albertolicea00@outlook.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '1', 'is_primary' => true, 'label' => '', 'value' => 'albertolicea00@icloud.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => '2', 'is_primary' => false, 'label' => 'Ventas', 'value' => 'albertolicea00@gmail.com', 'about' => '', 'meta' => "{\"is_valid\":false}"],
        ];

        $this->phones = [
            ['type_id' => 1, 'value' => '32292629', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32292629\",\"number\":\"+5332292629\",\"call_number\":\"+5332292629\",\"clean_number\":\"32292629\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 1, 'value' => '32271900', 'is_primary' => true, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+53 32271900\",\"number\":\"+5332271900\",\"call_number\":\"+5332271900\",\"clean_number\":\"32271900\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
            ['type_id' => 1, 'value' => '5615459878', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":true,\"value\":\"+1 5615459878\",\"number\":\"+15615459878\",\"call_number\":\"+15615459878\",\"clean_number\":\"5615459878\",\"country_code\":null,\"country_dial_code\":\"1\",\"country_iso2\":\"us\",\"country_name\":\"United States\"}"],
            ['type_id' => 1, 'value' => '354771264', 'is_primary' => false, 'about' => '', 'value_meta' => "{\"is_valid\":false,\"value\":\"+53 54771264\",\"number\":\"+5354771264\",\"call_number\":\"+5354771264\",\"clean_number\":\"54771264\",\"country_code\":null,\"country_dial_code\":\"53\",\"country_iso2\":\"cu\",\"country_name\":\"Cuba\"}"],
        ];

        $this->instant_messages = [
            ['type_id' => 2, 'label' => null, 'value' => '+5354771264', 'is_primary' => true, 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 1, 'label' => '', 'value' => '+5354771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":null}"],
            ['type_id' => 3, 'label' => 'Soporte', 'value' => 'soporteit@wateke.travel', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'label' => 'Ventas', 'value' => '+54771264', 'is_primary' => false, 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];

        $this->webs = [
            ['type_id' => 1, 'value' => 'albertos-blog.com', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'alberto.licea', 'about' => '', 'meta' => "{\"is_valid\":Null}"],
            ['type_id' => 6, 'value' => 'wateke.travel', 'about' => '', 'meta' => "{\"is_valid\":false}"],
        ];
        $this->rrss = [
            ['type_id' => 4, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":false}"],
            ['type_id' => 1, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
            ['type_id' => 2, 'value' => 'albertolicea00', 'about' => '', 'meta' => "{\"is_valid\":true}"],
        ];


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
