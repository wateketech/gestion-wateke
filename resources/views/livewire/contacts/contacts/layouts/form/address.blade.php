<div class="col-12 mb-4">



    @foreach ($address as $index_add => $add)
        <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
            <span class="font-weight-bolder opacity-9 pt-1 @error("address.{$index_add}.name") text-danger  @enderror"><i class="fas fa-map-marker-alt"></i> &nbsp; Dirección&nbsp;&nbsp;
                <input type="text" class="font-weight-bolder opacity-8 border-0 w-25 d-inline-block" style="border-bottom: 1.2px grey solid !important; @error("address.{$index_add}.name") border-bottom: 2px red dashed !important @enderror"
                wire:model="address.{{ $index_add }}.name">:
            </span>
            @if (count($address) > 1)
            <button wire:click="removeAddress({{ $index_add }})" class="btn btn-outline-danger px-3 py-2 mr-2">Quitar direccion</button>
            @endif
        </div>

        <div class="row">
            <div class="col-1 form-group pr-0 d-flex justify-content-center mt-4">
                <div disabled class="px-3 btn btn-outline-secondary form-control-input" name="geolocation_{{ $index_add }}"
                    wire:click="geolocation({{ $index_add }})">
                    <i class="fas fa-globe-africa fa-lg"></i>
                </div>
            </div>
            <div class="col-3 form-group pr-0">
                <div wire:ignore>
                    <label for="countries_{{ $index_add }}" class="form-control-label">Pais *</label>
                    <select class="Select--2 form-control" name="countries_{{ $index_add }}" id="countries_{{ $index_add }}"
                    onchange="livewire.emit('updateCountry', {{ $index_add }},this.value);">
                        <option></option>
                        @foreach ($countries as $country)
                            <option value="{{ $country->id }}"
                                data-flag={{ $country->emoji }}>
                                {{ property_exists(json_decode($country->translations), 'es') ? json_decode($country->translations)->es :  $country->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                @error("address.{$index_add}.country_id") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col-3 form-group pr-0">
                <div wire:ignore>
                    <label for="states_{{ $index_add }}" class="form-control-label">Provincia *</label>
                    <select class="Select--2 form-control" name="states_{{ $index_add }}" id="states_{{ $index_add }}"
                    onchange="livewire.emit('updateState', {{ $index_add }},this.value);" disabled>
                        <option></option>
                    </select>
                </div>
                @error("address.{$index_add}.state_id") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col-3 form-group pr-0">
                <div wire:ignore>
                    <label for="cities_{{ $index_add }}" class="form-control-label">Municipio *</label>
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
                        type="text" id="zip_code_{{ $index_add }}" id="zip_code_{{ $index_add }}"  wire:model="address.{{ $index_add }}.zip_code">
                @error("address.{{ $index_add }}.zip_code") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>

            <div class="row py-3">
                @foreach ($address_line[$index_add] as $index_l => $line)
                    <div class="col-2 form-check pt-2 h5 d-flex justify-content-end">
                        <p class="font-weight-bolder opacity-8">Linea {{ $index_l + 1 }} :</p>
                    </div>
                    <div class="col-3 col-md-3 form-group py-0 pb-3 my-0">{{--  style="padding-right: 9.2em"> --}}
                        <input class="@error("address_line.{$index_add}.{$index_l}.label")border border-danger rounded-3 @enderror form-control mb-0"
                            type="tel" name="address_line_{{ $index_add }}_label_{{ $index_l }}" id="address_line_{{ $index_add }}_label_{{ $index_l }}"
                            wire:model.debounce.500ms="address_line.{{ $index_add }}.{{ $index_l  }}.label">

                        @error("address_line.{$index_add}.{$index_l}.label") <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                    <div class="col-5 col-md-5 form-group py-0 pb-3 my-0">{{--  style="padding-right: 9.2em"> --}}
                        <input class="@error("address_line.{$index_add}.{$index_l}.value")border border-danger rounded-3 @enderror form-control mb-0"
                            type="tel" name="address_line_{{ $index_add }}_value_{{ $index_l }}" id="address_line_{{ $index_add }}_value_{{ $index_l }}"
                            wire:model.debounce.500ms="address_line.{{ $index_add }}.{{ $index_l  }}.value">

                        @error("address_line.{$index_add}.{$index_l}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>


                    <div class="col-2 col-md-2">
                        @if ($index_l === count($address_line[$index_add]) - 1)
                            @if (count($address_line[$index_add]) > 1)
                                <button wire:click="removeAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                            @endif
                            @if (count($address_line[$index_add]) < $address_line_max)
                                <button wire:click="addAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                            @endif
                        @else
                            <button wire:click="removeAddressLine({{ $index_l }},{{ $index_add }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="col-3 col-md-3">
                @if ($index_add === count($address) - 1)
                    @if (count($address) < $address_max)
                        <button wire:click="addAddress({{ $index_add }})" class="btn btn-outline-success px-3">Agregar otra Direccion</button>
                    @endif
                @endif
            </div>
        </div>
    @endforeach



</div>
@push('scripts')
<script>
    window.addEventListener('init-select2-countries', function(event){
        $('#countries_' + event.detail.index_add +'.Select--2').select2({
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
        $selectCity = $('#cities_' + event.detail.index_add +'.Select--2');
        $selectCity.empty();
        if ($selectCity.length && $selectCity.data('select2')) $selectCity.select2('destroy');
        $selectCity.attr('disabled', true);

        var $select = $('#states_' + event.detail.index_add +'.Select--2');

        $select.empty();
        $select.prop('disabled', false);
        $select.append($('<option>', { value: '', text: '' }));
        $select.select2({
                placeholder: 'Seleccione una provincia',
                data: event.detail.states
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
        var $select = $('#cities_' + event.detail.index_add +'.Select--2');
        $select.empty();
        $select.prop('disabled', false);
        $select.append($('<option>', { value: '', text: '' }));
        $select.select2({
                placeholder: 'Seleccione un municipio',
                data: event.detail.cities
            });
    });

    window.dispatchEvent(new CustomEvent('init-select2-countries', { detail: { index_add: 0 } }));
</script>
@endpush
