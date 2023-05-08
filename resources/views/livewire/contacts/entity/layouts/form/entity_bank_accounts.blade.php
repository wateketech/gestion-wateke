<div class="container-fluid mt-4">
    <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            {{-- tarjeta --}}
                            <div class="col-xl-5 mb-xl-0 mb-4 mt-4">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl"
                                        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                        @if ( !isset($entity_bank_account_card_number, $entity_bank_account_card_holder, $entity_bank_account_expiration_year, $entity_bank_account_expiration_month, $entity_bank_account_is_credit, $entity_bank_account_bank_name) )
                                            {{-- difuminacion fondo cuando esta este con los campos necesarios llenos --}}
                                            <span class="mask bg-gradient-dark"></span>
                                        @endif
                                        <div class="card-body position-relative z-index-1 p-3">
                                            {{-- @isset($entity_bank_account_is_credit) --}}
                                                <i class="fas fa-wifi text-white p-2"></i>
                                            {{-- @endisset --}}
                                            <h6 class="text-white mt-4 mb-4 pb-2 fs-4" for="entity_bank_account_card_number">
                                                {{-- NUMERO DE LA TARJETA --}}
                                                {!! isset($entity_bank_account_card_number) ? $entity_bank_account_card_number : '####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####&nbsp;&nbsp;&nbsp;####' !!}
                                            </h6>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <div class="me-4">
                                                        <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                        {{-- NOMBRE DE LA TARJETA --}}
                                                        <h6 class="text-white mb-0">{{ $entity_bank_account_card_holder }}</h6>
                                                    </div>
                                                    <div>
                                                        <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                        {{-- FECHA EXPIRACION --}}
                                                        <h6 class="text-white mb-0">{{ str_pad($entity_bank_account_expiration_month, 2, '0', STR_PAD_LEFT)  }}/{{ substr($entity_bank_account_expiration_year, -2)  }}</h6>
                                                    </div>
                                                </div>
                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                    {{-- TIPO DE TARJETA --}}
                                                    @if ($entity_bank_account_types->find($entity_bank_account_type)->label != 'Unknown')
                                                        <img class="w-60 mt-2" src="{{ $entity_bank_account_types->find($entity_bank_account_type)->logo }}" alt="{{ $entity_bank_account_types->find($entity_bank_account_type)->label }}">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-none d-xl-flex justify-content-end mt-3 h3">
                                    {{-- <button class="btn btn-secondary mx-1">Nota</button> --}}
                                    <button class="btn btn-success mx-1 mx-4" wire:click="addAccountCard">agregar tarjeta</button>
                                </div>


                            </div>

                            {{-- formulario --}}
                            <div class="col-xl-7">
                                <div class="row">


                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_bank_name" class="form-control-label">Nombre del Banco *</label>
                                            <input class="@error('entity_bank_account_bank_name')border border-danger rounded-3 @enderror form-control" type="text" placeholder="HAVANATUR"
                                                name="entity_bank_account_bank_name" id="entity_bank_account_bank_name" wire:model="entity_bank_account_bank_name">
                                            @error('entity_bank_account_bank_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>
                                    <div class="col-3">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_bank_title" class="form-control-label">Alias del Banco</label>
                                            <input class="@error('entity_bank_account_bank_title')border border-danger rounded-3 @enderror form-control" type="text" placeholder="HAVANATUR"
                                                name="entity_bank_account_bank_title" id="entity_bank_account_bank_title" wire:model="entity_bank_account_bank_title">
                                            @error('entity_bank_account_bank_title') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>


                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="entity_bank_account_card_holder" class="form-control-label">Nombre de la cuenta *</label>
                                            <input class="@error('entity_bank_account_card_holder')border border-danger rounded-3 @enderror form-control" type="text" placeholder="{{ isset($entity_legal_name) ? $entity_legal_name : $entity_comercial_name }}"
                                                name="entity_bank_account_card_holder" id="entity_bank_account_card_holder" wire:model="entity_bank_account_card_holder">
                                            @error('entity_bank_account_card_holder') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 form-group mt-3 mb-0 px-xl-2 px-lg-5 px-sm-4">
                                        {{-- entity_bank_account_is_credit --}}
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1" value="true" wire:model="entity_bank_account_is_credit">
                                            <label class="custom-control-label" for="customRadio1">Credito</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2" value="false" wire:model="entity_bank_account_is_credit">
                                            <label class="custom-control-label" for="customRadio2">Debito</label>
                                        </div>

                                    </div>


                                    <div class="col-12 form-group">
                                        <label for="entity_bank_account_card_number" class="form-control-label">Numeración *</label>
                                        <input class="@error('entity_bank_account_card_number')border border-danger rounded-3 @enderror form-control" type="text" placeholder="####   ####   ####   ####"
                                        name="entity_bank_account_card_number" id="entity_bank_account_card_number" wire:model="entity_bank_account_card_number"
                                        pattern="\d{13,19}" maxlength="25"
                                        oninput="function formatCardNumber(event) {
                                            const input = event.target.value.replace(/\D/g, '').substring(0, 16);
                                            const cardNumber = input !== '' ? input.match(/.{1,4}/g).join('&nbsp;&nbsp;&nbsp;') : '';
                                            event.target.value = cardNumber;
                                        } formatCardNumber(event)">
                                        @error('entity_bank_account_card_number') <sub class="text-danger">{{ $message }}</sub> @enderror

                                    </div>


                                    <label for="entity_comercial_name" class="form-control-label">Fecha Expiración *</label>
                                    <div class="col-6 form-group">
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
                                    <div class="col-6 form-group">
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
                                <div class="card mt-4">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                <h6 class="mb-0">Cuentas Registradas</h6>
                                            </div>
                                            {{-- <div class="col-md-6 d-flex align-items-center "> --}}
                                            <div class="col-md-6 d-xl-none text-right">
                                                {{-- <button class="btn btn-secondary mx-1">Nota</button> --}}
                                                <button class="btn btn-success mx-1 mx-4" wire:click="addAccountCard">agregar tarjeta</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            {{-- repetir en bucle las ya añadidas --}}
                                            <div class="col-md-6 mb-md-0 mb-4">
                                                <div
                                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/mastercard.png"
                                                        alt="logo">
                                                    <h6 class="mb-0">
                                                        ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852
                                                    </h6>
                                                    <div class="ms-auto">
                                                        <i class="fas fa-pencil-alt text-dark cursor-pointer px-2"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i>
                                                        <i class="fas fa-trash-alt text-dark cursor-pointer"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                                                    <h6 class="mb-0">
                                                        ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248
                                                    </h6>
                                                    <div class="ms-auto">
                                                        <i class="fas fa-pencil-alt text-dark cursor-pointer icon px-2"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Editar"></i>
                                                        <i class="fas fa-trash-alt text-dark cursor-pointer icon"
                                                            data-bs-toggle="tooltip" data-bs-placement="top" title="Eliminar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- endforeach --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>








    </div>
</div>
