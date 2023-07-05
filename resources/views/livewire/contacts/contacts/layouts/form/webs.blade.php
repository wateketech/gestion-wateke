<div class="col-12 mb-3 mt-5">
    <div class="row">


        @forelse ($webs as $index => $web)
            <div class="col-1 m-0 p-0 w-3">
                {{-- <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
                    <input id="web-star-fav-{{ $index }}" type="radio" name="web-is_primary" wire:click="selectWebIsPrimary({{ $index }})" {{ $webs[$index]['is_primary'] ? 'checked' : '' }} >
                    <label for="web-star-fav-{{ $index }}"></label>
                </div> --}}
            </div>
            <div class="col-3 form-group pr-0">
                <label for="webs_types_{{ $index }}" class="form-control-label">Etiqueta *</label>
                <select class="@error("webs.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                    name="webs_types_{{ $index }}" id="webs_types_{{ $index }}" wire:model="webs.{{ $index }}.type_id">
                    @foreach ($web_types as $type)
                        <option value="{{ $type->id }}">
                            {{ $type->label }}
                        </option>
                    @endforeach
                    <script>

                    </script>
                </select>
                @error("webs.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>
            <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
                <label for="webs_value_{{ $index }}" class="form-control-label">Enlace *</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style='padding-right: 0px !important;'>https://</span>
                    <input class="@error("webs.{$index}.value")border border-danger rounded-3 @enderror form-control text-lower"
                        type="text" name="webs_value_{{ $index }}" id="webs_value_{{ $index }}"
                        wire:model="webs.{{ $index }}.value"
                        wire:blur="validate_webs('value', {{ $index }})"
                        style='padding-left: 63px !important;'>
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='//{{ $webs[$index]["value"] }}'>
                        <i class="fas fa-location-arrow"></i>
                    </a>
                </div>
                @error("webs.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                <sub class="text-warning">{{ $this->uniqueWarningBD('contact_webs', 'value', $web['value'], 'Esta web ya es utilizado por otro contacto' ) }}</sub>
            </div>



         <div class="col-2 col-md-2 mt-4">
            @if ($index === count($webs) - 1)
                @if (count($webs) > 1)
                    <div wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($webs) == 1)
                    <div wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    <div wire:click="addWeb({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @elseif (count($webs) < $webs_max)
                    <div wire:click="addWeb({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>

        <div class="clearfix"></div>
        @empty
            <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
                <div wire:click="addWeb({{ -1 }})" class="btn btn-outline-success px-3">Agregar una Web</i></div>
            </div>
        @endforelse

    </div>
</div>
