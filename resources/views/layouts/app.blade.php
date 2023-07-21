<x-layouts.base>
    {{-- If the user is authenticated --}}
    @auth()
        {{-- @include('layouts.navbars.auth.sidebar-maxs') --}}
        @include('layouts.navbars.auth.sidebar')
        @include('layouts.navbars.auth.nav')
        {{-- @include('components.plugins.fixed-plugin') --}}
        {{ $slot }}
        <main>
            <div class="container-fluid">
                <div class="row">
                    @include('layouts.footers.auth.footer')
                </div>
            </div>
        </main>
    @endauth

    {{-- If the user is not authenticated (if the user is a guest) --}}
    @guest
        {{-- If the user is on the login page --}}
        @if (!auth()->check() && in_array(request()->route()->getName(),['login'],))
            @include('layouts.navbars.guest.login')
            {{ $slot }}
            <div class="mt-5">
                @include('layouts.footers.guest.with-socials')
            </div>
        @endif
    @endguest

</x-layouts.base>
