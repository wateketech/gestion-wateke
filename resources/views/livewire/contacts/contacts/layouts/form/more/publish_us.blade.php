

    <div class="col-12 mb-4">
        <div class="d-flex justify-content-start my-3 mx-0 h4 text-dark form-title">
            <span class="font-weight-bolder opacity-7"><i class="fas fa-share"></i> &nbsp; Nos Publica :</span>
        </div>
        <div class="row mx-3">
            @forelse ($publish_us as $index => $date)
            <div class="col-3 form-group pr-0">
                <label for="publish_us_types_{{ $index }}" class="form-control-label">Tipo *</label>
                <select class="@error("publish_us.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="publish_us_types_{{ $index }}" id="publish_us_types_{{ $index }}"
                    wire:blur="validate_publish_us('label', {{ $index }})"
                    wire:model="publish_us.{{ $index }}.type_id">
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
                        wire:blur="validate_publish_us('value', {{ $index }})"
                        wire:model.="publish_us.{{ $index }}.value"
                        style='padding-left: 63px !important;'
                        wire:blur="updatePublishUsValue({{ $index }}, $event.target.value);">
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='//{{ $publish_us[$index]["value"] }}'>
                        <i class="fas fa-location-arrow"></i>
                    </a>
                </div>

                @error("publish_us.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>


            <div class="col-3 col-md-3 mt-4">
                @if ($index === count($publish_us) - 1)
                    @if (count($publish_us) > 1)
                        <div wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    @endif
                    @if (count($publish_us) == 1)
                        <div wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                        <div wire:click="addPublishUs({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                    @elseif (count($publish_us) < $publish_us_max)
                        <div wire:click="addPublishUs({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                    @endif
                @else
                    <div wire:click="removePublishUs({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
            </div>
            @empty
            <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
                <div wire:click="addPublishUs({{ -1 }})" class="btn btn-outline-success px-3">¿ Este contacto Nos Publica ?</i></div>
            </div>
            @endforelse
        </div>

    </div>
