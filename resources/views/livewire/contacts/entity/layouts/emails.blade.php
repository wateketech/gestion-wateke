<div class="col-6">
    <div class="row">
        <div class="col-4 form-group">
            <label for="email-label" class="form-control-label">Nombre email *</label>
            <input list="categories-mail" class="form-control" type="text" placeholder="info"
                name="email-label" id="email-label.{{ $index }}" wire:model="emails.{{ $index }}.label">
            <datalist id="categories-mail">
                <option>Microsoft</option>
                <option>Google</option>
                <option>Yahoo</option>
                <option>Apple</option>
            </datalist>
        </div>

        <div class="col-6 form-group">
            <label for="email" class="form-control-label">Correo *</label>
            <input class="form-control" type="email" placeholder='info@wateke.travel'
                name="email" id="email.{{ $index }}" wire:model="emails.{{ $index }}.email">
        </div>
        <div class="col-2 p-0">
            <button wire:click="removeEmail({{ $index }})" type="button" class="btn btn-secondary my-4">-</button>
            {{-- @if ()
            @else
                <button wire:click="$emitUp('addEmail')" type="button" class="btn btn-secondary my-4">+</button>
            @endif --}}
        </div>       
    </div>
</div>