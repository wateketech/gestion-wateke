<div>
    @extends("layouts.form")


    @section('header-form')
    <h6 class="mb-2 h5">Actualización de Métricas </h6>
    @endsection


    @section('body-form')
                <form wire:submit.prevent="save" id='user-metric-form'>

                    <div class="m-3">
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="metrica" class="form-control-label">Metrica</label>
                                <input class="form-control" type="text" name="metrica" id="metrica"
                                    disabled value='prueba'>

                            </div>

                            <div class="col-3 form-group">
                                <label for="usuario" class="form-control-label">Usuarios</label>
                                <input class="form-control" type="text" name="usuario" id="usuario"
                                    disabled value="prueba">
                            </div>
                            <div class="col-3 form-group">
                                <label for="valor" class="form-control-label">Valor *</label>
                                <input class="@error('valor')border border-danger rounded-3 @enderror form-control" type="text" placeholder="30"
                                    wire:model="valor" name="valor" id="valor">
                                @error('valor')
                                    <sub class="text-danger">{{ $message }}</sub>
                                @enderror
                            </div>

                            <div class="col-3 form-group">
                                <label for="tiempo" class="form-control-label">Tiempo *</label>
                                <input class="@error('tiempo')border border-danger rounded-3 @enderror form-control" type="datetime-local"
                                    wire:model='tiempo' name="tiempo" id="tiempo">
                                @error('tiempo')
                                    <sub class="text-danger">{{ $message }}</sub>
                                @enderror
                            </div>

                        </div>
                    </div>


                </form>
    @endsection


    @section('footer-form')
        <button type="button" class="btn btn-secondary mx-2" wire:click="refresh">Deshacer</button>
        <button type="button" class="btn btn-success mx-2" wire:click="updateComfirmed">Actualizar Métrica</button>
    @endsection

</div>
