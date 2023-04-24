<div class="main-content p-4">

    <div class="d-flex flex-row justify-content-end pl-4">
        <div>
            <a class="btn text-white btn-success active btn-lx px-3" href="{{ route('crear-agencia-full') }}">
                Registrar Entidad
            </a>
            <a class="btn text-white btn-primary px-3" title="buscar / filtrar">
                <i class="fas fa-search"></i>
            </a>

            {{-- <div name="btn" type="submit" class="btn txt-blanco box-azul btn-md px-3" wire:click='order("asc")' title="ordenar">
                <i class="fas fa-sort-up"></i>
            </div> --}}

        </div>
    </div>

    <div class="row">
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-users opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Grupos de Gestion</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-store-alt opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Agencias Mayoristas</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-store opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Agencias Minoristas</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-glass-cheers opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Restaurantes</h5>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-city opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Grupos Hoteleros</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-hotel opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Hoteles</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-house-user opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Hostales</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-utensils opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Paladares</h5>
                </div>
            </div>
        </div>

    </div>
    <div class="row">

        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-car-side opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Transportistas</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-plane-arrival opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Compañias Aereas</h5>
                </div>
            </div>
        </div>
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-suitcase opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Consolidadores Aéreo</h5>
                </div>
            </div>
        </div>

        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-beer opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Bares</h5>
                </div>
            </div>
        </div>
    </div>



    <div class="row">
        <div class="col-3 p-2">
            <div class="card">
                <div class="card-header mx-auto p-3 text-center">
                    <div class="icon icon-shape icon-lg bg-primary shadow text-center border-radius-lg">
                        <i class="fas fa-folder-open opacity-10" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="card-body pt-0 p-3 text-center">
                    <hr class="horizontal dark my-3">
                    <h5 class="mb-0">Otros</h5>
                </div>
            </div>
        </div>
    </div>
</div>
