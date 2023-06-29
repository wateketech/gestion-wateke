<div class="col-12 mb-3">
    <div class="row">


        @foreach ($instant_messages as $index => $instant_message)
        <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
            <input id="instant_messages-star-fav-{{ $index }}" type="radio" name="instant_messages-is_primary" wire:click="selectInstantMessageIsPrimary({{ $index }})" {{ $instant_messages[$index]['is_primary'] ? 'checked' : '' }} >
            <label for="instant_messages-star-fav-{{ $index }}"></label>
        </div>
        <div class="col-2 form-group pr-0">
            <label for="instant_messages_label_{{ $index }}" class="form-control-label">Etiqueta *</label>
            <input class="@error("instant_messages.{$index}.label")border border-danger rounded-3 @enderror form-control text-lower"
                    type="text" name="instant_messages_label_{{ $index }}" id="instant_messages_label_{{ $index }}"
                    wire:blur="validate_chats('label, {{ $index }}')"
                    wire:model="instant_messages.{{ $index }}.label">
            @error("instant_messages.{$index}.label") <sub class="text-danger">{{ $message }}</sub> @enderror

        </div>
        <div class="col-2 form-group pr-0">
            <label for="instant_message_types_{{ $index }}" class="form-control-label">Proveedor *</label>
            <select class="@error("instant_messages.{$index}.type_id")border border-danger rounded-3 is-invalid @enderror form-control"
                name="instant_message_types_{{ $index }}" id="instant_message_types_{{ $index }}" wire:model="instant_messages.{{ $index }}.type_id">
                @foreach ($instant_message_types as $type)
                    <option value="{{ $type->id }}">
                        {{ $type->label }}
                    </option>
                @endforeach
            </select>
            @error("instant_messages.{$index}.type_id") <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-5 col-md-5 form-group">
            <label for="instant_messages_value_{{ $index }}" class="form-control-label">Usuario *</label>
            <sub class='ml-3 mb-2'style='font-size:11px'>{{ $instant_message_types->find($instant_messages[$index]['type_id'])->about ? 'NOTA : ' : '' }} {{ $instant_message_types->find($instant_messages[$index]['type_id'])->about }}</sub>
            <div class="input-group">
                <input class="form-control text-lower
                        @error("instant_messages.{$index}.value")border border-danger rounded-3 @enderror
                        @if($this->uniqueWarningBD('contact_instant_messages', 'value', $instant_message['value']) != null) border border-warning rounded-3 @endif"
                    type="tel" name="instant_messages_value_{{ $index }}" id="instant_messages_value_{{ $index }}"
                    wire:blur="validate_chats('value, {{ $index }}')"
                    wire:model="instant_messages.{{ $index }}.value">
                @if ($instant_message_types->find($instant_messages[$index]["type_id"])->url)
                    <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank"
                        href='{{ $instant_message_types->find($instant_messages[$index]["type_id"])->url . $instant_messages[$index]["value"] }}'>
                        {!! html_entity_decode($instant_message_types->find($instant_messages[$index]['type_id'])->icon) !!}
                    </a>
                @endif
            </div>
            @error("instant_messages.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            <sub class="text-warning">{{ $this->uniqueWarningBD('contact_instant_messages', 'value', $instant_message['value'], 'Esta cuenta ya es utilizado por otro contacto' ) }}</sub>

        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($instant_messages) - 1)
                @if (count($instant_messages) > 1)
                    <div wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($instant_messages) < $instant_messages_max)
                    <div wire:click="addInstantMessages({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeInstantMessages({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @endforeach
    </div>
</div>
