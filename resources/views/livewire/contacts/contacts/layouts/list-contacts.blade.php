<div class="card h-100">
    <div class="card-header pb-0 p-3">
        <input type="text" wire:model='search'
            class="w-100 form-control search-input" aria-label="Large" placeholder="BUSQUEDA">
    </div>
    <div class="card-body p-3">

        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0">
                <thead>
                    <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                    {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cargo</th> --}}
                    {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registrado</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @forelse ($contacts as $index => $contact)
                    <tr>
                        <td>
                            <div class="d-flex px-2 py-1">
                                <div>
                                    {{-- <div class="avatar avatar-sm me-3 bg-primary"> {{ $contact->id }} </div> --}}
                                    <img class="avatar avatar-sm me-3"
                                        src="{{ count($contacts->find($contact)->pics) == 0 ? '../assets/img/illustrations/contact-profile-2.png'
                                            : 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path( $contacts->find($contact)->pics->first()->store . $contacts->find($contact)->pics->first()->name ))) }}">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                    <h6 class="mb-0 text-sm">
                                        {!! json_decode($contacts->find($contact)->prefix->label)->abb !!}.
                                        {{ $contact['name'] . ' ' . $contact['first_lastname'] }}
                                    </h6>

                                    {{-- <p class="text-xs text-secondary mb-0">{{ $contacts->find($contact)->emails->where('is_primary', true)->first()->value }}</p> --}}
                                    <span class="text-secondary text-xs font-weight-bold"><small>
                                        {{ $contact->created_at == $contact->updated_at ? 'creado' : 'actualizado' }}
                                        {{ $contact->updated_at->diffForHumans() }} </small>
                                    </span>

                                </div>
                            </div>
                        </td>
                        {{-- <td>
                            <p class="text-xs font-weight-bold mb-0">Recursos Humanos</p>
                            <p class="text-xs text-secondary mb-0">Wateke Travel</p>
                        </td> --}}

                        <td class="align-middle text-center">
                            @if ($primaryPhone = $contacts->find($contact)->phones->where('is_primary', true)->first())
                                @if ($phoneNumber = json_decode($primaryPhone->value_meta)->call_number)
                                    <a href='tel:{!! $phoneNumber !!}'><i class="fas fa-phone-alt fa-sm me-2 icon-call"></i></a>
                                @endif
                                @else
                                    {{-- <a href='void(0)'><i class="fas fa-phone-alt fa-sm me-2"></i></a> --}}
                            @endif

                            <a href='mailto:{{ $contacts->find($contact)->emails->where('is_primary', true)->first()->value }}'>
                                <i class="fas fa-envelope fa-sm me-2 icon-mail"></i>
                            </a>

                            @if ($primaryChat = $contacts->find($contact)->instant_messages->where('is_primary', true)->first())
                                    <a href='{{ $primaryChat->type->url . $primaryChat->value  }}' target="_blank">
                                        <i class="fas fa-comment fa-sm me-2 icon-text"></i>
                                    </a>
                                @else
                                    {{-- <a href='void(0)'><i class="fas fa-comment-alt fa-sm me-2"></i></a> --}}
                            @endif

                            {{-- <span class="text-secondary text-xs font-weight-bold">{{ $contact->created_at->format('M y') }}</span> --}}
                        </td>
                    </tr>
                    @empty
                    @if ($search != '')
                        No coincide ningun contacto &nbsp;&nbsp; <strong>boton de crear</strong>
                    @else
                        Aun no hay contactos &nbsp;&nbsp; <strong>._.</strong>
                    @endif
                    @endforelse
               </tbody>
            </table>
        </div>
    </div>
</div>
