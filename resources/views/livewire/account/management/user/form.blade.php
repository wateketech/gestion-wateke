<div>
    <form wire:submit.prevent="save" id='user-form'>

        <div class="m-3">

            <div class="row">
                <div class="col-3 form-group">
                    <label for="name" class="form-control-label">Nombre *</label>
                    <input class="form-control @error('name')border border-danger rounded-3 @enderror"
                        wire:model='name' name="name" id="name" type="text" placeholder="Alberto">
                        @error('name') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-3 form-group">
                    <label for="email" class="form-control-label">Correo *</label>
                    <input class="form-control @error('email')border border-danger rounded-3 @enderror"
                        wire:model='email' name="email" id="email" type="email" placeholder="info@wateke.travel">
                        @error('email') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-3 form-group">
                    <label for="password" class="form-control-label">Contraseña *</label>
                    <input class="form-control @error('password')border border-danger rounded-3 @enderror"
                        wire:model='public_password' name="password" id="password" type="password" placeholder="Secret123*">
                        @error('password') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col-3 form-group">
                    <label for="role" class="form-control-label">Rol *</label>
                    <select class="form-control" name="role" id="role" wire:model='role'>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

        </div>

    </form>
</div>


@section('scripts')
<script>

</script>
@endsection
