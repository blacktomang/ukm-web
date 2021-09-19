@section('title', 'Login' )
@extends('layouts.auth')
@section('content')
<div class="col container auth-container w-100" style="min-height: 90vh">
  <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
    <div class="card border-0 shadow rounded-3 my-5">
      <div class="card-body p-4 p-sm-5">
        <h5 class="card-title text-center mb-5 fw-light fs-5">Selamat datang kembali</h5>
        <form action="{{route('login.store')}}" method="POST" class="d-flex text-center flex-column">
          @csrf
          <!-- <div class="row">
            <h2>
              Selamat datang kembali
            </h2>
          </div> -->
          @if (session()->has('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{session('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif
          @if (session()->has('loginError'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{session('loginError')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
          @endif

          <div class="mb-3 mb-3 d-flex flex-column align-items-start">
            <label for="formGroupExampleInput2" class="form-label small">Nama Pengguna</label>
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="formGroupExampleInput2" name="username" placeholder="nama pengguna / username" value="{{old('username')}}">
            @error('username')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror

          </div>
          <div class="mb-3 mb-3 d-flex flex-column align-items-start">
            <label for="formGroupExampleInput2" class="form-label small">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
            @error('password')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
            <div class="w-100 mt-2">
              <button class="w-100 btn btn-primary">Login</button>
            </div>
        </form>
        <div class="w-100 d-flex justify-content-between">
          <a href="{{route('register.index')}}" class="mt-2">Daftar</a>
          <a href="/" class="mt-2">Home</a>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
@endsection