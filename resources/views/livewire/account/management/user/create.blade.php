<div>
    @extends("layouts.form")


    @section('header-form')
        <h6 class="mb-2 h5">Creacion de Usuarios </h6>
    @endsection


    @section('body-form')
        @include("livewire.account.management.user.form")
    @endsection


    @section('footer-form')
            <button class="btn btn-secondary mx-2" wire:click="$refresh" >Deshacer</button>
            <button class="btn btn-success mx-2" form="user-form">Crear Usuario</button>
    @endsection

</div>
