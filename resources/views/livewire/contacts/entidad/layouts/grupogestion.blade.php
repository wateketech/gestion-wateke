<div>

    <label for="grupo_gestion" class="form-control-label">Grupo Gestion</label>   
    <input list="grupo_gestiones" name="grupo_gestiones" class="form-control" id="grupo_gestion" 
    wire:model='grupog_name'>

    <datalist id="grupo_gestiones">    
        @forelse ($grupogestiones as $grupogestion)
            <option> {{ $grupogestion->nombre }} </option>
        @empty
        @endforelse
    </datalist>

</div>


