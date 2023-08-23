<li class="nav-item mt-2">
    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">{{ __("Acoount") }}</h6>
</li>

<li class="nav-item">
    <a class="nav-link icon {{ Route::currentRouteName() == 'profile' ? 'active' : '' }}"
        href="{{ route('profile') }}">
        <div class="icon icon-shape icon-sm p-2 shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
            <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. --><path d="M224 256c70.7 0 128-57.3 128-128S294.7 0 224 0 96 57.3 96 128s57.3 128 128 128zm89.6 32h-16.7c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16h-16.7C60.2 288 0 348.2 0 422.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-41.6c0-74.2-60.2-134.4-134.4-134.4z"/></svg>
        </div>
        <span class="nav-link-text ms-1">{{ __("My Profile") }}</span>
    </a>
</li>
