<div class="main-content">
    <div class="d-flex justify-content-center my-3 h3 text-dark form-title">
        Formulario para registrar contactos
    </div>

    <div class="container-fluid py-2">
        <div class="row">


                {{-- form steps --}}
                <div class="col-lg-2 py-2 ">

                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'general' ? 'primary-btn-disabled-light' : '' }} {{ in_array("general", $passStep) && $currentStep != 'general' ? 'primary-btn-disabled-dark' : '' }}" id="menu-step-general"> Datos Generales </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'emails' ? 'primary-btn-disabled-light' : '' }}  {{ in_array("emails", $passStep) && $currentStep != 'emails' ? 'primary-btn-disabled-dark' : '' }}"  id="menu-step-emails" > Emails </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'phones' ? 'primary-btn-disabled-light' : '' }}  {{ in_array("phones", $passStep) && $currentStep != 'phones' ? 'primary-btn-disabled-dark' : '' }}"  id="menu-step-phones" > Teléfonos </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'chats' ? 'primary-btn-disabled-light' : '' }}   {{ in_array("chats", $passStep) && $currentStep != 'chats' ? 'primary-btn-disabled-dark' : '' }}"   id="menu-stepchats"   > Mensajerías </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'rrss' ? 'primary-btn-disabled-light' : '' }}    {{ in_array("rrss", $passStep) && $currentStep != 'rrss' ? 'primary-btn-disabled-dark' : '' }}"    id="menu-step-rrss"   > RRSS </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'webs' ? 'primary-btn-disabled-light' : '' }}    {{ in_array("webs", $passStep) && $currentStep != 'webs' ? 'primary-btn-disabled-dark' : '' }}"    id="menu-step-webs"   > WEBS </div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'address' ? 'primary-btn-disabled-light' : ''}}  {{ in_array("address", $passStep) && $currentStep != 'address' ? 'primary-btn-disabled-dark' : '' }}" id="menu-step-address"> Dirección</div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'ocupation' ? 'primary-btn-disabled-light' : ''}}{{ in_array("ocupation", $passStep) && $currentStep != 'ocupation' ? 'primary-btn-disabled-dark' : '' }}" id="menu-step-ocupation">Datos Laborales</div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'more' ? 'primary-btn-disabled-light' : '' }}    {{ in_array("more", $passStep) && $currentStep != 'more' ? 'primary-btn-disabled-dark' : '' }}"    id="menu-step-more"   > Datos Extras</div>
                    <div class="d-lg-block btn btn-primary {{ $currentStep != 'resumen' ? 'primary-btn-disabled-light' : ''}}  {{ in_array("resumen", $passStep) && $currentStep != 'resumen' ? 'primary-btn-disabled-dark' : '' }}" id="menu-step-resumen"> Vista Resumen</div>

                </div>

                {{-- form --}}
                <div class="col-lg-10 py-2">
                    <form wire:submit.prevent="{{ $create_mode ?  'store' : 'update' }}" method='POST' action="#">
                        @csrf
                        <div class="card card-body blur shadow-blur mx-2 my-1 px-4" style="min-height: 35em;">


                            {{-- -------------------------- STEP GENERALS -------------------------- --}}
                            <div class="row {{ $currentStep != 'general' ? 'd-none' : '' }}" id="step-general">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-id-card"></i> &nbsp; Datos generales :</span>
                                    </div>
                                    <div class="z-index-2">
                                    @if ($this->canContinueStep('general'))
                                        <a class="btn btn-outline-primary"
                                            wire:click="continueStep">
                                            <i class="fas fa-share">&nbsp; Falta</i>
                                        </a>
                                    @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        <a class="btn btn-primary" wire:click="stepSubmit_general_next">
                                            <i class="fas fa-angle-double-right"></i>
                                        </a>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.general")

                            </div>
                            {{-- -------------------------- STEP EMAILS -------------------------- --}}
                            <div class="row {{ $currentStep != 'emails' ? 'd-none' : '' }}" id="step-emails">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-envelope"></i> &nbsp; Emails :</span>
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_emails_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('emails'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('emails'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_emails_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_emails_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.emails")

                            </div>
                            {{-- -------------------------- STEP PHONES -------------------------- --}}
                            <div class="row {{ $currentStep != 'phones' ? 'd-none' : '' }}" id="step-phones">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-phone"></i> &nbsp; Télefonos :</span>
                                    </div>
                                    <div class="z-index-2">
                                        @if ($this->canContinueStep('phones'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-primary" wire:click="stepSubmit_phones_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('phones'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_phones_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_phones_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.phones")

                            </div>
                            {{-- -------------------------- STEP CHATS -------------------------- --}}
                            <div class="row {{ $currentStep != 'chats' ? 'd-none' : '' }}" id="step-chats">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-sms"></i> &nbsp; Mensajerías Instantáneas :</span>
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_chats_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('chats'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('chats'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_chats_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_chats_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.chats")

                            </div>
                            {{-- -------------------------- STEP RRSS -------------------------- --}}
                            <div class="row {{ $currentStep != 'rrss' ? 'd-none' : '' }}" id="step-rrss">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-share-alt"></i> &nbsp; Redes Sociales :</span>
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_rrss_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('rrss'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('rrss'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_rrss_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_rrss_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.rrss")

                            </div>
                            {{-- -------------------------- STEP WEBS -------------------------- --}}
                            <div class="row {{ $currentStep != 'webs' ? 'd-none' : '' }}" id="step-webs">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-globe"></i> &nbsp; Sitios Webs :</span>
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_webs_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('webs'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('webs'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_webs_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_webs_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.webs")

                            </div>
                            {{-- -------------------------- STEP ADDRESS -------------------------- --}}
                            <div class="row {{ $currentStep != 'address' ? 'd-none' : '' }}" id="step-address">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        {{-- <span class="font-weight-500 opacity-7"><i class="fas fa-map-marker-alt"></i> &nbsp; Dirección :</span> --}}
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_address_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('address'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('address'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_address_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_address_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.address")

                            </div>
                            {{-- -------------------------- STEP OCCUPATION -------------------------- --}}
                            <div class="row {{ $currentStep != 'ocupation' ? 'd-none' : '' }}" id="step-ocupation">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        <span class="font-weight-500 opacity-7"><i class="fas fa-briefcase"></i> &nbsp; Datos Laborales :</span>
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_ocupation_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        <a class="btn btn-secondary"
                                            wire:click="stepSubmit_ocupation_omit">
                                            <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                        </a>
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.ocupation")

                            </div>
                            {{-- -------------------------- STEP MORE -------------------------- --}}
                            <div class="row {{ $currentStep != 'more' ? 'd-none' : '' }}" id="step-more">
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="h4 text-dark form-title">
                                        {{-- <span class="font-weight-500 opacity-7"><i class="fas fa-id-card"></i> &nbsp; Datos Extras :</span> --}}
                                    </div>
                                    <div class="z-index-2">
                                        <a class="btn btn-primary" wire:click="stepSubmit_more_back">
                                            <i class="fas fa-angle-double-left"></i>
                                        </a>
                                        @if ($this->canContinueStep('more'))
                                            <a class="btn btn-outline-primary"
                                                wire:click="continueStep">
                                                <i class="fas fa-share">&nbsp; Falta</i>
                                            </a>
                                        @endif
                                        <a class="btn btn-outline-danger opacity-8 px-4 mx-1" wire:click="exit">
                                            <i class="fas fa-trash-alt fa-lg"></i>
                                        </a>
                                        @if ($this->canOmitStep('more'))
                                            <a class="btn btn-secondary"
                                                wire:click="stepSubmit_more_omit">
                                                <i class="fas fa-share">&nbsp;&nbsp;Omitir</i>
                                            </a>
                                        @else
                                            <a class="btn btn-primary" wire:click="stepSubmit_more_next">
                                                <i class="fas fa-angle-double-right"></i>
                                            </a>
                                        @endif
                                    </div>
                                </div>

                                @include("livewire.contacts.contacts.layouts.form.more")

                            </div>
                            {{-- -------------------------- STEP RESUMEN -------------------------- --}}
                            <div class="row {{ $currentStep != 'resumen' ? 'd-none' : '' }}" id="step-resumen">

                                @include("livewire.contacts.contacts.layouts.form.resumen")

                                <div>
                                    @if ($create_mode)
                                        <div class="d-flex justify-content-center mt-3">
                                            <a type="button" href="{{ route('crear-contacto') }}" class="btn btn-danger opacity-7 mx-2"><i class="fas fa-sync-alt"></i></a>
                                            <div type="button" wire:click="exit" class="btn btn-secondary mx-2">Descartar cambios</div>
                                            {{-- <button type="submit" class="btn btn-success mx-2">Crear Contacto</button> --}}
                                            <button type="submit" class="btn btn-success mx-2">Crear Contacto</button>
                                        </div>
                                        <div class='px-4 fs-5'>
                                            <sub>
                                                <strong>Nota: </strong>Eventualmente podrá recibir notificaciones a implementaciones y/o actualizaciones de campos nuevos o faltantes al completar la información de contacto.
                                            </sub>
                                        </div>
                                    @endif
                                    @if ($edit_mode)
                                        <div class="d-flex justify-content-center mt-3">
                                            <a type="button" href="{{ route('editar-contacto', ['id' => $contact_id]) }}" class="btn btn-danger opacity-7 mx-2"><i class="fas fa-sync-alt"></i></a>
                                            <div type="button" wire:click="exit" class="btn btn-secondary mx-2">Descartar cambios</div>
                                            {{-- <a type="button" wire:click="update" class="btn btn-success mx-2">Actualizar Contacto</a> --}}
                                            <button type="submit" class="btn btn-success mx-2">Actualizar Contacto</button>
                                        </div>
                                    @endif

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
