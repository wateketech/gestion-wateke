<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use App\Models\EntityType as EntityTypes;
use App\Models\Contact as Contacts;

class AllContacts extends Component
{
    public $entity_types;
    protected $contacts;

    public $current_contact;
    private $perPage = 100;
    public $pageOffset = 0;
    public $search = '';

    public function mount(){
        $this->entity_types = EntityTypes::all();

        //$nextPage = $this->contacts->currentPage() + 1;
        //$nextPage = $this->contacts->currentPage() + $this->pageOffset;
        //$morePosts = Contacts::paginate(10, ['*'], 'page', $nextPage);
        // $this->pageOffset++;
        //dd($morePosts->currentPage());
    }
    public function render()
    {
        $this->contacts = Contacts::where('enable', true)
                                  ->where(function ($query) {
                                        $query->where('alias', 'like', '%'.$this->search.'%')
                                              ->orWhere('name', 'like', '%'.$this->search.'%')
                                              ->orWhere('middle_name', 'like', '%'.$this->search.'%')
                                              ->orWhere('first_lastname', 'like', '%'.$this->search.'%')
                                              ->orWhere('second_lastname', 'like', '%'.$this->search.'%')
                                              ->orWhereHas('ids', function ($query) { $query->where('value', 'like', '%'.$this->search.'%'); })
                                              ->orWhereHas('emails', function ($query) { $query->where('value', 'like', '%'.$this->search.'%'); })
                                              ->orWhereHas('phones', function ($query) { $query->whereRaw("JSON_EXTRACT(value_meta, '$.call_number') LIKE ?", ['%'.$this->search.'%']); })
                                              ->orWhereHas('webs', function ($query) { $query->where('value', 'like', '%'.$this->search.'%');
                                        });
                                    })
                                  ->paginate($this->perPage);
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
    }

    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }
}
