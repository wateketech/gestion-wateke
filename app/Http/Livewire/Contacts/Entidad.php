<?php

namespace App\Http\Livewire\Contacts;

use Livewire\Component;
use App\Models\Entidad as Entidades;
use Livewire\WithPagination;

class Entidad extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $perPage = '12';
    public $view = 'main';

    public $entidad_id, $grupo_gestion_id, $direccion_id, $gds_id,
        $nombre, $num_oficina, $nombre_fiscal, $nif, $es_minorista, $es_central, $iata, $rp,  $observ;

    public function render()
    {
        $entidades = Entidades::all();

        return view('livewire.contacts.entidad', compact('entidades'));
    }
}
