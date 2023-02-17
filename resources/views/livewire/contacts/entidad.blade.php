<div>
    @extends("layouts.table")

    @section('thead')
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
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">GDS</th>

        <th class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">Observacion</th>
        <th></th>
    @endsection

    @section('tbody')
        <td>
            Nombre
        </td>

        <td>
            Nombre Fiscal asdfasd
        </td>

        <td>
            +32 292829281
        </td>


        <td>
            asdfasdf
        </td>

        <td>
            asdfasdf
        </td>

        <td>
            asdfasdf
        </td>

        <td>
            asdfasdf
        </td>
        <td>
            asdfasdf
        </td>

        <td>
            asdfasdf
        </td>
        <td>
            asdfasdf
        </td>


    <td class="align-middle">

        {{-- modo desplegable para las acciones en modo pantalla chica
        <i class="cursor-pointer fa fa-ellipsis-v text-xs"></i> --}}


        <a class="mx-1" data-bs-toggle="tooltip" title="mostrar contactos"
                data-bs-original-title="Mostrar contactos">
                <i class="cursor-pointer fas fa-info-circle text-secondary ishow"></i>
        </a>

        <a class="mx-1" href='#'>
            <i class="cursor-pointer fas fa-edit text-secondary idelet"
            data-bs-toggle="tooltip" title="editar"
            data-bs-original-title="Editar"></i>
        </a>

        <a class="mx-1">
            <i class="cursor-pointer fas fa-trash text-secondary idelet"
            data-bs-toggle="tooltip" title="eliminar"
            data-bs-original-title="Eliminar"></i>
        </a>

    </td>



    @endsection

</div>
