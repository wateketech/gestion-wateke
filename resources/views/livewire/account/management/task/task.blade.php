<div>

    <main class="main-content">
        <div class="container-fluid py-4">

            {{-- CRUD --}}
            @include("livewire.account.management.task.$view")

            {{-- Tables --}}
            @include("livewire.account.management.task.table")

        </div>
    </main>

    @stack('task-scripts')

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

        // window.addEventListener('show-metric-updateComfirmed', function(){
        //     swalWithBootstrapButtons.fire({
        //         position: 'center' ,
        //         title: '¿Estas seguro?',
        //         html: "¡Al actualizar la métrica no habrá vuelta atrás!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Actualizalo',
        //         cancelButtonText: 'Cancelar',
        //         timer: 10000
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Livewire.emit('update-metric');

        //             swalWithBootstrapButtons.fire(
        //                 '¡Actualizado!',
        //                 'La métrica ha sido actualizada en la base de datos.',
        //                 'success'
        //             )
        //         } else if
        //         ( result.dismiss === Swal.DismissReason.cancel)
        //         {
        //             swalWithBootstrapButtons.fire(
        //                 'Cancelado',
        //                 'La métrica esta a salvo :)',
        //                 'error'
        //             )
        //         }
        //     });
        // });

        // window.addEventListener('show-metric-deleteComfirmed', function(){
        //     swalWithBootstrapButtons.fire({
        //         position: 'center' ,
        //         title: '¿Estas seguro?',
        //         html: "¡Al eliminar la métrica no habrá vuelta atrás!",
        //         icon: 'warning',
        //         showCancelButton: true,
        //         confirmButtonText: 'Borralo',
        //         cancelButtonText: 'Cancelar',
        //         timer: 10000
        //     }).then((result) => {
        //         if (result.isConfirmed) {
        //             Livewire.emit('delete-metric');

        //             swalWithBootstrapButtons.fire(
        //                 '¡Eliminado!',
        //                 'La métrica ha sido eliminada de la base de datos.',
        //                 'success'
        //             )
        //         } else if
        //         ( result.dismiss === Swal.DismissReason.cancel)
        //         {
        //             swalWithBootstrapButtons.fire(
        //                 'Cancelado',
        //                 'La métrica está a salvo :)',
        //                 'error'
        //             )
        //         }

        //     });
        // });



        window.addEventListener('show-metric-createComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: 'Creado',
                html: "¡Métrica creada exitosamente!",
                icon: 'success',
                timer: 5000
            })
        });


    </script>

@endpush
