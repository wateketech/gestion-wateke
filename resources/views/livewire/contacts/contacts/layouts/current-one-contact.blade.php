<div class="card-header p-3">

    <div class="d-flex px-2 py-1 justify-content-between">
        <div class="d-flex">
            {{-- <div class="avatar avatar-xxl me-3 bg-primary text-center fs-4">id: {{ $contact->id }} </div> --}}
                <img class="avatar avatar-xxl me-3 cursor-pointer"
                    src="{{ count($contact->pics) == 0 ? '../assets/img/illustrations/contact-profile-1.png'
                        : 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path( $contact->pics->first()->store . $contact->pics->first()->name ))) }}"
                    onclick="document.getElementById('contact-content-{{ $contact->id }}').scrollIntoView();">

            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-xl h5">
                    @isset($contact->prefix)
                        {!! json_decode($contact->prefix->label)->abb !!}.
                    @endisset
                    {{$contact->name . ' ' . $contact->middle_name . ' ' . $contact->first_lastname . ' ' . $contact->second_lastname}}
                </h6>
                {{ $contact->alias ? '(' . $contact->alias . ')': '' }}

                @if ($contact->emails->where('is_primary', true)->first())
                    <p class="text-md text-secondary pb-2 mb-0">{{ $contact->emails->where('is_primary', true)->first()->value }}</p>
                    <hr/>
                @else
                    {{-- esto nunca puede aparecer !!--}}
                    <p class="text-sm pt-2 mb-0"><i class="far fa-sad-tear fa-md icon-primary"></i> Este usuario no tiene email primario</p>
                @endif

                {{-- @if (isset($ocupation_id) && isset($ocupation_entity_id))
                    <p class="text-lg pt-2 mb-0">ocupation_id &nbsp;|&nbsp; ocupation_entity_id</p>
                @else
                    <p class="text-sm pt-2 mb-0">Este usuario no dispone de datos laborales</p>
                @endif --}}

            </div>
        </div>


        <div class="d-flex justify-content-top">

                @if ($primaryPhone = $contact->phones->where('is_primary', true)->first())
                    @if ($phoneNumber = json_decode($primaryPhone->value_meta)->call_number)
                        <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #ff6400"
                            href='tel:{!! $phoneNumber !!}'>
                            <i class="fas fa-phone-alt fa-lg"></i>
                        </a>
                    @endif
                @else
                    <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-phone-alt fa-lg"></i></div>
                @endif


                @if ($primaryChat = $contact->instant_messages->where('is_primary', true)->first())
                    <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #ff6400"
                        href='{{ $primaryChat->type->url . $primaryChat->value  }}' target="_blank">
                        <i class="fas fa-comment fa-lg"></i>
                    </a>
                @else
                    <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-comment fa-lg"></i></div>
                @endif

                @if ($contact->emails->where('is_primary', true)->first())
                    <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #ff6400"
                        href='mailto:{{ $contact->emails->where('is_primary', true)->first()->value }}'>
                        <i class="fas fa-envelope fa-lg"></i>
                    </a>
                @else
                    <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-envelope fa-lg"></i></div>
                @endif



        </div>


    </div>


    <div class="row">
        <div class="col-5 pb-3 pl-8 text-start">
            @forelse ($contact->rrss as $index => $rs)
                <a href="{{ $rs->type->url . $rs->value }}" target="_blank" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                    style="background-color: {{ $rs->type->color }}">
                    {!! html_entity_decode($rs->type->icon) !!}
                </a>
            @empty
            <i class="far fa-sad-tear fa-md icon-primary"></i> Este contacto no tienen redes sociales
            @endforelse
        </div>
        <div class="col-7 pb-4 px-4 text-end">
            @forelse ($contact->dates as $index => $date)
                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    {{-- style="background-color: {{ $date->type->color }}; color:white; cursor:pointer; position:relative;" --}}
                    style="background-color: #ffb280; color:white; cursor:pointer; position:relative;"
                        onmouseover="this.innerHTML='{!! htmlspecialchars($date->type->icon, ENT_QUOTES) !!}&nbsp;{{ $date->type->label }}';"
                        onmouseout="this.innerHTML='{!! htmlspecialchars($date->type->icon, ENT_QUOTES) !!}&nbsp;{{ $date->value }}';">
                    {!! html_entity_decode($date->type->icon) !!}&nbsp;{{ $date->value }}
                </a>
            @empty

            @endforelse
        </div>
    </div>

</div>


<div class="card-body px-2 pt-0">

    <div class="row mx-1">
        <div class="col-md-3 mb-md-0 mb-3 card card-body border card-plain border-radius-lg mx-3 px-3 py-3 min-height-120">
            {{-- <div class=""> --}}
                @forelse ($contact->ids as $id)
                    <p class="p-0 m-0">{!! html_entity_decode($id->type->icon) !!} {{ $id->value }}</p>
                    @empty
                    {{-- <p class="p-0 m-0"><small><i class="far fa-sad-tear fa-md icon-primary"></i> No tiene documentación <i class="far fa-sad-tear fa-md icon-primary"></i></small></p> --}}
                @endforelse
                <p class="pt-3 pb-2 p-0 m-0">{!! count($contact->publish_us) == 0 ? html_entity_decode('<i class="far fa-angry icon-danger"></i>') . ' NO nos publica ' : '' !!}</p>

                <strong class='pt-1 pr-3'>Notas: </strong>
                <small>{{ (isset($contact->about) && strlen(trim($contact->about))!=0) ? '' : 'No dispone' }}</small>{{-- agregar tambien condicion para el about laboral --}}
                @if (isset($contact->about) && strlen(trim($contact->about))!=0)
                    <div type="button" class="d-inline mx-0 px-2 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt px-0"></i>
                    </div>
                    <div class="dropdown-menu about">
                        {{ $contact->about}}
                    </div>
                @endif
                {{-- @if ()
                    <div type="button" class="d-inline mx-0 px-2 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fas fa-file-alt px-0"></i>
                    </div>
                    <div class="dropdown-menu about">

                    </div>
                @endif --}}

            {{-- </div> --}}
        </div>
        <div class="col-md-7 card card-body border card-plain border-radius-lg mx-3 px-3 py-3 pt-0 min-height-120">
            {{-- <div class=""> --}}
                @forelse ($contact->address as $index_add => $add)
                    <strong class="mt-3">Dirección {{ $add->name }}:</strong>
                    <p class="card-text fs-6 {{ ($add->geolocation || strlen($add->geolocation)!=0) ? 'cursor-pointer' : '' }}">
                        <i class="fas fa-map-marker-alt pl-3 pr-1 {{ ($add->geolocation || strlen($add->geolocation)!=0 ) ? 'text-primary' : '' }}"></i>
                                @php $localidad = null; @endphp
                            @foreach ($add->lines as $index_l => $line)
                                @if ($line->label != 'Localidad')
                                    {{ ($line->label == 'Número' ) || ($line->label=='Calle' ) ? '' : $line->label }}
                                    {{ $line->value }}
                                @else
                                    @php $localidad = $line->value; @endphp
                                @endif
                            @endforeach
                                @if ($add->country != null)
                                    {{ $localidad ? ', ' . $localidad : '' }},
                                    {{ $add->state != null ? $add->state->name : '' }},
                                    {{ $add->city != null ? $add->city->name : '' }},
                                    {{-- , {{ $find($add['country_id'])->name }} --}}
                                    {{ $add->country->name }} <span class="emoji">{{ $add->country->emoji }}</span>
                                @endif
                        </p>
                @empty
                    <p class="text-center py-6"><i class="far fa-sad-tear fa-lg icon-primary"></i> El usuario no tiene direcciones registradas <i class="far fa-sad-tear fa-lg icon-primary"></i></p>
                @endforelse
            {{-- </div> --}}
        </div>
    </div>





    <div class="accordion mt-4 mx-2" id="accordionInfoContacts">





        @if (count($contact->phones) != 0)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingPhone">
                    <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="false" aria-controls="collapsePhone">
                        <i class="fas fa-phone"></i>
                        &nbsp; TELÉFONOS
                    </div>
                </h2>
                <div id="collapsePhone" class="accordion-collapse collapse" aria-labelledby="headingPhone">
                    <div class="accordion-body">
                        @foreach ($contact->phones as $index => $phone)

                            <div class="row pb-3">
                                <div class="col text-start">
                                    <div class="d-flex px-0 py-1 px-2">
                                        <div class="d-flex flex-column justify-content-center px-2 {{ $phone->is_primary == true ? 'text-primary' : '' }}">
                                            {!!  html_entity_decode($phone->type->icon) !!}
                                        </div>
                                        <div class="d-flex flex-column justify-content-center px-2">
                                            <h6 class="mb-0 text-sm">{{ $phone->type->label }}</h6>
                                            <p class="text-xs text-secondary mb-0">
                                                {{ isset(json_decode($phone->value_meta)->country_name) ? json_decode($phone->value_meta)->country_name : ' - - - - - - ' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col px-3">
                                    {{-- <div class="d-flex flex-column justify-content-center px-3"> --}}
                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                            onclick="copyToClipboard('{!! json_decode($phone->value_meta)->call_number !!}')">
                                            @if (isset(json_decode($phone->value_meta)->country_dial_code) && isset(json_decode($phone->value_meta)->clean_number))
                                                {!! '+' . json_decode($phone->value_meta)->country_dial_code . ' ' . json_decode($phone->value_meta)->clean_number !!}
                                            @else
                                                {{ $phone->value != '' || $phone->value != null ? $phone->value : '? ? ? ? ? ? ? ? ? ? ? ? ? ? ?' }}
                                            @endif
                                        </p>
                                    {{-- </div> --}}
                                </div>
                                <div class="col px-3 text-end">
                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                        href='tel:{!! json_decode($phone->value_meta)->call_number !!}'>
                                        Llamar
                                    </a>
                                    <a class="btn btn-primary btn-sm me-1 mb-1 px-3 py-1 w-auto"
                                        href="javascript:void(0)" onclick="copyToClipboard('{!! json_decode($phone->value_meta)->call_number !!}')">
                                        Copiar
                                    </a>
                                </div>
                            </div>

                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        @if (count($contact->instant_messages) != 0)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingChats">
                    <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChats" aria-expanded="false" aria-controls="collapseChats">
                        <i class="fas fa-sms"></i>
                        &nbsp; CHATS
                    </div>
                </h2>
                <div id="collapseChats" class="accordion-collapse collapse" aria-labelledby="headingChats">
                    <div class="accordion-body">
                        @foreach ($contact->instant_messages as $index => $instant_message)
                            <div class="row pb-3">

                                <div class="col d-flex">
                                    <div class="d-flex flex-column justify-content-center px-2">
                                        <div class="d-flex flex-column justify-content-center px-1 {{ $instant_message->is_primary == true ? 'text-primary' : '' }}">
                                            @switch($instant_message->label)
                                                @case('Personal')
                                                @case('')
                                                @case(null)
                                                    <i class="fas fa-home fa-lg"></i>
                                                    @break
                                                @case('Trabajo')
                                                    <i class="fas fa-briefcase fa-lg"></i>
                                                    @break
                                                @default
                                                    <i class="fas fa-comments fa-lg"></i>
                                            @endswitch
                                        </div>
                                        <div class="d-flex flex-column justify-content-center px-2">
                                            <h6 class="mb-0 text-sm">{{ $instant_message->label === null || strlen($instant_message->label) === 0 ? 'Personal' : $instant_message->label }}</h6>
                                            <p class="text-xs text-secondary mb-0">{{ isset($instant_message->type->label) ? $instant_message->type->label : ' - - - - - - - - - ' }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="col px-3">
                                    {{-- <div class="d-flex flex-column justify-content-center px-3"> --}}
                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive; cursor:pointer;"
                                        onclick="copyToClipboard('{{ $instant_message->type->url . $instant_message->value  }}')">
                                            {{ $instant_message->value }}
                                        </p>
                                    {{-- </div> --}}
                                </div>

                                <div class="col px-3 text-end">
                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                        href='{{ $instant_message->type->url . $instant_message->value  }}' target="_blank">
                                        Chatear
                                    </a>
                                    <a class="btn btn-primary btn-sm me-1 mb-1 px-3 py-1 w-auto"
                                        href="javascript:void(0)" onclick="copyToClipboard('{{ $instant_message->type->url . $instant_message->value  }}')">
                                        Copiar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        @if (count($contact->emails) != 0)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingEmails">
                    <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmails" aria-expanded="false" aria-controls="collapseEmails">
                        <i class="fas fa-envelope"></i>
                        &nbsp; EMAILS
                    </div>
                </h2>
                <div id="collapseEmails" class="accordion-collapse" aria-labelledby="headingEmails">
                    <div class="accordion-body">
                        @foreach ($contact->emails as $index => $email)
                            <div class="row pb-3">

                                <div class="col d-flex">
                                    <div class="d-flex flex-column justify-content-center px-2 {{ $email->is_primary == true ? 'text-primary' : '' }}">
                                        @switch($email->label)
                                            @case('Personal')
                                            @case('')
                                            @case(null)
                                                <i class="fas fa-home fa-lg"></i>
                                                @break
                                            @case('Trabajo')
                                                <i class="fas fa-briefcase fa-lg"></i>
                                                @break
                                            @default
                                                <i class="fas fa-comments fa-lg"></i>
                                        @endswitch
                                    </div>
                                    <div class="d-flex flex-column justify-content-center px-2">
                                        <h6 class="mb-0 text-sm">{{ $email->label === null || strlen($email->label) === 0 ? 'Personal' : $email->label }}</h6>
                                        <p class="text-xs text-secondary mb-0">{{ isset($email->type->label) ? $email->type->label : ' - - - - - - - - - ' }}</p>
                                    </div>
                                </div>

                                <div class="col px-3">
                                    {{-- <div class="d-flex flex-column justify-content-center px-3"> --}}
                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                            onclick="copyToClipboard('{{ $email->value }}')">
                                            {{ $email->value }}
                                        </p>
                                    {{-- </div> --}}
                                </div>

                                <div class="col px-3 text-end">
                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                        href='mailto:{{ $email->value }}'>
                                        Enviar email
                                    </a>
                                    <a class="btn btn-primary btn-sm me-1 mb-1 px-3 py-1 w-auto"
                                        href="javascript:void(0)" onclick="copyToClipboard('{{ $email->value }}')">
                                        Copiar
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

        {{-- @if (count($contact->bank_accounts) != 0) --}}
        @if (false)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingBankAccounts">
                <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBankAcoounts" aria-expanded="false" aria-controls="collapseBankAcoounts">
                    {{-- <i class="fas fa-euro-sign"></i> --}}
                    <i class="fas fa-hand-holding-usd"></i>
                    &nbsp; CUENTAS BANCARIAS
                </div>
                </h2>
                <div id="collapseBankAcoounts" class="accordion-collapse collapse" aria-labelledby="headingBankAccounts">
                    <div class="accordion-body p-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 overflow-hidden">
                                <tbody>
                                    @foreach ($contact->bank_accounts as $index => $account)
                                        <tr class="row">
                                            <td class="col-4 text-start">
                                                <div class="d-flex px-0 py-1">
                                                    @if ($account->type->label != 'Unknown')
                                                        <img style="max-width: 100%; height: 40px;" src="{{ $account->type->logo }}" alt="{{ $account->type->label }}">
                                                    @else
                                                        <img style="max-width: 100%; height: 40px;" src="../assets/img/blank.png">
                                                    @endif

                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <h6 class="mb-0 text-sm">{{ $account->card_holder }}</h6>
                                                        <p class="text-xs text-secondary mb-0">
                                                            {{ $account->is_credit ? 'Cérdito' : 'Débito' }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="col-4 px-2">
                                                <div class="d-flex flex-column justify-content-center px-7">
                                                    <p class="text-md font-weight-bold mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                                        onclick="copyToClipboard('{{ $account->card_number }}')">
                                                        {!! implode('&nbsp;', str_split($account->card_number, 4)) !!}
                                                    </p>

                                                </div>
                                            </td>
                                            <td class="col-4 text-end">
                                                <span class="text-secondary text-xs ">Vence: <strong>{{ date('m/Y', strtotime($account->expiration_date)) }}    </strong></span>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @endif


        @if (count($contact->webs) != 0)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingWebs">
                    <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebs" aria-expanded="false" aria-controls="collapseWebs">
                        <i class="fas fa-wifi"></i>
                        {{-- <i class="fab fa-internet-explorer"></i> --}}
                        &nbsp; WEBS
                    </div>
                </h2>
                <div id="collapseWebs" class="accordion-collapse collapse" aria-labelledby="headingWebs">
                    <div class="accordion-body">
                        @foreach ($contact->webs as $index => $web)
                            <div class="row pb-3">

                                <div class="col d-flex">
                                        <div class="d-flex flex-column justify-content-center px-2">
                                            <i class="fas fa-globe fa-lg"></i>
                                        </div>
                                        <div class="d-flex flex-column justify-content-center px-2">
                                            <h6 class="mb-0 text-sm">{{ $web->type->label }}</h6>
                                            <p class="text-xs text-secondary mb-0">Personal</p>
                                        </div>
                                    </div>
                                </td>

                                <div class="col px-3">
                                    {{-- <div class="d-flex flex-column justify-content-center px-3"> --}}
                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                            onclick="copyToClipboard('{{ $web->value }}')">
                                            {{ $web->value }}
                                        </p>
                                    {{-- </div> --}}
                                </div>

                                <div class="col px-3 text-end">
                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                        href="//{{ $web->value }}" target="_blank">
                                        Visitar
                                    </a>
                                    <a class="btn btn-primary btn-sm me-1 mb-1 px-3 py-1 w-auto"
                                        href="javascript:void(0)" onclick="copyToClipboard('{{ $web->value }}')">
                                        Copiar
                                    </a>
                                </div>

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif


        @if (count($contact->publish_us) != 0)
            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingPublishUs">
                    <div class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePublishUs" aria-expanded="false" aria-controls="collapsePublishUs">
                        <i class="fas fa-bullhorn"></i>
                        {{-- <i class="fab fa-internet-explorer"></i> --}}
                        &nbsp; NOS PUBLICA
                    </div>
                </h2>
                <div id="collapsePublishUs" class="accordion-collapse collapse" aria-labelledby="headingPublishUs">
                    <div class="accordion-body">
                        @foreach ($contact->publish_us as $index => $web)
                            <div class="row pb-3">

                                <div class="col d-flex">
                                    <div class="d-flex flex-column justify-content-center px-2">
                                        <i class="fas fa-globe fa-lg"></i>
                                    </div>
                                    <div class="d-flex flex-column justify-content-center px-2">
                                        <h6 class="mb-0 text-sm">{{ $web->type->label }}</h6>
                                        {{-- <p class="text-xs text-secondary mb-0">Personal</p> --}}
                                    </div>
                                </div>

                                <div class="col px-3">
                                    {{-- <div class="d-flex flex-column justify-content-center px-3"> --}}
                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                            onclick="copyToClipboard('{{ $web->value }}')">
                                            {{ $web->value }}
                                        </p>
                                    {{-- </div> --}}
                                </div>

                                <div class="col px-3 text-end">
                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                        href="//{{ $web->value }}" target="_blank">
                                        Visitar
                                    </a>
                                    <a class="btn btn-primary btn-sm me-1 mb-1 px-3 py-1 w-auto"
                                        href="javascript:void(0)" onclick='copyToClipboard("{{ $web->value }}")'>
                                        Copiar
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif



















    </div>



</div>
