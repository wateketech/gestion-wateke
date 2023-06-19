<?php

namespace App\Http\Livewire\Contacts\Contacts;

use Livewire\Component;
use Carbon\Carbon;
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
        $this->contacts = Contacts::where('enable', true)
                                  ->where(function ($query) {
                                        $query->where('alias', 'like', '%'.$this->search.'%')
                                              ->orWhere('name', 'like', '%'.$this->search.'%')
                                              ->orWhere('middle_name', 'like', '%'.$this->search.'%')
                                              ->orWhere('first_lastname', 'like', '%'.$this->search.'%')
                                              ->orWhere('second_lastname', 'like', '%'.$this->search.'%');
                                    })
                                  ->paginate($this->perPage);
        //dd($this->contacts->find($this->contacts[0])->emails->where('is_primary', true));

        //$nextPage = $this->contacts->currentPage() + 1;
        //$nextPage = $this->contacts->currentPage() + $this->pageOffset;
        //$morePosts = Contacts::paginate(10, ['*'], 'page', $nextPage);
        // $this->pageOffset++;
        //dd($morePosts->currentPage());
        // dd($this->contacts->first()->created_at);
        // dd(Carbon::createFromTimestamp($this->contacts->first()->created_at)->diffForHumans() );
    }
    public function render()
    {
        return view('livewire.contacts.contacts.all-contacts')->with('contacts', $this->contacts);
    }

    public function selectContact($id){
        $this->current_contact = Contacts::find($id);
    }
}
