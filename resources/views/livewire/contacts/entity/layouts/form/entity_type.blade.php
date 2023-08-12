<div class="col-5 form-group">
    <label for="entity_type" class="form-control-label">Tipo de entidad *</label>
    <select class="form-control @error('entity_type')border border-danger rounded-3 is-invalid @enderror" type="text" name="entity_type" id="entity_type"
        wire:model="entity_type" required>
        <option value=""></option>
        @foreach ($entity_types as $entity)
            <option value='{{ $entity->id }}'>{{ $entity->visual_name_s }}</option>
        @endforeach
    </select>
    @error('entity_type') <sub class="text-danger">{{ $message }}</sub> @enderror
</div>
