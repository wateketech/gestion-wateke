
<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-calendar-alt"></i> &nbsp; Fechas :</span>
    </div>
    <div class="row mx-3">
        @forelse ($dates as $index => $date)
        <div class="col-2 form-group pr-0">
            <label for="date_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("dates.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="date_types_{{ $index }}" id="date_types_{{ $index }}" wire:model="dates.{{ $index }}.id_type">
                @foreach ($date_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("dates.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="dates_value_{{ $index }}" class="form-control-label">Enlace *</label>
            <input class="@error("dates.{$index}.value")border border-danger rounded-3 @enderror form-control"
                type="date" name="dates_value_{{ $index }}" id="dates_value_{{ $index }}"
                wire:model.debounce.500ms="dates.{{ $index }}.value">
            @error("dates.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($dates) - 1)
                @if (count($dates) > 1)
                    <button wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($dates) == 1)
                    <button wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                    <button wire:click="addDate({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @elseif (count($dates) < $dates_max)
                    <button wire:click="addDate({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @empty
        <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
            <button wire:click="addDate({{ -1 }})" class="btn btn-outline-success px-3">Agregar una fecha</i></button>
        </div>
        @endforelse
    </div>

</div>


<div class="col-12 mb-3">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-share"></i> &nbsp; Nos Publica :</span>
    </div>
    <div class="row mx-3">
        @forelse ($publish_us as $index => $date)
        <div class="col-2 form-group pr-0">
            <label for="publish_us_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("publish_us.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="publish_us_types_{{ $index }}" id="publish_us_types_{{ $index }}" wire:model="publish_us.{{ $index }}.id_type">
                @foreach ($publish_us_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("publish_us.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="publish_us_value_{{ $index }}" class="form-control-label">Enlace *</label>
            <input class="@error("publish_us.{$index}.value")border border-danger rounded-3 @enderror form-control"
                type="text" name="publish_us_value_{{ $index }}" id="publish_us_value_{{ $index }}"
                wire:model.debounce.500ms="publish_us.{{ $index }}.value">
            @error("publish_us.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($publish_us) - 1)
                @if (count($publish_us) > 1)
                    <button wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($publish_us) == 1)
                    <button wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                    <button wire:click="addPublishUs({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @elseif (count($publish_us) < $publish_us_max)
                    <button wire:click="addPublishUs({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @empty
        <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
            <button wire:click="addPublishUs({{ -1 }})" class="btn btn-outline-success px-3">¿ Este contacto Nos Publica ?</i></button>
        </div>
        @endforelse
    </div>

</div>

