<?php

use App\Models\ContactBankAccountType as BankAccountTypes;
use Livewire\Component;

class Create extends Component
{
    // BANK ACCOUNTS VARIABLES
    public $bank_account_types, $bank_account_type;
    public $bank_account_card_number, $bank_account_card_holder, $bank_account_is_credit, $bank_account_about, $bank_account_meta;
    public $bank_account_expiration_date, $bank_account_expiration_year, $bank_account_expiration_month;

    public $bank_account_bank_name, $bank_account_bank_title;
    public $bank_id_in_bbdd;
    public $bank_account_banks = [];
    public $bank_accounts = [];



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
    //
        // hacer en algun lado la validacion por si ya existe el banco sugerirlo
        // array_push($this->bank_account_banks, [
        //         'name' => $this->bank_account_bank_name,
        //         'title' => $this->bank_account_bank_title,
        //     ]);

        array_push($this->bank_accounts, [
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

    //.. passstep, currentstep, cokingtime

    }
    public function stepSubmit_bank_accounts_omit()
    {
        $this->bank_accounts = [];
        //.. passstep, currentstep, cokingtime
    }


    // DATA FAKER SEED
    private function fakerseed(){
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
    }

}

