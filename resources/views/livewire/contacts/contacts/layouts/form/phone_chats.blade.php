<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-phone"></i> &nbsp; Teléfonos :</span>
    </div>

    <div class="row">
        @foreach ($phones as $index => $phone)
        <div class="col-1 form-check pt-4">
            {{-- <input class="form-check-input" type="radio" id="phones.{{$index}}.is_primary" wire:model="phones.{{ $index }}.is_primary"> --}}
        </div>
        <div class="col-2 form-group pr-0">
            <label for="phone_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("phones.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="phone_types_{{ $index }}" id="phone_types_{{ $index }}" wire:model="phones.{{ $index }}.id_type">
                @foreach ($phone_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("phones.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="phone_value_{{ $index }}" class="form-control-label">Teléfono *</label>
            <div class="input-group">
                <input class="@error("phones.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="tel" name="phone_value_{{ $index }}" id="phone_value_{{ $index }}"
                    wire:model.debounce.500ms="phones.{{ $index }}.value">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">{{ $phone_types->find($phones[$index]['id_type'])->value }}.com</span>
                </div> --}}
              </div>
            @error("phones.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- @php
                $phone_value_valid = true;
                if (strlen($phones[$index]['value']) > 0) {
                    $value = $phone_types->find($phones[$index]['id_type'])->value;
                    $regEx = '/^[\w.-]+@' . $value . '\.[a-zA-Z]{2,}$/';
                    if (preg_match($regEx, $phones[$index]['value'])) {
                        $phone_value_valid = true;
                        break;
                    } else {
                        $phone_value_valid = false;
                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                    }
                }
            @endphp
            @if (!$phone_value_valid)
                <sub class="text-warning">Tenga presente que el teléfono no cumple con el formato. </sub>
                <script>
                    document.getElementById('phone_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif --}}
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($phones) - 1)
                @if (count($phones) > 1)
                    <button wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($phones) < $phones_max)
                    <button wire:click="addPhone({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @endforeach
    </div>
</div>

<div class="col-12 mb-3">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-sms"></i> &nbsp; Mensajería Instantanéa :</span>
    </div>
    <div class="row">
        @foreach ($instant_messages as $index => $instant_message)
        <div class="col-1 form-check pt-4">
            {{-- <input class="form-check-input" type="radio" id="instant_messages.{{$index}}.is_primary" wire:model="instant_messages.{{ $index }}.is_primary"> --}}
        </div>

        <div class="col-2 form-group pr-0">
            <label for="instant_messages_label_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("instant_messages.{$index}.label")border border-danger rounded-3 is-invalid @enderror form-control"
                name="instant_messages_label_{{ $index }}" id="instant_messages_label_{{ $index }}" wire:model="instant_messages.{{ $index }}.label">
                    @foreach ($labels_type as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
            </select>
            @error("instant_messages.{$index}.label") <sub class="text-danger">{{ $message }}</sub> @enderror

        </div>
        <div class="col-2 form-group pr-0">
            <label for="instant_message_types_{{ $index }}" class="form-control-label">Proveedor *</label>
            <select class="@error("instant_messages.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="instant_message_types_{{ $index }}" id="instant_message_types_{{ $index }}" wire:model="instant_messages.{{ $index }}.id_type">
                @foreach ($instant_message_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("instant_messages.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-5 col-md-5 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="instant_messages_value_{{ $index }}" class="form-control-label">Mensajería *</label>
            <div class="input-group">
                <input class="@error("instant_messages.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="tel" name="instant_messages_value_{{ $index }}" id="instant_messages_value_{{ $index }}"
                    wire:model.debounce.500ms="instant_messages.{{ $index }}.value">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">{{ $instant_message_types->find($instant_messages[$index]['id_type'])->value }}.com</span>
                </div> --}}
              </div>
            @error("instant_messages.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- @php
                $instant_messages_value_valid = true;
                if (strlen($instant_messages[$index]['value']) > 0) {
                    $value = $instant_messages_types->find($instant_messages[$index]['id_type'])->value;
                    $regEx = '/^[\w.-]+@' . $value . '\.[a-zA-Z]{2,}$/';
                    if (preg_match($regEx, $instant_messages[$index]['value'])) {
                        $instant_messages_value_valid = true;
                        break;
                    } else {
                        $instant_messages_value_valid = false;
                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                    }
                }
            @endphp
            @if (!$instant_messages_value_valid)
                <sub class="text-warning">Tenga presente que el teléfono no cumple con el formato. </sub>
                <script>
                    document.getElementById('instant_messages_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif --}}
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($instant_messages) - 1)
                @if (count($instant_messages) > 1)
                    <button wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($instant_messages) < $instant_messages_max)
                    <button wire:click="addInstantMessages({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @endforeach
    </div>
</div>
