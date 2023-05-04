<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-primary">
        Formulario para registrar {{ $entity_type == Null ? 'Entidad' : $entity_type->visual_name_p }}
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2">
                    <div id="menu-step-entity_type" class="btn btn-primary d-lg-block {{ $currentStep != 'entity_type' ? 'disabled' : 'text-white' }}">Tipo de Entidad</div>
                    <div id="menu-step-entity_general" class="btn btn-primary d-lg-block {{ $currentStep != 'entity_general' ? 'disabled' : 'text-white' }}">Datos Generales</div>
                    <div id="menu-step-3" class="btn btn-primary d-lg-block {{ $currentStep != 3 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-4" class="btn btn-primary d-lg-block {{ $currentStep != 4 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-5" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">General</div>
                    <div id="menu-step-6" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">General</div>

                    <div id="menu-step-0" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">Vista Resumen</div>
                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="store" action="#" method="POST">
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4">
                        {{-- -------------------------- STEP TYPE -------------------------- --}}
                            <div class="row {{ $currentStep != 'entity_type' ? 'd-none' : '' }}" id="step-entity_type">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_entity_type">
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

                        {{-- -------------------------- STEP GENERALS -------------------------- --}}
                            <div class="row {{ $currentStep != 'entity_general' ? 'd-none' : '' }}" id="step-entity_general">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_entity_general">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                <div class="container-fluid mt-4">
                                    <div class="row">
                                        <div class='col-lg-8'>
                                            <div class="row">
                                                <div class="col-2 form-group pr-0">
                                                    <label for="entity_id_types" class="form-control-label">ID *</label>
                                                    <select class="@error('entity_id_type')border border-danger rounded-3 @enderror form-control" type="text" placeholder="John Snow"
                                                        name="entity_id_types" id="entity_id_types" wire:model="entity_id_type">
                                                        @foreach ($entity_type_ids as $id_type)
                                                            <option value="{{ $id_type->id }}">{{ $id_type->label }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('entity_id_type') <sub class="text-danger">{{ $message }}</sub> @enderror
                                                </div>
                                                <div class="col-10 form-group">
                                                    <label for="entity_ids" class="form-control-label">{{  $entity_type_ids->find($entity_id_type)->title }} *</label>
                                                    <input class="@error('entity_id_value')border border-danger rounded-3 @enderror form-control" type="text" placeholder="John Snow"
                                                        name="entity_ids" id="entity_ids" wire:model="entity_id_value">
                                                    @error('entity_id_value') <sub class="text-danger">{{ $message }}</sub> @enderror
                                                    @php
                                                        $entity_id_value_valid = true;
                                                        foreach (json_decode($entity_type_ids->find($entity_id_type)->regEx) as $regEx){
                                                            if ($entity_id_value && !preg_match($regEx, $entity_id_value)){
                                                                $entity_id_value_valid = false;
                                                                // print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                                            }else{
                                                                $entity_id_value_valid = true;
                                                            }
                                                        }
                                                    @endphp
                                                    @if (!$entity_id_value_valid)
                                                        <sub class="text-warning">Este {{ $entity_type_ids->find($entity_id_type)->label }} no cumple con las validacion predefinidas</sub>
                                                    @endif
                                                </div>
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
                                        <div class='col-lg-4'>
                                            <div class="row">
                                                <div class="col-sm-5 col-md-5 col-lg-12 col-xl-11 col-xxl-11">

                                                    <div class="form-group p-4">

                                                        <div id="carouselExampleIndicators" class="carousel slide @error('entity_logos')border border-danger rounded-3 @enderror" data-ride="carousel">
                                                            <ol class="carousel-indicators">

                                                                @forelse ($entity_logos as $index => $logo)
                                                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class={{ $index==0 ? 'active' : '' }}></li>
                                                                @empty
                                                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class='active'></li>
                                                                @endforelse

                                                            </ol>
                                                            <div class="carousel-inner">

                                                                {{-- ARREGLAR EL TAMAÑO DE LA IMAGEN --}}
                                                                @forelse ($entity_logos as $index => $logo)
                                                                    <div class="carousel-item {{ $index==0 ? 'active' : '' }}">
                                                                        <img class="d-block rounded-top" src="{{ $logo->temporaryUrl() }}" alt="...">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="position-absolute top-0 p-3">
                                                                                <a href="" class="icon p-1"><i class="far fa-trash-alt"></i></a>
                                                                                <a href="" class="icon p-1"><i class="far fa-eye"></i></a>
                                                                                <a href="" class="icon p-1"><i class="far fa-star"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @empty
                                                                    <div class="carousel-item active">
                                                                        <img class="d-block rounded-top" src="https://via.placeholder.com/800x800/f2f2f2/161616?text=Logo+{{ $entity_type == Null ? 'Entidad' : $entity_type->visual_name_s }}" alt="...">
                                                                        <div class="d-flex justify-content-center">
                                                                            <div class="position-absolute top-0 p-3">
                                                                                <a href="" class="icon p-1"><i class="far fa-trash-alt"></i></a>
                                                                                <a href="" class="icon p-1"><i class="far fa-eye"></i></a>
                                                                                <a href="" class="icon p-1"><i class="far fa-star"></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforelse

                                                            </div>

                                                            {{-- CAMBIAR COLOR A ICONOS PRE NEXT --}}
                                                            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Previous</span>
                                                            </a>
                                                            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                <span class="sr-only">Next</span>
                                                            </a>

                                                        </div>

                                                        <input class="form-control" id="entity_logos" type="file" name="images[]" wire:model="entity_logos" accept=".jpeg,.jpg,.png,.webp" multiple>
                                                        <sub><strong>NOTA:</strong> Seleccionar todos los logotipos a subir al mismo tiempo con un tamaño máximo 5mg por cada uno.</sub>
                                                        @error('entity_logos')<br/><sub class="text-danger">{{ $message }}</sub> @enderror
                                                    </div>

@push('scripts')

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



@endpush


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
                        {{-- -------------------------- STEP 4 -------------------------- --}}
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



{{-- Sweet Alert Notificaciones --}}
@push('scripts')
<script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                container: 'swal-wide-container',
                popup: 'swal-wide-popup',
                confirmButton: 'btn btn-success mx-3',
                cancelButton: 'btn btn-danger mx-3'
            },
            buttonsStyling: false
        })

        window.addEventListener('ddbb-error', function($event){
            swalWithBootstrapButtons.fire({
                icon: 'error',
                title: 'Oops...',
                timer: 5000,
                text: "Hubo un error al procesar sus datos!",
                footer: "<code> " + $event.detail.code + " : " + $event.detail.message + "</code>"
            }).then(() => {
                window.location.href = "entidades";
            })
        });


</script>
@endpush
