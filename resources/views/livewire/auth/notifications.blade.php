{{-- controlar el wire:poll para que no me reinicie el estado del desplegable --}}

<li class="nav-item dropdown px-3 pe-2 d-flex align-items-center" wire:poll="refresh">
    <a href="javascript:;" class="nav-link text-body p-0 {{ $is_open_menu ? 'show' : '' }}" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
        @if ($unreadNotifications > 0)
            <i class="far fa-bell fa-lg text-danger"></i>
            <span class="badge bg-danger rounded-circle position-absolute top-0 start-80 translate-middle p-1">{{ $unreadNotifications }}</span>
        @else
            <i class="fa fa-bell cursor-pointer fa-lg"></i>
        @endif
    </a>

    <ul class="dropdown-menu {{ $is_open_menu ? 'show' : '' }} dropdown-menu-end  px-2 py-3 me-sm-n4" aria-labelledby="dropdownMenuButton"
    style="width: max-content;">
    @if ($unreadNotifications < 0)
        <li class="mt-2 text-center">
            No tienes notificaciones
        </li>
    @else
        @foreach ($is_editing_contact as $contact)
            <li class="mb-1" >
                <a class="dropdown-item border-radius-md" href="javascript:;" wire:click='finish_editing_contact("{{ $contact->id }}")'>
                {{-- <a class="dropdown-item border-radius-md" href="/editar-contacto/{{ $contact->id }}"> --}}
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <img class="avatar avatar-sm me-3"
                            src="{{ count($contact->pics) == 0 ? '../assets/img/illustrations/contact-profile-2.png'
                                : 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path( $contact->pics->first()->store . $contact->pics->first()->name ))) }}">
                        </div>

                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-0">
                                <p class="font-weight-bold mb-0">Contacto
                                    <span class="blink-3"> en edición</span>
                                </p>
                            </h6>
                            <p class="text-xs text-secondary text-danger mb-0">
                                <i class="fas fa-ban me-1"></i>
                                ¡ Click para terminar proceso !
                            </p>
                        </div>
                    </div>
                </a>
            </li>
        @endforeach

        <hr class="horizontal dark mb-2">

        @forelse ($notifications as $notification)
            <li class="mb-2">
                <a class="dropdown-item border-radius-md" href="javascript:;">
                    <div class="d-flex py-1">
                        <div class="my-auto">
                            <img src="../assets/img/kal-visuals-square.jpg" class="avatar avatar-sm me-3">
                        </div>
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="text-sm font-weight-normal mb-1">
                                <span class="font-weight-bold">Nuevo contacto</span> por Patricia
                            </h6>
                            <p class="text-xs text-secondary mb-0">
                                <i class="fa fa-clock me-1"></i>
                                hace 1 día
                            </p>
                        </div>
                    </div>
                </a>
            </li>
        @empty
            <li class="mt-2 text-center">
                No tienes notificaciones
            </li>
        @endforelse
    @endif
</ul>
</li>

<script wire:ignore>
    // Obtener el menú desplegable
    var dropdownToggle = document.querySelector('#dropdownMenuButton');
    var dropdownMenu = dropdownToggle.nextElementSibling;

    // Escuchar el evento click en el objeto document
    document.addEventListener('click', function(event) {
        // Comprobar si el clic se produjo dentro o fuera del menú desplegable
        var isClickedInside = dropdownToggle.contains(event.target) || dropdownMenu.contains(event.target);

        // Si el clic se produjo fuera del menú desplegable, cerrar el menú
        if (!isClickedInside) {
            // Livewire.emit('delete_contact', deletedContactId, result.value);
            Livewire.emit('set_open_menu', false);
        }else{
            Livewire.emit('set_open_menu', true);
        }
    });
</script>
