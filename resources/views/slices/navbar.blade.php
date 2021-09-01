<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container-fluid oke-nav ">
    <a class="navbar-brand" href="#">
      <img src="{{asset('logo.png')}}" alt="" height="30px" width="30px">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#product">Produk UKM</a>
        <li class="nav-item">
          <a class="nav-link" href="#">Tentang</a>
        </li>
        @if (Auth::check())
          <div class="dropdown rounded-circle bg-light px-3 d-flex align-items-center">
            {{-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown"
              aria-expanded="false">
              Dropdown button
            </button> --}}
            <div class="rounded-circle bg-light w-100 h-100 d-flex align-items-center" style="cursor: pointer" id="dropdownMenuButton1"
              data-bs-toggle="dropdown" aria-expanded="false">
              {{substr(Auth::user()->name, 0,1)}}
            </div>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
              @hasrole('seller')
              <li><a class="dropdown-item" href="#">Profil</a></li>
              <li><a class="dropdown-item" href="#">Produk Saya</a></li>
              <li><a class="dropdown-item" href="#" onClick="event.preventDefault(); document.getElementById('form-logout').submit()">Logout</a></li>
              @endhasrole
              @hasrole('buyer')
              <li><a class="dropdown-item" href="#">Profil</a></li>
                <li><a class="dropdown-item" href="#"
                    onClick="event.preventDefault(); document.getElementById('form-logout').submit()">Logout</a></li>
              @endhasrole
            </ul>
          </div>
        @else
            <li class="nav-item">
                <a class="nav-link" href="{{route('login.index')}}">Gabung</a>
              </li>
        @endif
      <form action="{{route('logout')}}" id="form-logout" method="POST" hidden>
        @method('POST')
        @csrf
      </form>
      </ul>
    </div>
</nav>