<div class="main-content">
    <div class="page-header min-height-300 border-radius-xl mt-4"
        style="background-image: url('../assets/img/wallpapers/wallpaper-2.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-secondary opacity-7"></span>
    </div>
    <div class="card card-body blur shadow-blur mx-4 mt-n6">
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
                        {{ auth()->user()->name}} |  {{ auth()->user()->role}}
                    </h5>
                    <p class="mb-0 font-weight-bold text-sm">
                        {{ auth()->user()->email }}
                    </p>
                </div>
            </div>

         
            
        </div>
    </div>
</div>

{{-- notificaciones --}}

<div class="container-fluid py-2">
    <div class="row">

        <div class="col-lg-4 py-2">
            {{-- informacion del perfil --}}
            @include('livewire.account.profile.layouts.information')            
        </div>

        <div class="col-lg-8 py-2">
            {{-- grafoca de metricas --}}
            @include('livewire.account.profile.layouts.metrics')
        </div>


    </div>
</div>
</div>