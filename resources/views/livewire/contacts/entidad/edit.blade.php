<div>
    @extends("layouts.form")


    @section('header-form')
        Formulario para editar agencias
    @endsection


    @section('body-form')
        @include("livewire.contacts.entidad.form")
    @endsection


    @section('footer-form')
        <button type="button" class="btn btn-secondary mx-2">Deshacer</button>
        <button type="button" class="btn btn-success mx-2" type="submit">Actualizar Agencia</button>
    @endsection

</div>