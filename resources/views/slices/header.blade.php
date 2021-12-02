<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta name="description" content="UKM Desa Tombolo">
  <!-- @yield('title') -->
  <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon">
  <title>@yield('title') | UKM Desa Tombolo</title>
  <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
  <!-- <link rel="stylesheet" href="{{asset('assets/css/bootstrap.min.css')}}"> -->

  <link rel="stylesheet" href="{{asset('template/assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{asset('template/assets/css/templatemo.css')}}">
  <link rel="stylesheet" href="{{asset('template/assets/css/custom.css')}}">

  <!-- Load fonts style after rendering the layout styles -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;200;300;400;500;700;900&display=swap">
  <link rel="stylesheet" href="{{asset('template/assets/css/fontawesome.min.css')}}">
  @yield('another-style-sheet')
  <link rel="stylesheet" href="{{asset('customs/custom.css')}}">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@3.6.1/dist/chart.min.js"></script>
</head>
@php
$paths = Request::path();
@endphp

<body @if($paths=="login" ) style="background-color: #00599e;" @endif>