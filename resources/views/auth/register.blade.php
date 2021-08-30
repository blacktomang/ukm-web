@section('title', 'Register' )
@extends('layouts.auth')
@section('main-content')
<div class="container auth-container d-flex mt-4">
  <form action="{{route('register.store')}}" method="POST" class="d-flex align-items-center text-center">
    @csrf
    <div class="col">
      <div class="row">
        <h2>
          Selamat Data di Sistem Pemesanan UKM Desa Bontolo
        </h2>
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" placeholder="Nama Lengkap" name="name" value="{{old('name')}}">
        @error('name')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label">Nama Pengguna</label>
        <input type="text" class="form-control @error('username') is-invalid @enderror" id="formGroupExampleInput2" name="username" placeholder="Another input placeholder" value="{{old('username')}}">
        @error('username')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">Email</label>
        <input type="text" class="form-control @error('email') is-invalid @enderror" id="formGroupExampleInput"
        placeholder="Email" name="email" value="{{old('email')}}">
        @error('email')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
        @error('password')
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2"
        name="password" placeholder="Kata Sandi">
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">No Hp</label>
        <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror" id="formGroupExampleInput"
        name="phoneNumber" placeholder="No Hp / Telepon" value="{{old('phoneNumber')}}">
        @error('phoneNumber')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label @error('address') is-invalid @enderror"> Alamat</label>
        <textarea class="form-control @error('address') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Lengkap"
        name="address" value="{{old('address')}}"></textarea>
        @error('address')
        <div class="invalid-feedback">
          {{$message}}
        </div>
        @enderror
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-primary">Daftar</button>
        <div class="d-flex justify-content-between">
          <a href="{{route('login.index')}}" class="mt-2">Login</a>
          <a href="/" class="mt-2">Home</a>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection