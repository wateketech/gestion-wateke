    <div class="card-header p-0">

        <div class="d-flex px-1 py-2 justify-content-between">
            <div class="d-flex">
                <div>
                    <img id='profile_pics' class="avatar avatar-xxl me-3" src="{{ $profile_pics ? $profile_pics[0]->temporaryUrl() : '../assets/img/illustrations/contact-profile-1.png' }}" alt="Imagen de Perfil">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xl h5">
                        {!! json_decode($prefixs->find($prefix)->label)->abb !!}.
                        {{$name . ' ' . $middle_name . ' ' . $first_lastname . ' ' . $second_lastname}}
                    </h6>
                    {{ $alias ? '(' . $alias . ')': '' }}
                    <p class="text-md text-secondary pb-2 mb-0">
                        @php
                            $primary_emails = array_column(array_filter($this->emails, function($email) {
                                    return $email['is_primary'] == 1;
                                }), 'value');
                        @endphp
                        {{ reset($primary_emails) }}
                    </p>
                    <hr/>
                    @if (isset($ocupation_id) && isset($ocupation_entity_id))
                        <p class="text-lg pt-2 mb-0">ocupation_id &nbsp;|&nbsp; ocupation_entity_id</p>
                    @else
                        <p class="text-sm pt-2 mb-0">Este usuario no dispone de datos laborales</p>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-top">
                {{-- <p class="icon icon-shape icon-md shadow text-center border-radius-50 me-2"
                    style="background-color: #00a600">
                    <i class="fas fa-phone-alt fa-lg"></i>
                </p>
                <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2"
                    style="background-color: rgb(0, 153, 255)">
                    <i class="fas fa-envelope fa-lg"></i>
                </a>
                <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2"
                    style="background-color: #008000">
                    <i class="fas fa-comment fa-lg"></i>
                </a> --}}
            </div>

        </div>


        <div class="row">
            <div class="col-5 pb-4 pl-11 text-start">
                @forelse ($rrss as $index => $rs)
                    <a href="{{ $rrss_types->find($rs['type_id'])->url . $rs['value'] }}" target="_blank" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color: {{ $rrss_types->find($rs['type_id'])->color }}">
                        {!! html_entity_decode($rrss_types->find($rs['type_id'])->icon) !!}
                    </a>
                @empty
                    Este contacto no tienen redes sociales
                @endforelse
            </div>
            <div class="col-7 pb-4 px-4 text-end">
                @forelse ($dates as $index => $date)
                    <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                        style="background-color: {{ $date_types->find($date['type_id'])->color }}; color:white; cursor:pointer; position:relative;"
                            onmouseover="this.innerHTML='{!! htmlspecialchars($date_types->find($date['type_id'])->icon, ENT_QUOTES) !!}&nbsp;{{ $date_types->find($date['type_id'])->label }}';"
                            onmouseout="this.innerHTML='{!! htmlspecialchars($date_types->find($date['type_id'])->icon, ENT_QUOTES) !!}&nbsp;{{ $date['value'] }}';">
                        {!! html_entity_decode($date_types->find($date['type_id'])->icon) !!}&nbsp;{{ $date['value'] }}
                    </a>
                @empty

                @endforelse
            </div>
        </div>



    </div>

    <div class="card-body px-0 pt-0">
        <div class="row mx-1">
            <div class="col-md-3 mb-md-0 mb-3 card card-body border card-plain border-radius-lg mx-3 px-3 py-3 min-height-120">
                {{-- <div class=""> --}}
                    @foreach ($ids as $id)
                        <p class="p-0 m-0">{!! html_entity_decode($id_types->find($id['type_id'])->icon) !!} {{ $id['value'] }}</p>
                    @endforeach
                    <p class="pt-3 p-0 m-0">{{ count($publish_us) == 0 ? 'NO nos publica' : '' }}</p>

                    <strong class='pr-3'>Notas: </strong>
                    <small>{{ (isset($about) && strlen($about) != 0) ? '' : 'No dispone' }}</small>{{-- agregar tambien condicion para el about laboral --}}
                    @if (isset($about) && strlen($about) != 0)
                        <div type="button" class="d-inline mx-0 px-2 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-file-alt px-0"></i>
                        </div>
                        <div class="dropdown-menu about">
                            {{ $about}}
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
                    @forelse ($address as $index_add => $add)
                        <strong class="mt-3">Dirección {{ $add['name'] }}:</strong>
                        <p class="card-text fs-6 {{ ($add['geolocation'] || strlen($add['geolocation'])!=0) ? 'cursor-pointer' : '' }}">
                            <i class="fas fa-map-marker-alt pl-3 pr-1 {{ ($add['geolocation'] || strlen($add['geolocation'])!=0 ) ? 'text-primary' : '' }}"></i>
                                    @php $localidad = null; @endphp
                                @foreach ($address_line[$index_add] as $index_l => $line)
                                    @if ($line['label'] != 'Localidad')
                                        {{ ($line['label']=='Número' ) || ($line['label']=='Calle' ) ? '' : $line['label'] }}
                                        {{ $line['value'] }}
                                    @else
                                        @php $localidad = $line['value']; @endphp
                                    @endif
                                @endforeach
                                    {{ $localidad ? ', ' . $localidad : '' }},
                                    {{ $countries->find($add['country_id'])->states->find($add['state_id'])->name }},
                                    {{ $countries->find($add['country_id'])->cities->find($add['city_id'])->name }},
                                    {{-- , {{ $countries->find($add['country_id'])->name }} --}}
                                    {{ $countries->find($add['country_id'])->name }} <span class="emoji">{{ $countries->find($add['country_id'])->emoji }}</span>
                            </p>
                    @empty
                        No dispone
                    @endforelse
                {{-- </div> --}}
            </div>
        </div>




        <div class="accordion mt-4 mx-2" id="accordionExample">





            @if (count($phones) != 0)
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
                                        @foreach ($phones as $index => $phone)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-0 py-1">
                                                    <div class="d-flex flex-column justify-content-center pl-3 {{ $phone['is_primary'] == true ? 'text-primary' : '' }}">
                                                        {!!  html_entity_decode($phone_types->find($phone['type_id'])->icon) !!}
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <h6 class="mb-0 text-sm">{{ $phone_types->find($phone['type_id'])->label }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ json_decode($phone['value_meta'])->country_name }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <p class="text-md font-weight-bold mb-0" >
                                                        {{-- {{ $phone['value'] }} --}}
                                                        {!! '+' . json_decode($phone['value_meta'])->country_dial_code . ' ' . json_decode($phone['value_meta'])->clean_number !!}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                    Quitar
                                                </a> --}}
                                                @if (isset(json_decode($phone['value_meta'])->is_valid))
                                                    {!! json_decode($phone['value_meta'])->is_valid ? '<i class="fas fa-check-double text-info"></i>' : '<i class="fas fa-check-double text-danger"></i>' !!}
                                                @else
                                                    <i class="fas fa-check-double text-info"></i>
                                                @endif
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

            @if (count($instant_messages) != 0)
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
                                    @foreach ($instant_messages as $index => $instant_message)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-0 py-1">
                                                    <div class="d-flex flex-column justify-content-center pl-3 {{ $instant_message['is_primary'] == true ? 'text-primary' : '' }}">
                                                        @switch($instant_message['label'])
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
                                                        <h6 class="mb-0 text-sm">{{ $instant_message['label'] }}</h6>
                                                        <p class="text-xs text-secondary mb-0">{{ $instant_message_types->find($instant_message['type_id'])->label }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <p class="text-md font-weight-bold mb-0" >
                                                        {{ $instant_message['value'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                    Quitar
                                                </a> --}}
                                                @if (isset(json_decode($instant_message['meta'])->is_valid))
                                                    {!! json_decode($instant_message['meta'])->is_valid ? '<i class="fas fa-check-double text-info"></i>' : '<i class="fas fa-check-double text-danger"></i>' !!}
                                                @else
                                                    <i class="fas fa-check-double text-info"></i>
                                                @endif
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

            @if (count($emails) != 0)
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
                                        @foreach ($emails as $index => $email)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        <div class="d-flex flex-column justify-content-center pl-3 {{ $email['is_primary'] == true ? 'text-primary' : '' }}">
                                                            @switch($email['label'])
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
                                                            <h6 class="mb-0 text-sm">{{ $email['label'] }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $email_types->find($email['type_id'])->label }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-3">
                                                        <p class="text-md font-weight-bold mb-0" >
                                                            {{ $email['value'] }}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    {{-- <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                        Quitar
                                                    </a> --}}
                                                    {{-- @if (isset(json_decode($email['meta'])->is_valid))
                                                        {!! json_decode($email['meta'])->is_valid ? '<i class="fas fa-check-double text-info"></i>' : '<i class="fas fa-check-double text-danger"></i>' !!}
                                                    @else
                                                        <i class="fas fa-check-double text-info"></i>
                                                    @endif --}}
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

            @if (count($bank_accounts) != 0)
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
                                        @foreach ($bank_accounts as $index => $account)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-0 py-1">
                                                        @if ($bank_account_types->find($account['type_id'])->label != 'Unknown')
                                                            <img style="max-width: 100%; height: 40px;" src="{{ $bank_account_types->find($account['type_id'])->logo }}" alt="{{ $bank_account_types->find($account['type_id'])->label }}">
                                                        @else
                                                            <img style="max-width: 100%; height: 40px;" src="../assets/img/blank.png">
                                                        @endif

                                                        <div class="d-flex flex-column justify-content-center pl-3">
                                                            <h6 class="mb-0 text-sm">{{ $account['card_holder'] }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                {{ $account['is_credit'] ? 'Cérdito' : 'Débito' }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column justify-content-center px-7">
                                                        <p class="text-md font-weight-bold mb-0" style="font-family: monospace, cursive;">
                                                            {!! implode('&nbsp;', str_split($account['card_number'], 4)) !!}
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs ">Vence: <strong>{{ date('m/Y', strtotime($account['expiration_date'])) }}    </strong></span>
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

            @if (count($webs) != 0)
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
                                    @foreach ($webs as $index => $web)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-0 py-1">
                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <i class="fas fa-globe fa-lg"></i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <h6 class="mb-0 text-sm">{{ $web_types->find($web['type_id'])->label }}</h6>
                                                        <p class="text-xs text-secondary mb-0">Personal</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <p class="text-md font-weight-bold mb-0" >
                                                        {{ $web['value'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                    Quitar
                                                </a> --}}
                                                @if (isset(json_decode($web['meta'])->is_valid))
                                                    {!! json_decode($web['meta'])->is_valid ? '<i class="fas fa-check-double text-info"></i>' : '<i class="fas fa-check-double text-danger"></i>' !!}
                                                @else
                                                    <i class="fas fa-check-double text-info"></i>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if (count($publish_us) != 0)
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
                                    @foreach ($publish_us as $index => $web)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-0 py-1">
                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <i class="fas fa-globe fa-lg"></i>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center pl-3">
                                                        <h6 class="mb-0 text-sm">{{ $web_types->find($web['type_id'])->label }}</h6>
                                                        {{-- <p class="text-xs text-secondary mb-0">Personal</p> --}}
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-column justify-content-center px-3">
                                                    <p class="text-md font-weight-bold mb-0" >
                                                        {{ $web['value'] }}
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="align-middle text-center">
                                                {{-- <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                    Quitar
                                                </a> --}}
                                                @if (isset(json_decode($web['meta'])->is_valid))
                                                    {!! json_decode($web['meta'])->is_valid ? '<i class="fas fa-check-double text-info"></i>' : '<i class="fas fa-check-double text-danger"></i>' !!}
                                                @else
                                                    <i class="fas fa-check-double text-info"></i>
                                                @endif
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


    <div class="card-footer px-4 pt-1">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rememberMe" wire:model='is_user_link'>
            <label class="form-check-label fs-6" for="rememberMe"> Convertir en un usuario del sistema</label>
        </div>
        @if ($is_user_link)
            <div class="mt-3 row">
                <div class="col form-group">
                    <label for="user_link_role" class="form-control-label">Rol *</label>
                    <select class="form-control" name="role" id="user_link_role" wire:model='user_link_role'>
                        @foreach ($user_link_roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col form-group">
                    <label for="user_link_email" class="form-control-label">Usuario</label>
                    <input class="@error('user_link_email')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="user_link_email" id="user_link_email" value="{{ $user_link_email }}" disabled>
                    @error('user_link_email') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col form-group">
                    <label for="user_link_password_public" class="form-control-label">Contraseña *</label>
                    <input class="@error('user_link_password_public')border border-danger rounded-3 is-invalid @enderror form-control"  type="password" aria-label="Password"
                        name="user_link_password_public" id="user_link_password_public" wire:model="user_link_password_public" aria-describedby="password-addon">
                    @error('user_link_password_public') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col form-group">
                    <label for="user_link_password_check" class="form-control-label">Confirmar contraseña *</label>
                    <input class="@error('user_link_password_check')border border-danger rounded-3 is-invalid @enderror form-control" type="password" aria-label="Password"
                        name="user_link_password_check" id="user_link_password_check" wire:model="user_link_password_check" aria-describedby="password-addon">
                    @error('user_link_password_check') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        @endif
        @error('is_user_link') <sub class="text-danger">{{ $message }}</sub> @enderror
    </div>

