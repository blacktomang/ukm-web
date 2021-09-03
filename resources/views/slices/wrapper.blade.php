<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="UKM Desa Tombolo">
  <!-- @yield('title') -->
  <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon">
  <title>@yield('title') | UKM Desa Tombolo</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('customs/custom.css')}}">
</head>

<body style="min-height: 100vh">
    @yield('content')

 @include('slices.footernscript')
</body>
</html>