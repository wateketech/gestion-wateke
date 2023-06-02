<div class="container-fluid mt-4">
    <div class="row">

        <div class="col-lg-12">
            <div class="row">

                {{-- tarjeta --}}
                <div class="col-xl-5 mb-xl-0 mb-4 mt-sm-4 mt-md-4 mt-xl-1">
                    <div class="card bg-transparent shadow-xl">
                        <div class="overflow-hidden position-relative border-radius-xl"
                            style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                <span class="mask bg-gradient-dark"></span>
                            <div class="card-body position-relative z-index-1 p-3">
                                <h6 class="d-flex justify-content-between text-white" for="bank_account_bank_name">
                                    <i class="fas fa-sim-card fa-rotate-90"></i>
                                    <span>{!! isset($bank_account_bank_name) ? strtoupper($bank_account_bank_name) : '- - - - ' !!}</span>
                                </h6>
                                {{-- @isset($bank_account_is_credit)
                                @endisset --}}
                                <h6 class="text-white mt-4 mb-4 pb-2 fs-4" for="bank_account_card_number" style="font-family: cursive;">
                                    {{-- NUMERO DE LA TARJETA --}}
                                    @php
                                        $account_card = preg_replace('/\D/', '', $bank_account_card_number);
                                        // hacer funcion para que los digitos faltantes sean #
                                    @endphp
                                    {!! strlen($bank_account_card_number) != 0 ? strtoupper($bank_account_card_number) : '####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####' !!}
                                </h6>

                                <div class="d-flex">
                                    <div class="d-flex">
                                        <div class="me-4">
                                            <p class="text-white text-sm opacity-8 mb-0">Titular</p>
                                            {{-- NOMBRE DE LA TARJETA --}}
                                            <h6 class="text-white mb-0">{{ strtoupper($bank_account_card_holder) }}</h6>
                                        </div>
                                        <div>
                                            <p class="text-white text-sm opacity-8 mb-0">Expira</p>
                                            {{-- FECHA EXPIRACION --}}
                                            <h6 class="text-white mb-0">{{ str_pad($bank_account_expiration_month, 2, '0', STR_PAD_LEFT)  }}/{{ substr($bank_account_expiration_year, -2)  }}</h6>
                                        </div>
                                    </div>
                                    <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                        {{-- TIPO DE TARJETA --}}
                                        @if ($bank_account_types->find($bank_account_type)->label != 'Unknown')
                                            <img class="w-100 mt-n4" src="{{ $bank_account_types->find($bank_account_type)->logo }}" alt="{{ $bank_account_types->find($bank_account_type)->label }}">
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
                            @foreach ($bank_account_types as $type)
                                @if ($type->label == 'Unknown')
                                    <li><a class="dropdown-item" href="#" wire:click="$set('bank_account_type', {{ $type->id }})">Ninguna</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                @else
                                    <li><a class="dropdown-item" href="#" wire:click="$set('bank_account_type', {{ $type->id }})">{{ $type->label }}</a></li>
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
                                <label for="bank_account_bank_name" class="form-control-label opacity-4">Nombre del Banco *</label>
                                <input class="@error('bank_account_bank_name')border border-danger rounded-3 @enderror form-control disabled" type="text" placeholder="SECCIÓN EN CONSTRUCCIÓN"  style="text-align: center;"
                                    name="bank_account_bank_name" id="bank_account_bank_name" disabled>
                                    {{-- wire:model="bank_account_bank_name"> --}}
                                @error('bank_account_bank_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="form-group mb-2">
                                <label for="bank_account_bank_title" class="form-control-label opacity-4">Alias del Banco</label>
                                <input class="@error('bank_account_bank_title')border border-danger rounded-3 @enderror form-control disabled" type="text" placeholder="EN BREVE"  style="text-align: center;"
                                    name="bank_account_bank_title" id="bank_account_bank_title" disabled>
                                    {{-- wire:model="bank_account_bank_title"> --}}
                                @error('bank_account_bank_title') <sub class="text-danger">{{ $message }}</sub> @enderror
                            </div>
                        </div>


                        <div class="col-8">
                            <div class="form-group mb-2">
                                <label for="bank_account_card_holder" class="form-control-label">Titular de la cuenta *</label>
                                <input class="@error('bank_account_card_holder')border border-danger rounded-3 @enderror form-control" type="text"
                                    name="bank_account_card_holder" id="bank_account_card_holder" wire:model="bank_account_card_holder">
                                @error('bank_account_card_holder') <sub class="text-danger">{{ $message }}</sub> @enderror
                            </div>
                        </div>
                        <div class="col-4 form-group mt-3 mb-0 px-xl-2 px-lg-5 px-sm-4">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" value="true" wire:model="bank_account_is_credit">
                                <label class="custom-control-label" for="customRadio1">Crédito</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2" value="false" wire:model="bank_account_is_credit">
                                <label class="custom-control-label" for="customRadio2">Débito</label>
                            </div>

                        </div>



                        <div class="col-6 form-group pr-9">
                            <label for="bank_account_card_number" class="form-control-label">Numeración *</label>
                            <input class="@error('bank_account_card_number')border border-danger rounded-3 @enderror form-control" type="text" placeholder="####   ####   ####   ####"
                            name="bank_account_card_number" id="bank_account_card_number" wire:model="bank_account_card_number" maxlength="25"
                            style="font-family: cursive;"
                            oninput="function formatCardNumber(event) {
                                const input = event.target.value.replace(/\D/g, '').substring(0, 16);
                                const cardNumber = input !== '' ? input.match(/.{1,4}/g).join('&nbsp;&nbsp;&nbsp;') : '';
                                event.target.value = cardNumber;
                            } formatCardNumber(event)">
                            @error('bank_account_card_number') <sub class="text-danger">{{ $message }}</sub> @enderror

                            @php
                            $bank_account_card_number_valid = true;
                            if (!empty($bank_account_types->find($bank_account_type)->regEx)) {
                                foreach (json_decode($bank_account_types->find($bank_account_type)->regEx) as $regEx){
                                    if ($type->label == "Unknown") {
                                        continue;
                                    }
                                    if ($bank_account_card_number && !preg_match($regEx, $bank_account_card_number)){
                                        $bank_account_card_number_valid = false;
                                        // print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                    }else{
                                        $bank_account_card_number_valid = true;
                                    }
                                }
                            }
                            @endphp
                            @if (!$bank_account_card_number_valid)
                                <sub class="text-warning">Tenga presente que su numeración no cumple con el formato. </sub>
                                <script> document.getElementById('bank_account_card_number').classList += ' is-warning';  </script>
                                    {{-- {{ cleanError('id_value') }} --}}
                            @endif


                        </div>
                        <div class="col-3 form-group">
                            <label for="bank_account_expiration_month" class="form-control-label">Fecha Expiración *</label>
                            <select class="form-control" name="bank_account_expiration_month" id="bank_account_expiration_month" wire:model="bank_account_expiration_month">
                                @php
                                    if(date("Y") == $bank_account_expiration_year){
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
                            @error('bank_account_expiration_month') <sub class="text-danger">{{ $message }}</sub> @enderror
                        </div>
                        <div class="col-3 form-group">
                            <label for="bank_account_expiration_year" class="form-control-label"> </label>
                            <select class="form-control" name="bank_account_expiration_year" id="bank_account_expiration_year" wire:model="bank_account_expiration_year">
                                @php
                                    $current_year = date("Y");
                                @endphp
                                @for ($i = $current_year; $i <= $current_year + 10; $i++)
                                    <option value="{{ $i }}"> {{ $i }} </option>
                                @endfor
                            </select>
                            @error('bank_account_expiration_year') <sub class="text-danger">{{ $message }}</sub> @enderror
                        </div>

                    </div>



                </div>

                {{-- lista anadidas --}}
                <div class="col-md-12 mb-lg-0 mb-4">
                    <div class="mt-4">
                        <div class="pb-0 p-3">
                            <div class="row">
                                <div class="col-md-6 d-flex align-items-center">
                                    <strong class="mb-n3 p-3 h5 text-dark form-title">{{ count($bank_accounts) !=0 ? 'Cuentas Registradas' : '' }}</strong>
                                </div>
                                {{-- <div class="col-md-6 d-flex align-items-center "> --}}
                                <div class="col-md-6 d-xl-none text-right px-4">
                                    <button class="btn btn-success mx-1" wire:click="addAccountCard">agregar tarjeta</button>

                                    <button type="button" class="btn btn-secondary mx-1 dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="visually-hidden">Toggle Dropdown</span> tipo
                                    </button>
                                    <ul class="dropdown-menu" style="max-height: 200px; overflow-y: auto;">
                                        @foreach ($bank_account_types as $type)
                                            @if ($type->label == 'Unknown')
                                                <li><a class="dropdown-item" href="#" wire:click="$set('bank_account_type', {{ $type->id }})">Ninguna</a></li>
                                                <li><hr class="dropdown-divider"></li>
                                            @else
                                                <li><a class="dropdown-item" href="#" wire:click="$set('bank_account_type', {{ $type->id }})">{{ $type->label }}</a></li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="p-3">
                            <div class="row">
                                @php $index = 0 @endphp
                                @foreach ($bank_accounts as $account)

                                    <div class="col-sm-12 col-lg-6 col-md-6 col-xl-4 mb-md-0 pb-3">
                                        <div class="card card-body border border-2 card-plain border-radius-lg d-flex align-items-between flex-row py-3 px-2" style="min-height:5.2em">
                                            @if ($bank_account_types->find($account['type_id'])->label != 'Unknown')
                                                <img style="max-width: 100%; height: 50px;" src="{{ $bank_account_types->find($account['type_id'])->logo }}" alt="{{ $bank_account_types->find($account['type_id'])->label }}">
                                            @else
                                                {{-- <img class="w-10 me-3 mb-0" src="{{ $bank_account_types->find($account['type_id'])->logo }}" alt="{{ $bank_account_types->find($account['type_id'])->label }}"> --}}
                                            @endif
                                            <h6 class="ms-auto d-flex align-items-center flex-row" style="font-family: monospace, cursive;">
                                                <span>{!! implode('&nbsp;', str_split($account['card_number'], 4)) !!}</span>
                                            </h6>
                                            <div class="ms-auto d-flex align-items-center flex-row">
                                                {{-- <a> <i class="icon-edit fas fa-pencil-alt text-dark cursor-pointer px-2" data-bs-toggle="tooltip" data-bs-placement="top"  title="Editar"></i> </a> --}}
                                                {{-- <a> <i class="icon-view fas fa-eye text-dark cursor-pointer px-2" wire:click="viewAccountCard({{ $index }})" title="Ver"></i></a> --}}
                                            <div class="dropup">
                                                <a type="button" class="dropdown-toggle dropdown-toggle-split dropdown-toggle-no-caret" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="icon-del fas fa-trash-alt text-dark cursor-pointer"></i>
                                                </a>
                                                <div class="dropdown-menu px-2 py-1 mx-n8" style="background-color: #212529;    min-width: 18em;">
                                                    <span class="cursor-default text-bold text-white">
                                                        ¿ Estás seguro ?
                                                         &nbsp;
                                                        <a class='cursor-pointer text-decoration-underline text-danger' wire:click="removeAccountCard({{ $index }})">Quitar</a>
                                                         &nbsp;
                                                        <a class='cursor-pointer text-white'>Cancelar</a>
                                                    </span>
                                                </div>
                                            </div>

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
