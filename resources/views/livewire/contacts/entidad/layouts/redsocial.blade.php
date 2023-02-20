<div class="col-6">
        <div class="row">
            <div class="col-4 form-group">
                <label for="observ" class="form-control-label">RRSS *</label>
                <input list="categories-rrss" class="form-control" type="text" placeholder="instagram"
                    name="observ" id="observ" wire:model="observ">
                <datalist id="categories-rrss">
                    <option>Facebook</option>
                    <option>Instagram</option>
                    <option>Twitter</option>
                </datalist>
            </div>
            <div class="col-6 form-group">
                <label for="enlace" class="form-control-label">Enlace *</label>
                <input class="form-control" type="email" placeholder='/wateke.travel'
                    name="enlace" id="enlace" wire:model="enlace">
            </div>
            <div class="col-2 p-0">
                <button type="button" class="btn btn-secondary my-4">+</button>
                {{-- <button type="button" class="btn btn-secondary my-4">-</button> --}}
            </div>       
        </div>
</div>
     