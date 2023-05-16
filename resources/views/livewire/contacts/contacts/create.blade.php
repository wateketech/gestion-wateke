<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-dark form-title">
        Formulario para registrar contactos
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2">

                    <div id="menu-step-general" class="d-lg-block btn btn-primary {{ $currentStep != 'general' ? 'primary-btn-disabled-light' : '' }} {{ in_array("general", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Generales</div>
                    <div id="menu-step-bank_accounts" class="d-lg-block btn btn-primary {{ $currentStep != 'bank_accounts' ? 'primary-btn-disabled-light' : '' }} {{ in_array("bank_accounts", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Bancarios</div>
                    <div id="menu-step-4" class="d-lg-block btn btn-primary {{ $currentStep != 4 ? 'primary-btn-disabled-light' : '' }}">Teléfonos y Mensajería</div>
                    <div id="menu-step-5" class="d-lg-block btn btn-primary {{ $currentStep != 5 ? 'primary-btn-disabled-light' : '' }}">RRSS y WEBS</div>
                    <div id="menu-step-6" class="d-lg-block btn btn-primary {{ $currentStep != 6 ? 'primary-btn-disabled-light' : '' }}">Datos Extras</div>

                    <div id="menu-step-0" class="d-lg-block btn btn-primary {{ $currentStep != 7 ? 'primary-btn-disabled-light' : '' }}">Vista Resumen</div>
                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="store" action="#" method="POST">
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4">

                        {{-- -------------------------- STEP GENERALS -------------------------- --}}
                            <div class="row {{ $currentStep != 'general' ? 'd-none' : '' }}" id="step-general">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_general">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.general")

                            </div>
                        {{-- -------------------------- STEP BANK ACCOUNTS -------------------------- --}}
                            <div class="row {{ $currentStep != 'bank_accounts' ? 'd-none' : '' }}" id="step-bank_accounts">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_bank_accounts">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.bank_accounts")

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
                                        <a type="button" href="{{ route('contactos') }}" class="btn btn-secondary mx-2">Descartar cambios</a>
                                        <button type="submit" class="btn btn-success mx-2">Crear Contacto</button>
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


        window.addEventListener('coocking-time', function($event){
            let timerInterval
            Swal.fire({
                title: 'Lo estamos cocinando',
                html: 'Esto tomará unos segundos <img class="w-25 m-auto mt-4 mb-2" src="../assets/img/logos/loading.gif">',
                timer: $event.detail.time,
                timerProgressBar: true,
                allowOutsideClick: false,
                backdropOpacity: 0.2,
                showConfirmButton: false,
                showCancelButton: false,
                // allowEscapeKey: false,
                didOpen: () => {
                    console.log();
                    // Swal.showLoading()
                    // const b = Swal.getHtmlContainer().querySelector('b')
                    timerInterval = setInterval(() => {
                        // b.textContent = Swal.getTimerLeft()
                    }, 100)
                },
                willClose: () => {
                    clearInterval(timerInterval)
                }
            })
        });



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
