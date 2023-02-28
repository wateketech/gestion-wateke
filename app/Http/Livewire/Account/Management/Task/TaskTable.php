<?php

namespace App\Http\Livewire\Account\Management\Task;

use App\Models\Task;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;

use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;

class TaskTable extends LivewireDatatable
{
    public $model = Task::class;
    // public $hideable = 'select';
    // public $exportable = true;
    // public $buttonsSlot = 'livewire.usuario.main';
    public function builder()
    {
        return Task::query()
            ->where('enable', '=', true);
    }

    public function columns()
    {
        return[
            Column::name('tasks.name')  ->label('Nombre'),
            Column::name('tasks.type_value')  ->label('Valor'),
            Column::name('tasks.average') ->label('Promedio'),
            Column::name('tasks.about') ->label('Observaciones'),

            Column::callback(['id', 'name'], function ($id, $name) {
                return view('livewire.account.management.task.table-actions', ['id' => $id, 'name' => $name]);
            })->unsortable()->label('Acciones')
        ];
    }
}
