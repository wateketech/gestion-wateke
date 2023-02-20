<div>
    <label for="gds" class="form-control-label">GDS *</label>
    <input list="gdss" name="gds" class="form-control" id="gds" 
    wire:model='gds_name'>

    <datalist id="gdss">    
        @forelse ($gdss as $gds)
            <option> {{ $gds->nombre }} </option>
        @empty
        @endforelse
    </datalist>

</div>
