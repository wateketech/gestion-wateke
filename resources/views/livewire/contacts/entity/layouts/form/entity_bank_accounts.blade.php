<div class="container-fluid mt-4">
    <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            {{-- tarjeta --}}
                            <div class="col-xl-5 mb-xl-0 mb-4 mt-sm-4 mt-md-4 mt-xl-1">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl"
                                        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                            {{-- <span class="mask bg-gradient-dark"></span> --}}
                                        <div class="card-body position-relative z-index-1 p-3">
                                            <h6 class="d-flex justify-content-between text-white" for="entity_bank_account_bank_name">
                                                <i class="fas fa-sim-card fa-rotate-90"></i>
                                                <span>{!! isset($entity_bank_account_bank_name) ? strtoupper($entity_bank_account_bank_name) : '- - - - ' !!}</span>
                                            </h6>
                                            {{-- @isset($entity_bank_account_is_credit)
                                            @endisset --}}
                                            <h6 class="text-white mt-4 mb-4 pb-2 fs-4" for="entity_bank_account_card_number">
                                                {{-- NUMERO DE LA TARJETA --}}
                                                @php
                                                    $account_card = preg_replace('/\D/', '', $entity_bank_account_card_number);
                                                    // hacer funcion para que los digitos faltantes sean #
                                                @endphp
                                                {!! strlen($entity_bank_account_card_number) != 0 ? strtoupper($entity_bank_account_card_number) : '####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####' !!}
                                            </h6>

                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <div class="me-4">
                                                        <p class="text-white text-sm opacity-8 mb-0">Titular</p>
                                                        {{-- NOMBRE DE LA TARJETA --}}
                                                        <h6 class="text-white mb-0">{{ strtoupper($entity_bank_account_card_holder) }}</h6>
                                                    </div>
                                                    <div>
                                                        <p class="text-white text-sm opacity-8 mb-0">Expira</p>
                                                        {{-- FECHA EXPIRACION --}}
                                                        <h6 class="text-white mb-0">{{ str_pad($entity_bank_account_expiration_month, 2, '0', STR_PAD_LEFT)  }}/{{ substr($entity_bank_account_expiration_year, -2)  }}</h6>
                                                    </div>
                                                </div>
                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                    {{-- TIPO DE TARJETA --}}
                                                    @if ($entity_bank_account_types->find($entity_bank_account_type)->label != 'Unknown')
                                                        <img class="w-100 mt-1" src="{{ $entity_bank_account_types->find($entity_bank_account_type)->logo }}" alt="{{ $entity_bank_account_types->find($entity_bank_account_type)->label }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-none d-xl-flex justify-content-end mt-3 h3 px-4">
                                    <button class="btn btn-success mx-1" wire:click="addAccountCard">agregar tarjeta</button>

                                    <button type="button" class="btn btn-secondary mx-1 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span> tipo
                                    </button>
                                    <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($entity_bank_account_types as $type)
                                            @if ($type->label == 'Unknown')
                                                <li><a class="dropdown-item" href="#" wire:click="$set('entity_bank_account_type', {{ $type->id }})">Ninguna</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                            @else
                                                <li><a class="dropdown-item" href="#" wire:click="$set('entity_bank_account_type', {{ $type->id }})">{{ $type->label }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>


                            </div>

                            {{-- formulario --}}
                            <div class="col-xl-7">
                                <div class="row">


                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_bank_name" class="form-control-label">Nombre del Banco *</label>
                                            <input class="@error('entity_bank_account_bank_name')border border-danger rounded-3 @enderror form-control" type="text" placeholder="Banco Popular de Ahorro"
                                                name="entity_bank_account_bank_name" id="entity_bank_account_bank_name" wire:model="entity_bank_account_bank_name">
                                            @error('entity_bank_account_bank_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_bank_title" class="form-control-label">Alias del Banco</label>
                                            <input class="@error('entity_bank_account_bank_title')border border-danger rounded-3 @enderror form-control" type="text" placeholder="BPA"
                                                name="entity_bank_account_bank_title" id="entity_bank_account_bank_title" wire:model="entity_bank_account_bank_title">
                                            @error('entity_bank_account_bank_title') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>


                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_card_holder" class="form-control-label">Titular de la cuenta *</label>
                                            <input class="@error('entity_bank_account_card_holder')border border-danger rounded-3 @enderror form-control" type="text" placeholder="{{ isset($entity_legal_name) ? $entity_legal_name : $entity_comercial_name }}"
                                                name="entity_bank_account_card_holder" id="entity_bank_account_card_holder" wire:model="entity_bank_account_card_holder">
                                            @error('entity_bank_account_card_holder') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 form-group mt-3 mb-0 px-xl-2 px-lg-5 px-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" value="true" wire:model="entity_bank_account_is_credit">
                                            <label class="custom-control-label" for="customRadio1">Crédito</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2" value="false" wire:model="entity_bank_account_is_credit">
                                            <label class="custom-control-label" for="customRadio2">Débito</label>
                                        </div>

                                    </div>



                                    <div class="col-6 form-group pr-9">
                                        <label for="entity_bank_account_card_number" class="form-control-label">Numeración *</label>
                                        <input class="@error('entity_bank_account_card_number')border border-danger rounded-3 @enderror form-control" type="text" placeholder="####   ####   ####   ####"
                                        name="entity_bank_account_card_number" id="entity_bank_account_card_number" wire:model="entity_bank_account_card_number" maxlength="25"
                                        oninput="function formatCardNumber(event) {
                                            const input = event.target.value.replace(/\D/g, '').substring(0, 16);
                                            const cardNumber = input !== '' ? input.match(/.{1,4}/g).join('&nbsp;&nbsp;&nbsp;') : '';
                                            event.target.value = cardNumber;
                                        } formatCardNumber(event)">
                                        @error('entity_bank_account_card_number') <sub class="text-danger">{{ $message }}</sub> @enderror

                                        @php
                                        $entity_bank_account_card_number_valid = true;
                                        if (!empty($entity_bank_account_types->find($entity_bank_account_type)->regEx)) {
                                            foreach (json_decode($entity_bank_account_types->find($entity_bank_account_type)->regEx) as $regEx){
                                                if ($type->label == "Unknown") {
                                                    continue;
                                                }
                                                if ($entity_bank_account_card_number && !preg_match($regEx, $entity_bank_account_card_number)){
                                                    $entity_bank_account_card_number_valid = false;
                                                    // print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                                }else{
                                                    $entity_bank_account_card_number_valid = true;
                                                }
                                            }
                                        }
                                        @endphp
                                        @if (!$entity_bank_account_card_number_valid)
                                            <sub class="text-warning">Tenga presente que su numeración no cumple con el formato. </sub>
                                            <script> document.getElementById('entity_bank_account_card_number').classList += ' is-warning';  </script>
                                                {{-- {{ cleanError('entity_id_value') }} --}}
                                        @endif


                                    </div>
                                    <div class="col-3 form-group">
                                        <label for="entity_bank_account_expiration_month" class="form-control-label">Fecha Expiración *</label>
                                        <select class="form-control" name="entity_bank_account_expiration_month" id="entity_bank_account_expiration_month" wire:model="entity_bank_account_expiration_month">
                                            @php
                                                if(date("Y") == $entity_bank_account_expiration_year){
                                                    $start_month = date("n") + 4;
                                                }else{
                                                    $start_month = 1;
                                                }
                                            @endphp
                                            @for ($i = $start_month; $i <= 12; $i++)
                                                @php
                                                    $month = date("F", mktime(0, 0, 0, $i, 1));
                                                    $n_month = date("n", mktime(0, 0, 0, $i, 1));
                                                @endphp
                                                <option value="{{ $n_month }}"> {{ __($month) }} </option>
                                            @endfor
                                        </select>
                                        @error('entity_bank_account_expiration_month') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                    <div class="col-3 form-group">
                                        <label for="entity_bank_account_expiration_year" class="form-control-label"> </label>
                                        <select class="form-control" name="entity_bank_account_expiration_year" id="entity_bank_account_expiration_year" wire:model="entity_bank_account_expiration_year">
                                            @php
                                                $current_year = date("Y");
                                            @endphp
                                            @for ($i = $current_year; $i <= $current_year + 10; $i++)
                                                <option value="{{ $i }}"> {{ $i }} </option>
                                            @endfor
                                        </select>
                                        @error('entity_bank_account_expiration_year') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>

                                </div>



                            </div>

                            {{-- lista anadidas --}}
                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="mt-4">
                                    <div class="pb-0 p-3">
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                <h6 class="mb-0">{{ count($entity_bank_accounts) !=0 ? 'Cuentas Registradas' : '' }}</h6>
                                            </div>
                                            {{-- <div class="col-md-6 d-flex align-items-center "> --}}
                                            <div class="col-md-6 d-xl-none text-right px-4">
                                                <button class="btn btn-success mx-1" wire:click="addAccountCard">agregar tarjeta</button>

                                                <button type="button" class="btn btn-secondary mx-1 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <span class="visually-hidden">Toggle Dropdown</span> tipo
                                                </button>
                                                <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                                    @foreach ($entity_bank_account_types as $type)
                                                        @if ($type->label == 'Unknown')
                                                            <li><a class="dropdown-item" href="#" wire:click="$set('entity_bank_account_type', {{ $type->id }})">Ninguna</a></li>
                                                            <li><hr class="dropdown-divider"></li>
                                                        @else
                                                            <li><a class="dropdown-item" href="#" wire:click="$set('entity_bank_account_type', {{ $type->id }})">{{ $type->label }}</a></li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3">
                                        <div class="row">
                                            @php $index = 0 @endphp
                                            @foreach ($entity_bank_accounts as $account)

                                                <div class="col-md-6 mb-md-0 mb-4">
                                                    <div class="card card-body border card-plain border-radius-lg d-flex align-items-between flex-row">
                                                        @if ($entity_bank_account_types->find($account['type_id'])->label != 'Unknown')
                                                            <img class="w-10 me-3 mb-0 pr-3" src="{{ $entity_bank_account_types->find($account['type_id'])->logo }}" alt="{{ $entity_bank_account_types->find($account['type_id'])->label }}">
                                                        @else
                                                            {{-- <img class="w-10 me-3 mb-0" src="{{ $entity_bank_account_types->find($account['type_id'])->logo }}" alt="{{ $entity_bank_account_types->find($account['type_id'])->label }}"> --}}
                                                        @endif
                                                        <h6 class="mb-0 pl-2">
                                                            ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp; {{  substr($account['card_number'], -4) }}
                                                        </h6>
                                                        <div class="ms-auto">
                                                            <a>
                                                                <i class="icon-edit fas fa-pencil-alt text-dark cursor-pointer px-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="editAccountCard({{ $index }})" title="Editar"></i>
                                                            </a>

                                                            <a id="remove-account" data-bs-toggle="tooltip" data-bs-html="true" data-bs-placement="top" data-bs-sanitize="false" data-bs-trigger="click"
                                                            title="<div id='remove-bank-account-title' class='tooltip-title'>¿ Estás seguro ? <a id='remove-bank-account' class='cursor-pointer text-decoration-underline text-danger'>Quitar</a> <a id='cancel-remove-bank-account' class='cursor-pointer'>Cancelar</a></div>">
                                                           <i class="icon-del fas fa-trash-alt text-dark cursor-pointer"></i>
                                                         </a>

                                                        @push('scripts')
                                                        <script>
                                                            document.getElementById('remove-account').addEventListener('click', function() {
                                                                var removeBankAccount = document.getElementById('remove-bank-account');
                                                                var cancel_removeBankAccount = document.getElementById('cancel-remove-bank-account');
                                                                document.getElementById(removeBankAccount.parentNode.parentNode.parentNode.id).classList.remove("d-none");
                                                                removeBankAccount.addEventListener('click', function() {
                                                                    Livewire.emit('removeAccountCard', {{ $index }});
                                                                    close_removeBankAccount_tooltip();
                                                                });
                                                                cancel_removeBankAccount.addEventListener('click', close_removeBankAccount_tooltip );
                                                                function close_removeBankAccount_tooltip(){
                                                                    var tooltip  = removeBankAccount.parentNode.parentNode.parentNode.id;
                                                                    document.getElementById(tooltip).classList.add("d-none");
                                                                }
                                                            });
                                                        </script>
                                                        @endpush
                                                        </div>
                                                    </div>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>




                                </div>
                            </div>
                        </div>
                    </div>








    </div>
</div>
