<div class="main-content">
<div wire:ignore>
    <div id='menu' class="card blur shadow-blur mx-4">
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                    <li class="nav-item" wire:click="$set('view', 'user')">
                        <a class="nav-link mb-0 px-0 py-2 active " data-bs-toggle="tab" href="javascript:;" role="tab"
                            aria-controls="overview" aria-selected="true">
                            <span class="ms-1">Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item" wire:click="$set('view', 'task')">
                        <a class="nav-link mb-0 px-0 py-2 " data-bs-toggle="tab" href="javascript:;" role="tab"
                            aria-controls="teams" aria-selected="false">
                            <span class="ms-1">Tareas</span>
                        </a>
                    </li>
                    <li class="nav-item" wire:click="$set('view', 'user-task')">
                        <a class="nav-link mb-0 px-0 py-2 " data-bs-toggle="tab" href="javascript:;" role="tab"
                            aria-controls="dashboard" aria-selected="false">
                            <span class="ms-1">Asignacion de Tareas</span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
</div>


    {{-- <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white"><strong>Add, Edit, Delete features are not functional!</strong> This is a
            <strong>PRO</strong> feature!
            Click <strong><a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank"
                    class="text-white">here</a></strong>
            to see the PRO
            product!</span>
    </div> --}}


    {{-- SECCIONES DE LA PAGINA  --}}
    <div class="my-2">
        @if($view === 'user')
            @livewire("account.management.user.user")
        @elseif($view === 'task')
            @livewire("account.management.task.task")
        @elseif($view === 'user-task')
            @livewire("account.management.user-task.user-task")
        @endif
    </div>
</div>


{{-- Sweet Alert Notificaciones --}}
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



        // SECCION DE USUARIOS
        window.addEventListener('show-user-updateComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al actualizar el usuario no habrá vuelta atrás!",
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
                        'El usuario ha sido actualizado de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El usuario esta a salvo :)',
                        'error'
                    )
                }
            });
        });

        window.addEventListener('show-user-deleteComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al eliminar el usuario no habrá vuelta atrás!",
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
                        'El usuario ha sido eliminado de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'El usuario esta a salvo :)',
                        'error'
                    )
                }

            });
        });

        window.addEventListener('show-user-createComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: 'Creado',
                html: "¡Usuario creado exitosamente!",
                icon: 'success',
                timer: 5000
            })
        });


        // SECCION DE TAREAS
        window.addEventListener('show-metric-updateComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al actualizar la métrica no habrá vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Actualizalo',
                cancelButtonText: 'Cancelar',
                timer: 10000
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('update-metric');

                    swalWithBootstrapButtons.fire(
                        '¡Actualizado!',
                        'La métrica ha sido actualizada en la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La métrica esta a salvo :)',
                        'error'
                    )
                }
            });
        });

        window.addEventListener('show-metric-deleteComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al eliminar la métrica no habrá vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Borralo',
                cancelButtonText: 'Cancelar',
                timer: 10000
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete-metric');

                    swalWithBootstrapButtons.fire(
                        '¡Eliminado!',
                        'La métrica ha sido eliminada de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La métrica está a salvo :)',
                        'error'
                    )
                }

            });
        });

        window.addEventListener('show-metric-createComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: 'Creado',
                html: "¡Métrica creada exitosamente!",
                icon: 'success',
                timer: 5000
            })
        });



        // SECCION TAREAS POR USUARIOS
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


{{-- JSs SECCION DE USER    (por defecto ya vienen cargados[pq es la vista principal]) )--}}
@push('scripts')
@endpush

{{-- JSs SECCION DE TASK    (encapsulados en eventos al cambio de menu ($view) )--}}
@push('scripts')
@endpush

{{-- JSs SECCION DE USER-TASK   (encapsulados en eventos al cambio de menu ($view) )--}}
@push('scripts')
    <script src="../../assets/js/plugins/chartjs.min.js"></script>
    <script>
        window.addEventListener('build-user-metrics', function(){

            // Line chart
            var ctx1 = document.getElementById("line-chart-metrics").getContext("2d");

            new Chart(ctx1, {
            type: "line",
            data: {
                labels: ['ene', 'feb', 'marz', 'abril', 'mayo', 'jun', 'julio', 'agosto', 'sept'],

                datasets: [

                {
                    label: "Valor Promedio",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#e3316e",
                    borderColor: "#e3316e",
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    data: [50, 50, 300, 220, 500, 250, 400, 230, 500],
                    maxBarThickness: 6
                },
                {
                    label: "Referral",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#3A416F",
                    borderColor: "#3A416F",
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
                    maxBarThickness: 6
                },
                {
                    label: "Direct",
                    tension: 0.4,
                    borderWidth: 0,
                    pointRadius: 2,
                    pointBackgroundColor: "#17c1e8",
                    borderColor: "#17c1e8",
                    borderWidth: 3,
                    backgroundColor: 'transparent',
                    data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
                    maxBarThickness: 6
                },
                ],




            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                legend: {
                    display: false,
                }
                },
                interaction: {
                intersect: false,
                mode: 'index',
                },
                scales: {
                y: {
                    grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: false,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    padding: 10,
                    color: '#b2b9bf',
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                x: {
                    grid: {
                    drawBorder: false,
                    display: true,
                    drawOnChartArea: true,
                    drawTicks: true,
                    borderDash: [5, 5]
                    },
                    ticks: {
                    display: true,
                    color: '#b2b9bf',
                    padding: 10,
                    font: {
                        size: 11,
                        family: "Open Sans",
                        style: 'normal',
                        lineHeight: 2
                    },
                    }
                },
                },
            },
            });
        });
    </script>

@endpush


