

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
