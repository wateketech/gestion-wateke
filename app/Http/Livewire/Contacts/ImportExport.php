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
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportContact($id){
        $this->dispatchBrowserEvent('show-in-progress');
    }

    public function exportContacts($ids){
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
