<div class="main-content p-4">

    {{-- ACCIONES  --}}
    <div class="d-flex flex-row justify-content-between mx-4">

        @include('livewire.account.management.layouts.views')

        <div>
            <a class="btn btn-primary btn-lx px-3 mx-1 " href="{{ route('user-management') }}">
                Crear Usuario
            </a>
        </div>

    </div>



    @include('livewire.account.management.layouts.users-list')




    {{-- @livewire('account.management.user-table') --}}

    {{-- <div class="container-fluid ">
        <div class="main-content">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4 mx-0">
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                ID
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Nombre
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Email
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Rol
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Fecha de Creacion
                                            </th>
                                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Acciones
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($users as $user)
                                            <tr>
                                                <td class="ps-4">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->id }}</p>
                                                </td>
                                                <td class="">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->name }}</p>
                                                </td>
                                                <td class="">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->email }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $user->role }}</p>
                                                </td>
                                                <td class="text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        {{ ($user->created_at)->formatLocalized('%e de') }}
                                                        {{__(($user->created_at)->formatLocalized('%B')) }}
                                                        {{ ($user->created_at)->formatLocalized('del %Y') }}
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <a href="#" class="mx-3" data-bs-toggle="tooltip"
                                                        data-bs-original-title="Edit user">
                                                        <i class="fas fa-user-edit text-secondary"></i>
                                                    </a>
                                                    <span>
                                                        <i class="cursor-pointer fas fa-trash text-secondary"></i>
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div> --}}


</div>

