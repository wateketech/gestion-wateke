<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-phone"></i> &nbsp; Teléfonos :</span>
    </div>

    <div class="row">
        @foreach ($phones as $index => $phone)
        <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
            <input id="phone-star-fav-{{ $index }}" type="radio" name="phone-is_primary" wire:click="selectPhoneIsPrimary({{ $index }})" {{ $phones[$index]['is_primary'] ? 'checked' : '' }} >
            <label for="phone-star-fav-{{ $index }}"></label>
        </div>
        <div class="col-2 form-group pr-0">
            <label for="phone_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("phones.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="phone_types_{{ $index }}" id="phone_types_{{ $index }}" wire:model="phones.{{ $index }}.type_id">
                @foreach ($phone_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("phones.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="phone_value_{{ $index }}" class="form-control-label">Teléfono *</label>
            <div class="input-group intl-tel" wire:ignore>
                <input class="form-control @error("phones.{$index}.value")border border-danger rounded-3 @enderror"
                    type="tel" name="phone_value_{{ $index }}" id="intl-tel-input-{{ $index }}"
                    data-index={{ $index }}>
                <a id="phone_call-test-{{$index}}" class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='tel:'>
                    <i class="fas fa-phone"></i>
                </a>
            </div>
            <sub wire:ignore id='phone_value_warning-{{$index}}' class="text-warning" hidden>El número no cumple con el formato.</sub>
            @error("phones.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($phones) - 1)
                @if (count($phones) > 1)
                    <div wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($phones) < $phones_max)
                    <div wire:click="addPhone({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
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
        <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
            <input id="instant_messages-star-fav-{{ $index }}" type="radio" name="instant_messages-is_primary" wire:click="selectInstantMessageIsPrimary({{ $index }})" {{ $instant_messages[$index]['is_primary'] ? 'checked' : '' }} >
            <label for="instant_messages-star-fav-{{ $index }}"></label>
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
            <select class="@error("instant_messages.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="instant_message_types_{{ $index }}" id="instant_message_types_{{ $index }}" wire:model="instant_messages.{{ $index }}.type_id">
                @foreach ($instant_message_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
            </select>
            @error("instant_messages.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-5 col-md-5 form-group">
            <label for="instant_messages_value_{{ $index }}" class="form-control-label">Usuario *</label>
            <sub class='ml-3 mb-2'style='font-size:11px'>{{ $instant_message_types->find($instant_messages[$index]['type_id'])->about ? 'NOTA : ' : '' }} {{ $instant_message_types->find($instant_messages[$index]['type_id'])->about }}</sub>
            <div class="input-group">
                <input class="@error("instant_messages.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="tel" name="instant_messages_value_{{ $index }}" id="instant_messages_value_{{ $index }}"
                    wire:model.debounce.500ms="instant_messages.{{ $index }}.value">
                @if ($instant_message_types->find($instant_messages[$index]["type_id"])->url)
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank"
                        href='{{ $instant_message_types->find($instant_messages[$index]["type_id"])->url . $instant_messages[$index]["value"] }}'>
                        {!! html_entity_decode($instant_message_types->find($instant_messages[$index]['type_id'])->icon) !!}
                    </a>
                @endif
            </div>
            @error("instant_messages.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($instant_messages) - 1)
                @if (count($instant_messages) > 1)
                    <div wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($instant_messages) < $instant_messages_max)
                    <div wire:click="addInstantMessages({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @endforeach
    </div>
</div>



<script wire:ignore src="../assets/js/plugins/intl-tel-input/js/intlTelInput.js"></script>
<script wire:ignore>
    window.addEventListener('intl-tel-input', function(event){
        var index = event.detail.index;
        var tel = document.getElementById("intl-tel-input-" + index);
        var iti = window.intlTelInput(tel, {
            hiddenInput: "tel-" + index,
            initialCountry: "es",
            separateDialCode: false,
            // excludeCountries: ["af"],
            preferredCountries: ['cu', 'gt', 'cr', 'ad', 'es'],
            utilsScript: "../assets/js/plugins/intl-tel-input/js/utils.js",
        });

        tel.addEventListener('change', function(event) {
            let warningMessage = document.getElementById('phone_value_warning-' + index)
            if (iti.isValidNumber()){
                warningMessage.hidden = true;
            }else{
                warningMessage.hidden = false;
            }

            let cleanNumber = iti.getNumber().replace(/\D/g, '');
            let countryCode = iti.getSelectedCountryData().dialCode;
            cleanNumber = cleanNumber.replace(countryCode, '');

            value_meta = {
                is_valid : iti.isValidNumber(),
                value : tel.value,
                number : iti.getNumber(),
                call_number : ('+' + countryCode + cleanNumber),
                clean_number : cleanNumber,
                country_code : iti.getSelectedCountryData().areaCode,
                country_dial_code : countryCode,
                country_iso2 : iti.getSelectedCountryData().iso2,
                country_name : iti.getSelectedCountryData().name
            }
            value_meta = Object.keys(value_meta).reduce(function(obj, key) {
                obj[key] = (typeof value_meta[key] === "undefined") ? null : value_meta[key];
                return obj;
            }, {});

            document.getElementById('phone_call-test-' + index).href = 'tel:' + value_meta['call_number']

            livewire.emit('updatePhoneNumber', index , tel.value, value_meta );
        });
    });

    window.dispatchEvent(new CustomEvent('intl-tel-input', { detail: { index: 0 } }));
</script>

