<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
        <span class="font-weight-bolder opacity-7"><i class="fas fa-wifi"></i> &nbsp; Webs :</span>
    </div>
    <div class="row">
        @foreach ($webs as $index => $web)
        <div class="col-1 form-check pt-4">
            {{-- <input class="form-check-input" type="radio" id="webs.{{$index}}.is_primary" wire:model="webs.{{ $index }}.is_primary"> --}}
        </div>
        <div class="col-2 form-group pr-0">
            <label for="webs_types_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("webs.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="webs_types_{{ $index }}" id="webs_types_{{ $index }}" wire:model="webs.{{ $index }}.id_type">
                @foreach ($web_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("webs.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="webs_value_{{ $index }}" class="form-control-label">Enlace *</label>
            <div class="input-group">
                <input class="@error("webs.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="url" name="webs_value_{{ $index }}" id="webs_value_{{ $index }}"
                    wire:model.debounce.500ms="webs.{{ $index }}.value">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">{{ $webs_types->find($webs[$index]['id_type'])->value }}.com</span>
                </div> --}}
              </div>
            @error("webs.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- @php
                $webs_value_valid = true;
                if (strlen($webs[$index]['value']) > 0) {
                    $value = $webs_types->find($webs[$index]['id_type'])->value;
                    $regEx = '/^[\w.-]+@' . $value . '\.[a-zA-Z]{2,}$/';
                    if (preg_match($regEx, $webs[$index]['value'])) {
                        $webs_value_valid = true;
                        break;
                    } else {
                        $webs_value_valid = false;
                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                    }
                }
            @endphp
            @if (!$webs_value_valid)
                <sub class="text-warning">Tenga presente que el teléfono no cumple con el formato. </sub>
                <script>
                    document.getElementById('webs_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif --}}
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($webs) - 1)
                @if (count($webs) > 1)
                    <button wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($webs) < $webs_max)
                    <button wire:click="addWeb({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removeWeb({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
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
        <div class="col-1 form-check pt-4">
            {{-- <input class="form-check-input" type="radio" id="rrss.{{$index}}.is_primary" wire:model="rrss.{{ $index }}.is_primary"> --}}
        </div>
        <div class="col-2 form-group pr-0">
            <label for="rrss_types_{{ $index }}" class="form-control-label">RRSS *</label>
            <select class="@error("rrss.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="rrss_types_{{ $index }}" id="rrss_types_{{ $index }}" wire:model="rrss.{{ $index }}.id_type">
                @foreach ($rrss_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("rrss.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="rrss_value_{{ $index }}" class="form-control-label">Cuenta *</label>
            <div class="input-group">
                <input class="@error("rrss.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="url" name="rrss_value_{{ $index }}" id="rrss_value_{{ $index }}"
                    wire:model.debounce.500ms="rrss.{{ $index }}.value">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">{{ $rrss_types->find($rrss[$index]['id_type'])->value }}.com</span>
                </div> --}}
              </div>
            @error("rrss.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- @php
                $rrss_value_valid = true;
                if (strlen($rrss[$index]['value']) > 0) {
                    $value = $rrss_types->find($rrss[$index]['id_type'])->value;
                    $regEx = '/^[\w.-]+@' . $value . '\.[a-zA-Z]{2,}$/';
                    if (preg_match($regEx, $rrss[$index]['value'])) {
                        $rrss_value_valid = true;
                        break;
                    } else {
                        $rrss_value_valid = false;
                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                    }
                }
            @endphp
            @if (!$rrss_value_valid)
                <sub class="text-warning">Tenga presente que el teléfono no cumple con el formato. </sub>
                <script>
                    document.getElementById('rrss_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif --}}
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
