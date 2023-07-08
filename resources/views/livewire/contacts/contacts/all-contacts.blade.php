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

            <a class="btn btn-outline-secondary btn-lx px-3 mx-1 disabled" href="#">
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
            <a class="btn btn-outline-secondary btn-lx mx-1 px-3 disabled" href="#">
                <i class="fas fa-users"></i> &nbsp;
                Crear Grupo
            </a>
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


{{-- Sweet Alert Notificaciones --}}
@push('scripts')
<script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                container: 'swal-wide-container',
                popup: 'swal-wide-popup',
                confirmButton: 'btn btn-outline-success border-2 mx-3',
                cancelButton: 'btn btn-outline-danger border-2 mx-3'
            },
            buttonsStyling: false
        })
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 4500,
            showCloseButton: true // Agregamos esta opción
        })


        window.addEventListener('show-delete-contact', function(event){
            let deletedContactId = event.detail.contact_id;
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "\
                <p>¡Al eliminar el contacto NO habrá vuelta atrás!</p>\
                <p>Para confirmar teclee el ID del contacto (<strong class='text-danger'> ID:" + deletedContactId + " </strong>) :</p>\
                ",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Borralo',
                cancelButtonText: 'Cancelar',
                timer: 50000

            }).then(async (result) => {
                if (result.isConfirmed) {
                    if (result.value === deletedContactId) {
                        new Promise((resolve) => {
                            Livewire.emit('delete_contact', deletedContactId, result.value);
                            resolve();
                        })
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'El contacto ha sido eliminado de la base de datos.',
                                // html: "\
                                // <p>El contacto ha sido eliminado de la base de datos.</p>\
                                // <p class='btn btn-outline-secondary py-1 px-2'\
                                //     wire:click=\"enableContact(" + deletedContactId + ")\">Deshacer acción</p>\
                                // "
                            });

                        });
                    }else{
                        Toast.fire(
                            '¡Error al eliminar!',
                            'Error en el id de confirmacion al eliminar el contacto :)',
                            'error'
                        )
                    }
                } else if
                ( result.dismiss === Swal.DismissReason.cancel){
                    Toast.fire(
                        'Cancelado',
                        'El contacto esta a salvo :)',
                        'warning'
                    )
                }
            })
        });


        window.addEventListener('show-delete-contacts', function(event){
            let deletedContactIds = JSON.parse(event.detail.contacts_id);
            let formattedContactIds = deletedContactIds.join(' - ');

            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "\
                <p>¡Al eliminar los contactos NO habrá vuelta atrás!</p>\
                <small>Confirme tecleando los IDs de los contacto seguido de una coma</small>\
                <p><strong class='text-danger'> IDs: " + formattedContactIds + " </strong> :</p>\
                ",
                icon: 'warning',
                input: 'text',
                showCancelButton: true,
                confirmButtonText: 'Borralos',
                cancelButtonText: 'Cancelar',
                timer: 50000

            }).then(async (result) => {
                if (result.isConfirmed) {
                    if (result.value === deletedContactIds.join(', ')) {
                        new Promise((resolve) => {
                            Livewire.emit('delete_contacts', deletedContactIds, result.value);
                            resolve();
                        })
                        .then(() => {
                            Toast.fire({
                                icon: 'success',
                                title: '¡Eliminado!',
                                text: 'Los contactos ha sido eliminados de la base de datos.',
                                // html: "\
                                // <p>Los contactos han sido eliminados de la base de datos.</p>\
                                // <p class='btn btn-outline-secondary py-1 px-2'\
                                //     wire:click=\"enableContact(" + deletedContactId + ")\">Deshacer acción</p>\
                                // "
                            });

                        });
                    }else{
                        Toast.fire(
                            '¡Error al eliminar!',
                            'Error en los ids de confirmacion al eliminar los contactos :)',
                            'error'
                        )
                    }
                } else if
                ( result.dismiss === Swal.DismissReason.cancel){
                    Toast.fire(
                        'Cancelado',
                        'Los contactos están a salvo :)',
                        'warning'
                    )
                }
            })
        });

        window.addEventListener('show-recovery-contact-success', function(event){
            let is_multiple = event.detail.is_multiple;

            Toast.fire({
                title: '¡Recuperado!',
                text: is_multiple ? 'Contacto recuperado exitosamente.' : 'Contactos recuperados exitosamente.',
                icon: 'success',
            });
        });
        window.addEventListener('show-recovery-contact-error', function(event){
            let is_multiple = event.detail.is_multiple;

            Toast.fire({
                title: '¡Error!',
                text: is_multiple ? 'No se ha podido recuper el contacto.' : 'No se han podido recuper los contactos.',
                icon: 'danger',
            });
        });



</script>
@endpush
