<div class="col-12 mb-3">
    <div class="row">
        @foreach ($emails as $index => $id)
        <div class="col-2 form-group pr-0">
            <label for="email_label_{{ $index }}" class="form-control-label">Tipo *</label>
            <select class="@error("emails.{$index}.label")border border-danger rounded-3 is-invalid @enderror form-control"
                name="email_label_{{ $index }}" id="email_label_{{ $index }}" wire:model="emails.{{ $index }}.label">
                    @foreach ($labels_type as $type)
                        <option value="{{ $type }}">{{ $type }}</option>
                    @endforeach
            </select>
            @error("emails.{$index}.label") <sub class="text-danger">{{ $message }}</sub> @enderror

        </div>
        <div class="col-2 form-group pr-0">
            <label for="email_types_{{ $index }}" class="form-control-label">Proveedor *</label>
            <select class="@error("emails.{$index}.id_type")border border-danger rounded-3 is-invalid @enderror form-control"
                name="email_types_{{ $index }}" id="email_types_{{ $index }}" wire:model="emails.{{ $index }}.id_type">
                @foreach ($email_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
                <script>

                </script>
            </select>
            @error("emails.{$index}.id_type") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-6 col-md-6 form-group">
            <label for="email_value_{{ $index }}" class="form-control-label">Email *</label>
            {{-- <div class="input-group px-5">
            <input class="@error("ids.{$index}.value")border border-danger rounded-3 @enderror form-control"
                type="email" name="email_value_{{ $index }}" id="email_value_{{ $index }}"
                wire:model.debounce.500ms="emails.{{ $index }}.value">
            <span class="input-group-text" id="basic-addon2"> @example.com</span>
            </div> --}}
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2">
                <div class="input-group-append">
                  <span class="input-group-text" id="basic-addon2">@example.com</span>
                </div>
              </div>
                {{-- <div class="input-group">
                    <input type="text" class="form-control" aria-describedby="basic-addon2">
                    <div class="input-group-append">
                    </div>
                </div> --}}
            @error("emails.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror



            @php
                $email_value_valid = true;
                if (strlen($emails[$index]['value']) > 0) {
                    foreach (json_decode($email_types->find($emails[$index]['id_type'])->value) as $value) {
                        if (preg_match($regEx, $id['id_value'])) {
                            $email_value_valid = true;
                            break;
                        } else {
                            $email_value_valid = false;
                            print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                        }
                    }
                }
            @endphp
            @if (!$email_value_valid)
                <sub class="text-warning">Tenga presente que el email no cumple con el formato de {{ $email_types->find($emails[$index]['id_type'])->title }}. </sub>
                <script>
                    document.getElementById('id_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($emails) - 1)
                @if (count($emails) > 1)
                    <button wire:click="removeEmail({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
                @endif
                @if (count($emails) < $emails_max)
                    <button wire:click="addEmail({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></button>
                @endif
            @else
                <button wire:click="removeEmail({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></button>
            @endif
        </div>
        @endforeach
    </div>
</div>
