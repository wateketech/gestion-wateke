<div class="container-fluid mt-4">
    <div class="row">

                    <div class="col-lg-12">
                        <div class="row">

                            {{-- tarjeta --}}
                            <div class="col-xl-6 mb-xl-0 mb-4 mt-4">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl"
                                        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                        <span class="mask bg-gradient-dark"></span>
                                        {{-- difuminacion fondo cuando esta este con los campos necesarios llenos --}}
                                        <div class="card-body position-relative z-index-1 p-3">
                                            {{-- icono tipo de tarjeta --}}
                                            <i class="fas fa-wifi text-white p-2"></i>
                                            <h6 class="text-white mt-4 mb-4 pb-2 fs-4">
                                                {{-- NUMERO DE LA TARJETA --}}
                                                {{-- <input wire:model="entity_alias"> ---> como hacerlo --}}
                                                4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h6>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <div class="me-4">
                                                        <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                        {{-- NOMBRE DE LA TARJETA --}}
                                                        <h6 class="text-white mb-0">Jack Peterson</h6>
                                                    </div>
                                                    <div>
                                                        <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                        {{-- FECHA EXPIRACION --}}
                                                        <h6 class="text-white mb-0">11/22</h6>
                                                    </div>
                                                </div>
                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                    {{-- TIPO DE TARJETA --}}
                                                    <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 d-none d-xl-flex justify-content-end mt-3 h3">
                                    {{-- <button class="btn btn-secondary mx-1">Nota</button> --}}
                                    <button class="btn btn-success mx-1 mx-4">agregar tarjeta</button>
                                </div>


                            </div>

                            {{-- formulario --}}
                            <div class="col-xl-6">
                                <div class="row">

                                    <div class="col-8">
                                        <div class="form-group mb-2">
                                            <label for="entity_alias" class="form-control-label">Nombre del Banco *</label>
                                            <input class="@error('entity_alias')border border-danger rounded-3 @enderror form-control" type="text" placeholder="HAVANATUR"
                                                name="entity_alias" id="entity_alias" wire:model="entity_alias">
                                            @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>

                                        <div class="form-group mb-2">
                                            <label for="entity_legal_name" class="form-control-label"> Nombre *</label>
                                            <input class="@error('entity_legal_name')border border-danger rounded-3 @enderror form-control" type="text" placeholder="John Snow"
                                                name="entity_legal_name" id="entity_legal_name" wire:model="entity_legal_name">
                                            @error('entity_legal_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                        </div>
                                    </div>
                                    <div class="col-4 form-group mt-4 mb-0 px-xl-2 px-lg-5 px-sm-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio1">
                                            <label class="custom-control-label" for="customRadio1">Credito</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio2">
                                            <label class="custom-control-label" for="customRadio2">Debito</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3">
                                            <label class="custom-control-label" for="customRadio3">Paypal</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="flexRadioDefault" id="customRadio3">
                                            <label class="custom-control-label" for="customRadio3">Regalo</label>
                                        </div>
                                    </div>

                                    <div class="col-12 form-group">
                                        <label for="entity_alias" class="form-control-label">Numeración *</label>
                                        <input class="@error('entity_alias')border border-danger rounded-3 @enderror form-control" type="number" placeholder="HAVANATUR"
                                            name="entity_alias" id="entity_alias" wire:model="entity_alias">
                                        @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>


                                    <label for="entity_comercial_name" class="form-control-label">Fecha Expiración *</label>
                                    <div class="col-6 form-group">
                                        <select class="form-control" name="" id="">
                                            <option value=""></option>
                                        </select>
                                        @error('entity_comercial_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                    <div class="col-6 form-group">
                                        <select class="form-control" name="" id="">
                                            <option value=""></option>
                                        </select>
                                        @error('entity_comercial_name') <sub class="text-danger">{{ $message }}</sub> @enderror
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
                                                <button class="btn btn-success mx-1 mx-4">agregar tarjeta</button>
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
