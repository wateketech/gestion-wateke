<?php

namespace App\Http\Livewire\Account\Management\Task;
use App\Models\Task as Tasks;

use Livewire\Component;

class Task extends Component
{
    public $prueba;
    public $view;
    public $id_task, $name, $average, $about;
    public $type_value = 'number';
    public $type_values = ['number' =>'Cuantitativo', 'text' => 'Cualitativo', 'datetime-local' => 'Fecha'];

    protected $listeners = [
        'viewUpdate-metric' => 'view_update',
        'deleteComfirmed-metric' => 'deleteComfirmed',
        'delete-metric' => 'delete',
        'update-metric' => 'update'
    ];
    protected $rules = [
        'name' => 'required',
        'type_value' => 'required',
        'average' => 'required',
        'about' => 'required'
    ];
    protected $messages = [
        '*.required' => 'Campo Oblitgatorio'
    ];
    //  ---------------------  RENDER ---------------------
    public function refresh(){
        $this->reset();
    }
    public function render()
    {
        return view('livewire.account.management.task.task');
    }
    private function loadDatas($id){
        $metric = Tasks::find($id);
        $this->id_task = $id;
        $this->name = $metric->name;
        $this->type_value = $metric->type_value;
        $this->average = $metric->average;
        $this->about = $metric->about;
    }
    //  ---------------------  SAVE ---------------------
    public function save(){
        $validatedData = $this->validate();
        Tasks::create($validatedData);

        $this->dispatchBrowserEvent('show-metric-createComfirmed');
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  DELETE ---------------------
    public function deleteComfirmed($id){
        $this->loadDatas($id);
        $this->dispatchBrowserEvent('show-metric-deleteComfirmed');
        $this->delete();                // eliminar esto cuendo los popus funcionen
    }
    public function delete(){
        Tasks::destroy($this->id_task);
        $this->emit('resetTable');
        $this->refresh();
    }
    //  ---------------------  UPDATE ---------------------
    public function view_update($id){
        $this->loadDatas($id);
        $this->view = 'edit' ;
    }
    public function updateComfirmed(){
        $this->dispatchBrowserEvent('show-metric-updateComfirmed');
        $this->update();                // eliminar esto cuendo los popus funcionen
    }
    public function update(){
        $validatedData = $this->validate();

        Tasks::find($this->id_task)
            ->update($validatedData);

        $this->emit('resetTable');
        $this->reset();
    }

}
