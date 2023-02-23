<?php

namespace App\Http\Livewire\Account\Management\UserTask;

use App\Models\UserTask;

use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class UserTaskTable extends LivewireDatatable
{
    public $model = UserTask::class;
    // public $hideable = 'select';
    // public $exportable = true;
    // public $buttonsSlot = 'livewire.metrica.main';

    public function builder()
    {
        return UserTask::query();
    }

    public function columns()
    {
        return[

            Column::name('user_tasks.user_id')->label('ID Usuario'),
            Column::name('user_tasks.task_id')->label('ID Metrica'),

            Column::name('user_tasks.value')->label('Valor'),

            Column::name('user_tasks.manually_time')->label('Tiempo')

            // Column::name('usuario.nombre')
            //     ->label('Usuario'),

            // Column::name('metrica.nombre')
            //     ->label('Metrica'),

            //     Column::name('metrica_usuario.valor')
            //     ->label('Valor'),

            //     Column::name('metrica.promedio')
            //     ->label('Promedio'),

            // DateColumn::name('metrica_usuario.tiempo'),

            // Column::callback(['id'], function ($id) {
            //     return view('livewire.usuario-metrica.table-actions', ['id' => $id]);
            // })->unsortable()->label('Acciones')
        ];
    }
}
