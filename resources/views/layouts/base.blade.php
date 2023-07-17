<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    {{--
    <!-- Metas -->
    @if(env('IS_DEMO'))
        <meta  name="keywords" content="creative tim, updivision, html dashboard, laravel, livewire, laravel livewire, alpine.js, html css dashboard laravel, soft ui dashboard laravel, livewire soft ui dashboard, soft ui admin, livewire dashboard, livewire admin, web dashboard, bootstrap 4 dashboard laravel, bootstrap 4, css3 dashboard, bootstrap 4 admin laravel, soft ui dashboard bootstrap 4 laravel, frontend, responsive bootstrap 4 dashboard, soft ui dashboard, soft ui laravel bootstrap 4 dashboard" />
        <meta  name="description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta  itemprop="name" content="Soft UI Dashboard Laravel by Creative Tim & UPDIVISION" />
        <meta  itemprop="description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta  itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/492/original/opt_sd_laravel_thumbnail.jpg" />
        <meta  name="twitter:card" content="product" />
        <meta  name="twitter:site" content="@creativetim" />
        <meta  name="twitter:title" content="Soft UI Dashboard Laravel by Creative Tim & UPDIVISION" />
        <meta  name="twitter:description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta  name="twitter:creator" content="@creativetim" />
        <meta  name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/492/original/opt_sd_laravel_thumbnail.jpg" />
        <meta  property="fb:app_id" content="655968634437471" />
        <meta  property="og:title" content="Soft UI Dashboard Laravel by Creative Tim & UPDIVISION" />
        <meta  property="og:type" content="article" />
        <meta  property="og:url" content="https://www.creative-tim.com/live/vue-argon-dashboard-laravel" />
        <meta  property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/492/original/opt_sd_laravel_thumbnail.jpg" />
        <meta  property="og:description" content="Dozens of handcrafted UI components, Laravel authentication, register & profile editing, Livewire & Alpine.js" />
        <meta  property="og:site_name" content="Creative Tim" />
        <script>
            (function(a,s,y,n,c,h,i,d,e){
                s.className+=' '+y;
                h.start=1*new Date;
                h.end=i=function(){
                    s.className=s.className.replace(RegExp(' ?'+y),'')
                };
                (a[n]=a[n]||[]).hide=h;
                setTimeout(function(){i();h.end=null},c);
                h.timeout=c;
            })(window,document.documentElement,'async-hide','dataLayer',4000,
            {'GTM-K9BGS8K':true});
        </script>
        <script>
            (function(i,s,o,g,r,a,m){
                i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();
                a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;
                m.parentNode.insertBefore(a,m)
            })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
            ga('create', 'UA-46172202-22', 'auto', {allowLinker: true});
            ga('set', 'anonymizeIp', true);
            ga('require', 'GTM-K9BGS8K');
            ga('require', 'displayfeatures');
            ga('require', 'linker');
            ga('linker:autoLink', ["2checkout.com","avangate.com"]);
            </script>
        <script>
            (function(w,d,s,l,i)
                {w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});
                var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';
                j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-NKDMSK6');
        </script>
    @endif
    --}}


    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
        Gestión | Wateke Travel
    </title>
    <!-- Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Color+Emoji&display=swap" rel="stylesheet">
    <!-- Nucleo Icons -->
    {{-- <link href="../assets/css/nucleo-icons.css" rel="stylesheet" /> --}}
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    {{-- <link href="../assets/css/nucleo-svg.css" rel="stylesheet" /> --}}
    <link id="stylesheet" href="../assets/css/font-awesome5.15.3.min.css"/>
    <!-- CSS Files -->
    <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1" rel="stylesheet" />
    <link href="../assets/css/app.css" rel="stylesheet" />
    <!-- Alpine -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Tailwindcss -->
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <!--   Plugins CSS  -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/flag-icon-css@3.5.0/css/flag-icon.min.css" rel="stylesheet" /> --}}
    <link rel="stylesheet" href="../assets/js/plugins/intl-tel-input/css/intlTelInput.css">

    @livewireStyles
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elements = document.querySelectorAll('[data-toggle="tooltip"]');
            elements.forEach(function(element) {
                var tooltip = new bootstrap.Tooltip(element);
                tooltips[element.id] = tooltip;
            });
        });
    </script>
    @yield('styles')
    @stack('styles')

</head>

<body class="g-sidenav-show bg-gray-100">

    {{ $slot }}


    <!--   Plugins JS  -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!--   Core JS Files   -->
    <script type="module" src="../assets/js/app.js"></script>
    <script src="../assets/js/core/popper.min.js"></script>
    <script src="../assets/js/core/bootstrap.min.js"></script>
    {{-- <script src="assets/js/plugins/smooth-scrollbar.min.js"></script> --}}
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="../assets/js/soft-ui-dashboard.js"></script>
    @livewireScripts
    @yield('scripts')
    @stack('scripts')
</body>

</html>
