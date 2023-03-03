<div class="col-6">
    <div class="row">
        <div class="col-4 form-group">
            <label for="observ" class="form-control-label">Label *</label>
            <input list="categories-mail" class="form-control" type="text" placeholder="info"
                name="observ" id="observ" wire:model="observ">
            <datalist id="categories-mail">
                <option>Microsoft</option>
                <option>Google</option>
                <option>Yahoo</option>
                <option>Apple</option>
            </datalist>
        </div>
        <div class="col-6 form-group">
            <label for="correo" class="form-control-label">Correo *</label>
            <input class="form-control" type="email" placeholder='info@wateke.travel'
                name="correo" id="correo" wire:model="correo">
        </div>
        <div class="col-2 p-0">
            <button wire:click="$emitUp('addEmail')" type="button" class="btn btn-secondary my-4">+</button>
            {{-- <button type="button" class="btn btn-secondary my-4">-</button> --}}
        </div>       
    </div>
</div>
