<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
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
    public $prueba, $datos_prueba;
//    public $available_id_types = [];

    public $errorMessage;
    public $passStep = [];
    public $currentStep = 'more' ; //'general';

    protected $rules = [

    ];

    public $labels_type = ['Personal', 'Trabajo'];
    // GENERALS
    public $alias, $name, $middle_name, $first_lastname, $second_lastname, $about;
    public $id_types, $id_type;
    public $id_value;
    public $ids = [];
    public $id_max = 4;
    public $main_profile_pic;
    public $profile_pics = [];

    // EMAILS
    public $email_types, $email_type;
    public $email_value, $email_is_personal, $email_about;
    public $emails = [];
    public $emails_max = 10;

    // PHONE AND CHATS
    public $phone_types, $phone_type;
    public $phone_value, $phone_is_personal, $phone_about;
    public $phones = [];
    public $phones_max = 8;

    public $instant_message_types, $instant_message_type;
    public $instant_message_value, $instant_message_is_personal, $instant_message_about;
    public $instant_messages = [];
    public $instant_messages_max = 8;


    // RRSS AND WEBS
    public $rrss_types, $rrss_type;
    public $rrss_value, $rrss_is_personal, $rrss_about;
    public $rrss = [];
    public $rrss_max = 8;

    public $web_types, $web_type;
    public $web_value, $web_is_personal, $web_about;
    public $webs = [];
    public $webs_max = 8;


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

        $this->id_type = $this->id_types->first()->id;
        $this->email_type = $this->email_types->first()->id;
        $this->phone_type = $this->phone_types->first()->id;
        $this->instant_message_type = $this->instant_message_types->first()->id;
        $this->rrss_type = $this->rrss_types->first()->id;
        $this->web_type = $this->web_types->first()->id;
        $this->bank_account_type = $this->bank_account_types->first()->id;
        $this->date_type = $this->date_types->first()->id;
        $this->publish_us_type = $this->publish_us_types->first()->id;

        $this->ids[] = ['id_type' => $this->id_types[0]->id, 'id_value' => ''];
        $this->emails[] = ['id_type' => $this->email_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => 1, 'about' => '',  ];
        $this->phones[] = ['id_type' => $this->phone_types[0]->id, 'value_meta' => '', 'value' => '', 'is_primary' => 1, 'about' => '',  ];
        $this->instant_messages[] = ['id_type' => $this->phone_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'about' => '',  ];
        $this->rrss[] = ['id_type' => $this->rrss_types[0]->id, 'value' => '', 'about' => '',  ];
        $this->webs[] = ['id_type' => $this->web_types[0]->id, 'value' => '', 'about' => '',  ];
        $this->dates[] = ['id_type' => $this->date_types[0]->id, 'value' => ''];
        // $this->publish_us[] = ['id_type' => $this->date_types[0]->id, 'value' => ''];



        $this->datos_prueba();
    }
    public function render()
    {
        return view('livewire.contacts.contacts.create');
    }

// ----------------------- flujo STEPS --------------------------

// -------------------------- STEP GENERALS --------------------------
    public function addId($index){
        // dd($this->ids[$index]['id_value']);
        $this->validate([
            'ids.*.id_type' => [ 'required','integer', Rule::in($this->id_types->pluck('id')->toArray()),],
            'ids.*.id_value' => 'required|string',
                'ids.'.$index.'.id_value' => ['required',
                function ($attribute, $value, $fail) {
                        $ids = array_column($this->ids, 'id_value');
                        if (count($ids) != count(array_unique($ids))) {
                            $fail('Los valores no pueden repetirse');
                        }
                    }
                ]
            ],[
                'ids.*.id_type.required' => 'El campo es obligatorio',
                'ids.*.id_value.required' => 'El campo es obligatorio',
            ]);
        if (count($this->ids) < $this->id_max) {
            $this->ids[] = ['id_type' => $this->id_types->first()->id, 'id_value' => ''];
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
            'main_profile_pic' => ['required', 'integer', 'numeric', 'min:0', 'max:' . count($this->profile_pics)],
            'ids' => 'required|array',
            'ids.*.id_value' => ['required', 'string',
                function ($attribute, $value, $fail) {
                        $ids = array_column($this->ids, 'id_value');
                        if (count($ids) != count(array_unique($ids))) {
                            $fail('Los valores no pueden repetirse');
                        }
                    }
                ],
            'ids.*.id_type' => [ 'required','integer', Rule::in($this->id_types->pluck('id')->toArray()),],
        ],[
            '*.required' => 'El campo es obligatorio',
            'ids.*.id_value.required' => 'El campo es obligatorio',
            '*.max' => 'El campo no puede tener más de :max caracteres',
            '*.min' => 'El campo no puede menos más de :min caracteres',
        ]);
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'general';
        $this->currentStep = 'emails';
    }

// -------------------------- STEP EMAILS --------------------------
    public function addEmail($index){
        $this->validate([
            'emails.*.is_primary' => '',
            'emails.*.id_type' => [ 'required','integer', Rule::in($this->email_types->pluck('id')->toArray()),],
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
            $this->emails[] = ['id_type' => $this->email_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => 0, 'about' => '',  ];
        }
    }

    public function removeEmail($index){
        unset($this->emails[$index]);
        $this->emails = array_values($this->emails);
    }
    public function stepSubmit_emails(){
        $this->validate([
            'emails' => 'required|array',
            'emails.*.is_primary' => '',
            'emails.*.id_type' => [ 'required','integer', Rule::in($this->email_types->pluck('id')->toArray()),],
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
                '*.required' => 'El campo es obligatorio',
                'emails.*.*.required' => 'El campo es obligatorio',
                'emails.*.*.email' => 'El campo debe ser un email',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);
        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'emails';
        $this->currentStep = 'phone_chats';
    }
// -------------------------- STEP PHONE AND CHATS --------------------------
    public function addPhone($index){
        $this->validate([
            'phones.*.is_primary' => '',
            'phones.*.id_type' => [ 'required','integer', Rule::in($this->phone_types->pluck('id')->toArray()),],
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
            $this->phones[] = ['id_type' => $this->phone_types[0]->id, 'value_meta' => '', 'value' => '', 'is_primary' => 0, 'about' => '',  ];
        }
    }

    public function removePhone($index){
        unset($this->phones[$index]);
        $this->phones = array_values($this->phones);
    }


    public function addInstantMessages($index){
        $this->validate([
            'instant_messages.*.is_primary' => '',
            'instant_messages.*.id_type' => [ 'required', Rule::in($this->instant_message_types->pluck('id')->toArray()),],
            'instant_messages.*.label' => ['required', Rule::in($this->labels_type),],
            'instant_messages.*.about' => '',
            'instant_messages.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $instantMessages = collect($this->instant_messages);
                        $duplicates = $instantMessages->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $instantMessages->pluck('id_type')->first())->count();

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
            $this->instant_messages[] = ['id_type' => $this->phone_types[0]->id, 'label' => $this->labels_type[0], 'value' => '', 'is_primary' => 0, 'about' => '',  ];
        }
    }

    public function removeInstantMessages($index){
        unset($this->instant_messages[$index]);
        $this->instant_messages = array_values($this->instant_messages);
    }


    public function stepSubmit_phone_chats(){
        $this->validate([
            'phones.*.is_primary' => '',
            'phones.*.id_type' => [ 'required','integer', Rule::in($this->phone_types->pluck('id')->toArray()),],
            'phones.*.about' => '',
            'phones.*.value' => ['required',
                function ($attribute, $value, $fail) {
                        $phones = array_column($this->phones, 'value');
                        if (count($phones) != count(array_unique($phones))) {
                            $fail('Los números de teléfonos no pueden repetirse');
                        }
                    }
                ],
            'instant_messages.*.is_primary' => '',
            'instant_messages.*.id_type' => [ 'required','integer', Rule::in($this->instant_message_types->pluck('id')->toArray()),],
            'instant_messages.*.label' => ['required', Rule::in($this->labels_type),],
            'instant_messages.*.about' => '',
            'instant_messages.*.value' => ['required',
                function ($attribute, $value, $fail) {
                    $instantMessages = collect($this->instant_messages);
                    $duplicates = $instantMessages->filter(function ($item) use ($value) {
                            return $item['value'] == $value;
                        })->where('id_type', $instantMessages->pluck('id_type')->first())->count();

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


        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'phone_chats';
        $this->currentStep = 'rrss_web';
    }
// -------------------------- STEP RRSS AND WEBS --------------------------
    public function addWeb($index){
        $this->validate([
            'webs.*.id_type' => [ 'required','integer', Rule::in($this->web_types->pluck('id')->toArray()),],
            'webs.*.about' => '',
            'webs.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $webs = collect($this->webs);
                        $duplicates = $webs->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $webs->pluck('id_type')->first())->count();

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
            $this->webs[] = ['id_type' => $this->web_types[0]->id, 'value' => '', 'about' => '',  ];
        }
    }

    public function removeWeb($index){
        unset($this->webs[$index]);
        $this->webs = array_values($this->webs);
    }


    public function addRrss($index){
        $this->validate([
            'rrss.*.id_type' => [ 'required', Rule::in($this->rrss_types->pluck('id')->toArray()),],
            'rrss.*.about' => '',
            'rrss.' . $index . '.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $rrss = collect($this->rrss);
                        $duplicates = $rrss->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $rrss->pluck('id_type')->first())->count();

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
            $this->rrss[] = ['id_type' => $this->rrss_types[0]->id, 'value' => '', 'about' => '',  ];
        }
    }

    public function removeRrss($index){
        unset($this->rrss[$index]);
        $this->rrss = array_values($this->rrss);
    }


    public function stepSubmit_rrss_web(){
        $this->validate([
            'webs.*.id_type' => [ 'required','integer', Rule::in($this->web_types->pluck('id')->toArray()),],
            'webs.*.about' => '',
            'webs.*.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $webs = collect($this->webs);
                        $duplicates = $webs->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $webs->pluck('id_type')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las webs no pueden repetirse con un mismo tipo');
                        }
                    }
                ],
            'rrss.*.id_type' => [ 'required', Rule::in($this->rrss_types->pluck('id')->toArray()),],
            'rrss.*.about' => '',
            'rrss.*.value' => ['required',
                    function ($attribute, $value, $fail) {
                        $rrss = collect($this->rrss);
                        $duplicates = $rrss->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $rrss->pluck('id_type')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las redes sociales no pueden repetirse con un mismo tipo');
                        }
                    }
                ],
            ],[
                '*.required' => 'El campo es obligatorio',
                'webs.*.*.required' => 'El campo es obligatorio',
                'rrss.*.*.required' => 'El campo es obligatorio',
                '*.max' => 'El campo no puede tener más de :max caracteres',
                '*.min' => 'El campo no puede menos más de :min caracteres',
            ]);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
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
    public function addDate($index){
        if (count($this->dates) >= 1 ) {
        $this->validate([
            'dates.' . $index . '.value' => ['required', 'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('Y-m-d'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('Y-m-d'),
            ],
            'dates.' . $index . '.id_type' => [ 'required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
                    function ($attribute, $value, $fail) {
                        // Obtener los valores de id_type de todos los elementos de dates
                        $id_types = array_column($this->dates, 'id_type');

                        // Obtener el índice del elemento actual que se está validando
                        $index = str_replace('dates.', '', $attribute);
                        $index = str_replace('.id_type', '', $index);

                        // Eliminar el elemento actual de la matriz de id_type
                        unset($id_types[$index]);

                        // Verificar si el valor de id_type se repite en la matriz de id_type restante
                        if (in_array($value, $id_types)) {
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
            $this->dates[] = ['id_type' => $this->date_types[0]->id, 'value' => '', ];
        }
    }

    public function removeDate($index){
        unset($this->dates[$index]);
        $this->dates = array_values($this->dates);
    }

    public function addPublishUs($index){
        if (count($this->publish_us) >= 1 ) {
        $this->validate([
            'publish_us.' . $index . '.id_type' => [ 'required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.' . $index . '.value' => [ 'required', 'url',
                    function ($attribute, $value, $fail) {
                        $url = collect($this->publish_us);
                        $duplicates = $url->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $url->pluck('id_type')->first())->count();

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
            $this->publish_us[] = ['id_type' => $this->publish_us_types[0]->id, 'value' => '', ];
        }
    }

    public function removePublishUs($index){
        unset($this->publish_us[$index]);
        $this->publish_us = array_values($this->publish_us);
    }


    public function stepSubmit_more(){
        $this->validate([
            'dates.' => '',
            'dates.*.value' => ['required', 'date',
                // 'before_or_equal:' . Carbon::now()->subYears(1)->format('d-m-Y'),
                // 'after_or_equal:' . Carbon::now()->subYears(118)->format('d-m-Y'),
                ],
            'dates.*.id_type' => [ 'required', 'integer', Rule::in($this->phone_types->pluck('id')->toArray()),
                    function ($attribute, $value, $fail) {
                        $id_types = array_column($this->dates, 'id_type');
                        $index = str_replace('dates.', '', $attribute);
                        $index = str_replace('.id_type', '', $index);
                        unset($id_types[$index]);
                        if (in_array($value, $id_types)) {
                            $fail('El motivo de la fecha no puede repetirse.');
                        }
                    }
                ],
            'publish_us' => '',
            'publish_us.*.id_type' => [ 'required', 'integer', Rule::in($this->publish_us_types->pluck('id')->toArray())],
            'publish_us.*.value' => [ 'required', 'url',
                    function ($attribute, $value, $fail) {
                        $url = collect($this->publish_us);
                        $duplicates = $url->filter(function ($item) use ($value) {
                                return $item['value'] == $value;
                            })->where('id_type', $url->pluck('id_type')->first())->count();

                            if ($duplicates > 1) {
                            $fail('Las url no pueden repetirse con un mismo tipo');
                        }
                    }
                ]
            ],[
                'dates.*.value.before_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.after_or_equal' => 'La fecha debe estar en un rango coherente.',
                'dates.*.value.date' => 'El campo debe ser una fecha válida',
                '*.required' => 'El campo es obligatorio',
                'dates.*.*.required' => 'El campo es obligatorio',
                'publish_us.*.value.url' => 'El campo debe ser una url válida',
                '*.required' => 'El campo es obligatorio',
                'publish_us.*.*.required' => 'El campo es obligatorio',
            ]);

        $this->dispatchBrowserEvent('coocking-time', ['time'=> 1500]);
        $this->passStep[] = 'more';
        $this->currentStep = 'resumen';
    }
// -------------------------- STEP RESUMEN --------------------------
    public function UpdatedIsUserLink(){
        $this->user_link_roles = \Spatie\Permission\Models\Role::all(); // ->where('enable', true);
        if($this->is_user_link){
            $this->user_link_name = $this->name . $this->first_lastname  ;
            $this->user_link_email =  'email primario' ;
            $this->user_link_phone = 'telefono primario';
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
    public function stepSubmit_resumen(){
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


// -------------------------- DATOS DE PRUEBA  --------------------------
    private function datos_prueba(){
        $this->alias = 'Al';
        $this->name = 'Alberto';
        $this->middle_name = 'de Jesús';
        $this->first_lastname = 'Licea';
        $this->second_lastname = 'Vallejo';
        $this->about = 'Nada ';
        // $this->id_types = '';
        // $this->id_type = '';
        // $this->id_value = '';
        $this->ids = [
            [ 'id_type' => 1, 'id_value' => '00090120123'],
            [ 'id_type' => '2', 'id_value' => 'A1234567'],
            ];
        $this->main_profile_pic = 0;
        // $this->profile_pics = [];

    // EMAILS
        // $this->email_types = '';
        // $this->email_type = '';
        // $this->email_value = '';
        // $this->email_is_personal = '';
        // $this->email_about = '';
        $this->emails = [
            [ 'id_type' => '1', 'is_primary' => 0, 'label' => 'Personal',  'value' => 'albertolicea00@outlook.com', 'about' => ''],
            [ 'id_type' => '3', 'is_primary' => 1, 'label' => 'Personal',  'value' => 'albertolicea00@icloud.com', 'about' => ''],
            [ 'id_type' => '2', 'is_primary' => 0, 'label' => 'Trabajo',  'value' => 'albertolicea00@gmail.com', 'about' => ''],
            ];

    // PHONE AND CHATS
        // $this->phone_types = '';
        // $this->phone_type = '';
        // $this->phone_value = '';
        // $this->phone_is_personal = '';
        // $this->phone_about = '';
        // $this->phones = '';
        $this->phones = [
            [ 'id_type' => 2, 'value_meta' => '', 'value' => '+53 32292629', 'is_primary' => 0, 'about' => '' ],
            [ 'id_type' => 3, 'value_meta' => '', 'value' => '+53 32271900', 'is_primary' => 0, 'about' => '' ],
            [ 'id_type' => 1, 'value_meta' => '', 'value' => '+1 56154598789', 'is_primary' => 1, 'about' => '' ],
            [ 'id_type' => 1, 'value_meta' => '', 'value' => '+53 54771264', 'is_primary' => 0, 'about' => '' ],
            ];
        // $this->instant_message_types = '';
        // $this->instant_message_type;
        // $this->instant_message_value = '';
        // $this->instant_message_is_personal = '';
        // $this->instant_message_about = '';
        // $this->instant_messages = '';
        $this->instant_messages = [
            ['id_type' => 2, 'label' => 'Personal', 'value' => '+53 54771264', 'is_primary' => 1, 'about' => ''] ,
            ['id_type' => 1, 'label' => 'Personal', 'value' => '+53 54771264', 'is_primary' => 0, 'about' => ''] ,
            ['id_type' => 3, 'label' => 'Personal', 'value' => 'soporteit@wateke.travel', 'is_primary' => 0, 'about' => ''] ,
            ];

        // RRSS AND WEBS
        // $this->rrss_types = '';
        // $this->rrss_type = '';
        // $this->rrss_value = '';
        // $this->rrss_is_personal = '';
        // $this->rrss_about = '';
        $this->rrss = [
            ['id_type' => 4, 'value' => 'albertolicea00', 'about' => ''] ,
            ['id_type' => 1, 'value' => 'albertolicea00', 'about' => ''] ,
            ['id_type' => 2, 'value' => 'albertolicea00', 'about' => ''] ,
            ];

        // $this->web_types = '';
        // $this->web_type = '';
        // $this->web_value = '';
        // $this->web_is_personal = '';
        // $this->web_about = '';
        $this->webs = [
            ['id_type' => 1, 'value' => 'https://albertos-blog.com',  'about' => ''],
            ['id_type' => 2, 'value' => 'https://alberto.licea',  'about' => ''],
            ['id_type' => 6, 'value' => 'https://wateke.travel',  'about' => ''] ,
            ];

        // ADDRESS

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
        // $this->entity_bank_account_bank_title = '';
        // $this->bank_account_banks = '';
        // $this->bank_accounts = '';

        // OCUPATION

        // MORE
        // $this->date_types = '';
        // $this->date_type = '';
        // $this->date_value = '';
        // $this->dates = '';

        // $this->publish_us_types = '';
        // $this->publish_us_type = '';
        // $this->publish_us_value = '';
        // $this->publish_us_about = '';
        // $this->publish_us = '';






    }

}
