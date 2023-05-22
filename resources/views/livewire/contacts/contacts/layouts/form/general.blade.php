<div class="container-fluid mt-7 mt-lg-4">
    <div class="row">
        <div class='col-lg-8'>
            <div class="row">
                @foreach ($ids as $index => $id)
                <div class="row">
                    <div class="col-2 form-group pr-0">
                        <label for="id_types_{{ $index }}" class="form-control-label">ID *</label>
                        <select class="@error("ids.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                            name="id_types_{{ $index }}" id="id_types_{{ $index }}" wire:model="ids.{{ $index }}.id_type">
                            @foreach ($id_types as $type)
                                <option value="{{ $type->id }}">
                                    {{ $type->label }}
                                </option>
                            @endforeach
                            <script>

                            </script>
                        </select>
                        @error("ids.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                    <div class="col-8 col-md-8 form-group">
                        <label for="id_value_{{ $index }}" class="form-control-label">{{ $id_types->find($id['id_type'])->title }} *</label>
                        <input class="@error("ids.{$index}.id_value")border border-danger rounded-3 @enderror form-control"
                            type="text" name="id_value_{{ $index }}" id="id_value_{{ $index }}"
                            wire:model.debounce.500ms="ids.{{ $index }}.id_value">
                        @error("ids.{$index}.id_value") <sub class="text-danger">{{ $message }}</sub> @enderror
                        @php
                            $id_value_valid = true;
                            if ($id['id_value']) {
                                foreach (json_decode($id_types->find($id['id_type'])->regEx) as $regEx) {
                                    if (preg_match($regEx, $id['id_value'])) {
                                        $id_value_valid = true;
                                        break;
                                    } else {
                                        $id_value_valid = false;
                                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                    }
                                }
                            }
                        @endphp
                        @if (!$id_value_valid)
                            <sub class="text-warning">Tenga presente que el {{ $id_types->find($id['id_type'])->title }} no cumple con el formato. </sub>
                            <script>
                                document.getElementById('id_value_{{ $index }}').classList += ' is-warning';
                            </script>
                        @endif
                    </div>
                    <div class="col-2 col-md-2 mt-4">
                            @if ($index === count($ids) - 1)
                                @if (count($this->ids) < $this->id_max)
                                    <button wire:click="addId({{ $index }})" class="btn btn-outline-success px-3"><i
                                            class="fas fa-plus text-success"></i></button>
                                @endif
                            @else
                                <button wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3"><i
                                        class="fas fa-minus text-danger"></i></button>
                            @endif
                    </div>
                </div>
            @endforeach
        </div>



































                <br/><br/><br/><br/><br/><hr><br/><br/>



                <div class="col-4 form-group">
                    <label for="name" class="form-control-label">Nombre *</label>
                    <input class="@error('name')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="name" id="name" wire:model="name">
                    @error('name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-4 form-group">
                    <label for="middle_name" class="form-control-label">Segundo Nombre</label>
                    <input class="@error('middle_name')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="middle_name" id="middle_name" wire:model="middle_name">
                    @error('middle_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-4 form-group">
                    <label for="alias" class="form-control-label">Alias</label>
                    <input class="@error('alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="alias" id="alias" wire:model="alias">
                    @error('alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

                <div class="col-6 form-group">
                    <label for="first_lastname" class="form-control-label">Primer Apellido *</label>
                    <input class="@error('first_lastname')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="first_lastname" id="first_lastname" wire:model="first_lastname">
                    @error('first_lastname') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-6 form-group">
                    <label for="second_lastname" class="form-control-label">Segundo Apellido</label>
                    <input class="@error('second_lastname')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="second_lastname" id="second_lastname" wire:model="second_lastname">
                    @error('second_lastname') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>



                <br/><br/><br/><br/><br/><hr><br/><br/>

                <div class="col-12 form-group">
                    <label for="about">Observaciones</label>
                    <textarea class="@error('about')border border-danger rounded-3 is-invalid @enderror form-control" rows="3"
                        name="about" id="about" wire:model="about"></textarea>
                    @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
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


