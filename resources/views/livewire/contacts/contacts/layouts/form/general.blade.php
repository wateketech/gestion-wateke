<div class="container-fluid mt-5 mt-lg-4">
    <div class="row">
        <div class='col-lg-8 col-md-12 pb-5'>
            <div class="row">



                <div class="col-3 form-group">
                    <label for="prefix" class="form-control-label">Titulo</label>
                    <select class="@error("prefix")border border-danger rounded-3 is-invalid @enderror form-control"
                        name="prefix" id="prefix" wire:model="prefix">
                        <option value="">Ninguno</option>
                        @foreach ($prefixs as $prefix)
                            <option value="{{ $prefix->id }}">
                                {!! json_decode($prefix->label)->abb !!}.
                                &nbsp;&nbsp;
                                ({!! json_decode($prefix->label)->exp !!})
                            </option>
                        @endforeach
                    </select>
                    @error('prefix') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>


                <div class="clearfix"></div>

                <div class="col-6 form-group">
                    <label for="name" class="form-control-label">Primer Nombre *</label>
                    <input class="@error('name')border border-danger rounded-3 is-invalid @enderror form-control" name="name" id="name"
                        wire:blur="validate_general('name')"
                        wire:model="name" type="text">
                    @error('name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-6 form-group">
                    <label for="middle_name" class="form-control-label">Segundo Nombre</label>
                    <input class="@error('middle_name')border border-danger rounded-3 is-invalid @enderror form-control" name="middle_name" id="middle_name"
                        wire:blur="validate_general('middle_name')"
                        wire:model="middle_name" type="text">
                    @error('middle_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>


                <div class="col-6 form-group">
                    <label for="first_lastname" class="form-control-label">Primer Apellido *</label>
                    <input class="@error('first_lastname')border border-danger rounded-3 is-invalid @enderror form-control" name="first_lastname" id="first_lastname"
                        wire:blur="validate_general('first_lastname')"
                        wire:model="first_lastname" type="text">
                    @error('first_lastname') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-6 form-group">
                    <label for="second_lastname" class="form-control-label">Segundo Apellido</label>
                    <input class="@error('second_lastname')border border-danger rounded-3 is-invalid @enderror form-control" name="second_lastname" id="second_lastname"
                        wire:blur="validate_general('second_lastname')"
                        wire:model="second_lastname" type="text">
                    @error('second_lastname') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>


                <div class="clearfix"></div>


                <div class="col-3 form-group">
                    <label for="gender" class="form-control-label mb-2">Sexo</label>
                    <div class="form-check m-0 mb-2 px-1">
                        @foreach ($genders as $gender)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="gender_{{ $gender->id }}" value="{{ $gender->id }}" wire:model="gender"
                                    style="transform: scale(0.8);">
                                <label class="form-check-label" for="gender_{{ $gender->id }}" title="{{$gender->label }}"style="transform: scale(1.6);">{!! html_entity_decode($gender->icon) !!}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>



        <div class='col-lg-4 m-xxl-auto m-lg-0' style="width: 20rem;">
            <div class='col-lg-4 m-xxl-auto m-lg-0' style="width: 20rem;">
                <div class="position-relative">
                    <img id='profile_pics' class="card-img-top" src="{{ $profile_pics ? $profile_pics[0]->temporaryUrl() : '../assets/img/illustrations/contact-profile-1.png' }}" alt="Imagen de Perfil">
                    <div wire:ignore id="profile_pics-loading" class="position-absolute top-0 start-0 h-100 w-100 bg-white d-flex justify-content-center align-items-center opacity-0">
                        <img id='loading' wire:ignore class="w-35 m-auto mt-4 mb-2" src="../assets/img/logos/loading.gif">
                    </div>
                    @push('scripts')
                    <script>
                        function coocking_time_profile_img(){
                            document.querySelector('#profile_pics-loading').classList.remove("opacity-0");
                            document.querySelector('#profile_pics-loading').classList.add("opacity-75");
                            var timeoutId = setTimeout(function() {
                                document.querySelector('#profile_pics-loading').classList.remove("opacity-75");
                                document.querySelector('#profile_pics-loading').classList.add("opacity-0");
                            }, 3000)
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


