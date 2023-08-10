<div class="card h-100">
    <div class="card-header p-4 form-title">
        <div class="w-100 text-center">
            <i class="fas fa-users"></i> &nbsp;Grupos
        </div>
    </div>
    <div class="card-body px-2 pt-0">
        <p href='javascript:void(0)' class="text-uppercase text-secondary text-xs font-weight-bolder opacity-8 mx-3">
            {{ count($contact_groups) }} grupos
        </p>



            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-3 col-sm-4 col-xs-6 p-0">
                        <div class="d-flex p-2 m-1 contact-row {{ $current_group == Null ? 'active': '' }}"
                                wire:click="setCurrentGroup({{ 0 }})">
                            <div class="position-relative icon icon-shape icon-md shadow text-center border-radius-sm me-2"
                                style="background-color: #75b14f">
                                <i class="fas fa-star"></i>
                            </div>
                            <div class="d-flex flex-column justify-content-center pl-2">
                                <h6 class="mb-0 text-md row-name">Todos</h6>
                                {{-- <p class="text-xs text-secondary mb-0">Recientemente</p> --}}
                            </div>
                        </div>
                    </div>

                @forelse ($contact_groups as $group)
                    <div class="col-lg-12 col-md-3 col-sm-4 col-xs-6 p-0">
                        <div class="d-flex p-2 m-1 contact-row {{ $current_group == $group->id ? 'active': '' }}"
                                wire:click="setCurrentGroup({{ $group->id }})">
                            <div class="position-relative icon icon-shape icon-md shadow text-center border-radius-sm me-2"
                                style="background-color: {{ $group->color }}">
                                {!! html_entity_decode($group->icon) !!}
                                <a href="javascript:;" class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2"  wire:click="GroupForm('{{ $group->id }}')"
                                    style="transform: scale(.85)">
                                    <i class="fa fa-pen top-0 text-dark" data-bs-toggle="tooltip" data-bs-placement="top" title="" aria-hidden="true"
                                    data-bs-original-title="Editar" aria-label="Editar Image"></i>
                                    <span class="sr-only">Editar</span>
                                </a>
                            </div>
                            <div class="d-flex flex-column justify-content-center pl-2">
                                <h6 class="mb-0 text-sm row-name">{{ $group->name }}</h6>
                                <p class="text-xs text-secondary mb-0">{{ count($group->contacts) }} Contactos</p>
                            </div>
                        </div>
                    </div>
                @empty

                    {{-- <div class="d-flex justify-content-center">
                        <p>
                            <i class="far fa-frown-open"></i> &nbsp;Aun no hay grupos.&nbsp; <i class="far fa-frown-open"></i>
                        </p>
                    </div> --}}

                @endforelse
                <div class="col-lg-12 col-md-3 col-sm-4 col-xs-6 p-0">
                    <div class="d-flex p-2 m-1 contact-row {{ $current_group == -1 ? 'active': '' }}"
                            wire:click="setCurrentGroup({{ -1 }})">
                        <div class="position-relative icon icon-shape icon-md shadow text-center border-radius-sm me-2"
                            style="background-color: #323232">
                            <i class="fas fa-trash"></i>
                        </div>
                        <div class="d-flex flex-column justify-content-center pl-2">
                            <h6 class="mb-0 text-md row-name">Papelera</h6>
                            {{-- <p class="text-xs text-secondary mb-0">Recientemente</p> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</div>
