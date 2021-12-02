<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title') | @hasrole('seller')Seller @endhasrole @hasrole('admin')Admin @endhasrole Panel</title>
  <link rel="shortcut icon" href="{{asset('logo.png')}}" type="image/x-icon">
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <link data-require="c3.js@0.4.11" data-semver="0.4.11" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.css" />

  <!-- CSS Libraries -->

  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('ds-template/style.css')}}">
  <link rel="stylesheet" href="{{asset('ds-template/components.css')}}">
</head>

<body>
  @include('sweetalert::alert')
  @include('slices.sidebar')
  <div class="main-wrapper">
    {{-- @include('sweetalert::alert') --}}
    @include('slices.ds-navbar')
    @include('slices.sidebar')
    @php
    $paths = explode('/', Request::path());
    $len = count($paths)-1;
    if (Request::path() != '/') {
    $path = ucfirst($paths[$len]);
    }else {
    $path = 'Dashboard';
    }
    @endphp
    <div class="main-content">
      <section class="section">
        <div class="section-header">
          <h1>@yield('header')</h1>
          <div class="section-header-breadcrumb">
            {{-- @if (url()->full()=='http://127.0.0.1:8000')
                    <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                @else --}}
            <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
            @if (Request::path() != "/")
            @foreach ($paths as $key => $path )
            <div class="breadcrumb-item">{{ucfirst($path)}}</div>
            @endforeach
            @endif
            {{-- @endif --}}
          </div>
        </div>
        @yield('content')
      </section>
    </div>
    {{-- @include('slices.footer') --}}
  </div>
  </div>
  <!-- @include('slices.footernscript') -->
  @yield('modal')
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="{{asset('ds-template/stisla.js')}}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('ds-template/scripts.js')}}"></script>
  <script src="{{asset('ds-template/custom.js')}}"></script>
  @yield('script')

  <!-- Page Specific JS File -->
</body>

</html>