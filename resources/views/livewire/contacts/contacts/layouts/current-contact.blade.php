<div class="card max-vh-100 min-vh-100
    {{ !isset($contact) && count($contacts) <= 1 ? 'd-flex align-items-center justify-content-center' : '' }}">

    @if (isset($contact) && !$multiple_selection)
        <div class="card-header p-3">

            <div class="d-flex px-2 py-1 justify-content-between">
                <div class="d-flex">
                    {{-- <div class="avatar avatar-xxl me-3 bg-primary text-center fs-4">id: {{ $contact->id }} </div> --}}
                    <div>
                        <img class="avatar avatar-xxl me-3"
                            src="{{ count($contact->pics) == 0 ? '../assets/img/illustrations/contact-profile-1.png'
                                : 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path( $contact->pics->first()->store . $contact->pics->first()->name ))) }}">
                    </div>
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="mb-0 text-xl h5">
                            {!! json_decode($contact->prefix->label)->abb !!}.
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
                            <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #00a600"
                                href='tel:{!! $phoneNumber !!}'>
                                <i class="fas fa-phone-alt fa-lg"></i>
                            </a>
                        @endif
                    @else
                        <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-phone-alt fa-lg"></i></div>
                    @endif


                    @if ($contact->emails->where('is_primary', true)->first())
                        <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: rgb(0, 153, 255)"
                            href='mailto:{{ $contact->emails->where('is_primary', true)->first()->value }}'>
                            <i class="fas fa-envelope fa-lg"></i>
                        </a>
                    @else
                        <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-envelope fa-lg"></i></div>
                    @endif


                    @if ($primaryChat = $contact->instant_messages->where('is_primary', true)->first())
                        <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #008000"
                            href='{{ $primaryChat->type->url . $primaryChat->value  }}' target="_blank">
                            <i class="fas fa-comment fa-lg"></i>
                        </a>
                    @else
                        <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-comment fa-lg"></i></div>
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
                            style="background-color: {{ $date->type->color }}; color:white; cursor:pointer; position:relative;"
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
                            <p class="p-0 m-0"><small><i class="far fa-sad-tear fa-md icon-primary"></i> No tiene documentación <i class="far fa-sad-tear fa-md icon-primary"></i></small></p>
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
                                        {{ $localidad ? ', ' . $localidad : '' }},
                                        {{ $add->state->name }},
                                        {{ $add->city->name }},
                                        {{-- , {{ $find($add['country_id'])->name }} --}}
                                        {{ $add->country->name }} <span class="emoji">{{ $add->country->emoji }}</span>
                                </p>
                        @empty
                            <p class="text-center py-6"><i class="far fa-sad-tear fa-lg icon-primary"></i> El usuario no tiene direcciones registradas <i class="far fa-sad-tear fa-lg icon-primary"></i></p>
                        @endforelse
                    {{-- </div> --}}
                </div>
            </div>





            <div class="accordion mt-4 mx-2" id="accordionExample">





                @if (count($contact->phones) != 0)
                    <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                        <h2 class="accordion-header" id="headingPhone">
                            <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="false" aria-controls="collapsePhone">
                                <i class="fas fa-phone"></i>
                                &nbsp; TELÉFONOS
                            </button>
                        </h2>
                        <div id="collapsePhone" class="accordion-collapse collapse" aria-labelledby="headingPhone">
                            <div class="accordion-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                            @foreach ($contact->phones as $index => $phone)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        <div class="d-flex flex-column justify-content-center pl-3 {{ $phone->is_primary == true ? 'text-primary' : '' }}">
                                                            {!!  html_entity_decode($phone->type->icon) !!}
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <h6 class="mb-0 text-sm">{{ $phone->type->label }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ json_decode($phone->value_meta)->country_name }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive;">
                                                            {!! '+' . json_decode($phone->value_meta)->country_dial_code . ' ' . json_decode($phone->value_meta)->clean_number !!}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        href='tel:{!! json_decode($phone->value_meta)->call_number !!}'>
                                                        Llamar
                                                    </a>
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        onclick="copyToClipboard('{!! json_decode($phone->value_meta)->call_number !!}')">
                                                        Copiar
                                                    </a>
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


                @if (count($contact->instant_messages) != 0)
                    <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                        <h2 class="accordion-header" id="headingChats">
                            <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChats" aria-expanded="false" aria-controls="collapseChats">
                                <i class="fas fa-sms"></i>
                                &nbsp; CHATS
                            </button>
                        </h2>
                        <div id="collapseChats" class="accordion-collapse collapse" aria-labelledby="headingChats">
                            <div class="accordion-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                        @foreach ($contact->instant_messages as $index => $instant_message)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        <div class="d-flex flex-column justify-content-center pl-3 {{ $instant_message->is_primary == true ? 'text-primary' : '' }}">
                                                            @switch($instant_message->label)
                                                                @case('Personal')
                                                                    <i class="fas fa-home fa-lg"></i>
                                                                    @break
                                                                @case('Trabajo')
                                                                    <i class="fas fa-briefcase fa-lg"></i>
                                                                    @break
                                                                @default
                                                                    <i class="fas fa-comments"></i>
                                                            @endswitch
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <h6 class="mb-0 text-sm">{{ $instant_message->label }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $instant_message->type->label }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive;">
                                                            {{ $instant_message->value }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        href='{{ $instant_message->type->url . $instant_message->value  }}' target="_blank">
                                                        Chatear
                                                    </a>
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        onclick="copyToClipboard('{{ $instant_message->value }}')">
                                                        Copiar
                                                    </a>
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


                @if (count($contact->emails) != 0)
                    <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                        <h2 class="accordion-header" id="headingEmails">
                            <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmails" aria-expanded="false" aria-controls="collapseEmails">
                                <i class="fas fa-envelope"></i>
                                &nbsp; EMAILS
                            </button>
                        </h2>
                        <div id="collapseEmails" class="accordion-collapse collapse" aria-labelledby="headingEmails">
                            <div class="accordion-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                            @foreach ($contact->emails as $index => $email)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-0 py-1">
                                                            <div class="d-flex flex-column justify-content-center pl-3 {{ $email->is_primary == true ? 'text-primary' : '' }}">
                                                                @switch($email->label)
                                                                    @case('Personal')
                                                                        <i class="fas fa-home fa-lg"></i>
                                                                        @break
                                                                    @case('Trabajo')
                                                                        <i class="fas fa-briefcase fa-lg"></i>
                                                                        @break
                                                                    @default
                                                                        <i class="fas fa-comments"></i>
                                                                @endswitch
                                                            </div>
                                                            <div class="d-flex flex-column justify-content-center pl-3">
                                                                <h6 class="mb-0 text-sm">{{ $email->label }}</h6>
                                                                <p class="text-xs text-secondary mb-0">{{ $email->type->label }}</p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center px-3">
                                                            <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive;">
                                                                {{ $email->value }}
                                                            </p>
                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-end">
                                                        <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                            href='mailto:{{ $email->value }}'>
                                                            Enviar email
                                                        </a>
                                                        <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                            onclick="copyToClipboard('{{ $email->value }}')">
                                                            Copiar
                                                        </a>
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


                @if (count($contact->bank_accounts) != 0)
                    <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                        <h2 class="accordion-header" id="headingBankAccounts">
                        <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBankAcoounts" aria-expanded="false" aria-controls="collapseBankAcoounts">
                            {{-- <i class="fas fa-euro-sign"></i> --}}
                            <i class="fas fa-hand-holding-usd"></i>
                            &nbsp; CUENTAS BANCARIAS
                        </button>
                        </h2>
                        <div id="collapseBankAcoounts" class="accordion-collapse collapse" aria-labelledby="headingBankAccounts">
                            <div class="accordion-body p-0">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                            @foreach ($contact->bank_accounts as $index => $account)
                                                <tr>
                                                    <td>
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
                                                    <td>
                                                        <div class="d-flex flex-column justify-content-center px-7">
                                                            <p class="text-md font-weight-bold mb-0" style="font-family: monospace, cursive; cursor:pointer"
                                                                onclick="copyToClipboard('{{ $account->card_number }}')">
                                                                {!! implode('&nbsp;', str_split($account->card_number, 4)) !!}
                                                            </p>

                                                        </div>
                                                    </td>
                                                    <td class="align-middle text-center">
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
                            <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebs" aria-expanded="false" aria-controls="collapseWebs">
                                <i class="fas fa-wifi"></i>
                                {{-- <i class="fab fa-internet-explorer"></i> --}}
                                &nbsp; WEBS
                            </button>
                        </h2>
                        <div id="collapseWebs" class="accordion-collapse collapse" aria-labelledby="headingWebs">
                            <div class="accordion-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        @foreach ($contact->webs as $index => $web)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <i class="fas fa-globe fa-lg"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <h6 class="mb-0 text-sm">{{ $web->type->label }}</h6>
                                                            <p class="text-xs text-secondary mb-0">Personal</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive;">
                                                            {{ $web->value }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        href="//{{ $web->value }}" target="_blank">
                                                        Visitar
                                                    </a>
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        onclick="copyToClipboard('{{ $web->value }}')">
                                                        Copiar
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif


                @if (count($contact->publish_us) != 0)
                    <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                        <h2 class="accordion-header" id="headingPublishUs">
                            <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePublishUs" aria-expanded="false" aria-controls="collapsePublishUs">
                                <i class="fas fa-bullhorn"></i>
                                {{-- <i class="fab fa-internet-explorer"></i> --}}
                                &nbsp; NOS PUBLICA
                            </button>
                        </h2>
                        <div id="collapsePublishUs" class="accordion-collapse collapse" aria-labelledby="headingPublishUs">
                            <div class="accordion-body">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center mb-0">
                                        <tbody>
                                        @foreach ($contact->publish_us as $index => $web)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <i class="fas fa-globe fa-lg"></i>
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <h6 class="mb-0 text-sm">{{ $web->type->label }}</h6>
                                                            {{-- <p class="text-xs text-secondary mb-0">Personal</p> --}}
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <p class="text-md text-secondary mb-0" style="font-family: monospace, cursive;">
                                                            {{ $web->value }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-end">
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        href="//{{ $web->value }}" target="_blank">
                                                        Visitar
                                                    </a>
                                                    <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto"
                                                        onclick="copyToClipboard('{{ $web->value }}')">
                                                        Copiar
                                                    </a>
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


            </div>



        </div>


    @elseif (count($contacts) > 1 && $multiple_selection)
        <div class="card-header p-3">

            <div class="d-flex px-2 py-1 justify-content-end">

                <div class="d-flex justify-content-top">


                    @php

                    @endphp

                        @if (count($contacts_emails) != 0)
                            <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: rgb(0, 153, 255)"
                                href='mailto:'>
                                    <i class="fas fa-bullhorn"></i>
                            </a>
                        @else
                        <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: #c0c0c0"
                            href='javascript:void(0)'><i class="fas fa-bullhorn"></i></a>
                        @endif


                        <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-download"></i></div>




                </div>


            </div>


        </div>

    @else
    <div class="">
        <img class="" src="../assets/img/logo-travel.png">
    </div>


    @endif


</div>
