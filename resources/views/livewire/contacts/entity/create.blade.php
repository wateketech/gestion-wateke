<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-primary">
        Formulario para registrar {{ $entity_type == Null ? 'Entidad' : $entity_type->visual_name_p }}
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
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4">
                        {{-- -------------------------- STEP 1 -------------------------- --}}
                            <div class="row {{ $currentStep != 1 ? 'd-none' : '' }}" id="step-1">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_1">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                <div class="col-5 form-group">
                                    <label for="entity_type" class="form-control-label">Tipo de entidad *</label>
                                    <select class="form-control @error('entity_type')border border-danger rounded-3 @enderror" type="text" name="entity_type" id="entity_type"
                                        wire:model="entity_type" required>
                                        <option value=""></option>
                                        @foreach ($entity_types as $entity)
                                            <option value='{{ $entity->id }}'>{{ $entity->visual_name_s }}</option>
                                        @endforeach
                                    </select>
                                    @error('entity_type') <sub class="text-danger">{{ $message }}</sub> @enderror
                                </div>
                            </div>

                        {{-- -------------------------- STEP 2 -------------------------- --}}
                            <div class="row {{ $currentStep != 2 ? 'd-none' : '' }}" id="step-2">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_2">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class='col-lg-8'>
                                            <div class="row">
                                                <div class="col-2 form-group pr-0">
                                                    <label for="nif" class="form-control-label">ID *</label>
                                                    <input class="form-control" type="text" placeholder="John Snow"
                                                    name="nif" id="nif" wire:model="nif">
                                                </div>
                                                <div class="col-10 form-group">
                                                    <label for="nif" class="form-control-label">NIF *</label>
                                                    <input class="form-control" type="text" placeholder="John Snow"
                                                    name="nif" id="nif" wire:model="nif">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="nombre" class="form-control-label">Alias *</label>
                                                    <input class="form-control" type="text" placeholder="HAVANATUR"
                                                        name="nombre" id="nombre" wire:model="nombre">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="nombre_fiscal" class="form-control-label">Nombre Fiscal *</label>
                                                    <input class="form-control" type="text" placeholder="John Snow"
                                                        name="nombre_fiscal" id="nombre_fiscal" wire:model="nombre_fiscal">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="nombre_fiscal" class="form-control-label">Nombre Comercial *</label>
                                                    <input class="form-control" type="text" placeholder="John Snow"
                                                        name="nombre_fiscal" id="nombre_fiscal" wire:model="nombre_fiscal">
                                                </div>
                                                <div class="col-12 form-group">
                                                    <label for="observ">Observaciones</label>
                                                    <textarea class="form-control" rows="3" name="observ" id="observ" wire:model="observ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-lg-4'>
                                            <div class="row">
                                                <div class="col-sm-5 col-md-5 col-lg-12 col-xl-11 col-xxl-11">

                                                    <div class="form-group p-4">

                                                        <div wire:ignore id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                                                            <ol class="carousel-indicators">
                                                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                                                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                                                                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
                                                            </ol>
                                                            <div class="carousel-inner">
                                                                <div class="carousel-item">
                                                                    <img class="d-block w-100" src="https://via.placeholder.com/800x800?text=First+Slide" class="w-100 h-74 d-block rounded-top" alt="...">
                                                                    {{-- <button id="deleteButton" class="btn btn-danger">Borrar foto actual</button> --}}
                                                                </div>
                                                                <div class="carousel-item active">
                                                                    <img class="d-block w-100" src="https://via.placeholder.com/800x800?text=Second+Slide" class="w-100 h-74 d-block rounded-top" alt="...">
                                                                    <div class="d-flex justify-content-center">
                                                                        <div class="position-absolute top-0 p-3">
                                                                            <a href="" class="icon p-1"><i class="far fa-trash-alt"></i></a>
                                                                            <a href="" class="icon p-1"><i class="far fa-eye"></i></a>
                                                                            <a href="" class="icon p-1"><i class="far fa-star"></i></a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="carousel-item">
                                                                    <img class="d-block w-100" src="https://via.placeholder.com/800x800?text=Third+Slide" class="w-100 h-74 d-block rounded-top" alt="...">
                                                                    {{-- <button id="deleteButton" class="btn btn-danger">Borrar foto actual</button> --}}
                                                                </div>
                                                            </div>
                                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                              <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                              <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                              <span class="sr-only">Next</span>
                                                            </a>
                                                        </div>

                                                        <input class="form-control" id="profile_pic" type="file" name="images[]" multiple>
                                                        <sub><strong>NOTA:</strong> Seleccionar todos los logotipos a subir al mismo tiempo con un tamaño máximo 5mg por cada uno.</sub>
                                                    </div>




                        <script wire:ignore>
                            document.addEventListener("DOMContentLoaded", function() {
                                var carousel = document.querySelector("#carouselExampleIndicators");
                                var carouselInstance = new bootstrap.Carousel(carousel);

                                var prevButton = carousel.querySelector(".carousel-control-prev");
                                var nextButton = carousel.querySelector(".carousel-control-next");

                                prevButton.addEventListener("click", function() {
                                    carouselInstance.prev();
                                });

                                nextButton.addEventListener("click", function() {
                                    carouselInstance.next();
                                });

                                carousel.addEventListener("mouseenter", function() {
                                    carouselInstance.pause();
                                });

                                carousel.addEventListener("mouseleave", function() {
                                    carouselInstance.cycle();
                                });
                            });
                        </script>


                                                </div>
                                            </div>
                                      </div>
                                  </div>



                            </div>
                        {{-- -------------------------- STEP 3 -------------------------- --}}
                            <div class="row {{ $currentStep != 3 ? 'd-none' : '' }}" id="step-3">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_3">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                paso 3

                            </div>
                        {{-- -------------------------- STEP 3 -------------------------- --}}
                            <div class="row {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-3">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
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
