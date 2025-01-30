<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- favicon -->
      <link rel="icon" type="image/png" href="{{ asset('backend') }}/assets/images/favicon.jpeg">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/fontawesome.min.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style.css">
      @yield('css')
      <title>@yield('title') | Cahaya Raudhah Cirendang </title>
</head>
<body>

    <!-- start Container Wrapper -->
    <div id="container-wrapper">
        <!-- Dashboard -->
        <div id="dashboard" class="dashboard-container">
            @include('layouts.backend.topbar')
            
            @include('layouts.backend.sidebar')

            @yield('content')
            <!-- Content / End -->
            
            <!-- Copyrights -->
            <div class="copyrights">
               Copyright © {{ date('Y') }} PT Cahaya Raudhah Cirendang. All rights reserveds. Version 1.0.0
            </div>
        </div>
        <!-- Dashboard / End -->
    </div>
    <!-- end Container Wrapper -->
    <!-- *Scripts* -->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.2.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/bootstrap.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/counterup.min.js"></script>
    <script src="{{ asset('backend') }}/assets/js/jquery.slicknav.js"></script>
    <script src="{{ asset('backend') }}/assets/js/dashboard-custom.js"></script>
    @yield('js')
</body>
</html>