
<div>
    <form wire:submit.prevent="save" id='metric-form'>

        <div class="mx-3">
            <div class="row">
                <div class="col-sm-3 form-group">
                    <label for="name" class="form-control-label">Nombre *</label>
                    <input class="form-control @error('name')border border-danger rounded-3 @enderror"
                        wire:model="name" name="name" id="name" type="text" placeholder="nombre">
                        @error('name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                {{-- <div class="col-3 form-group">
                    <label for="type_value" class="form-control-label">Tipo de Valor *</label>
                    <select class="form-control" name="type_value" id="type_value"
                        wire:model="type_value">
                        @foreach ($type_values as $type=>$value)
                            <option value="{{$type}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div> --}}

                <div class="col-sm-2 form-group">
                    <label for="average" class="form-control-label">Promedio *</label>
                    <input class="form-control @error('average')border border-danger rounded-3 @enderror"
                        wire:model="average" name="average" id="average" type="{{$type_value}}" placeholder="10">
                        @error('average') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

                <div class="col-sm-3 form-group">
                    <label for="type_frec" class="form-control-label">Frecuencia *</label>
                    <select class="form-control" name="type_frec" id="type_frec"
                        wire:model="type_frec">
                        @foreach ($type_frecs as $type=>$value)
                            <option value="{{$type}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-sm-4 form-group">
                    <label for="about" class="form-control-label">Observaciones</label>
                    <input class="form-control @error('about')border border-danger rounded-3 @enderror"
                        wire:model.defer="about" name="about" id="about" type="text" placeholder="notas referentes">
                        @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

            </div>
            <div class="row">
                <div class="col-sm-6 mb-2">
                    <div class="row">

                        <div class="col-6 text-center">
                            <label for="roles-available" class="fw-ligh">{{ count($availableRoles) }} Roles disponibles</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                @foreach ($availableRoles as $role)
                                    <li name='availableRoles' class="fs-6-sm lh-3"><input id="availableRoles.{{ $role['id'] }}" type="checkbox" class="align-middle mr-1" value={{ $role['id'] }}><label class="fw-normal" for="availableRoles.{{ $role['id'] }}">{{ $role['name'] }}</label></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-1 mt-4 text-center">
                            <div wire:click='$emit("transferRoleToActiveEvent")' class="btn p-2"> <i class="fas fa-angle-right"></i></div>
                            <div wire:click='$emit("transferRoleToAvailableEvent")' class="btn p-2"> <i class="fas fa-angle-left"></i></div>
                            <br>
                            <div wire:click='transferAllRolesToActive' class="btn p-2"><i class="fas fa-angle-double-right"></i></div>
                            <div wire:click='transferAllRolesToAvailable' class="btn p-2"><i class="fas fa-angle-double-left"></i></div>
                        </div>
                        <div class="col-5 text-center">
                            <label for="roles-active" class="fw-ligh">{{ count($activeRoles) }} Roles activos</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                @foreach ($activeRoles as $role)
                                    <li name='activeRoles' class="fs-10 lh-3"><input id="activeRoles.{{ $role['id'] }}" type="checkbox" class="align-middle mr-1" value={{ $role['id'] }}><label class="fw-normal" for="activeRoles.{{ $role['id'] }}">{{ $role['name'] }}</label></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="row">

                        <div class="col-6 text-center">
                            <label for="users-available" class="fw-ligh">{{ count($availableUsers) }} Usuario disponibles</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                @foreach ($availableUsers as $user)
                                    <li name="availableUsers" class="fs-10 lh-3"><input id="availableUsers.{{ $user['id'] }}" type="checkbox" class="align-middle mr-1" value={{ $user['id'] }}><label class="fw-normal" for="availableUsers.{{ $user['id'] }}">{{ $user['name'] }}</label></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-1 mt-4 text-center">
                            <div wire:click="$emit('transferUserToActiveEvent')" class="btn p-2"> <i class="fas fa-angle-right"></i></div>
                            <div wire:click="$emit('transferUserToAvailableEvent')" class="btn p-2"> <i class="fas fa-angle-left"></i></div>
                            <br>
                            <div wire:click='transferAllUsersToActive' class="btn p-2"><i class="fas fa-angle-double-right"></i></div>
                            <div wire:click='transferAllUsersToAvailable' class="btn p-2"><i class="fas fa-angle-double-left"></i></div>
                        </div>
                        <div class="col-5 text-center">
                            <label for="users-active" class="fw-ligh">{{ count($activeUsers) }} Usuario activos</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                @foreach ($activeUsers as $user)
                                    <li name="activeUsers" class="fs-10 lh-3"><input id="activeUsers.{{ $user['id'] }}" type="checkbox" class="align-middle mr-1" value={{ $user['id'] }}><label class="fw-normal" for="activeUsers.{{ $user['id'] }}">{{ $user['name'] }}</label></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>
