<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class ImportExport extends Component
{
    public $contact_id;
    public $contact_ids;
    public $multiple;
    public $platform;
    public $extension;

    protected $listeners = [
        'importContactsQ', 'importContacts',
        'exportContactsQ', 'exportContact','exportContacts',
        'importEntitysQ',  'importEntitys',
        'exportEntitysQ',  'exportEntity','exportEntitys',
    ];

    public function render()
    {
        return view('livewire.contacts.import-export');
    }





    // contact section
    public function importContactsQ(){
        $this->dispatchBrowserEvent('show-in-progress');
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

    public function importContacts($id){
        $this->dispatchBrowserEvent('show-in-progress');
    }
    public function exportContact($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];

    }
    public function exportContacts($args){
        if (array_key_exists('platform', $args)) $this->platform = $args['platform'];
        if (array_key_exists('extension', $args)) $this->extension = $args['extension'];

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




}
