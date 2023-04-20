<?php

namespace App\Http\Livewire\Account\Profile\Layouts;
use App\Models\UserHasVisits as UserHasVisits;
use App\Models\UserHasVisits as UserVisits;

use Livewire\Component;

class MakeVisit extends Component
{
    public $prueba = 0;
    public $visitAgencys;
    public $visitSelected;
    public $about;
    protected $rules = [
        'about' => 'required',
    ];
    protected $messages = [
        '*.required' => 'Campo Oblitgatorio'
    ];
    protected $listeners = [
        'save',
    ];
    public function showCreateVisit(){
        $this->prueba = 1;
    }

    public function mount()
    {
        $this->visitAgencys = UserHasVisits::select('user_has_visits.id', 'entitys.name', 'user_has_visits.about', 'user_has_visits.deaddate', 'user_has_visits.about')
            ->join('entitys', 'entitys.id', 'user_has_visits.entity_id')
            ->orderBy('user_has_visits.deaddate')
            ->where('user_has_visits.enable', true)
            ->get();
        $this->visitSelected = count($this->visitAgencys)!=0 ? $this->visitAgencys[0]->id : Null;
    }
    public function refresh(){
        $this->reset();
        $this->mount();
    }
    public function render()
    {
        return view('livewire.account.profile.layouts.make-visit');
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        // relacionar UserVisits con UserHas Visits para eliminar las llaves foraneas y que sea una relacion de uno a uno
        UserVisits::create([
            'entity_id' => intval($this->entity_id),
            'user_id' => intval($this->assignedUser_visit),
            'deaddate' => $this->deaddate_visit,
            'about' => $this->about_visit,
        ]);
        UserHasVisits::find($this->visitSelected)->update(['enable' => false]);
        // lanzar notificacion

        return redirect('/profile');
        // $this->emitTo('account.profile.profile', 'refresh');
        // Users::create($validatedData)
        //     ->assignRole($this->role);
        // $this->dispatchBrowserEvent('modal-booton-visit-end');
    }
}
