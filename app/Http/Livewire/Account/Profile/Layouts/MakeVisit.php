<?php

namespace App\Http\Livewire\Account\Profile\Layouts;
use App\Models\UserHasVisits as UserHasVisits;

use Livewire\Component;

class MakeVisit extends Component
{
    public $prueba = 0;
    public $visitAgencys;


    protected $listeners = [
        'createVisit' => "showCreateVisit",
    ];

    public function showCreateVisit(){
        $this->prueba = 1;
    }

    public function mount()
    {
        $this->visitAgencys = UserHasVisits::select('entitys.id', 'entitys.name', 'user_has_visits.about', 'user_has_visits.deaddate')
            ->join('entitys', 'entitys.id', 'user_has_visits.entity_id')
            ->orderBy('user_has_visits.deaddate')
            ->get();
    }
    public function render()
    {
        return view('livewire.account.profile.layouts.make-visit');
    }
}
