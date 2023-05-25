<div class="col-12 mb-3">
    <div class="row">
        <div class="d-flex justify-content-start my-3 mx-3 h5 text-dark form-title">
            <span class="font-weight-bolder opacity-7"><i class="fas fa-envelope"></i> &nbsp; Emails :</span>
        </div>

        @foreach ($emails as $index => $email)
        <div class="col-1 form-check pt-4">
            {{-- <input class="form-check-input" type="radio" id="emails.{{$index}}.is_primary" wire:model="emails.{{ $index }}.is_primary"> --}}
        </div>
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
        <div class="col-5 col-md-5 form-group">{{--  style="padding-right: 9.2em"> --}}
            <label for="email_value_{{ $index }}" class="form-control-label">Email *</label>
            <div class="input-group">
                <input class="@error("emails.{$index}.value")border border-danger rounded-3 @enderror form-control"
                    type="email" name="email_value_{{ $index }}" id="email_value_{{ $index }}"
                    wire:model.debounce.500ms="emails.{{ $index }}.value">
                {{-- <div class="input-group-append">
                  <span class="input-group-text">{{ $email_types->find($emails[$index]['id_type'])->value }}.com</span>
                </div> --}}
              </div>
            @error("emails.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- @php
                $email_value_valid = true;
                if (strlen($emails[$index]['value']) > 0) {
                    $value = $email_types->find($emails[$index]['id_type'])->value;
                    $regEx = '/^[\w.-]+@' . $value . '\.[a-zA-Z]{2,}$/';
                    if (preg_match($regEx, $emails[$index]['value'])) {
                        $email_value_valid = true;
                        break;
                    } else {
                        $email_value_valid = false;
                        print '<p class="d-none text-danger">fallo en :'. $regEx . '</p>';
                    }
                }
            @endphp
            @if (!$email_value_valid)
                <sub class="text-warning">Tenga presente que el email no cumple con el formato de {{ $email_types->find($emails[$index]['id_type'])->label }}. </sub>
                <script>
                    document.getElementById('email_value_{{ $index }}').classList += ' is-warning';
                </script>
            @endif --}}
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
