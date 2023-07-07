<div class="main-content p-4">

    {{-- ACCIONES  --}}
    <div class="d-flex flex-row justify-content-between mx-4">
        <div>
            <a class="btn text-white btn-secondary px-3 disabled" title="buscar / filtrar">
                <i class="fas fa-search"></i> Buscar / Filtrar
            </a>
        </div>

        <div>
            <a class="btn text-white btn-success active btn-lx px-3" href="{{ route('crear-contacto') }}">
                Crear Contacto
            </a>
        </div>
    </div>


    <div class="container-fluid ">
        <div class="row">
            {{-- <div class="col-lg-2 py-2">
                @include('livewire.contacts.contacts.layouts.groups-contacts')
            </div> --}}
            <div class="col-lg-5 py-1">
                @include('livewire.contacts.contacts.list-contacts')
            </div>
            <div class="col-lg-7 py-1">
                @livewire('contacts.contacts.current-contact', ['contact_id' => $current_contact])
            </div>
        </div>
    </div>
</div>
