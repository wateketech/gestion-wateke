<div class="main-content p-4">


    <div class="d-flex flex-row justify-content-between mx-4">

        <div>
            <a class="btn text-white btn-secondary px-3 disabled" title="buscar / filtrar">
                <i class="fas fa-search"></i> Buscar / Filtrar
            </a>
        </div>


        <div>
            <a class="btn text-white btn-success active btn-lx px-3" href="{{ route('crear-contacto') }}">
                Crear Contacto
            </a>
        </div>



    </div>


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

    <div class="container-fluid ">
        <div class="row">


            {{-- <div class="col-lg-2 py-2"> --}}
                {{-- @include('livewire.contacts.contacts.layouts.groups-contacts') --}}
            {{-- </div> --}}

            <div class="col-lg-5 py-1">
                @include('livewire.contacts.contacts.list-contacts')
            </div>
            <div class="col-lg-7 py-1">
                @livewire('contacts.contacts.current-contact')
            </div>


        </div>
    </div>
</div>
