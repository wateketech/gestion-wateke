<div class="main-content">
    <form wire:submit.prevent="store" action="#" method="POST">
        <div class="d-flex justify-content-center my-3 h3 text-primary">
            Formulario Rapido para registrar agencias
        </div>

            <div class="card card-body blur shadow-blur mx-4 my-1">
                @include('livewire.contacts.entity.layouts.fastForm')
            </div>    

       <div class="d-flex justify-content-center my-3">
           <a type="button" href="{{ route('contactos') }}" class="btn btn-secondary mx-2">Deshacer</a>
           <button type="submit" class="btn btn-success mx-2">Crear Agencia</button>
       </div>
    </form>
</div>
