<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-primary">
        Formulario para registrar {{ $entity_type == Null ? 'Entidad' : $entity_type->visual_name_p }}
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2">
                    <div id="menu-step-entity_type" class="btn btn-primary d-lg-block {{ $currentStep != 'entity_type' ? 'disabled' : 'text-white' }}">Tipo de Entidad</div>
                    <div id="menu-step-entity_general" class="btn btn-primary d-lg-block {{ $currentStep != 'entity_general' ? 'disabled' : 'text-white' }}">Datos Generales</div>
                    <div id="menu-step-entity_bank_accounts" class="btn btn-primary d-lg-block {{ $currentStep != 'entity_bank_accounts' ? 'disabled' : 'text-white' }}">Datos Bancarios</div>
                    <div id="menu-step-4" class="btn btn-primary d-lg-block {{ $currentStep != 4 ? 'disabled' : 'text-white' }}">Teléfonos y Mensajería</div>
                    <div id="menu-step-5" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">RRSS y WEBS</div>
                    <div id="menu-step-6" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">Datos Extras</div>

                    <div id="menu-step-0" class="btn btn-primary d-lg-block {{ $currentStep != 5 ? 'disabled' : 'text-white' }}">Vista Resumen</div>
                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="store" action="#" method="POST">
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4">
                        {{-- -------------------------- STEP TYPE -------------------------- --}}
                            <div class="row {{ $currentStep != 'entity_type' ? 'd-none' : '' }}" id="step-entity_type">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_entity_type">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.entity.layouts.form.entity_type")

                            </div>

                        {{-- -------------------------- STEP GENERALS -------------------------- --}}
                            <div class="row {{ $currentStep != 'entity_general' ? 'd-none' : '' }}" id="step-entity_general">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_entity_general">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.entity.layouts.form.entity_general")

                            </div>
                        {{-- -------------------------- STEP BANK ACCOUNTS -------------------------- --}}
                            <div class="row {{ $currentStep != 'entity_bank_accounts' ? 'd-none' : '' }}" id="step-entity_bank_accounts">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_entity_bank_accounts">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.entity.layouts.form.entity_bank_accounts")

                            </div>
                        {{-- -------------------------- STEP 4 -------------------------- --}}
                            <div class="row {{ $currentStep != 4 ? 'd-none' : '' }}" id="step-4">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_4">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                paso 4

                            </div>
                        {{-- -------------------------- STEP 0  -------------------------- --}}
                            <div class="row {{ $currentStep != 0 ? 'd-none' : '' }}" id="step-0">

                                <div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a type="button" href="{{ route('entidades') }}" class="btn btn-secondary mx-2">Descartar cambios</a>
                                        <button type="submit" class="btn btn-success mx-2">Crear Entidad</button>
                                    </div>
                                </div>

                            </div>
                        {{-- -------------------------- END - STEPS -------------------------- --}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



</div>



{{-- Sweet Alert Notificaciones --}}
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

        window.addEventListener('ddbb-error', function($event){
            swalWithBootstrapButtons.fire({
                icon: 'error',
                title: 'Oops...',
                timer: 5000,
                text: "Hubo un error al procesar sus datos!",
                footer: "<code> " + $event.detail.code + " : " + $event.detail.message + "</code>"
            }).then(() => {
                window.location.href = "entidades";
            })
        });


</script>
@endpush
