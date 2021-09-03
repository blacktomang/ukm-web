@section('title', 'Login' )
@extends('layouts.auth')
@section('content')
<div class="col container auth-container d-flex justify-content-center align-items-center" style="min-height: 90vh">
  <form action="{{route('login.store')}}" method="POST" class="d-flex text-center flex-column">
    @csrf
    <div class="row">
      <h2>
        Selamat datang kembali
      </h2>
    </div>
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
      <label for="formGroupExampleInput2" class="form-label">Nama Pengguna</label>
      <input type="text" class="form-control @error('username') is-invalid @enderror" id="formGroupExampleInput2" name="username" placeholder="nama pengguna / username" value="{{old('username')}}">
      @error('username')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror

    </div>
    <div class="mb-3 mb-3 d-flex flex-column align-items-start">
      <label for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
      <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
      @error('password')
      <div class="invalid-feedback">
        {{$message}}
      </div>
      @enderror
      <div class="d-grid gap-2 mt-2">
        <button class="btn btn-primary">Login</button>
      </div>
  </form>
  <div class="w-100 d-flex justify-content-between">
    <a href="{{route('register.index')}}" class="mt-2">Daftar</a>
    <a href="/" class="mt-2">Home</a>
  </div>
</div>
</div>
@endsection