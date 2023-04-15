<?php

namespace App\Http\Livewire\Contacts\Entity;

use Livewire\Component;

class Create extends Component
{
    public $prueba = 1;

    public $name, $legal_name, $management_group, $office_num, $about;
    public $is_retail = "true";
    public $is_mainoffice = "true";

    public $emails = [];

// ----------------------- VALIDACIONES --------------------------
    public function validateEmails(){
        foreach($this->emails as $index => $email){
            $this->validate([
                "emails.{$index}.label" => 'required',
                "emails.{$index}.email" => 'required|email|unique:correo_ent,correo',
            ],[
                "emails.{$index}.*.required" => 'Campo Obligatorio',
                // "emails.{$index}.email" => 'required|email|unique:correo_ent,correo',

                // '*.'.$value.'.required' => '',
                // 'email_contacto.'.$value.'.unique' => 'Ya existe un contacto con este email',
                // 'email_contacto.'.$value.'.email' => 'Email no valido'

            ]);
        }
    }


        
    //         'nombre_contacto.'.$value => 'required',
    //         'email_contacto.'.$value => 'required|email|unique:contactos,email',
    //         'num_movil_contacto.'.$value => 'required'
    //     ],[
    //         '*.'.$value.'.required' => 'Campo Obligatorio',
    //         'email_contacto.'.$value.'.unique' => 'Ya existe un contacto con este email',
    //         'email_contacto.'.$value.'.email' => 'Email no valido'

    //     ]);
    // }



    public function store()
    {
        $this->validateEmails();
        // $validatedData = validate([
        //     'emails.*.label' => 'required|string|max:255',
        //     'emails.*.address' => 'required|email|max:255',
        // ]);

        // foreach ($validatedData['emails'] as $emailData) {
        //     $email = new Email();
        //     $email->label = $emailData['label'];
        //     $email->address = $emailData['address'];
        //     $email->save();
        // }

        // return redirect()->route('emails.index');
    }






    public function render()
    {
        return view('livewire.contacts.entity.create');
    }
}
