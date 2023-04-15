<?php

namespace App\Http\Livewire\Contacts\Entidad\Layouts;

use Livewire\Component;
use App\Models\Pais as Paises;
use App\Models\Provincia as Provincias;
// use App\Models\Municipio as Municipios;

class Direccion extends Component
{
    public $paises, $provincias, $municipios;
    public $pais_id, $provincia_id;
    public $municipio_id, $localidad, $cod_postal, $direccion;

    public function mount(){
        $this->paises = Paises::select('id', 'name')->get();
        $this->pais_id = $this->paises[206]['id'];
        $this->provincias = Provincias::select('id', 'name')->where('country_id', (int)$this->pais_id)->orderBy('name')->get();
        $this->provincia_id = $this->provincias[0]['name'];
        // $this->municipios = Municipios::select('id', 'name')->where('state_id', (int)$this->provincia_id)->orderBy('name')->get();
        // $this->municipios_id = $this->municipios[0]['name'];
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
