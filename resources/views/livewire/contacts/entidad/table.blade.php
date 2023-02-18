<div>
    @extends("layouts.table")

    @section('header-table')
    @endsection

    @section('thead')
        <tr>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre</th>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nombre fiscal</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Num Oficina</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">NIF</th>

            {{-- hacerlo mediante tags --}}
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Minorista</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Central</th>

            {{-- un ver mas.. --}}
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">IATA</th>
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">RP</th>

            <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Observacion</th>
            <th></th>
        </tr>
    @endsection

    @section('tbody')
        @forelse ( $entidades as $entidad )
            <tr>
                <td>
                    {{ $entidad->nombre }}
                </td>

                <td>
                    {{ $entidad->nombre_fiscal }}
                </td>

                <td>
                    {{ $entidad->num_oficina }}
                </td>


                <td>
                    {{ $entidad->nif }}
                </td>

                <td>
                    {{ $entidad->es_minorista }}
                </td>

                <td>
                    {{ $entidad->es_central }}
                </td>

                <td>
                    {{ $entidad->iata }}
                </td>
                <td>
                    {{ $entidad->rp }}
                </td>

                <td>
                    {{ $entidad->observ }}
                </td>


            <td class="align-middle">

                {{-- modo desplegable para las acciones en modo pantalla chica
                <i class="cursor-pointer fa fa-ellipsis-v text-xs"></i> --}}


                <a class="mx-1"> 
                    <i class="cursor-pointer fas fa-info-circle text-secondary ishow"
                        data-bs-toggle="tooltip" title="mostrar"
                        data-bs-original-title="Mostrar">
                    </i>
                </a>

                <a class="mx-1" href='#'>
                    <i class="cursor-pointer fas fa-edit text-secondary iedit"
                    data-bs-toggle="tooltip" title="editar"
                    data-bs-original-title="Editar"></i>
                </a>

                <a class="mx-1">
                    <i class="cursor-pointer fas fa-trash text-secondary idelet"
                    data-bs-toggle="tooltip" title="eliminar"
                    data-bs-original-title="Eliminar"></i>
                </a>

            </td>
        </tr>
        @empty
            @section('footer-table')
            <p> No hay agencias disponibles  &nbsp;&nbsp; <strong>._.</strong> </p>
            @endsection
        @endforelse

    @endsection

    @section('footer-table')
        {{-- {{ $entidades->links() }}      --}}
    @endsection
     
</div>
