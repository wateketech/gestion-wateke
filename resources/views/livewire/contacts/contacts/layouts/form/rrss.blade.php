<div class="col-12 mb-3 mt-5">
    <div class="row">


        @forelse ($rrss as $index => $rs)
        <div class="col-1 m-0 p-0 w-3">
        </div>
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
        <div class="col-6 col-md-6 form-group">{{--  style="padding-right: 9.2em"> --}}
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
            <sub class="text-warning">{{ $this->uniqueWarningBD('contact_rrss', 'value', $rs['value'], 'Esta cuenta ya es utilizado por otro contacto' ) }}</sub>

        </div>



        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($rrss) - 1)
                @if (count($rrss) > 1)
                    <div wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($rrss) == 1)
                    <div wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    <div wire:click="addRrss({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @elseif (count($rrss) < $rrss_max)
                    <div wire:click="addRrss({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeRrss({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>

        <div class="clearfix"></div>
        @empty
            <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
                <div wire:click="addRrss({{ -1 }})" class="btn btn-outline-success px-3">Agregar una Red Social</i></div>
            </div>
        @endforelse


    </div>
</div>
