<div class="col-12 mb-3 mt-5">
    <div class="row">


        @foreach ($emails as $index => $email)
        <div class="col-1 form-check d-flex justify-content-end pt-4 star-primary">
            <input id="email-star-fav-{{ $index }}" type="radio" name="email-is_primary" wire:click="selectEmailIsPrimary({{ $index }})" {{ $emails[$index]['is_primary'] ? 'checked' : '' }} >
            <label for="email-star-fav-{{ $index }}"></label>
        </div>
        <div class="col-3 form-group pr-0">
            <label for="email_label_{{ $index }}" class="form-control-label">Etiqueta </label>
            <input class="@error("emails.{$index}.label")border border-danger rounded-3 @enderror form-control"
                    type="text" name="email_label_{{ $index }}" id="email_label_{{ $index }}"
                    wire:blur="validate_emails('label', {{ $index }})"
                    wire:model="emails.{{ $index }}.label">
            @error("emails.{$index}.label") <sub class="text-danger">{{ $message }}</sub> @enderror

        </div>
        <div class="col-6 col-md-6 form-group">
            <label for="email_value_{{ $index }}" class="form-control-label">Email *</label>
            <div class="input-group">
                <input class="form-control text-lower
                    @if($this->uniqueWarningBD('contact_emails', 'value', $email['value']) != null) border border-warning rounded-3 @endif
                    @error("emails.{$index}.value")border border-warning rounded-3 @enderror "
                        type="email" name="email_value_{{ $index }}" id="email_value_{{ $index }}"
                        wire:blur="validate_emails('value', {{ $index }})"
                        wire:model="emails.{{ $index }}.value">
                <a class="input-group-text btn btn-outline-secondary m-0" type="button" target="_blank" href='mailto:{{ $emails[$index]["value"] }}'>
                    <i class="fas fa-paper-plane"></i>
                </a>
            </div>
            @error("emails.{$index}.value") <sub class="text-danger">{{ $message }}</sub> @enderror
            {{-- {!! html_entity_decode($rs->type->icon) !!} --}}
            <sub class="text-warning">{!! $this->uniqueWarningBD('contact_emails', 'value', $email['value'], 'El email ya es utilizado por otro contacto' ) !!}</sub>
        </div>


        <div class="col-2 col-md-2 mt-4">
            @if ($index === count($emails) - 1)
                @if (count($emails) > 1)
                    <div wire:click="removeEmail({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
                @endif
                @if (count($emails) < $emails_max)
                    <div wire:click="addEmail({{ $index }})" class="btn btn-outline-success px-3"><i class="fas fa-plus text-success"></i></div>
                @endif
            @else
                <div wire:click="removeEmail({{ $index }})" class="btn btn-outline-danger px-3 mr-2"><i class="fas fa-minus text-danger"></i></div>
            @endif
        </div>
        @endforeach
    </div>
</div>
