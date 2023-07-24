<div class="col-12  mb-5 mt-n6">

    @forelse ($address as $index_add => $add)
        <div class="d-flex justify-content-start my-3 mx-0 h4 text-dark form-title">
            <span class="font-weight-500 opacity-7 @error("address.{$index_add}.name") text-danger  @enderror"><i class="fas fa-map-marker-alt"></i> &nbsp; Dirección&nbsp;&nbsp;
                <input type="text" class="font-weight-500 opacity-8 border-0 w-25 d-inline-block" style="border-bottom: 1.2px grey solid !important; @error("address.{$index_add}.name") border-bottom: 2px red dashed !important @enderror"
                wire:blur="validate_address('name', {{ $index_add }})"
                wire:model="address.{{ $index_add }}.name">:
            </span>

            @if (count($address) > 0)
                <div wire:click="removeAddress({{ $index_add }})" class="btn btn-outline-danger px-3 py-2 mr-6">Quitar direccion</div>
            @endif
        </div>

        <div class="row mt-4 mb-7">
            <div class="col-1 form-group pr-0 d-flex justify-content-center mt-4">
                <div disabled class="px-3 btn btn-outline-secondary form-control-input" name="geolocation_{{ $index_add }}"
                    wire:click="geolocation({{ $index_add }})">
                    <i class="fas fa-globe-africa fa-lg"></i>
                </div>
            </div>
            <div class="col-3 form-group pr-0 pb-0">
                <label for="countries_{{ $index_add }}" class="form-control-label">Pais *</label>
                <div wire:ignore>
                    <select class="Select--2 form-control" name="countries_{{ $index_add }}" id="countries_{{ $index_add }}"
                    onchange="livewire.emit('updateCountry', {{ $index_add }},this.value);">
                        <option></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                data-flag={{ $country->emoji }}
                                {{ $country->id == $add['country_id'] ? 'selected' : '' }}
                                >
                                {{ property_exists(json_decode($country->translations), 'es') ? json_decode($country->translations)->es :  $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error("address.{$index_add}.country_id") <sub class="{{ $message == 'El campo es requerido si está disponible' ? 'text-warning' : 'text-danger' }}">{{ $message }}</sub> @enderror
            </div>
            <div class="col-3 form-group pr-0">
                <div wire:ignore>
                    <label for="states_{{ $index_add }}" class="form-control-label">Provincia / Estado *</label>
                    <select class="Select--2 form-control" name="states_{{ $index_add }}" id="states_{{ $index_add }}"
                    onchange="livewire.emit('updateState', {{ $index_add }},this.value);" disabled>
                        <option></option>
                    </select>
                </div>
                @error("address.{$index_add}.state_id") <sub class="{{ $message == 'El campo es requerido si está disponible' ? 'text-warning' : 'text-danger' }}">{{ $message }}</sub> @enderror

            </div>
            <div class="col-3 form-group pr-0">
                <div wire:ignore>
                    <label for="cities_{{ $index_add }}" class="form-control-label">Municipio / Ciudad *</label>
                    <select class="Select--2 form-control @error("address.{{ $index_add }}.citie_id")border border-danger rounded-3 is-invalid @enderror"
                        name="cities_{{ $index_add }}" id="cities_{{ $index_add }}"
                        onchange="livewire.emit('updateCity', {{ $index_add }},this.value);" disabled>
                        <option></option>
                    </select>
                </div>
                @error("address.{$index_add}.city_id") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>

            <div class="col-2 form-group pr-0">
                <label for="zip_code_{{ $index_add }}" class="form-control-label">Cod. Postal</label>
                <input class="@error("address.{{ $index_add }}.zip_code")border border-danger rounded-3 @enderror form-control"
                        type="text" id="zip_code_{{ $index_add }}" id="zip_code_{{ $index_add }}"
                        wire:blur="validate_address('zip_code', {{ $index_add }})"
                        wire:model="address.{{ $index_add }}.zip_code">
                @error("address.{{ $index_add }}.zip_code") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>

            @if (count($address_line[$index_add]) != 0)
                <div class="row">
                    <div class="col-2 form-check pt-2 h5 d-flex justify-content-end"></div>

                    <div class="col-2 col-md-2 form-group text-start p-0 my-0">
                        <label class="form-control-label pl-6 opacity-7">Etiqueta </label>
                    </div>
                    <div class="col-6 col-md-6 form-group text-start p-0 my-0">
                        <label class="form-control-label pl-6 opacity-7">Valores </label>
                    </div>

                </div>
            @endif
            <div class="row pb-3">
                @foreach ($address_line[$index_add] as $index_l => $line)
                    <div class="col-2 form-check pt-2 h5 d-flex justify-content-end">
                        <p class="font-weight-bolder opacity-8">Línea {{ $index_l + 1 }} :</p>
                    </div>
                    <div class="col-2 col-md-2 form-group py-0 pb-3 my-0">{{--  style="padding-right: 9.2em"> --}}
                        <input class="@error("address_line.{$index_add}.{$index_l}.label")border border-danger rounded-3 @enderror form-control mb-0"
                            type="text" name="address_line_{{ $index_add }}_label_{{ $index_l }}" id="address_line_{{ $index_add }}_label_{{ $index_l }}"
                            wire:blur="validate_address_lines('label', {{ $index_add }}, {{ $index_l }})"
                            wire:model="address_line.{{ $index_add }}.{{ $index_l  }}.label">

                        @error("address_line.{$index_add}.{$index_l}.label") <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                    <div class="col-6 col-md-6 form-group py-0 pb-3 my-0">{{--  style="padding-right: 9.2em"> --}}
                        <input class="@error("address_line.{$index_add}.{$index_l}.value")border border-danger rounded-3 @enderror form-control mb-0"
                            type="text" name="address_line_{{ $index_add }}_value_{{ $index_l }}" id="address_line_{{ $index_add }}_value_{{ $index_l }}"
                            wire:blur="validate_address_lines('value', {{ $index_add }}, {{ $index_l }})"
                            wire:model="address_line.{{ $index_add }}.{{ $index_l  }}.value">

                        @error("address_line.{$index_add}.{$index_l}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>

                    <div class="col-2 col-md-2">
                        @if ($index_l === count($address_line[$index_add]) - 1)
                            @if (count($address_line[$index_add]) > 1)
                                <div wire:click="removeAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                            @endif
                            @if (count($address_line[$index_add]) < $address_line_max)
                                <div wire:click="addAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                            @endif
                        @else
                            <div wire:click="removeAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                        @endif
                    </div>
                @endforeach
            </div>



            <div class="col-3 col-md-3">
                @if ($index_add === count($address) - 1)
                    @if (count($address) < $address_max)
                        <div wire:click="addAddress({{ $index_add }})" class="btn btn-outline-success px-3 mt-3">Agregar otra Dirección</div>
                    @endif
                @endif
            </div>
        </div>

    @empty

        <div class="h4 text-dark form-title mr-1 py-3 {{ $steps_view ? 'mb-5 pb-4' : 'mb-0 pb-0' }}">
            <span class="font-weight-500 opacity-7"><i class="fas fa-map-marker-alt"></i> &nbsp; Direcciones</span>
        </div>
            <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
                <div wire:click="addAddress({{ -1 }})" class="btn btn-outline-success px-3">Agregar una Dirección</i></div>
            </div>
    @endforelse


        {{-- @if (count($address_line[$index_add]) != 0)
            <div class="mb-n5 h6 d-flex justify-content-end cursor-pointer"
                onclick="window.dispatchEvent(new CustomEvent('help-address-lines'))">
                <p class="text-primary px-3 py-1"><u>¿ Qué son las lineas de direción ? **</u></p>
            </div>
        @endif --}}


</div>
@push('scripts')
<script>
    window.addEventListener('init-select2-countries', function(event){
        var address = $('#countries_' + event.detail.index_add +'.Select--2')

        if (address.is_select == false || address.is_select == undefined || address.is_select == null || address.is_select == NaN){
            address.select2({
                placeholder: 'Seleccione un país',
                templateResult: function (data) {
                        if (!data.id) {
                        return data.text;
                        }
                        var $result = $('<span class="emoji-flag">'+ data.element.dataset.flag + data.text + '</span>');
                        return $result;
                    },
                templateSelection: function (data) {
                    if (!data.id) {
                    return data.text;
                    }
                    var $selection = $('<span class="emoji-flag">'+ data.element.dataset.flag + data.text + '</span>');
                    return $selection;
                }
            });
            address.is_select = true;
        }
    });

    window.addEventListener('init-select2-states-disabled', function(event){
        $selectCity = $('#cities_' + event.detail.index_add +'.Select--2');
        $selectCity.empty();
        if ($selectCity.length && $selectCity.data('select2')) $selectCity.select2('destroy');
        $selectCity.attr('disabled', true);

        var $select = $('#states_' + event.detail.index_add +'.Select--2');
        $select.empty();
        $select.select2({
            placeholder: 'No disponible',
        });
        $select.attr('disabled', true);
        window.dispatchEvent(new CustomEvent('init-select2-cities-disabled', { detail: { index_add: event.detail.index_add } }));

    });
    window.addEventListener('init-select2-states', function(event){
        let current_state = event.detail.current_state

        $selectCity = $('#cities_' + event.detail.index_add +'.Select--2');
        $selectCity.empty();
        if ($selectCity.length && $selectCity.data('select2')) $selectCity.select2('destroy');
        $selectCity.attr('disabled', true);

        var $select = $('#states_' + event.detail.index_add +'.Select--2');

        $select.empty();
        $select.prop('disabled', false);
        $select.append($('<option>', { value: '', text: '' }));
        $.each(event.detail.states, function (i, state) {
            let $option = $('<option>', { value: state.id, text: state.text });
            if (state.id === current_state) {
                $option.prop('selected', true);
            }
            $select.append($option);
        });

        $select.select2({
                placeholder: 'Seleccione',
            });
    });

    window.addEventListener('init-select2-cities-disabled', function(event){
        var $select = $('#cities_' + event.detail.index_add +'.Select--2');
        $select.empty();
        $select.select2({
            placeholder: 'No disponible',
        });
        $select.attr('disabled', true);
    });
    window.addEventListener('init-select2-cities', function(event){
        let current_city = event.detail.current_city

        var $select = $('#cities_' + event.detail.index_add +'.Select--2');
        $select.empty();
        $select.prop('disabled', false);
        $select.append($('<option>', { value: '', text: '' }));
        $.each(event.detail.cities, function (i, city) {
            let $option = $('<option>', { value: city.id, text: city.text });
            if (city.id === current_city) {
                $option.prop('selected', true);
            }
            $select.append($option);
        });
        $select.select2({
                placeholder: 'Seleccione',
            });
    });


</script>



@if ($edit_mode)
    @foreach ($address as $index => $add)
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('init-select2-countries', { detail:{
                    index_add: {{ $index }}
                }
            }));
        </script>
        {{-- FILL STATES --}}
        @php $states = $this->getStates($add['country_id']); @endphp
        @if (count($states) != 0)
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('init-select2-states', { detail:{
                    index_add: {{ $index }},
                    states : {!! json_encode($states) !!},
                    current_state : {!! $add['state_id'] != null ? $add['state_id'] : -1 !!}
                }
            }));
        </script>
        @else
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('init-select2-states-disabled', { detail:{
                    index_add: {{ $index }},
                }
            }));
        </script>
        @endif

        {{-- FILL CITIES --}}
        @php $cities = $this->getCities($add['country_id'], $add['state_id']); @endphp
        @if (count($cities) != 0)
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('init-select2-cities', { detail:{
                    index_add: {{ $index }},
                    cities : {!! json_encode($cities) !!},
                    current_city : {!! $add['city_id'] != null ? $add['city_id'] : -1 !!}
                }
            }));
        </script>
        @else
        <script wire:ignore>
            window.dispatchEvent(new CustomEvent('init-select2-cities-disabled', { detail:{
                    index_add: {{ $index }},
                }
            }));
        </script>
        @endif


    @endforeach
@else
<script wire:ignore>
    window.dispatchEvent(new CustomEvent('init-select2-countries', { detail: { index_add: 0 } }));
</script>
@endif


@endpush

