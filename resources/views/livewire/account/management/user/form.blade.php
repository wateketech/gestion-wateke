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
                        {{-- <span data-target="password" id="password-eye" class="ml-2"> --}}
                            {{-- <i class="fas fa-eye"></i> --}}
                            {{-- <i class="fas fa-eye-slash"></i> --}}
                        {{-- </span> --}}
                        <label for="password" class="form-control-label">Contraseña *</label>
                    @if ($view=='create')                           
                            {{-- <input class="form-control" type="password" name="password" id="password-input" maxlength="40" required autofocus/> --}}
                        <input class="form-control @error('password')border border-danger rounded-3 @enderror"
                            wire:model='public_password' name="password" id="password-input" type="password" placeholder="Secret123*" required autofocus>
                            @error('password') <sub class="text-danger">{{ $message }}</sub> @enderror
                    @else
                        @if (auth()->user()->hasRole('SuperAdmin'))
                            <input class="form-control @error('password')border border-danger rounded-3 @enderror"
                                wire:model='public_password' name="password" id="password-input" type="text" placeholder="Secret123*" required autofocus>
                                @error('password') <sub class="text-danger">{{ $message }}</sub> @enderror                          
                        @else
                            <input disabled class="form-control" name="password" id="password" type="password" placeholder="*******">                            
                        @endif
                    @endif

                </div>
                <div class="col-3 form-group">
                    <label for="role" class="form-control-label">Rol *</label>
                    <select class="form-control" name="role" id="role" wire:model='role'>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
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
