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

    <div class="container">
        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xxl-6">

            @foreach ( $entity_types as $entity )
                <div class="col p-2">
                    <div class="card">
                        <div class="card-header mx-auto p-3 text-center">
                            <div class="icon icon-shape icon-lg shadow text-center border-radius-lg"
                                style="background-color: {{ $entity->color }}">
                                {!! html_entity_decode($entity->icon) !!}
                            </div>
                        </div>
                        <div class="card-body pt-0 p-3 text-center">
                            <hr class="horizontal dark my-2">
                            <h5 class="mb-0">{{ $entity->visual_name_p }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>




</div>
