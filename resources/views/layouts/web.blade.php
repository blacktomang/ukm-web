@extends('slices.wrapper')
@section('content')
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid oke-nav ">
    @yield('navbar')
  </div>
</nav>
    @yield('main-content')
@endsection