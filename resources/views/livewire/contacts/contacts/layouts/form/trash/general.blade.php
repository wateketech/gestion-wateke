<div class="container-fluid mt-7 mt-lg-4">
    <div class="row">
        <div class='col-lg-8 col-md-12'>
            <div class="row">
                <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-id-card"></i> &nbsp; Identificaiones :</span>
                </div>
                <div class="col-12 mb-3">
                    <div class="row">
                        @foreach ($ids as $index => $id)
                        <div class="col-2 form-group pr-0">
                            <label for="id_types_{{ $index }}" class="form-control-label">ID *</label>
                            <select class="@error("ids.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                                name="id_types_{{ $index }}" id="id_types_{{ $index }}" wire:model="ids.{{ $index }}.type_id">
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
                        <div class="col-8 col-md-8 form-group">
                            <label for="id_value_{{ $index }}" class="form-control-label">{{ $id_types->find($ids[$index]['type_id'])->title }} *</label>
                            <input class="@error("ids.{$index}.value")border border-danger rounded-3 @enderror form-control text-upper"
                                type="text" name="id_value_{{ $index }}" id="id_value_{{ $index }}"
                                wire:model.debounce.500ms="ids.{{ $index }}.value">
                            @error("ids.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
                            {{-- @php
                                $id_value_valid = true;
                                if ($id[$index]['value']) {
                                    foreach (json_decode($id_types->find($id[$index]['type_id'])->regEx) as $regEx) {
                                        if (preg_match($regEx, $id['value'])) {
                                            $id_value_valid = true;
                                            break;
                                        } else {
                                            $id_value_valid = false;
                                            print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                                        }
                                    }
                                }
                            @endphp
                            @if (!$id_value_valid)
                                <sub class="text-warning">Tenga presente que el {{ $id_types->find($id[$index]['type_id'])->title }} no cumple con el formato. </sub>
                                <script>
                                    document.getElementById('id_value_{{ $index }}').classList += ' is-warning';
                                </script>
                            @endif --}}
                        </div>
                        <div class="col-2 col-md-2 mt-4">
                            @if ($index === count($ids) - 1)
                                @if (count($ids) > 1)
                                    <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                                @endif
                                @if (count($ids) < $id_max)
                                    <div wire:click="addId({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                                @endif
                            @else
                                <div wire:click="removeId({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>


                <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-signature"></i> &nbsp; Nombres :</span>
                </div>


                <div class="d-flex justify-content-start my-3 mx-3 mt-3 h5 text-dark form-title">
                    <span class="font-weight-bolder opacity-7"><i class="fas fa-info"></i> &nbsp; Adicional :</span>
                </div>
                <div class="col-4 form-group">
                    <label for="alias" class="form-control-label">Alias</label>
                    <input class="@error('alias')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="alias" id="alias" wire:model="alias">
                    @error('alias') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-12 form-group">
                    <label for="about">Observaciones</label>
                    <textarea class="@error('about')border border-danger rounded-3 is-invalid @enderror form-control" rows="3"
                        name="about" id="about" wire:model="about"></textarea>
                    @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        </div>


    </div>

</div>


