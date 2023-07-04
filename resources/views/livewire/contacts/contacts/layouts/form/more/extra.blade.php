<div class="col-12 mb-4">
    <div class="d-flex justify-content-start my-3 mx-0 h4 text-dark form-title">
        <span class="font-weight-500 opacity-7"><i class="fas fa-info"></i> &nbsp; Extras :</span>
    </div>
    <div class="row mx-3">
        <div class="col-5 form-group">
            <label for="alias" class="form-control-label">Alias</label>
            <input class="@error('alias')border border-danger rounded-3 is-invalid @enderror form-control"
                type="text" name="alias" id="alias"
                wire:blur="validate_extra('alias')"
                wire:model="alias">
            @error('alias') <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
        <div class="col-9 form-group">
            <label for="about">Observaciones</label>
            <textarea class="@error('about')border border-danger rounded-3 is-invalid @enderror form-control"
                rows="2" name="about" id="about"
                wire:blur="validate_extra('about')"
                wire:model="about"></textarea>
            @error('about') <sub class="text-danger">{{ $message }}</sub> @enderror
        </div>
    </div>

</div>




