<div>
    @extends("layouts.form")


    @section('header-form')
        <h6 class="mb-2 h5">Nueva Métrica </h6>
    @endsection


    @section('body-form')
    @include("livewire.account.management.task.form")
    @endsection


    @section('footer-form')
            <button class="btn btn-secondary mx-2" wire:click="refresh" >Deshacer</button>
            <button class="btn btn-success mx-2" form='metric-form'>Crear Métrica</button>
    @endsection

</div>
