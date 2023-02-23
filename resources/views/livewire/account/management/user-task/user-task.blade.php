<div>
    <div>
        <main class="main-content">
            <div class="container-fluid py-4">

                {{-- CRUD --}}
                @include("livewire.account.management.user-task.$view")

                {{-- Tables --}}
                @include("livewire.account.management.user-task.table")

            </div>
        </main>

        @stack('usuario-metrica-scripts')
    </div>
</div>

@push('scripts')
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                container: 'swal-wide-container',
                popup: 'swal-wide-popup',
                confirmButton: 'btn btn-success mx-3',
                cancelButton: 'btn btn-danger mx-3'
            },
            buttonsStyling: false
        })




        window.addEventListener('show-metric-user-updateComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al actualizar la relacion metrica-usuario no habrá vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Actualizalo',
                cancelButtonText: 'Cancelar',
                timer: 10000
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('update-user');

                    swalWithBootstrapButtons.fire(
                        '¡Actualizado!',
                        'La relacion metrica-usuario ha sido actualizado de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La relacion metrica-usuario esta a salvo :)',
                        'error'
                    )
                }
            });
        });

        window.addEventListener('show-metric-user-deleteComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al eliminar la relacion metrica-usuario no habrá vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Borralo',
                cancelButtonText: 'Cancelar',
                timer: 10000
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete-user');

                    swalWithBootstrapButtons.fire(
                        '¡Eliminado!',
                        'La relacion metrica-usuario ha sido eliminado de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La relacion metrica-usuario esta a salvo :)',
                        'error'
                    )
                }

            });
        });


        window.addEventListener('show-metric-asignComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: 'Creado',
                html: "¡Metrica asignada exitosamente!",
                icon: 'success',
                timer: 5000
            })
        });


    </script>

@endpush

