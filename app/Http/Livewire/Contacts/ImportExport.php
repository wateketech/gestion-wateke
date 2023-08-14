<?php

namespace App\Http\Livewire\Contacts;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class ImportExport extends Component
{
    use WithFileUploads;

    public $contact_id;
    public $contact_ids;
    public $multiple;
    public $platform;
    public $extension;
    public $file;

    protected $listeners = [
        'importContactsQ', 'importContacts',
        'exportContactsQ', 'exportContact','exportContacts',
        'importEntitysQ',  'importEntitys',
        'exportEntitysQ',  'exportEntity','exportEntitys',
        'loadFile'
    ];

    public function render()
    {
        return view('livewire.contacts.import-export');
    }





    // contact section
    public function importContactsQ(){
        $this->dispatchBrowserEvent('import-contacts', [
            'action' => 'importContacts',
            'id_component' => $this->id
        ]);
    }
    public function exportContactsQ($args){
        $this->multiple = $args['multiple'];

        if($this->multiple) {
            $this->contact_ids = $args['id'];
            $this->dispatchBrowserEvent('export-contacts', [
                'multiple' => 'true',
                'action' => 'exportContacts',
                'title' => '<i class="fas fa-download"></i> &nbsp; Exportar ' . count($args['id']) . ' Contactos</p>'
            ]);
        }else{
            $this->contact_id = $args['id'];
            $this->dispatchBrowserEvent('export-contacts', [
                'multiple' => 'false',
                'action' => 'exportContact',
                'title' => '<i class="fas fa-download"></i> &nbsp; Exportar 1 Contacto</p>'
            ]);
        }

    }

    public function loadFile($data)
    {
        dd($data);
    }



    public function importContacts($args){
        dd($args);
        // if (array_key_exists('platform', $args)) $platform = $args['platform'];
        // if (array_key_exists('extension', $args)) $extension = $args['extension'];
        // else{

        // }
        // if ($this->platform && $this->extension){





















        // }else{
        //     $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extencion por la cual importar']);
        // }
    }
    public function exportContact($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];
        if ($this->platform && $this->extension){













        }else{
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extención para la cual exportar']);
        }
    }
    public function exportContacts($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];
        if ($this->platform && $this->extension){














        }else{
            $this->dispatchBrowserEvent('simple-toast-message', ['icon' => 'warning', 'text' => 'No se ha especificado una plataforma y/o extención para la cual exportar']);
        }
    }















    // entity section
    public function importEntitysQ(){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntitysQ($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function importEntitys(){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntity($id){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportEntitys($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }









    private function createContact(){

    }




}
