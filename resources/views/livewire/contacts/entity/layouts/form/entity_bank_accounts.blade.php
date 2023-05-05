<div class="container-fluid mt-4">
    <div class="row">






                    <div class="col-lg-12">
                        <div class="row">
                            <div class="col-xl-6 mb-xl-0 mb-4">
                                <div class="card bg-transparent shadow-xl">
                                    <div class="overflow-hidden position-relative border-radius-xl"
                                        style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                                        <span class="mask bg-gradient-dark"></span>
                                        <div class="card-body position-relative z-index-1 p-3">
                                            <i class="fas fa-wifi text-white p-2"></i>
                                            <h5 class="text-white mt-4 mb-5 pb-2">
                                                4562&nbsp;&nbsp;&nbsp;1122&nbsp;&nbsp;&nbsp;4594&nbsp;&nbsp;&nbsp;7852</h5>
                                            <div class="d-flex">
                                                <div class="d-flex">
                                                    <div class="me-4">
                                                        <p class="text-white text-sm opacity-8 mb-0">Card Holder</p>
                                                        <h6 class="text-white mb-0">Jack Peterson</h6>
                                                    </div>
                                                    <div>
                                                        <p class="text-white text-sm opacity-8 mb-0">Expires</p>
                                                        <h6 class="text-white mb-0">11/22</h6>
                                                    </div>
                                                </div>
                                                <div class="ms-auto w-20 d-flex align-items-end justify-content-end">
                                                    <img class="w-60 mt-2" src="../assets/img/logos/mastercard.png" alt="logo">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6">
                                <div class="row">


                                    <div class="col-12 form-group">
                                        <label for="entity_alias" class="form-control-label">Alias *</label>
                                        <input class="@error('entity_alias')border border-danger rounded-3 @enderror form-control" type="text" placeholder="HAVANATUR"
                                            name="entity_alias" id="entity_alias" wire:model="entity_alias">
                                        @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="entity_legal_name" class="form-control-label">Nombre Fiscal *</label>
                                        <input class="@error('entity_legal_name')border border-danger rounded-3 @enderror form-control" type="text" placeholder="John Snow"
                                            name="entity_legal_name" id="entity_legal_name" wire:model="entity_legal_name">
                                        @error('entity_legal_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="entity_comercial_name" class="form-control-label">Nombre Comercial *</label>
                                        <input class="@error('entity_comercial_name')border border-danger rounded-3 @enderror form-control" type="text" placeholder="John Snow"
                                            name="entity_comercial_name" id="entity_comercial_name" wire:model="entity_comercial_name">
                                        @error('entity_comercial_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                    <div class="col-12 form-group">
                                        <label for="entity_about">Observaciones</label>
                                        <textarea class="@error('entity_about')border border-danger rounded-3 @enderror form-control" rows="3"
                                            name="entity_about" id="entity_about" wire:model="entity_about"></textarea>
                                        @error('entity_about') <sub class="text-danger">{{ $message }}</sub> @enderror
                                    </div>
                                </div>



                            </div>

                            <div class="col-md-12 mb-lg-0 mb-4">
                                <div class="card mt-4">
                                    <div class="card-header pb-0 p-3">
                                        <div class="row">
                                            <div class="col-md-6 d-flex align-items-center">
                                                <h6 class="mb-0">Payment Method</h6>
                                            </div>
                                            <div class="col-md-6 text-right">
                                                <a class="btn bg-gradient-dark mb-0" href="javascript:;"><i
                                                        class="fas fa-plus"></i>&nbsp;&nbsp;Add New Card</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-3">
                                        <div class="row">
                                            <div class="col-md-6 mb-md-0 mb-4">
                                                <div
                                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/mastercard.png"
                                                        alt="logo">
                                                    <h6 class="mb-0">
                                                        ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;7852
                                                    </h6>
                                                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div
                                                    class="card card-body border card-plain border-radius-lg d-flex align-items-center flex-row">
                                                    <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                                                    <h6 class="mb-0">
                                                        ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248
                                                    </h6>
                                                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"
                                                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>








    </div>
</div>
