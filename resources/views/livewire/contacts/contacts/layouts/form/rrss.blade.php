<div class="col-12 mb-3">
    <div class="row">


        @foreach ($rrss as $index => $rs)
        <div class="col-3 form-group pr-0">
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
                <input class="@error("rrss.{$index}.value")border border-danger rounded-3 @enderror form-control text-lower"
                    type="text" name="rrss_value_{{ $index }}" id="rrss_value_{{ $index }}"
                    wire:blur="validate_rrss('value', {{ $index }})"
                    wire:model="rrss.{{ $index }}.value"
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
                    <div wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($rrss) < $rrss_max)
                    <div wire:click="addRrss({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @endforeach
    </div>
</div>
