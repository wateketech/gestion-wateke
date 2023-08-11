<div class="main-content p-4">



    <div class="d-flex flex-row justify-content-between mx-6">

        <div>
            <a class="btn text-white btn-secondary px-3 disabled" title="vista masiva">
                Vista Masiva
            </a>
            <a class="btn text-white btn-secondary px-3 disabled" title="buscar / filtrar">
                <i class="fas fa-search"></i> Buscar / Filtrar
            </a>
        </div>



        <div>
            <a class="btn text-white btn-success active btn-lx px-3" href="{{ route('crear-entidad') }}">
                Crear Entidad
            </a>
        </div>



    </div>


    @if (isset($route))
        <div class="container-fluid">
            @include('livewire.contacts.entity.contacts')
        </div>
    @else
        <div class="container">
            <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 row-cols-xxl-6">

                @foreach ( $entity_types as $entity )
                    @if ($entity->route == "grupos-hoteleros")
                    @elseif ($entity->route == "cadenas-hoteleras")
                        <div class="col p-2">
                            <div class="card" style="min-height: 170px">
                                <div class="card-header mx-auto p-3 d-flex flex-column justify-content-center text-center">
                                    <a class="icon icon-shape icon-lg shadow text-center border-radius-lg" href="/entidades/grupos-cadenas-hoteleras"
                                        style="background-color: {{ $entity->color }}"
                                        onmouseover="this.style.transform='scale(1.3)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                        {!! html_entity_decode($entity->icon) !!}
                                    </a>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <hr class="horizontal dark my-2">
                                    <h5 class="mb-0">Grupos - Cadenas Hoteleras</h5>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col p-2">
                            <div class="card" style="min-height: 170px">
                                <div class="card-header mx-auto p-3 d-flex flex-column justify-content-center text-center">
                                    <a class="icon icon-shape icon-lg shadow text-center border-radius-lg" href= {{ "/entidades/" . $entity->route}}
                                        style="background-color: {{ $entity->color }}"
                                        onmouseover="this.style.transform='scale(1.3)';"
                                        onmouseout="this.style.transform='scale(1)';">
                                        {!! html_entity_decode($entity->icon) !!}
                                    </a>
                                </div>
                                <div class="card-body pt-0 p-3 text-center">
                                    <hr class="horizontal dark my-2">
                                    <h5 class="mb-0">{{ $entity->visual_name_p }}</h5>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach

            </div>
        </div>
    @endif








</div>
