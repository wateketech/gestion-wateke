<button class="p-3 btn btn-success rounded" wire:click="$set('view', 'create')">
    Asignar Metrica asdfas
</button>

@if (auth()->user()->hasRole('SuperAdmin'))
    @livewire('account.management.user-task.user-task-table')
@else
{{-- @livewire('usuario-metrica.usuario-metrica-table') --}}
@endif


