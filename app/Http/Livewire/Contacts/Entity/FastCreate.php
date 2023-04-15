<?php

namespace App\Http\Livewire\Contacts\Entity;
use App\Models\Entity as Entitys;
use App\Models\EntityEmail as Emails;

use Livewire\Component;

class FastCreate extends Component
{
    public $prueba;
    public $id_entity;
    public $name, $legal_name, $about;
    public $is_mainoffice = "true";
    public $is_retail = "true";


    public $email_label, $email;

    protected $listeners = [
        'deleteComfirmed-entity-basic' => 'deleteComfirmed',
        'delete-basic-entity' => 'delete',
    ];

    protected $rules = [
        'name'           => 'required',          
        'legal_name'     => 'required',    
        'about'          => 'nullable',
        'is_mainoffice'  => 'required',
        'is_retail'      => 'required',
        // 'nif'            => 'required',
        // 'iata'           => 'required',
        // 'rp'             => 'required',
        // 'email_label'    => 'required',          
        'email'          => 'required|email|unique:entity_emails,email',
    ];
    protected $messages = [
        '*.required' => 'Campo Oblitgatorio',
    ];

    //  ---------------------  RENDER ---------------------
    public function refresh(){
        $this->reset();
    }
    public function render()
    {
        return view('livewire.contacts.entity.fast-create');
    }
     //  ---------------------  SAVE ---------------------
    public function save(){
        $this->validate();

        $entity_id = Entitys::insertGetId([
            'name'           => $this->name,          
            'legal_name'     => $this->legal_name, 
            'is_mainoffice'  => filter_var($this->is_mainoffice, FILTER_VALIDATE_BOOLEAN),
            'is_retail'      => filter_var($this->is_retail, FILTER_VALIDATE_BOOLEAN),
            'nif'            => ' ',
            'iata'           => ' ',
            'rp'             => ' ',
            'about'          => $this->about==Null ? " " : $this->about,
            // 'enable'         => (bool) true,
        ]);

        Emails::create([
            'entity_id'      => $entity_id,
            'label'          => 'primary', // $this->email_label, 
            'email'          => $this->email,          
        ]);
        
        $this->reset();     
        $this->dispatchBrowserEvent('fastCreateComfirmed');
        $this->emit('resetTable');
    }
    //  ---------------------  REMOVE ---------------------
    public function deleteComfirmed($id){
        $this->id_entity = $id;
        $this->dispatchBrowserEvent('fastDeleteComfirmed');
    }
    
    public function delete(){
        Entitys::find($this->id_entity)->delete();
        Emails::where('entity_id', '=', $this->id_entity)->delete();
        $this->emit('resetTable');
    }
}
