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

        <div class="table-responsive p-0">
            <table class="table align-items-center mb-0 contact-table">
                <thead class="contact-header">
                    @if (count($users))
                        <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nombre</th>
                        {{-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Cargo</th> --}}
                        {{-- <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Registrado</th> --}}
                        </tr>
                    @endif
                </thead>
                <tbody class="contact-list">
                    @forelse ($users as $index => $user)
                        <tr class="contact-row {{ $current_user == $user->id ? 'active': '' }} {{ in_array($user->id, $current_users) ? 'active' : '' }}"
                                wire:click="$set('current_user', {{ $user->id }})">
                            <td class="p-1 px-2">
                                <div class="d-flex px-2 py-1">
                                    <a href='javascript:void(0)'>
                                        <div class="avatar avatar-sm me-2 bg-primary">
                                            {{ $user['id'] }}
                                        </div>
                                    </a>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="contact-name mb-0 text-sm">
                                            {{ $user['name'] . ' ' . $user['first_lastname'] }}
                                        </h6>

                                        <span class="text-secondary text-xs font-weight-bold">
                                            {{ $user['email'] }}
                                        </span>


                                        {{-- <span class="text-secondary text-xs font-weight-bold" wire:poll.keep-alive>
                                            @if ($user->is_editing)
                                                <span class="text-primary blink-3 ">en edicion por {{ $user->edited_by_user->name }}</span>
                                            @else
                                                {{ $user->created_at == $user->updated_at ? 'creado' : 'actualizado' }}
                                                por {{$user->created_at == $user->updated_at ? $user->created_by_user->name : $user->edited_by_user->name   }}
                                                {{ $user->updated_at->diffForHumans() }}
                                            @endif
                                        </span> --}}

                                    </div>
                                </div>
                            </td>
                            {{-- <td>
                                <p class="text-xs font-weight-bold mb-0">Recursos Humanos</p>
                                <p class="text-xs text-secondary mb-0">Wateke Travel</p>
                            </td> --}}

                            {{-- <td class="align-middle text-center p-1">
                                @if ($primaryPhone = $contacts->find($contact)->phones->where('is_primary', true)->first())
                                    @if ($phoneNumber = json_decode($primaryPhone->value_meta)->call_number)
                                        <a href='tel:{!! $phoneNumber !!}'><i class="fas fa-phone-alt fa-sm me-2 icon-call text-dark"></i></a>
                                    @endif
                                    @else

                                @endif

                                @if ($contacts->find($contact)->emails->where('is_primary', true)->first())
                                    <a href='mailto:{{ $contacts->find($contact)->emails->where('is_primary', true)->first()->value }}'>
                                        <i class="fas fa-envelope fa-sm me-2 icon-mail text-dark"></i>
                                    </a>
                                    @else
                                @endif

                                @if ($primaryChat = $contacts->find($contact)->instant_messages->where('is_primary', true)->first())
                                        <a href='{{ $primaryChat->type->url . $primaryChat->value  }}' target="_blank">
                                            <i class="fas fa-comment fa-sm me-2 icon-text text-dark"></i>
                                        </a>
                                    @else

                                @endif


                            </td> --}}
                        </tr>
                    @empty
                        <tr class='mx-auto text-center'>
                            @if ($search != '')
                                <td><i class="far fa-frown"></i> &nbsp;No coincide ningun usuario.&nbsp; <i class="far fa-frown"></i></td>
                            @else
                                <td><i class="far fa-frown-open"></i> &nbsp;Aun no hay usuarios.&nbsp; <i class="far fa-frown-open"></i></td>
                            @endif
                        </tr>
                    @endforelse
               </tbody>
            </table>
        </div>
    </div>
</div>



{{-- @push('scripts')
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
@endpush --}}
