<div class="col-6">
    {{$this->id}}
    <div class="row">
        <div class="col-5 form-group">
            <label for="observ" class="form-control-label">Nombre email *</label>
            <input list="categories-mail" class="form-control" type="text" placeholder="info"
                name="observ" id="observ" wire:model="observ">
            <datalist id="categories-mail">
                <option>Microsoft</option>
                <option>Google</option>
                <option>Yahoo</option>
                <option>Apple</option>
            </datalist>
        </div>
        <div class="col-7 form-group">
            <label for="correo" class="form-control-label">Correo *</label>
            <input class="form-control" type="email" placeholder='info@wateke.travel'
                name="correo" id="correo" wire:model="correo">
        </div>
        {{-- <div class="col-2 p-0"> --}}
            {{-- @if ()
                <button type="button" class="btn btn-secondary my-4">-</button>
            @else
                <button wire:click="$emitUp('addEmail')" type="button" class="btn btn-secondary my-4">+</button>
            @endif --}}
        {{-- </div>        --}}
    </div>
</div>
