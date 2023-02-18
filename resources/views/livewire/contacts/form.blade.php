<div>
   
        <form action="#" method="POST">
            <div class="m-3">
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="nombre" class="form-control-label">Nombre *</label>
                        <input class="form-control" type="text" placeholder="HAVANATUR"
                            name="nombre" id="nombre" wire:model="nombre">
                    </div>
                    <div class="col-3 form-group">
                        <label for="nombre_fiacal" class="form-control-label">Nombre Fiscal *</label>
                        <input class="form-control" type="text" placeholder="John Snow"
                            name="nombre_fiacal" id="nombre_fiacal" wire:model="nombre_fiscal">
                    </div>
                    <div class="col-3 form-group">
                        <label for="grupo_gestion" class="form-control-label">Grupo Gestion</label>                     
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Esto es un componente aparte</option>
                            <option>AMADEUS</option>
                            <option>nombre-grup-gest-2</option>
                            <option>...</option>
                            <option>Comvertir en input</option>
                        </select>
                        {{-- <input class="form-control" type="text" placeholder="AMADEUS"
                            name="grupo_gestion" id="grupo_gestion" wire:model="grupo_gestion"> --}}
                    </div>
                    <div class="col-3 form-group">
                        <label for="num_oficina" class="form-control-label">Num Oficina *</label>
                        <input class="form-control" type="tel" placeholder="(770)-888-444"
                            name="num_oficina" id="num_oficina" wire:model="num_oficina">
                    </div>
                </div>
        
                <div class="row">
                    <div class="col-3 form-group">
                        <label for="nif" class="form-control-label">NIF *</label>
                        <input class="form-control" type="text" placeholder="John Snow" 
                            name="nif" id="nif" wire:model="nif">
                    </div>
                    <div class="col-3 form-group">
                        <label for="iata" class="form-control-label">IATA *</label>
                        <input class="form-control" type="text" placeholder="MZT" 
                            name="iata" id="iata" wire:model="iata">
                    </div>
                    <div class="col-3 form-group">
                        <label for="rp" class="form-control-label">RP *</label>
                        <input class="form-control" type="text" placeholder="John Snow"
                            name="rp" id="rp" wire:model="rp">
                    </div>
        
                    <div class="col-3 form-group">
                        <label for="gds" class="form-control-label">GDS *</label>
                        <select class="form-control" id="exampleFormControlSelect1">
                            <option>Esto es un componente aparte</option>
                            <option>nombre-gds-2</option>
                            <option>...</option>
                            <option>Comvertir en input</option>
                        </select>
                        {{-- <input class="form-control" type="text" placeholder="John Snow" 
                        name="gds" id="gds" wire:model="gds"> --}}
                    </div>
                </div>
        
                <div class="row">
        
                    <div class="col-6 form-group">
                        <label for="observ">Observaciones</label>
                        <textarea class="form-control" rows="3" name="observ" id="observ" wire:model="observ"></textarea> 
                    </div>
                    <div class="col-6 my-4">
                        <div class="container">
                            <div class="row">
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox"
                                    name="es_minorista" id="es_minorista" wire:model="es_minorista">
                                    <label class="custom-control-label" for="es_minorista">Es una minorista</label>
                                </div>
                                
                                <div class="form-check my-2">
                                    <input class="form-check-input" type="checkbox"
                                    name="es_central" id="es_central" wire:model="es_central">
                                    <label class="custom-control-label" for="es_central">Es una central</label>
                                </div>
                            </div>
                        </div>
                    </div> 
        
                </div>
            </div>

            <div class="m-3">
                direccion, 
                telefonos, 
                correos, 
                ...
            </div>

        </form>
</div>