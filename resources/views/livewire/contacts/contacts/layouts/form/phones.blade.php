<div class="col-12 mb-3 mt-5">
    <div class="row">


        @forelse ($phones as $index => $phone)
            <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
                <input id="phone-star-fav-{{ $index }}" type="radio" name="phone-is_primary" wire:click="selectPhoneIsPrimary({{ $index }})" {{ $phones[$index]['is_primary'] ? 'checked' : '' }} >
                <label for="phone-star-fav-{{ $index }}"></label>
            </div>
            <div class="col-2 form-group pr-0">
                <label for="phone_types_{{ $index }}" class="form-control-label">Tipo *</label>
                <select class="@error("phones.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="phone_types_{{ $index }}" id="phone_types_{{ $index }}"
                    wire:blur="validate_phones('type_id', {{ $index }})"
                    wire:model="phones.{{ $index }}.type_id">
                    @foreach ($phone_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                </select>
                @error("phones.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col col-md form-group">
                <label for="phone_value_{{ $index }}" class="form-control-label">Teléfono *</label>
                <div class="input-group intl-tel" id="input-group-intl-tel" wire:ignore>
                    <input class="form-control @error("phones.{$index}.value")border border-danger rounded-3 @enderror"
                        type="tel" name="phone_value_{{ $index }}" id="intl-tel-input-{{ $index }}"
                        data-index={{ $index }}>
                    <a id="phone_call-test-{{$index}}" class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='tel:'>
                        <i class="fas fa-phone"></i>
                    </a>
                </div>
                <p><sub class="text-warning">{!! $this->uniqueWarningBD('contact_phones', 'value', $phone['value'], 'El telefono puede ya estar siendo utilizado por otro contacto' ) !!}</sub></p>
                <p><sub wire:ignore id='phone_value_warning-{{$index}}' class="text-warning" hidden>El número no cumple con el formato.</sub></p>
                @error("phones.{$index}.value")<sub class="text-danger d-block pt-2">{{ $message }}</sub> @enderror
            </div>

            @if ($phone_types->find($phone['type_id'])->label === 'Extensión')
                <div class="col-2 form-group pl-0">
                    <label for="phone_ext_{{ $index }}" class="form-control-label">Ext *</label>
                    <input class="form-control @error("phones.{$index}.extension")border border-danger rounded-3 @enderror"
                        wire:blur="validate_phones('extension', {{ $index }})"
                        wire:model="phones.{{ $index }}.extension">
                    @error("phones.{$index}.extension") <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            @endif


            <div class="col-2 col-md-2 mt-4">
                @if ($index === count($phones) - 1)
                    @if (count($phones) > 1)
                        <div wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    @endif
                    @if (count($phones) == 1)
                        <div wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                        <div wire:click="addPhone({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                    @elseif (count($phones) < $phones_max)
                        <div wire:click="addPhone({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                    @endif
                @else
                    <div wire:click="removePhone({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
            </div>

            <div class="clearfix"></div>
        @empty
            <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
                <div wire:click="addPhone({{ -1 }})" class="btn btn-outline-success px-3">Agregar un Télefono</i></div>
            </div>

        @endforelse
    </div>
</div>



<script wire:ignore src="../assets/js/plugins/intl-tel-input/js/intlTelInput.js"></script>
<script wire:ignore>

    window.addEventListener('intl-tel-input', function(event){
        var index = event.detail.index;
        var tel = document.getElementById("intl-tel-input-" + index);
        var iti = window.intlTelInput(tel, {
            hiddenInput: "tel-" + index,
            formatOnDisplay: true,
            initialCountry: "es",
            separateDialCode: false,
            // excludeCountries: ["af"],
            preferredCountries: ['cu', 'gt', 'cr', 'ad', 'es'],
            utilsScript: "../assets/js/plugins/intl-tel-input/js/utils.js",
        });


        if (event.detail.phone){
            let real_phone = event.detail.phone;
            let real_meta_phone = JSON.parse(real_phone.value_meta);


            let flag_div =  tel.parentNode.children[0].children[0];
            let flag_icon = tel.parentNode.children[0].children[0].children[0];
            let input = tel;
            let hidden = tel.parentNode.children[2];
            let a = tel.parentNode.parentNode.children[1];


            flag_div.title = real_meta_phone.country_name + ': +' + real_meta_phone.country_dial_code;
            //flag_icon.className = 'iti__flag iti__' + real_meta_phone.country_iso2;
            iti.setCountry(real_meta_phone.country_iso2)
            input.value = real_phone.value;
            a.href = real_meta_phone.call_number;
        }

        tel.addEventListener('blur', function(event) {
            // Establece el value formateado
            var formattedPhoneNumber = iti.getNumber(intlTelInputUtils.numberFormat.NATIONAL);
            tel.value = formattedPhoneNumber;


            // almacena en el componente las propiedades del telefono (value_meta)
            let warningMessage = document.getElementById('phone_value_warning-' + index)
            if (tel.value != null && tel.value != '' && tel.value != undefined){
                if (iti.isValidNumber()) warningMessage.hidden = true;
                else warningMessage.hidden = false;
            }
            else warningMessage.hidden = true;

            let cleanNumber = iti.getNumber().replace(/\D/g, '');
            let countryCode = iti.getSelectedCountryData().dialCode;
            cleanNumber = cleanNumber.replace(countryCode, '');

            value_meta = {
                is_valid : iti.isValidNumber(),
                value : tel.value,
                number : iti.getNumber(),
                call_number : ('+' + countryCode + cleanNumber),
                clean_number : cleanNumber,
                formatted_number : formattedPhoneNumber,
                country_code : iti.getSelectedCountryData().areaCode,
                country_dial_code : countryCode,
                country_iso2 : iti.getSelectedCountryData().iso2,
                country_name : iti.getSelectedCountryData().name
                // flag_title = 'country_name' + ': +' + 'country_dial_code';
                // flag_icon = 'iti__flag iti__' + 'country_iso2';
            }

            value_meta = Object.keys(value_meta).reduce(function(obj, key) {
                obj[key] = (typeof value_meta[key] === "undefined") ? null : value_meta[key];
                return obj;
            }, {});

            document.getElementById('phone_call-test-' + index).href = 'tel:' + value_meta['call_number']

            livewire.emit('updatePhoneNumber', index , tel.value, value_meta );
        });
    });

    window.addEventListener('intl-tel-input-remove-phone', function(event){
        let phonesvalues = document.querySelectorAll('#input-group-intl-tel');
        let index = 0;
        phonesvalues.forEach(phone => {
            let real_phone = event.detail.phones[index];
            let real_meta_phone = JSON.parse(real_phone.value_meta);

            let flag_div = phone.children[0].children[0].children[0];
            let flag_icon = phone.children[0].children[0].children[0].children[0];
            let input = phone.children[0].children[1];
            let hidden = phone.children[0].children[2];
            let a = phone.children[1];

            flag_div.title = real_meta_phone.country_name + ': +' + real_meta_phone.country_dial_code;
            flag_icon.className = 'iti__flag iti__' + real_meta_phone.country_iso2;
            input.value = real_phone.value;
            a.href = real_meta_phone.call_number;

            index++;
        });
    });

</script>


@if ($edit_mode)
    @foreach ($phones as $index => $current_phone)
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('intl-tel-input', { detail:
                {
                    index : {{ $index }},
                    phone: {!! json_encode($current_phone) !!},
                }
            }));
        </script>
    @endforeach
@else
<script wire:ignore>
    window.dispatchEvent(new CustomEvent('intl-tel-input', { detail: { index: 0 } }));
</script>
@endif
