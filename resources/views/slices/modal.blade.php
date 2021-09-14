 <!-- Modal -->
 <div class="modal fade bg-white" id="templatemo_search" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     <div class="w-100 pt-1 mb-5 text-right">
       <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <form action="" method="get" class="modal-content modal-body border-0 p-0">
       <div class="input-group mb-2">
         <input type="text" class="form-control" id="inputModalSearch" name="q" placeholder="Search ...">
         <button type="submit" class="input-group-text bg-success text-light">
           <i class="fa fa-fw fa-search text-white"></i>
         </button>
       </div>
     </form>
   </div>
 </div>
 <!-- Modal user-->
 <div class="modal fade bg-white" data-bs-backdrop="static" id="templatemo_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
     {{-- <div class="w-100 pt-1 mb-5 text-right">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div> --}}
     @if (Auth::check())
     <div class="modal-content modal-body border-0 p-0">
       <button type="button" class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
       @hasrole('seller')
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="#">Profil</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="{{ route('dashboard.index') }}">Dashboard UKM</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#product" onClick="event.preventDefault(); document.getElementById('form-logout').submit()">Logout</a>
         </li>
       </ul>
       @endhasrole
       @hasrole('admin')
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="#">Profil</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="/admin">Dashboard Admin</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#product" onClick="event.preventDefault(); document.getElementById('form-logout').submit()">Logout</a>
         </li>
       </ul>
       @endhasrole
       @hasrole('buyer')
       <ul class="navbar-nav me-auto mb-2 mb-lg-0">
         <li class="nav-item">
           <a class="nav-link active" aria-current="page" href="#">Profil</a>
         </li>
         <li class="nav-item">
           <a class="nav-link" href="#product" onClick="event.preventDefault(); document.getElementById('form-logout').submit()">Logout</a>
         </li>
       </ul>
       @endhasrole
     </div>
     @else
     <form onsubmit="e.preventDefault()" action="{{route('login.store')}}" method="POST" class="modal-content modal-body border-0 p-0">
       <button type="button" class="btn-close mb-2" data-bs-dismiss="modal" aria-label="Close"></button>
       @csrf
       <label for="formGroupExampleInput2" class="form-label">Nama Pengguna</label>
       <input type="text" class="form-control @error('username') is-invalid @enderror" id="formGroupExampleInput2" name="username" placeholder="nama pengguna / username" value="{{old('username')}}">
       @error('username')
       <div class="invalid-feedback">
         {{$message}}
       </div>
       @enderror
       <label for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
       <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
       @error('password')
       <div class="invalid-feedback">
         {{$message}}
       </div>
       @enderror
       <div class="d-grid gap-2 mt-2">
         <button class="btn btn-primary" onclick="e.preventDefault()">Login</button>
       </div>
   </div>
   <div class="mb-3 mb-3 d-flex flex-column align-items-start">
     </form>
     @endif
   </div>
 </div>
 <form action="{{route('logout')}}" id="form-logout" method="POST" hidden>
   @method('POST')
   @csrf
 </form>