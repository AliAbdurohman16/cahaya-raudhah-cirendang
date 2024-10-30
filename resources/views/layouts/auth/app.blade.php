<!doctype html>
<html lang="en">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <!-- favicon -->
      <link rel="icon" type="image/png" href="{{ asset('frontend') }}/assets/images/logo-kuning.jpeg">
      <!-- Bootstrap CSS -->
      <link rel="stylesheet" href="{{ asset('backend') }}/assets/css/bootstrap.min.css" media="all">
      <!-- Fonts Awesome CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/all.min.css">
      <!-- google fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,600;0,700;0,800;1,400&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,400&display=swap" rel="stylesheet">
      <!-- Custom CSS -->
      <link rel="stylesheet" type="text/css" href="{{ asset('backend') }}/assets/css/style.css">
      <title>@yield('title') | PT Cahaya Raudhah Cirendang </title>
</head>
<body>

    @yield('content')

    <!-- *Scripts* -->
    <script src="{{ asset('backend') }}/assets/js/jquery-3.2.1.min.js"></script>
    @yield('js')
</body>
</html>