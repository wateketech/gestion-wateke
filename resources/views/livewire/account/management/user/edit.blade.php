<div>
    @extends("layouts.form")


    @section('header-form')
    <h6 class="mb-2 h5">Actualización de Usuarios </h6>
    @endsection


    @section('body-form')
        @include("livewire.account.management.user.form")
    @endsection


    @section('footer-form')
        <button type="button" class="btn btn-secondary mx-2" wire:click="refresh" >Deshacer</button>
        <button type="submit" class="btn btn-success mx-2" wire:click="updateComfirmed">Actualizar Usuario</button>
    @endsection

</div>
