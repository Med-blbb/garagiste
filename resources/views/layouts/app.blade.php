<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('layouts.partials.head')
    
   
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@include('layouts.partials.main-headerbar')
@include('layouts.partials.main-sidebar')
   <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{asset('assets/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
        </div>
        <script src="{{asset('https://unpkg.com/swiper/swiper-bundle.min.js')}} "></script>
@yield('content')
@include('layouts.partials.footer')
</body>
</html>