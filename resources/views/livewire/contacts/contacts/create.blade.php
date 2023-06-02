<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-dark form-title">
        Formulario para registrar contactos
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2 ">

                    <div id="menu-step-general" class="d-lg-block btn btn-primary {{ $currentStep != 'general' ? 'primary-btn-disabled-light' : '' }} {{ in_array("general", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Generales</div>
                    <div id="menu-step-emails" class="d-lg-block btn btn-primary {{ $currentStep != 'emails' ? 'primary-btn-disabled-light' : '' }} {{ in_array("emails", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Emails</div>
                    <div id="menu-step-phone_chats" class="d-lg-block btn btn-primary {{ $currentStep != 'phone_chats' ? 'primary-btn-disabled-light' : '' }} {{ in_array("phone_chats", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Teléfonos y Mensajería</div>
                    <div id="menu-step-rrss_web" class="d-lg-block btn btn-primary {{ $currentStep != 'rrss_web' ? 'primary-btn-disabled-light' : '' }} {{ in_array("rrss_web", $passStep) ? 'primary-btn-disabled-dark' : '' }}">RRSS y WEBS</div>
                    <div id="menu-step-address" class="d-lg-block btn btn-primary {{ $currentStep != 'address' ? 'primary-btn-disabled-light' : '' }} {{ in_array("address", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Dirección</div>
                    <div id="menu-step-bank_accounts" class="d-lg-block btn btn-primary {{ $currentStep != 'bank_accounts' ? 'primary-btn-disabled-light' : '' }} {{ in_array("bank_accounts", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Bancarios</div>
                    <div id="menu-step-ocupation" class="d-lg-block btn btn-primary {{ $currentStep != 'ocupation' ? 'primary-btn-disabled-light' : '' }} {{ in_array("ocupation", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Laborales</div>
                    <div id="menu-step-more" class="d-lg-block btn btn-primary {{ $currentStep != 'more' ? 'primary-btn-disabled-light' : '' }} {{ in_array("more", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Datos Extras</div>
                    <div id="menu-step-resumen" class="d-lg-block btn btn-primary {{ $currentStep != 'resumen' ? 'primary-btn-disabled-light' : '' }} {{ in_array("resumen", $passStep) ? 'primary-btn-disabled-dark' : '' }}">Vista Resumen</div>
                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="store" action="#" method="POST">
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4" style="min-height: 35em;">

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
                        {{-- -------------------------- STEP EMAILS -------------------------- --}}
                            <div class="row {{ $currentStep != 'emails' ? 'd-none' : '' }}" id="step-emails">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_emails">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.emails")

                            </div>
                        {{-- -------------------------- STEP PHONE AND CHATS -------------------------- --}}
                            <div class="row {{ $currentStep != 'phone_chats' ? 'd-none' : '' }}" id="step-phone_chats">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_phone_chats">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.phone_chats")

                            </div>
                        {{-- -------------------------- STEP RRSS AND WEBS -------------------------- --}}
                            <div class="row {{ $currentStep != 'rrss_web' ? 'd-none' : '' }}" id="step-rrss_web">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_rrss_web">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.rrss_web")

                            </div>
                        {{-- -------------------------- STEP ADDRESS -------------------------- --}}
                            <div class="row {{ $currentStep != 'address' ? 'd-none' : '' }}" id="step-address">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_address">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.address")

                            </div>
                        {{-- -------------------------- STEP BANK ACCOUNTS -------------------------- --}}
                            <div class="row {{ $currentStep != 'bank_accounts' ? 'd-none' : '' }}" id="step-bank_accounts">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 d-flex  justify-content-end ">{{-- center --}}
                                        <div class="btn btn-primary"
                                            wire:click="stepSubmit_bank_accounts">
                                            <i class="fas fa-angle-double-right"></i>
                                        </div>
                                        <div class="btn btn-secondary position-absolute" style="right: 65px;"
                                            wire:click="stepSubmit_bank_accounts_omit">
                                            <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_bank_accounts">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div> --}}




                                @include("livewire.contacts.contacts.layouts.form.bank_accounts")

                            </div>
                        {{-- -------------------------- STEP OCUPATION -------------------------- --}}
                            <div class="row {{ $currentStep != 'ocupation' ? 'd-none' : '' }}" id="step-ocupation">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 d-flex  justify-content-end ">{{-- center --}}
                                        <div class="btn btn-primary"
                                            wire:click="stepSubmit_ocupation">
                                            <i class="fas fa-angle-double-right"></i>
                                        </div>
                                        {{-- <div class="btn btn-secondary position-absolute" style="right: 65px;" --}}
                                        <div class="btn btn-secondary position-absolute"
                                            wire:click="stepSubmit_ocupation_omit">
                                            <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                        </div>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.ocupation")

                            </div>
                        {{-- -------------------------- STEP MORE -------------------------- --}}
                            <div class="row {{ $currentStep != 'more' ? 'd-none' : '' }}" id="step-more">
                                <div class="position-relative">
                                    <div class="position-absolute top-0 end-0 btn btn-primary"
                                        wire:click="stepSubmit_more">
                                        <i class="fas fa-angle-double-right"></i>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.more")

                            </div>
                        {{-- -------------------------- STEP RESUMEN -------------------------- --}}
                            <div class="row {{ $currentStep != 'resumen' ? 'd-none' : '' }}" id="step-resumen">
                                <div class="position-relative">

                                {{-- @include("livewire.contacts.contacts.layouts.form.resumen") --}}

                                <div>
                                    <div class="d-flex justify-content-center mt-3">
                                        <a type="button" href="{{ route('crear-contacto') }}" class="btn btn-danger opacity-7 mx-2"><i class="fas fa-sync-alt"></i></a>
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
