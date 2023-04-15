<div>
    <div class="row">
        <div class="col-3 form-group">
            <label for="pais" class="form-control-label">Pais</label>                     
            <select class="form-control" id="pais"
                wire:model='pais_id'>
                @foreach ($paises as $pais)
                    <option value={{ $pais->id }}> {{ $pais->name }}</option>
                @endforeach
            </select>

        </div>
        <div class="col-3 form-group">
            <label for="provincia" class="form-control-label">Provincia / Com Autonoma*</label>

            <input list="provincias" name="provincias" class="form-control" id="provincia" 
                wire:model='provincia_id'>
            <datalist id="provincias">    
                @forelse ($provincias as $provincia)
                    <option data-value={{ $provincia->id }} value={{ $provincia->name }}>
                @empty
                    <option> nada </option>
                @endforelse
            </datalist>
        
        </div>

        <div class="col-3 form-group">
            <label for="municipio" class="form-control-label">Municipio</label>                     
            <input class="form-control" type="text" placeholder="Camagüey"
                name="municipio" id="municipio" wire:model="municipio">
        </div>
        
        <div class="col-3 form-group">
            <label for="localidad" class="form-control-label">Localidad</label>                     
            <input class="form-control" type="tet" placeholder="Centro"
                name="localidad" id="localidad" wire:model="localidad">
        </div>




            
    </div>

    <div class="row">
        <div class="col-3 form-group">
            <label for="cod_postal" class="form-control-label">Cod Postal *</label>
            <input class="form-control" type="text" placeholder="70100"
                name="cod_postal" id="cod_postal" wire:model="cod_postal">
        </div>


        <div class="col-7 form-group">
            <label for="direccion" class="form-control-label">Direccion *</label>
            <input class="form-control" type="text" placeholder="364 Bembeta"
                name="direccion" id="direccion" wire:model="direccion">
            
        </div>
    </div>

</div>