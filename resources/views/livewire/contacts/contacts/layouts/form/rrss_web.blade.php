<div class="col-12 mb-3">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-wifi"></i> &nbsp; Webs :</span>
    </div>
    <div class="row">
        @foreach ($webs as $index => $web)
            <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
                {{-- <input id="web-star-fav-{{ $index }}" type="radio" name="web-is_primary" wire:click="selectWebIsPrimary({{ $index }})" {{ $webs[$index]['is_primary'] ? 'checked' : '' }} >
                <label for="web-star-fav-{{ $index }}"></label> --}}
            </div>
            <div class="col-2 form-group pr-0">
                <label for="webs_types_{{ $index }}" class="form-control-label">Tipo *</label>
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
            <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
                <label for="webs_value_{{ $index }}" class="form-control-label">Enlace *</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1" style='padding-right: 0px !important;'>https://</span>
                    <input class="@error("webs.{$index}.value")border border-danger rounded-3 @enderror form-control"
                        type="text" name="webs_value_{{ $index }}" id="webs_value_{{ $index }}"
                        wire:model.debounce.500ms="webs.{{ $index }}.value"
                        style='padding-left: 63px !important;'
                        wire:change="updateWebValue({{ $index }}, $event.target.value);">
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='//{{ $webs[$index]["value"] }}'>
                        <i class="fas fa-location-arrow"></i>
                    </a>
                </div>
                @error("webs.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            </div>


            <div class="col-2 col-md-2 mt-4">
                @if ($index === count($webs) - 1)
                    @if (count($webs) > 1)
                        <div wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    @endif
                    @if (count($webs) < $webs_max)
                        <div wire:click="addWeb({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                    @endif
                @else
                    <div wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
            </div>
         @endforeach
    </div>
</div>



<div class="col-12 mb-3">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-share-alt"></i> &nbsp; Redes Sociales :</span>
    </div>
    <div class="row">
        @foreach ($rrss as $index => $rs)
        <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
            {{-- <input id="rrss-star-fav-{{ $index }}" type="radio" name="rrss-is_primary" wire:click="selectRrssIsPrimary({{ $index }})" {{ $rrss[$index]['is_primary'] ? 'checked' : '' }} >
            <label for="rrss-star-fav-{{ $index }}"></label> --}}
        </div>
        <div class="col-2 form-group pr-0">
            <label for="rrss_types_{{ $index }}" class="form-control-label">RRSS *</label>
            <select class="@error("rrss.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="rrss_types_{{ $index }}" id="rrss_types_{{ $index }}" wire:model="rrss.{{ $index }}.type_id">
                @foreach ($rrss_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("rrss.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-7 col-md-7 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="rrss_value_{{ $index }}" class="form-control-label">Usuario *</label>
            <div class="input-group">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input class="@error("rrss.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="text" name="rrss_value_{{ $index }}" id="rrss_value_{{ $index }}"
                    wire:model.debounce.500ms="rrss.{{ $index }}.value"
                    style='padding-left: 40px !important;'>
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank"
                        href='{{ $rrss_types->find($rrss[$index]["type_id"])->url . $rrss[$index]["value"] }}'>
                        {!! html_entity_decode($rrss_types->find($rrss[$index]['type_id'])->icon) !!}
                    </a>
                </div>
            @error("rrss.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($rrss) - 1)
                @if (count($rrss) > 1)
                    <button wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($rrss) < $rrss_max)
                    <button wire:click="addRrss({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @endforeach
    </div>
</div>
