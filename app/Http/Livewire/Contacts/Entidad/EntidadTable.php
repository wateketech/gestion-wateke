<?php

namespace App\Http\Livewire\Contacts\Entidad;

use App\Models\Entidad;
use App\Models\CorreoEnt;
use App\Models\TelefonoEnt;
use App\Models\WebEnt;
use App\Models\RedSocialEnt;
use App\Models\NosPublica;
use App\Models\CuentaBancaria;

use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class EntidadTable extends LivewireDatatable
{
    public $model = Entidad::class;
    public $hideable = 'select';
    public $exportable = true;




    public function builder()
    {
        return Entidad::query();
    }
    public function columns()
    {
        return[
            Column::name('entidad.nombre'),
            Column::name('entidad.nombre_fiscal'),
            Column::name('entidad.nif'),

            Column::name('entidad.es_minorista'),
            Column::name('entidad.es_central'),

            Column::name('entidad.iata')
                ->label('IATA'),
            Column::name('entidad.rp')
                ->label('RP'),
            Column::name('entidad.observ')
                ->label('observaciones'),

        ];
    }
}