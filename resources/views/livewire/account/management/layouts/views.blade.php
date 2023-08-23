<div>
    <a title="gestion de usuarios" href="{{ route('user-management') }}" class="btn px-3 mx-1
        {{ Route::currentRouteName() == 'user-management' ? 'btn-primary' : 'btn-outline-primary' }}">
        Usuarios
    </a>
    <a title="gestion de roles" href="{{ route('roles-management') }}" class="btn px-3 mx-1
        {{ Route::currentRouteName() == 'roles-management' ? 'btn-primary' : 'btn-outline-primary' }}">
         Roles / Permisos
    </a>
</div>
