<div class="card-header p-0">

    <div class="d-flex px-1 py-2 justify-content-between">
        <div class="d-flex">
            <div>
                <img id='profile_pics' class="avatar avatar-xxl me-3" src="{{ $profile_pics ? $profile_pics[0]->temporaryUrl() : '../assets/img/illustrations/contact-profile-1.png' }}" alt="Imagen de Perfil">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-xl h5">
                    @if (isset($prefix))
                        {!! json_decode($prefixs->find($prefix)->label)->abb !!}.
                    @endif
                    {{$name . ' ' . $middle_name . ' ' . $first_lastname . ' ' . $second_lastname}}
                </h6>
                {{ $alias ? '(' . $alias . ')': '' }}
                <p class="text-md text-secondary pb-2 mb-0">
                    @php
                        $primary_emails = array_column(array_filter($this->emails, function($email) {
                                return $email['is_primary'] == 1;
                            }), 'value');
                    @endphp
                    {{ reset($primary_emails) }}
                </p>
                <hr/>
                @if (isset($ocupation_id) && isset($ocupation_entity_id))
                    <p class="text-lg pt-2 mb-0">ocupation_id &nbsp;|&nbsp; ocupation_entity_id</p>
                @else
                    <p class="text-sm pt-2 mb-0">Este usuario no dispone de datos laborales</p>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-top">
            <a class="btn btn-outline-primary me-2" style="height: fit-content;"
                wire:click="stepSubmit_resumen_review">
                <i class="fas fa-share fa-flip-horizontal"></i> &nbsp;Revisar
            </a>
            <a class="btn btn-primary me-2" style="height: fit-content;"
                wire:click="stepSubmit_resumen_back">
                <i class="fas fa-angle-double-left"></i>
            </a>
        </div>

    </div>


    {{-- <div class="row">
        <div class="col-5 pb-4 pl-11 text-start">
            @forelse ($rrss as $index => $rs)
                <a href="{{ $rrss_types->find($rs['type_id'])->url . $rs['value'] }}" target="_blank" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                    style="background-color: {{ $rrss_types->find($rs['type_id'])->color }}">
                    {!! html_entity_decode($rrss_types->find($rs['type_id'])->icon) !!}
                </a>
            @empty
                Este contacto no tienen redes sociales
            @endforelse
        </div>
        <div class="col-7 pb-4 px-4 text-end">
            @forelse ($dates as $index => $date)
                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: {{ $date_types->find($date['type_id'])->color }}; color:white; cursor:pointer; position:relative;"
                        onmouseover="this.innerHTML='{!! htmlspecialchars($date_types->find($date['type_id'])->icon, ENT_QUOTES) !!}&nbsp;{{ $date_types->find($date['type_id'])->label }}';"
                        onmouseout="this.innerHTML='{!! htmlspecialchars($date_types->find($date['type_id'])->icon, ENT_QUOTES) !!}&nbsp;{{ $date['value'] }}';">
                    {!! html_entity_decode($date_types->find($date['type_id'])->icon) !!}&nbsp;{{ $date['value'] }}
                </a>
            @empty

            @endforelse
        </div>
    </div> --}}



</div>



{{-- <div class="card-footer px-4 pt-1">
    <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="rememberMe" wire:model='is_user_link'>
        <label class="form-check-label fs-6" for="rememberMe"> Convertir en un usuario del sistema</label>
    </div>
    @if ($is_user_link)
        <div class="mt-3 row">
            <div class="col form-group">
                <label for="user_link_role" class="form-control-label">Rol *</label>
                <select class="form-control" name="role" id="user_link_role" wire:model='user_link_role'>
                    @foreach ($user_link_roles as $role)
                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col form-group">
                <label for="user_link_email" class="form-control-label">Usuario</label>
                <input class="@error('user_link_email')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                    name="user_link_email" id="user_link_email" value="{{ $user_link_email }}" disabled>
                @error('user_link_email') <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col form-group">
                <label for="user_link_password_public" class="form-control-label">Contraseña *</label>
                <input class="@error('user_link_password_public')border border-danger rounded-3 is-invalid @enderror form-control"  type="password" aria-label="Password"
                    name="user_link_password_public" id="user_link_password_public" wire:model="user_link_password_public" aria-describedby="password-addon">
                @error('user_link_password_public') <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col form-group">
                <label for="user_link_password_check" class="form-control-label">Confirmar contraseña *</label>
                <input class="@error('user_link_password_check')border border-danger rounded-3 is-invalid @enderror form-control" type="password" aria-label="Password"
                    name="user_link_password_check" id="user_link_password_check" wire:model="user_link_password_check" aria-describedby="password-addon">
                @error('user_link_password_check') <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
        </div>
    @endif
    @error('is_user_link') <sub class="text-danger">{{ $message }}</sub> @enderror
</div>
 --}}
