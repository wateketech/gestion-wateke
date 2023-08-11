<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-0 h4 text-dark form-title">
        <span class="font-weight-500 opacity-7"><i class="fas fa-calendar-alt"></i> &nbsp; Fechas :</span>
    </div>
    <div class="row mx-3">
        @forelse ($dates as $index => $date)
        <div class="col-3 form-group pr-0">
            <label for="date_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("dates.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="date_types_{{ $index }}" id="date_types_{{ $index }}"
                wire:blur="validate_dates('label', {{ $index }})"
                wire:model="dates.{{ $index }}.type_id">
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
                    wire:blur="validate_dates('value', {{ $index }})"
                    wire:model="dates.{{ $index }}.value"
                    data-date-format="dd/MM/yyyy" {{-- implementar datapicker, flatpickr o moment.js (pluggin js parecido) para que coja este formato --}}
                    min="{{ date('Y-m-d', strtotime('-118 years')) }}"
                    max="{{ date('Y-m-d', strtotime('-1 years')) }}"
                    style='padding-right: 1em !important;padding-left: 63px !important;'>
            </div>
            @error("dates.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>



        <div class="col-3 col-md-3 mt-4">
            @if ($index === count($dates) - 1)
                @if (count($dates) > 1)
                    <div wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($dates) == 1)
                    <div wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    <div wire:click="addDate({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @elseif (count($dates) < $dates_max)
                    <div wire:click="addDate({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeDate({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @empty
        <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
            <div wire:click="addDate({{ -1 }})" class="btn btn-outline-success px-3">Agregar una fecha</i></div>
        </div>
        @endforelse
    </div>

</div>
