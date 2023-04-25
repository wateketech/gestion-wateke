<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-primary">
        {{-- Formulario para registrar {{ $entity_type == Null ? 'Entidad' : $entity_type }} --}}
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
                    <div id="menu-step-6" href="#step-6" class="btn btn-primary d-lg-block {{ $currentStep != 6 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-0" href="#step-0" class="btn btn-primary d-lg-block" style="background-color: #000" >Vista Resumen</div>
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

                                <div class="col-3 form-group">
                                    <label for="entity_type" class="form-control-label">Tipo de entidad *</label>
                                    {{-- <select class="form-control" type="text" name="entity_type" id="entity_type"
                                        wire:model="entity_type">
                                        @foreach ($entity_types as $entity)
                                            <option value="{{ $entity }}">{{ $entity }}</option>
                                        @endforeach
                                    </select> --}}
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
                                paso 2

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
