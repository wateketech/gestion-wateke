<div class="card h-100">
    <div class="card-header pb-0 p-3">
        <div class="row">
            <div class="col-md-8 d-flex align-items-center">
                <h6 class="mb-0">Information del perfil</h6>
            </div>
            <div class="col-md-4 text-right">
                <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip"
                        data-bs-placement="top" title="Editar Prerfil"></i>
                </a>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <p class="text-sm">
            {{ auth()->user()->about }}
        </p>
        <hr class="horizontal gray-light my-1">
        <ul class="list-group">
            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nombre:</strong>
                &nbsp; {{ auth()->user()->name }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Rol:</strong>
                &nbsp; {{ auth()->user()->role }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Telefono:</strong>
                &nbsp; {{ auth()->user()->phone }}</li>
            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Correo:</strong>
                &nbsp; {{ auth()->user()->email }}</li>
            <li class="list-group-item border-0 ps-0 pb-0">
                <strong class="text-dark text-sm">RRSS:</strong> &nbsp;
                <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                </a>
                <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                </a>
                <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                </a>
            </li>
        </ul>
    </div>
</div>