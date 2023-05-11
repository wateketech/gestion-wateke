<div class="main-content">

    {{-- <div class="card card-body blur shadow-blur mx-4">
        <div class="row gx-4">
            <div class="col-auto">
                <div class="avatar avatar-xl position-relative">
                    <img src="../assets/img/bruce-mars.jpg" alt="..." class="w-100 border-radius-lg shadow-sm">
                    <a href="javascript:;"
                        class="btn btn-sm btn-icon-only bg-gradient-light position-absolute bottom-0 end-0 mb-n2 me-n2">
                        <i class="fa fa-pen top-0" data-bs-toggle="tooltip" data-bs-placement="top"
                            title="Editar Image"></i>
                    </a>
                </div>
            </div>

            <div class="col-auto my-auto">
                <div class="h-100">
                    <h5 class="mb-1">
                        {{ auth()->user()->name}} |
                        {{ auth()->user()->roles->pluck('name')[0] ?? 'Ningun rol' }}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>



        </div>
    </div> --}}


{{-- notificaciones --}}
{{-- @if(auth()->user()->getRoleNames))

Holaaaaaaaaaaa

@endif --}}

    <div class="container-fluid py-2">
        <div class="row">


            <div class="col-lg-12 py-2">
                <div class="btn btn-primary">Grupos</div>
                <div class="btn btn-primary">Buscar</div>
                <div class="btn btn-primary">Crear</div>
            </div>



            <div class="col-lg-2 py-2">
                {{-- informacion del perfil --}}
                @include('livewire.contacts.contacts.layouts.groups-contacts')
            </div>

            <div class="col-lg-4 py-2">
                {{-- grafica de metricas --}}
                @include('livewire.contacts.contacts.layouts.list-contacts')
            </div>
            <div class="col-lg-6 py-2">
                {{-- grafica de metricas --}}
                @include('livewire.contacts.contacts.layouts.current-contact')
            </div>


        </div>
    </div>
</div>
