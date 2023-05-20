<div class="container-fluid mt-7 mt-lg-4">
    <div class="row">
        <div class='col-lg-8'>
            <div class="row">
                <div class="col-2 form-group pr-0">
                    <label for="id_types" class="form-control-label">ID *</label>
                    <select class="@error('id_type')border border-danger rounded-3 is-invalid @enderror form-control" type="text" placeholder="John Snow"
                        name="id_types" id="id_types" wire:model="id_type">
                        @foreach ($id_types as $id_type)
                            <option value="{{ $id_type->id }}">{{ $id_type->label }}</option>
                        @endforeach
                    </select>
                    @error('id_type') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-5 col-md-8 form-group">
                    <label for="entity_ids" class="form-control-label">{{  $id_types->find($id_type)->title }} *</label>
                    <input class="@error('id_value')border border-danger rounded-3 @enderror form-control" type="text"
                        name="entity_ids" id="entity_ids" wire:model="id_value">
                    @error('id_value') <sub class="text-danger">{{ $message }}</sub> @enderror
                        @php
                            $id_value_valid = true;
                            foreach (json_decode($id_types->find($id_type)->regEx) as $regEx){
                                if ($id_value && !preg_match($regEx, $id_value)){
                                    $id_value_valid = false;
                                    // print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                }else{
                                    $id_value_valid = true;
                                }
                            }
                        @endphp
                    @if (!$id_value_valid)
                        <sub class="text-warning">Tenga presente que el {{ $id_types->find($id_type)->title }} no cumple con el formato. </sub>
                        <script> document.getElementById('entity_ids').classList += ' is-warning';  </script>
                            {{-- {{ cleanError('entity_id_value') }} --}}
                    @endif
                </div>
                <div class="col-5 col-md-2 mt-4">
                    <button class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                    <button class="btn btn-outline-danger px-3"><i class="fas fa-minus text-danger"></i></button>
                </div>



                <br/><br/><br/><br/><br/><hr><br/><br/>



                <div class="col-4 form-group">
                    <label for="entity_alias" class="form-control-label">Nombre *</label>
                    <input class="@error('entity_alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="entity_alias" id="entity_alias" wire:model="entity_alias">
                    @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-4 form-group">
                    <label for="entity_alias" class="form-control-label">Segundo Nombre</label>
                    <input class="@error('entity_alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="entity_alias" id="entity_alias" wire:model="entity_alias">
                    @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-4 form-group">
                    <label for="entity_alias" class="form-control-label">Alias</label>
                    <input class="@error('entity_alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="entity_alias" id="entity_alias" wire:model="entity_alias">
                    @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

                <div class="col-6 form-group">
                    <label for="entity_alias" class="form-control-label">Primer Apellido *</label>
                    <input class="@error('entity_alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="entity_alias" id="entity_alias" wire:model="entity_alias">
                    @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-6 form-group">
                    <label for="entity_alias" class="form-control-label">Segundo Apellido</label>
                    <input class="@error('entity_alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="entity_alias" id="entity_alias" wire:model="entity_alias">
                    @error('entity_alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>



                <br/><br/><br/><br/><br/><hr><br/><br/>

                <div class="col-12 form-group">
                    <label for="entity_about">Observaciones</label>
                    <textarea class="@error('entity_about')border border-danger rounded-3 is-invalid @enderror form-control" rows="3"
                        name="entity_about" id="entity_about" wire:model="entity_about"></textarea>
                    @error('entity_about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        </div>


        {{-- <div class='col-lg-4'>
            <div class="row">
                <div class="col-sm-5 col-md-5 col-lg-12 col-xl-11 col-xxl-11">

                    <div class="form-group p-4">

                        <div id="carouselExampleIndicators" class="carousel slide @error('entity_logos')border border-danger rounded-3 is-invalid @enderror" data-ride="carousel">
                            @if (count($entity_logos) >= 2)
                                <ol class="carousel-indicators" style="background-color: bisque;border-radius: .7em;">
                            @else
                                <ol class="carousel-indicators">
                            @endif
                                @forelse ($entity_logos as $index => $logo)
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}" class={{ $index==0 ? 'active' : '' }} style="background-color: #000;"></li>
                                @empty
                                    <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class='active' style="background-color: #000;" ></li>
                                @endforelse

                            </ol>
                            <div class="carousel-inner">

                                ARREGLAR EL TAMAÑO DE LA IMAGEN
                                @forelse ($entity_logos as $index => $logo)
                                    <div class="carousel-item {{ $index==0 ? 'active' : '' }}">
                                        <img class="d-block rounded-top" src="{{ $logo->temporaryUrl() }}" alt="...">
                                        <div class="d-flex justify-content-center">
                                            <div class="position-absolute top-2 p-1 mx-1"
                                                style="background-color: bisque;border-radius: .9em;height: 2.2em;padding: 0.25em 1.1em 0 1.1em !important;">
                                                <span wire:click="removeLogo({{$index}})" class="icon-del p-1 text-black"><i class="far fa-trash-alt"></i></span>
                                                <a href="{{ $logo->temporaryUrl() }}" target="_blank" class="icon-view p-1 text-black"><i class="far fa-eye"></i></a>
                                                @if (count($entity_logos) != 1)
                                                    <span wire:click="$set('entity_main_logo', {{$index}})" class="icon p-1 text-black">
                                                        @if ($index == $entity_main_logo)
                                                            <i class="fas fa-star" style="color: #ff6400 ;"></i>
                                                        @else
                                                            <i class="far fa-star"></i>
                                                        @endif
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="carousel-item active">
                                        <img class="d-block rounded-top" src="https://via.placeholder.com/800x800/f2f2f2/161616?text=Logo+{{ $entity_type == Null ? 'Entidad' : $entity_type->visual_name_s }}" alt="...">
                                    </div>
                                @endforelse

                            </div>

                            CAMBIAR COLOR A ICONOS PRE NEXT
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
        </div> --}}
    </div>

</div>


