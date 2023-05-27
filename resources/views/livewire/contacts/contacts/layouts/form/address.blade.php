<div class="col-12 mb-4">



    @foreach ($contact_address as $index => $add)
        <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
            <span class="font-weight-bolder opacity-7"><i class="fas fa-map-marker-alt"></i> &nbsp; Dirección :</span>
        </div>
        <div class="row">
            <div class="col-2 form-group pr-0">
                <label for="phone_types_" class="form-control-label">Pais *</label>
                <select class="@error("phones.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="phone_types_" id="phone_types_" wire:model="phones.id_type">
                    @foreach ($phone_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                {{-- @error("phones.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror --}}
            </div>
            <div class="col-3 form-group pr-0">
                <label for="phone_types_" class="form-control-label">Provincia *</label>
                <select class="@error("phones.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="phone_types_" id="phone_types_" wire:model="phones.id_type">
                    @foreach ($phone_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                {{-- @error("phones.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror --}}
            </div>
            <div class="col-3 form-group pr-0">
                <label for="phone_types_" class="form-control-label">Municipio *</label>
                <select class="@error("phones.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="phone_types_ id="phone_types_ wire:model="phones.id_type">
                    @foreach ($phone_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                {{-- @error("phones.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror --}}
            </div>
            <div class="col-2 form-group pr-0">
                <label for="phone_types" class="form-control-label">Localidad</label>
                <select class="@error("phones.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="phone_types" id="phone_types" wire:model="phone.id_type">
                    @foreach ($phone_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                {{-- @error("phones.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror --}}
            </div>
            <div class="col-2 form-group pr-0">
                <label for="phone_types" class="form-control-label">Cod. Postal *</label>
                <input class="@error("phones.value")border border-danger rounded-3 @enderror form-control"
                        type="text" name="phone_value" id="phone_value"
                        >
                {{-- @error("phones.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror --}}
            </div>

            @foreach ($address_line as $index => $line)
                <div class="col-2 form-check pt-4 h5 d-flex justify-content-end">
                    <p>Linea {{ $index + 1 }} :</p>
                </div>
                <div class="col-3 col-md-3 form-group pt-3">{{--  style="padding-right: 9.2em"> --}}
                    <input class="@error("phones.{$index}.value")border border-danger rounded-3 @enderror form-control"
                        type="tel" name="phone_value_{{ $index }}" id="phone_value_{{ $index }}"
                        wire:model.debounce.500ms="phones.{{ $index }}.value">

                    @error("address_line.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-5 col-md-5 form-group pt-3">{{--  style="padding-right: 9.2em"> --}}
                    <input class="@error("phones.{$index}.value")border border-danger rounded-3 @enderror form-control"
                        type="tel" name="phone_value_{{ $index }}" id="phone_value_{{ $index }}"
                        wire:model.debounce.500ms="phones.{{ $index }}.value">

                    @error("address_line.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>


                <div class="col-2 col-md-2 mt-4">
                    @if ($index === count($address_line) - 1)
                        @if (count($address_line) > 1)
                            <button wire:click="removeAddressLine({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                        @endif
                        @if (count($address_line) < $address_line_max)
                            <button wire:click="addAddressLine({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                        @endif
                    @else
                        <button wire:click="removeAddressLine({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                    @endif
                </div>
            @endforeach

        </div>
    @endforeach

</div>
