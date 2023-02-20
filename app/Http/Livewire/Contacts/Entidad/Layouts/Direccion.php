<?php

namespace App\Http\Livewire\Contacts\Entidad\Layouts;

use Livewire\Component;
use App\Models\Pais as Paises;
use App\Models\Provincia as Provincias;

class Direccion extends Component
{
    public $paises, $provincias;
    public $pais_id, $provincia_id;

    public function mount(){
        $this->paises = Paises::select('id', 'name')->get();
        $this->pais_id = $this->paises[0]['id'];
        $this->provincias = Provincias::select('id', 'name')->where('country_id', (int)$this->pais_id)->orderBy('name')->get();
        $this->provincia_id = $this->provincias[0]['name'];
    }
    public function updatedPaisid(){
        $this->provincias = Provincias::select('id', 'name')->where('country_id', (int)$this->pais_id)->orderBy('name')->get();
        if (isset($this->provincias[0]['id'])){
            $this->provincia_id = $this->provincias[0]['name'];
        }else{
            // convertir a input
        }
    }


    public function render()
    {
        return view('livewire.contacts.entidad.layouts.direccion');
    }
}
