<div>
    @extends("layouts.form")


    @section('header-form')
    <h6 class="mb-2 h5">Actualización de Métricas </h6>
    @endsection


    @section('body-form')
        @include("livewire.account.management.task.form")
    @endsection


    @section('footer-form')
        <button type="button" class="btn btn-secondary mx-2" wire:click="refresh">Deshacer</button>
        <button type="button" class="btn btn-success mx-2" wire:click="updateComfirmed">Actualizar Métrica</button>
    @endsection

</div>
