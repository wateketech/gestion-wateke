
<div>
    <form wire:submit.prevent="save" id='metric-form'>

        <div class="m-3">
            <div class="row">
                <div class="col-3 form-group">
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

                <div class="col-3 form-group">
                    <label for="average" class="form-control-label">Promedio *</label>
                    <input class="form-control @error('average')border border-danger rounded-3 @enderror"
                        wire:model="average" name="average" id="average" type="{{$type_value}}">
                        @error('average') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

                <div class="col-3 form-group">
                    <label for="type_frec" class="form-control-label">Frecuencia *</label>
                    <select class="form-control" name="type_frec" id="type_frec"
                        wire:model="type_frec">
                        @foreach ($type_frecs as $type=>$value)
                            <option value="{{$type}}">{{$value}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-3 form-group">
                    <label for="about" class="form-control-label">Observaciones</label>
                    <input class="form-control @error('about')border border-danger rounded-3 @enderror"
                        wire:model.defer="about" name="about" id="about" type="text" placeholder="notas referentes">
                        @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>

            </div>
        </div>
        <div class="m-3">
            <div class="row">

                {{-- <div class="col-4 form-group">
                    <label for="about" class="form-control-label">Observaciones *</label>
                    <input class="form-control @error('about')border border-danger rounded-3 @enderror"
                        wire:model="about" name="about" id="about" type="text" placeholder="notas referentes">
                        @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div> --}}

            </div>
        </div>


    </form>
</div>

