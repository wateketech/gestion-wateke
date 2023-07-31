<div class="main-content p-4">

    {{-- ACTIONS COMPONENTS  --}}
    <livewire:contacts.import-export />




    {{-- ACCIONES  --}}
    <div class="d-flex flex-row justify-content-between mx-4">
        <div>
            <a class="btn {{ $filter_view ? 'btn-primary' : 'btn-outline-primary' }} px-3 mx-1" title="buscar / filtrar" wire:click="$toggle('filter_view')">
                <i class="fas fa-search"></i> Buscar / Filtrar
            </a>
            <a class="btn {{ $group_view ? 'btn-primary' : 'btn-outline-primary' }} px-3 mx-1" title="grupos" wire:click="$toggle('group_view')">
                <i class="fas fa-users"></i> Grupos
            </a>
            <a class="btn btn-primary btn-lx px-3 mx-1" wire:click="importContacts">
                <i class="fas fa-cloud-upload-alt"></i> &nbsp;
                Importar contactos
            </a>
            <a class="btn text-white btn-primary active btn-lx px-3 mx-1 " href="{{ route('crear-contacto') }}" target="_blank">
                Crear Contacto
            </a>
        </div>



        <div>
        {{-- SINGLE CONTACT VIEW --}}
        @if (isset($current_contact) && count($current_contacts) <= 1)


            <div class="btn btn-outline-primary btn-lx px-3 mx-1" wire:click="exportContacts('{{ $current_contact }}')">
                <i class="fas fa-download"></i> &nbsp;
                Exportar
            </div>

            <a class="btn btn-outline-primary btn-lx px-3 mx-1" target="_blank" href="{{ route('editar-contacto', ['id' => $current_contact]) }}">
                <i class="fas fa-pencil-alt"></i> &nbsp;
                Editar
            </a>
            @if ($contacts->contains('id', $current_contact))
                <div class="btn text-white btn-danger btn-lx px-3 mx-1" wire:click="deleteContact_Q('{{ $current_contact }}')">
                    <i class="fas fa-trash-alt "></i> Eliminar
                </div>
            @else
                <div class="btn btn-outline-danger btn-lx px-3 mx-1 animate-pulse" wire:click="enableContact('{{ $current_contact }}')">
                    <i class="fas fa-share fa-flip-horizontal"></i> Deshacer {{-- Recuperar --}}
                </div>
            @endif

        {{-- MULTIPLE CONTACT VIEW --}}
        @elseif (count($current_contacts) > 1)
            <div class="btn btn-outline-primary btn-lx px-3 mx-1" wire:click="exportContacts('{{ json_encode($current_contacts) }}')">
                <i class="fas fa-download"></i> &nbsp;
                Exportar
            </div>

            <div class="btn btn-outline-primary btn-lx mx-1 px-3" wire:click="GroupForm">
                <i class="fas fa-users"></i> &nbsp;
                Crear Grupo
            </div>



            @if ($contacts->contains('id', $current_contact))
                <div class="btn text-white btn-danger btn-lx px-3 mx-1" wire:click="deleteContacts_Q('{{ json_encode($current_contacts) }}')">
                    <i class="fas fa-trash-alt "></i> Eliminar
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

            <div class="col-lg-2 {{ $filter_view ? '' : 'd-none' }} py-2 px-1">
                @include('livewire.contacts.contacts.filters-contacts')
            </div>
            <div class="col-lg-2 {{ $group_view ? '' : 'd-none' }} py-2 px-1">
                @include('livewire.contacts.contacts.groups-contacts')
            </div>


            <div class="col-lg-{{ $filter_view || $group_view ? '4' : '5' }} py-1 px-1">
                @include('livewire.contacts.contacts.list-contacts')
            </div>
            <div class="col-lg-{{ $filter_view || $group_view ? '6' : '7' }} py-1 px-1">
                @livewire('contacts.contacts.current-contact', ['contact_id' => $current_contact])
            </div>
        </div>
    </div>
</div>

