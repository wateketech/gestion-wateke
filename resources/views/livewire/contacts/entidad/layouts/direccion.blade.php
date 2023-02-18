<div>
    <div class="row">
            
        <div class="col-4 form-group">
            <label for="direccion" class="form-control-label">Direccion *</label>
            <input class="form-control" type="text" placeholder="364 Bembeta"
                name="direccion" id="direccion" wire:model="direccion">
            
        </div>
        <div class="col-2 form-group">
            <label for="cod_postal" class="form-control-label">Cod Postal *</label>
            <input class="form-control" type="text" placeholder="70100"
                name="cod_postal" id="cod_postal" wire:model="cod_postal">
        </div>
        <div class="col-3 form-group">
            <label for="pais" class="form-control-label">Pais</label>                     
            <select class="form-control" id="pais">
                <option>Cuba</option>
                <option>...</option>
                <option>Comvertir en input</option>
            </select>

        </div>
        <div class="col-3 form-group">
            <label for="provincia" class="form-control-label">Provincia / Com Autonoma*</label>
            <select class="form-control" id="provincia">
                <option>Camagüey</option>
                <option>...</option>
                <option>Comvertir en input</option>
            </select>
        </div>
            
    </div>

    <div class="row">
        <div class="col-8">
                    
                <div class="row">
                    <div class="col-6 form-group">
                        <label for="municipio" class="form-control-label">Municipio</label>                     
                        <input class="form-control" type="text" placeholder="Camagüey"
                            name="municipio" id="municipio" wire:model="municipio">
                    </div>
                    <div class="col-3 form-group">
                        <label for="municipio_longitud" class="form-control-label">Longitud *</label>
                        <input class="form-control" type="num" placeholder="21.21672470"
                            name="municipio_longitud" id="municipio_longitud" wire:model="municipio_longitud">
                    </div>
                    <div class="col-3 form-group">
                        <label for="municipio_latitud" class="form-control-label">Latitud *</label>
                        <input class="form-control" type="num" placeholder="-77.74520810"
                            name="municipio_latitud" id="municipio_latitud" wire:model="municipio_latitud">
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 form-group">
                        <label for="localidad" class="form-control-label">Localidad</label>                     
                        <input class="form-control" type="tet" placeholder="Centro"
                            name="localidad" id="localidad" wire:model="localidad">
                    </div>
                    <div class="col-3 form-group">
                        <label for="localidad_longitud" class="form-control-label">Longitud *</label>
                        <input class="form-control" type="num" placeholder="10.55672000"
                            name="localidad_longitud" id="localidad_longitud" wire:model="localidad_longitud">
                    </div>
                    <div class="col-3 form-group">
                        <label for="localidad_latitud" class="form-control-label">Latitud *</label>
                        <input class="form-control" type="num" placeholder="47.73420010"
                            name="localidad_latitud" id="localidad_latitud" wire:model="localidad_latitud">
                    </div>
                </div>
        </div>
        <div class="col-4">
            bola del mundo dando vueltas
        </div>
    </div>

</div>


@section('script')
    <script>
        


    </script>
@endsection

