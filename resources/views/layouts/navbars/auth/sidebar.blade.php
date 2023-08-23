<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3"
    id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="align-items-center d-flex m-0 navbar-brand text-wrap" href="{{ route('dashboard') }}">
            <img src="../assets/img/logo-travel.png" class="mx-auto navbar-brand-img h-100" style="transform: scale(1.9)">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto h-auto" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            @include('layouts.navbars.auth.sidebar.dashboard')


            @include('layouts.navbars.auth.sidebar.account')
            @include('layouts.navbars.auth.sidebar.management')

            @include('layouts.navbars.auth.sidebar.contact')
        </ul>
    </div>
    </div>
</aside>
