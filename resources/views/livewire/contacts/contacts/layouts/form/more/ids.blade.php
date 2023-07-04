<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-0 h4 text-dark form-title">
        <span class="font-weight-500 opacity-7"><i class="fas fa-id-card"></i> &nbsp; Identificaiones :</span>
    </div>
    <div class="row mx-3">
        @forelse ($ids as $index => $id)
        <div class="col-3 form-group pr-0">
            <label for="id_types_{{ $index }}" class="form-control-label">ID *</label>
            <select class="@error("ids.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="id_types_{{ $index }}" id="id_types_{{ $index }}"
                wire:blur="validate_ids('label', {{ $index }})"
                wire:model="ids.{{ $index }}.type_id">
                @foreach ($id_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("ids.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">
            <label for="id_value_{{ $index }}" class="form-control-label">{{ $id_types->find($ids[$index]['type_id'])->title }} *</label>
            <input class="@error("ids.{$index}.value")border border-danger rounded-3 @enderror form-control text-upper"
                type="text" name="id_value_{{ $index }}" id="id_value_{{ $index }}"
                wire:blur="validate_ids('value', {{ $index }})"
                wire:model="ids.{{ $index }}.value">
            @error("ids.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-3 col-md-3 mt-4">
            @if ($index === count($ids) - 1)
                @if (count($ids) > 1)
                    <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($ids) == 1)
                    <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                    <div wire:click="addId({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @elseif (count($ids) < $id_max)
                    <div wire:click="addId({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @empty
        <div class="d-flex justify-content-start my-2 mx-3 h5 text-dark form-title">
            <div wire:click="addId({{ -1 }})" class="btn btn-outline-success px-3">Agregar una identificación</i></div>
        </div>
        @endforelse
    </div>

</div>
