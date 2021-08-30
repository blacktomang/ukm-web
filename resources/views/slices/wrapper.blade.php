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

<body>
  <div id="app">
    @yield('content')
  </div>
  <footer class="d-flex justify-content-center bg-dark align-items-center">
    <p class="text-light my-4 small">@ 2021 Sistem Pemesanan UKM Desa Tombolo. All Right Reserved.</p>
  </footer>
  <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"></script>
  <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
</body>

</html>