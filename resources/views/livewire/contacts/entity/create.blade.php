<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-primary">
        Formulario para registrar {{ $entity_type == Null ? 'Entidad' : $entity_type['visual_name_p'] }}
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2">
                    <div id="menu-step-1" href="#step-1" class="btn btn-primary d-lg-block {{ $currentStep != 1 ? 'disabled' : 'text-white' }}">Tipo de Entidad</div>
                    <div id="menu-step-2" href="#step-2" class="btn btn-primary d-lg-block {{ $currentStep != 2 ? 'disabled' : 'text-white' }}">Datos Generales</div>
                    <div id="menu-step-3" href="#step-3" class="btn btn-primary d-lg-block {{ $currentStep != 3 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-4" href="#step-4" class="btn btn-primary d-lg-block {{ $currentStep != 4 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-5" href="#step-5" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-6" href="#step-6" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-0" href="#step-0" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">Vista Resumen</div>
                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="store" action="#" method="POST">
                        <div class="card card-body blur shadow-blur mx-4 my-1">
                        {{-- -------------------------- STEP 1 -------------------------- --}}
                            <div class="row {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-2 btn btn-primary"
                                        wire:click="stepSubmit_1">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                <div class="col-5 form-group">
                                    <label for="entity_type" class="form-control-label">Tipo de entidad *</label>
                                    <select class="form-control @error('entity_type')border border-danger rounded-3 @enderror" type="text" name="entity_type" id="entity_type"
                                        wire:model="entity_type_id" required>
                                        <option value=""></option>
                                        @foreach ($entity_types as $entity)
                                            <option value={{ $entity['id'] }}>{{ $entity['visual_name_s'] }}</option>
                                        @endforeach
                                    </select>
                                    @error('entity_type') <sub class="text-danger">{{ $message }}</sub> @enderror
                                </div>
                            </div>

                        {{-- -------------------------- STEP 2 -------------------------- --}}
                            <div class="row {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-2 btn btn-primary"
                                        wire:click="stepSubmit_2">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>


                                <div class="col-3 form-group">
                                    <label for="nombre" class="form-control-label">Nombre *</label>
                                    <input class="form-control" type="text" placeholder="HAVANATUR"
                                        name="nombre" id="nombre" wire:model="nombre">
                                </div>
                                <div class="col-3 form-group">
                                    <label for="nombre_fiscal" class="form-control-label">Nombre Fiscal *</label>
                                    <input class="form-control" type="text" placeholder="John Snow"
                                        name="nombre_fiscal" id="nombre_fiscal" wire:model="nombre_fiscal">
                                </div>



                                <div class="row">
                                    <div class="col-3 form-group">
                                        <label for="nif" class="form-control-label">NIF *</label>
                                        <input class="form-control" type="text" placeholder="John Snow"
                                            name="nif" id="nif" wire:model="nif">
                                    </div>
                                    <div class="col-3 form-group">
                                        <label for="iata" class="form-control-label">IATA *</label>
                                        <input class="form-control" type="text" placeholder="MZT"
                                            name="iata" id="iata" wire:model="iata">
                                    </div>
                                    <div class="col-3 form-group">
                                        <label for="rp" class="form-control-label">RP *</label>
                                        <input class="form-control" type="text" placeholder="John Snow"
                                            name="rp" id="rp" wire:model="rp">
                                    </div>
                                    <div class="col-3 form-group">
                                        <label for="rp" class="form-control-label">Descripción *</label>
                                        <input class="form-control" type="text" placeholder="John Snow"
                                            name="rp" id="rp" wire:model="rp">
                                    </div>




                                    <div class="col-3 form-group">
                                            @livewire('contacts.entidad.layouts.gds')
                                    </div>
                                </div>



                                <div class="col-6 form-group">
                                    <label for="observ">Observaciones</label>
                                    <textarea class="form-control" rows="3" name="observ" id="observ" wire:model="observ"></textarea>
                                </div>
                                <div class="col-6 my-4">
                                    <div class="container">
                                        <div class="row">
                                            <div class="form-check my-2">
                                                <input class="form-check-input" type="checkbox"
                                                name="es_minorista" id="es_minorista" wire:model="es_minorista">
                                                <label class="custom-control-label" for="es_minorista">Es una minorista</label>
                                            </div>

                                            <div class="form-check my-2">
                                                <input class="form-check-input" type="checkbox"
                                                name="es_central" id="es_central" wire:model="es_central">
                                                <label class="custom-control-label" for="es_central">Es una central</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>












                            </div>
                        {{-- -------------------------- STEP 3 -------------------------- --}}
                            <div class="row {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-2 btn btn-primary"
                                        wire:click="stepSubmit_3">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                paso 3

                            </div>
                        {{-- -------------------------- STEP 3 -------------------------- --}}
                            <div class="row {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-3">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-2 btn btn-primary"
                                        wire:click="stepSubmit_4">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                paso 4

                            </div>
                        {{-- -------------------------- STEP 0  -------------------------- --}}
                            <div class="row {{ $currentStep != 0 ? 'd-none' : '' }}" id="step-0">

                                <div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a type="button" href="{{ route('entidades') }}" class="btn btn-secondary mx-2">Descartar cambios</a>
                                        <button type="submit" class="btn btn-success mx-2">Crear Entidad</button>
                                    </div>
                                </div>

                            </div>
                        {{-- -------------------------- END - STEPS -------------------------- --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>
