<div class="main-content" id='fast-form-create'>
    <form wire:submit.prevent="save" action="#" method="POST">
        
        <div class="card card-body blur shadow-blur mx-4 my-1">
                <div class="d-flex justify-content-center mb-3 h3">
                    {{-- <i class="fas fa-bolt"></i>  --}}
                    Formulario rápido para agencias.
                </div>
                <div class="row">

                    <div class="col-4 form-group">
                        <label for="name" class="form-control-label">Nombre Comercial*</label>
                        <input class="form-control @error('name')border border-danger rounded-3 @enderror" type="text" placeholder="HAVANATUR"
                            name="name" id="name" wire:model="name">
                            @error('name') <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label for="legal_name" class="form-control-label">Nombre Fiscal *</label>
                        <input class="form-control @error('legal_name')border border-danger rounded-3 @enderror" type="text" placeholder="John Snow"
                            name="legal_name" id="legal_name" wire:model="legal_name">
                            @error('legal_name') <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                    <div class="col-4 form-group">
                        <label for="email" class="form-control-label">Correo Primario*</label>
                        <input class="form-control @error('email')border border-danger rounded-3 @enderror" type="email" placeholder='info@wateke.travel'
                            name="email" id="email" wire:model="email">
                            @error('email') <sub class="text-danger">{{ $message }}</sub> @enderror
                    </div>
                
                </div>
                
                <div class="row">
                
                    <div class="col-7 form-group">
                        <label for="about">Observaciones</label>
                        <textarea class="form-control" rows="4" name="about" id="about" wire:model="about"></textarea> 
                    </div>

                    <div class="col-3 my-4 form-group">
                        <select class="form-control my-2" name="is_retail" id="is_retail" wire:model="is_retail">
                            <option value="true"> Es minorista</option>
                            <option value="false">Es mayorista</option>
                        </select>
                        <select class="form-control my-2" name="is_mainoffice" id="is_mainoffice" wire:model="is_mainoffice">
                            <option value="true"> Es una central</option>
                            <option value="false">Es una sucursal</option>
                        </select>
                    </div>            
                    <div class="col-2 my-4">
                
                    </div>
                
                </div>                
                <div class="d-flex justify-content-center mt-3">
                    <button type="button" onclick="document.getElementById('fast-form-create').hidden = true" class="btn btn-secondary mx-2">Deshacer</button>
                    <button type="submit" class="btn btn-success mx-2"><i class="fas fa-bolt"></i> Crear Agencia</button>
                </div>
            </div>    

    </form>
</div>
<div class="main-content" id='fast-view-table'>
    @livewire('contacts.entity.fast-entity-table')
</div>
@push('scripts')
    <script>
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
                container: 'swal-wide-container',
                popup: 'swal-wide-popup',
                confirmButton: 'btn btn-success mx-3',
                cancelButton: 'btn btn-danger mx-3'
            },
            buttonsStyling: false
        })

        // SECCION DE CREADO RAPIDO
        window.addEventListener('fastCreateComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: 'Creada',
                html: "¡Agencia registrada exitosamente!",
                icon: 'success',
                timer: 5000
            }).then( () => {
                document.getElementById('fast-form-create').hidden = true
                // window.location.href = '/contactos';
            });
        });
        window.addEventListener('fastDeleteComfirmed', function(){
            swalWithBootstrapButtons.fire({
                position: 'center' ,
                title: '¿Estas seguro?',
                html: "¡Al eliminar la agencia no habrá vuelta atrás!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Borrala',
                cancelButtonText: 'Cancelar',
                timer: 10000
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('delete-basic-entity');

                    swalWithBootstrapButtons.fire(
                        '¡Eliminado!',
                        'La agencia ha sido eliminada de la base de datos.',
                        'success'
                    )
                } else if
                ( result.dismiss === Swal.DismissReason.cancel)
                {
                    swalWithBootstrapButtons.fire(
                        'Cancelado',
                        'La Agencia esta a salvo :)',
                        'error'
                    )
                }

            });
        });
</script>
@endpush()