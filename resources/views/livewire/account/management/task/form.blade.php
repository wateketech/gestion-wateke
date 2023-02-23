
<div>
    <form wire:submit.prevent="save" id='metric-form'>

        <div class="m-3">
            <div class="row">
                <div class="col-3 form-group">
                    <label for="nombre" class="form-control-label">Nombre *</label>
                    <input class="form-control" type="text" placeholder="nombre"
                        wire:model="nombre" name="nombre" id="nombre">
                </div>
                <div class="col-3 form-group">
                    <label for="valor" class="form-control-label">Valor *</label>
                    <input class="form-control" type="text" placeholder="12"
                        wire:model="valor" name="valor" id="valor">
                </div>

                <div class="col-3 form-group">
                    <label for="promedio" class="form-control-label">Promedio *</label>
                    <input class="form-control" type="text" placeholder="30"
                        wire:model="promedio" name="promedio" id="promedio">
                </div>
                <div class="col-3 form-group">
                    <label for="about" class="form-control-label">Observaciones *</label>
                    <input class="form-control" type="text" placeholder="notas referentes"
                        wire:model="about" name="about" id="about">
                </div>
            </div>
        </div>

    </form>
</div>

