<div class="container-fluid mt-7 mt-lg-4">
    <div class="row">
        <div class='col-lg-8 col-md-12'>
            <div class="row">
                <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-id-card"></i> &nbsp; Identificaiones :</span>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        @foreach ($ids as $index => $id)
                        <div class="col-2 form-group pr-0">
                            <label for="id_types_{{ $index }}" class="form-control-label">ID *</label>
                            <select class="@error("ids.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                                name="id_types_{{ $index }}" id="id_types_{{ $index }}" wire:model="ids.{{ $index }}.type_id">
                                @foreach ($id_types as $type)
                                    <option value="{{ $type->id }}">
                                        {{ $type->label }}
                                    </option>
                                @endforeach
                                <script>

                                </script>
                            </select>
                            @error("ids.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
                        </div>
                        <div class="col-8 col-md-8 form-group">
                            <label for="id_value_{{ $index }}" class="form-control-label">{{ $id_types->find($ids[$index]['type_id'])->title }} *</label>
                            <input class="@error("ids.{$index}.value")border border-danger rounded-3 @enderror form-control"
                                type="text" name="id_value_{{ $index }}" id="id_value_{{ $index }}"
                                wire:model.debounce.500ms="ids.{{ $index }}.value">
                            @error("ids.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                            {{-- @php
                                $id_value_valid = true;
                                if ($id[$index]['value']) {
                                    foreach (json_decode($id_types->find($id[$index]['type_id'])->regEx) as $regEx) {
                                        if (preg_match($regEx, $id['value'])) {
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
                                <sub class="text-warning">Tenga presente que el {{ $id_types->find($id[$index]['type_id'])->title }} no cumple con el formato. </sub>
                                <script>
                                    document.getElementById('id_value_{{ $index }}').classList += ' is-warning';
                                </script>
                            @endif --}}
                        </div>
                        <div class="col-2 col-md-2 mt-4">
                            @if ($index === count($ids) - 1)
                                @if (count($ids) > 1)
                                    <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                                @endif
                                @if (count($ids) < $id_max)
                                    <div wire:click="addId({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                                @endif
                            @else
                                <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-signature"></i> &nbsp; Nombres :</span>
                </div>
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


                <div class="d-flex justify-content-start my-3 mx-3 mt-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-info"></i> &nbsp; Adicional :</span>
                </div>
                <div class="col-12 form-group">
                    <label for="about">Observaciones</label>
                    <textarea class="@error('about')border border-danger rounded-3 is-invalid @enderror form-control" rows="3"
                        name="about" id="about" wire:model="about"></textarea>
                    @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        </div>


        <div class='col-lg-4 pt-4 m-xxl-auto m-lg-0' style="width: 20rem;">
            {{-- <div class="row">
            <div class="col-sm-5 col-md-5 col-lg-12 col-xl-11 col-xxl-11"> --}}
            <div class='col-lg-4 pt-4 m-xxl-auto m-lg-0' style="width: 20rem;">
                <div class="position-relative">
                    <img id='profile_pics' class="card-img-top" src="{{ $profile_pics ? $profile_pics[0]->temporaryUrl() : 'https://via.placeholder.com/800x800/f2f2f2/161616?text=Perfil' }}" alt="Imagen de Perfil">
                    <div wire:ignore id="profile_pics-loading" class="position-absolute top-0 start-0 h-100 w-100 bg-white d-flex justify-content-center align-items-center opacity-0">
                        <img id='loading' wire:ignore class="w-35 m-auto mt-4 mb-2" src="../assets/img/logos/loading.gif">
                    </div>
                    {{--
                        IMPLEMENTAR UN DROPDOWN !!!
                    <form action="/file-upload" class="form-control dropzone" id="dropzone">
                        <div class="fallback">
                            <input name="file" type="file" multiple />
                        </div>
                    </form>
                    <script src="../../assets/js/plugins/dropzone.min.js"></script> --}}
                    @push('scripts')
                    <script>
                        function coocking_time_profile_img(){
                            document.querySelector('#profile_pics-loading').classList.remove("opacity-0");
                            document.querySelector('#profile_pics-loading').classList.add("opacity-75");
                            var timeoutId = setTimeout(function() {
                                document.querySelector('#profile_pics-loading').classList.remove("opacity-75");
                                document.querySelector('#profile_pics-loading').classList.add("opacity-0");
                            }, 3000)
                            // Observa la imagen para saber cuando fue cargada por completo
                            // var targetImg = document.querySelector('#profile_pics');
                            // var observer = new IntersectionObserver(function(entries, observer) {
                            //     entries.forEach(function(entry) {
                            //         if (entry.isIntersecting) {
                            //         document.querySelector('#profile_pics-loading #loading').hidden = true;
                            //         }
                            //     });
                            // });
                            // observer.observe(targetImg);
                        };
                    </script>
                    @endpush
                </div>
                <div class="card-body p-0">
                    <input class="form-control" id="profile_pics" type="file" name="images[]" wire:model="profile_pics" accept=".jpeg,.jpg,.png,.webp" onchange="coocking_time_profile_img()">
                    <small class="card-text"><strong>NOTA:</strong> Seleccionar la imagen de perfil con un tamaño máximo 5mg y un aspect ratio de 1x1.</small>
                    @error('profile_pics')<br/><sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        </div>






    </div>

</div>


