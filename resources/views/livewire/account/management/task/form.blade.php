
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
                            <label for="roles-avaible" class="fw-ligh">Roles disponibles</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                <li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li>
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                                                                                                                                                                
                            </ul>
                        </div>
                        <div class="col-1 mt-5 text-center">
                            <div> <i class="fas fa-angle-left"></i></div>
                            <div> <i class="fas fa-angle-right"></i></div>
                            <br>
                            <div><i class="fas fa-angle-double-left"></i></div>
                            <div><i class="fas fa-angle-double-right"></i></div>
                        </div>
                        <div class="col-5 text-center">
                            <label for="roles-active" class="fw-ligh">Roles activos</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                <li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li><li> <input type="checkbox" class="mr-2"> Alberto</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 mb-2">
                    <div class="row">

                        <div class="col-6 text-center">
                            <label for="users-avaible" class="fw-ligh">Usuario disponibles</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">

                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>                                                                                                                                 
                            </ul>
                        </div>
                        <div class="col-1 mt-5 text-center">
                            <div> <i class="fas fa-angle-left"></i></div>
                            <div> <i class="fas fa-angle-right"></i></div>
                            <br>
                            <div><i class="fas fa-angle-double-left"></i></div>
                            <div><i class="fas fa-angle-double-right"></i></div>
                        </div>
                        <div class="col-5 text-center">
                            <label for="users-active" class="fw-ligh">Usuario activos</label>
                            <ul class="form-control text-start overflow-auto" style="height: 200px;">
                                <li> <input type="checkbox" class="mr-2"> Alberto</li> 
                                <li> <input type="checkbox" class="mr-2"> Alberto</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </form>
</div>

