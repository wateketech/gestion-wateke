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
    private $search_alias, $search_name, $search_middle_name, $search_first_lastname, $search_second_lastname, $search_ids, $search_emails, $search_phones, $search_webs;

    public function mount(){
        $this->entity_types = EntityTypes::all();

        //$nextPage = $this->contacts->currentPage() + 1;
        //$nextPage = $this->contacts->currentPage() + $this->pageOffset;
        //$morePosts = Contacts::paginate(10, ['*'], 'page', $nextPage);
        // $this->pageOffset++;
        //dd($morePosts->currentPage());
    }
    public function updatedSearch(){
        // poner condiciones terciarios para manejar si es uno el otro, todos o ninguno
        $this->search_alias = $this->search;
        $this->search_name = $this->search;
        $this->search_middle_name = $this->search;
        $this->search_first_lastname = $this->search;
        $this->search_second_lastname = $this->search;
        $this->search_ids = $this->search;
        $this->search_emails = $this->search;
        $this->search_phones = $this->search;
        $this->search_webs = $this->search;
    }
    public function render()
    {
        $this->contacts = Contacts::where('enable', true)
                                  ->where(function ($query) {
                                        $query->where('alias', 'like', '%'.$this->search_alias.'%')
                                              ->orWhere('name', 'like', '%'.$this->search_name.'%')
                                              ->orWhere('middle_name', 'like', '%'.$this->search_middle_name.'%')
                                              ->orWhere('first_lastname', 'like', '%'.$this->search_first_lastname.'%')
                                              ->orWhere('second_lastname', 'like', '%'.$this->search_second_lastname.'%')
                                              ->orWhereHas('ids', function ($query) { $query->where('value', 'like', '%'.$this->search_ids.'%'); })
                                              ->orWhereHas('emails', function ($query) { $query->where('value', 'like', '%'.$this->search_emails.'%'); })
                                              ->orWhereHas('phones', function ($query) { $query->whereRaw("JSON_EXTRACT(value_meta, '$.call_number') LIKE ?", ['%'.$this->search_phones.'%']); })
                                              ->orWhereHas('webs', function ($query) { $query->where('value', 'like', '%'.$this->search_webs.'%');
                                        });
                                    })
                                  ->paginate($this->perPage);
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
    }

    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }
}
