<div class="card h-100"
    style="
        min-height: 100vh !important;
        max-height: 100vh !important;
    ">

    <div class="card-header pb-0 p-3 position-relative">
        <div class="position-relative">
            <input type="text" wire:model='search' class="w-100 form-control search-input" aria-label="Large" placeholder="BUSQUEDA">
            {{-- <div class="input-group-append position-absolute top-0 end-3"
                style="display: {{ $search != '' ? 'flex' : 'none' }};">
                <div class="py-2 px-1" type="button" wire:click="$toggle('is_search_name')"><i class="fas fa-signature {{ $is_search_name ? 'icon-primary fa-md': 'fa-xs'}}" aria-hidden="true"></i></div>
                <div class="py-2 px-1" type="button" wire:click="$toggle('is_search_ids')"><i class="fas fa-id-card {{ $is_search_ids ? 'icon-primary fa-md': 'fa-xs'}}" aria-hidden="true"></i></div>
                <div class="py-2 px-1" type="button" wire:click="$toggle('is_search_emails')"><i class="fas fa-envelope {{ $is_search_emails ? 'icon-primary fa-md': 'fa-xs'}}" aria-hidden="true"></i></div>
                <div class="py-2 px-1" type="button" wire:click="$toggle('is_search_webs')"><i class="fas fa-globe {{ $is_search_webs ? 'icon-primary fa-md': 'fa-xs'}}" aria-hidden="true"></i></div>
                <div class="py-2 px-1" type="button" wire:click="$toggle('is_search_phones')"><i class="fas fa-phone {{ $is_search_phones ? 'icon-primary fa-md': 'fa-xs'}}" aria-hidden="true"></i></div>
            </div> --}}
        </div>
    </div>
    <div class="card-body p-3" style="overflow-y: scroll;">

        <div class="table-responsive p-0" style="
                                            overflow-x: hidden;
                                            min-height: 100vh !important;">
            <table class="table align-items-center mb-0 contact-table">
                <thead class="contact-header">
                    @if (count($contacts))
                        <tr>
                            <th class="d-flex flex-row justify-content-between py-1 px-4">
                                <a href='javascript:void(0)' class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                    {{ count($contacts) }} contactos
                                </a>
                                <div>
                                    <a href='javascript:void(0)' class="btn {{ $multiple_selection ? 'btn-primary' : 'btn-outline-primary' }} text-xxs px-2 py-1 m-0 opacity-8"
                                        wire:click="$toggle('multiple_selection')">
                                        Seleccion Multiple
                                    </a>
                                    <a href='javascript:void(0)' class="btn {{ count($contacts) == count($current_contacts) ? 'btn-primary' : 'btn-outline-primary' }} text-xxs px-2 py-1 m-0 opacity-8"
                                        wire:click="selectAll">
                                        Todos
                                    </a>
                                </div>
                            </th>
                        </tr>
                    @endif
                </thead>
                <tbody class="contact-list" style="border-colapse:collapse">
                    @forelse ($contacts as $index => $contact)
                        <tr class="contact-row {{ $current_contact == $contact->id ? 'active': '' }} {{ in_array($contact->id, $current_contacts) ? 'active' : '' }}"
                                wire:click="$set('current_contact', {{ $contact->id }})"
                                onMouseOut="document.getElementById('contact-fast-actions-{{ $contact->id }}').classList.add('d-none')"
                                onMouseOver="document.getElementById('contact-fast-actions-{{ $contact->id }}').classList.remove('d-none')"
                                    >
                            <td class="p-1 px-4" id="contact-content-{{ $contact->id }}">
                                <div class="d-flex px-2 py-1" id="test">
                                    <a href='javascript:void(0)'> {{-- seleccionar varios a la vez --}}
                                        <img class="avatar avatar-sm me-3"
                                            src="{{ count($contacts->find($contact)->pics) == 0 ? '../assets/img/illustrations/contact-profile-2.png'
                                                : 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path( $contacts->find($contact)->pics->first()->store . $contacts->find($contact)->pics->first()->name ))) }}">
                                    </a>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="contact-name mb-0 text-sm">
                                            @isset($contacts->find($contact)->prefix)
                                                {!! json_decode($contacts->find($contact)->prefix->label)->abb !!}.
                                            @endisset
                                            {{ $contact['name'] . ' ' . $contact['first_lastname'] }}
                                        </h6>

                                        {{-- <p class="text-xs text-secondary mb-0">{{ $contacts->find($contact)->emails->where('is_primary', true)->first()->value }}</p> --}}
                                        <span class="text-secondary text-raleway text-xs" wire:poll.keep-alive>
                                            @if ($contact->is_editing)
                                                <span class="text-primary blink-3 ">en edicion por {{ $contact->edited_by_user->name }}</span>
                                            @else
                                                {{ $contact->created_at == $contact->updated_at ? 'creado' : 'actualizado' }}
                                                por {{$contact->created_at == $contact->updated_at ? $contact->created_by_user->name : $contact->edited_by_user->name   }}
                                                {{ $contact->updated_at->diffForHumans() }}
                                            @endif
                                        </span>

                                    </div>
                                </div>
                            </td>
                            {{-- <td>
                                <p class="text-xs font-weight-bold mb-0">Recursos Humanos</p>
                                <p class="text-xs text-secondary mb-0">Wateke Travel</p>
                            </td> --}}

                            <td class="align-middle text-center p-1 d-none" id="contact-fast-actions-{{ $contact->id }}"
                                style="position: absolute; right: 3em; border: none;" wire:ignore>
                                @if ($primaryPhone = $contacts->find($contact)->phones->where('is_primary', true)->first())
                                    @if ($phoneNumber = json_decode($primaryPhone->value_meta)->call_number)
                                        <a class="btn btn-primary btn-md"
                                            href='tel:{!! $phoneNumber !!}'>
                                            <i class="fas fa-phone-alt"></i>
                                        </a>
                                    @endif
                                    @else
                                        {{-- <a href='void(0)'><i class="fas fa-phone-alt fa-sm me-2"></i></a> --}}
                                @endif

                                @if ($contacts->find($contact)->emails->where('is_primary', true)->first())
                                    <a class="btn btn-primary btn-md"
                                        href='mailto:{{ $contacts->find($contact)->emails->where('is_primary', true)->first()->value }}'>
                                        <i class="fas fa-envelope"></i>
                                    </a>
                                    @else
                                    {{-- <a href='void(0)'><i class="fas fa-phone-alt fa-sm me-2"></i></a> --}}
                                @endif

                                @if ($primaryChat = $contacts->find($contact)->instant_messages->where('is_primary', true)->first())
                                        <a class="btn btn-primary btn-md"
                                            href='{{ $primaryChat->type->url . $primaryChat->value  }}' target="_blank">
                                            <i class="fas fa-comment"></i>
                                        </a>
                                    @else
                                        {{-- <a href='void(0)'><i class="fas fa-comment-alt fa-sm me-2"></i></a> --}}
                                @endif

                                {{-- <span class="text-secondary text-xs font-weight-bold">{{ $contact->created_at->format('M y') }}</span> --}}
                            </td>
                        </tr>
                    @empty
                        <tr class='mx-auto text-center'>
                            @if ($search != '')
                                <td><i class="far fa-frown"></i> &nbsp;No coincide ningun contacto.&nbsp; <i class="far fa-frown"></i></td>
                            @else
                                <td><i class="far fa-frown-open"></i> &nbsp;Aun no hay contactos.&nbsp; <i class="far fa-frown-open"></i></td>
                            @endif
                        </tr>
                    @endforelse
               </tbody>
            </table>
        </div>
    </div>
</div>



@push('scripts')
<script>
    window.addEventListener('load', function() {
        // seleccion multiple contactos con control
        $multiple_selection_start = false;

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Control' &&  !$multiple_selection_start){
                $multiple_selection_start = true;
                Livewire.emit('multiple_selection', {'is_multiple' : true});
            }
        });
        document.addEventListener('keyup', function(event) {
            if (event.key === 'Control') {
                $multiple_selection_start = false;
                Livewire.emit('multiple_selection', {'is_multiple' : false});
            }
        });
    });
</script>
@endpush
