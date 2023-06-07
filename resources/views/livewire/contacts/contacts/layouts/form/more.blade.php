
<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-calendar-alt"></i> &nbsp; Fechas :</span>
    </div>
    <div class="row mx-3">
        @forelse ($dates as $index => $date)
        <div class="col-3 form-group pr-0">
            <label for="date_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("dates.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="date_types_{{ $index }}" id="date_types_{{ $index }}" wire:model="dates.{{ $index }}.type_id">
                @foreach ($date_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("dates.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="dates_value_{{ $index }}" class="form-control-label">Fecha *</label>
            <div class="input-group" >
                <span class="input-group-text" id="basic-addon1" style='padding-left: 1em !important;'>
                    {!! html_entity_decode($date_types->find($dates[$index]['type_id'])->icon) !!}
                </span>
                <input class="@error("dates.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="date" name="dates_value_{{ $index }}" id="dates_value_{{ $index }}"
                    wire:model.debounce.500ms="dates.{{ $index }}.value"
                    data-date-format="dd/MM/yyyy" {{-- implementar datapicker, flatpickr o moment.js (pluggin js parecido) para que coja este formato --}}
                    min="{{ date('Y-m-d', strtotime('-118 years')) }}"
                    max="{{ date('Y-m-d', strtotime('-1 years')) }}"
                    style='padding-right: 1em !important;padding-left: 63px !important;'>
            </div>
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
        <div class="col-3 form-group pr-0">
            <label for="publish_us_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("publish_us.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="publish_us_types_{{ $index }}" id="publish_us_types_{{ $index }}" wire:model="publish_us.{{ $index }}.type_id">
                @foreach ($publish_us_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("publish_us.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="publish_us_value_{{ $index }}" class="form-control-label">Enlace *</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1" style='padding-right: 0px !important;'>https://</span>
                <input class="@error("publish_us.{$index}.value")border border-danger rounded-3 @enderror form-control text-lower"
                    type="text" name="publish_us_value_{{ $index }}" id="publish_us_value_{{ $index }}"
                    wire:model.debounce.500ms="publish_us.{{ $index }}.value"
                    style='padding-left: 63px !important;'
                    wire:blur="updatePublishUsValue({{ $index }}, $event.target.value);">
                <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='//{{ $publish_us[$index]["value"] }}'>
                    <i class="fas fa-location-arrow"></i>
                </a>
            </div>

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

