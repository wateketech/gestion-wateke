<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;

class ImportExport extends Component
{
    protected $listeners = [
        'importContacts',
        'exportContact',
        'exportContacts',
        'importEntitys',
        'exportEntity',
        'exportEntitys',
    ];

    public function render()
    {
        return view('livewire.contacts.import-export');
    }





    // contact section
    public function importContacts(){
        // dd('hola');
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportContact($id){
        dd('hola');
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportContacts($ids){
        dd('hola');
        $this->dispatchBrowserEvent('show-in-progress');
    }



    // entity section
    public function importEntitys(){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportEntity($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportEntitys($ids){
        $this->dispatchBrowserEvent('show-in-progress');
    }




}
