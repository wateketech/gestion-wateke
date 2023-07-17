<div class="main-content p-4">

    {{-- ACCIONES  --}}
    <div class="d-flex flex-row justify-content-between mx-4">
        <div>
            <a class="btn text-white btn-secondary px-3 mx-1 disabled" title="buscar / filtrar">
                <i class="fas fa-search"></i> Buscar / Filtrar
            </a>
            <a class="btn text-white btn-primary active btn-lx px-3 mx-1 " href="{{ route('crear-contacto') }}">
                Crear Contacto
            </a>
        </div>



        <div>
        {{-- SINGLE CONTACT VIEW --}}
        @if (isset($current_contact) && count($current_contacts) <= 1)

            <a class="btn btn-outline-primary btn-lx px-3 mx-1" target="_blank" href="{{ route('editar-contacto', ['id' => $current_contact]) }}">
                <i class="fas fa-pencil-alt"></i> &nbsp;
                Editar
            </a>
            @if ($contacts->contains('id', $current_contact))
                <div class="btn text-white btn-danger btn-lx px-3 mx-1" wire:click="deleteContact_Q('{{ $current_contact }}')">
                    <i class="fas fa-trash-alt "></i>
                </div>
            @else
                <div class="btn btn-outline-danger btn-lx px-3 mx-1 animate-pulse" wire:click="enableContact('{{ $current_contact }}')">
                    <i class="fas fa-share fa-flip-horizontal"></i> Deshacer {{-- Recuperar --}}
                </div>
            @endif

        {{-- MULTIPLE CONTACT VIEW --}}
        @elseif (count($current_contacts) > 1)
            <div class="btn btn-outline-primary btn-lx mx-1 px-3" wire:click="createGroup('{{ json_encode($current_contacts) }}')">
                <i class="fas fa-users"></i> &nbsp;
                Crear Grupo
            </div>
            @if ($contacts->contains('id', $current_contact))
                <div class="btn text-white btn-danger btn-lx px-3 mx-1" wire:click="deleteContacts_Q('{{ json_encode($current_contacts) }}')">
                    <i class="fas fa-trash-alt "></i>
                </div>
            @else
                <div class="btn btn-outline-danger btn-lx px-3 mx-1 animate-pulse" wire:click="enableContacts('{{ json_encode($current_contacts) }}')">
                    <i class="fas fa-share fa-flip-horizontal"></i> Deshacer {{-- Recuperar --}}
                </div>
            @endif
        @else



        @endif

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

