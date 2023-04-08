<div>
    @extends("layouts.form")


    @section('header-form')
        <h6 class="text-danger text-gradient font-weight-bolder h5 mb-2"><i class="fas fa-tasks pr-2"></i> Nueva Métrica </h6>
    @endsection


    @section('body-form')
        @include("livewire.account.management.task.form")
    @endsection


    @section('footer-form')
            <button class="btn btn-secondary mx-2" wire:click="refresh" >Deshacer</button>
            <button class="btn btn-success mx-2" form='metric-form'>Crear Métrica</button>
    @endsection

</div>
