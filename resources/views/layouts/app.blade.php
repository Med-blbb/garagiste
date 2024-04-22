<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.head')
   
</head>
<body class="hold-transition sidebar-mini layout-fixed">

@include('layouts.main-headerbar')
@include('layouts.main-sidebar')

@yield('content')
@include('layouts.footer')
</body>

</html>