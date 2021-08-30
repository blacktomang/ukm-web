@section('title', 'Login' )
@extends('layouts.auth')
@section('main-content')
<div class="container auth-container d-flex mt-4">
  <form action="{{route('login.store')}}" class="d-flex align-items-center text-center">
    <div class="col">
      <div class="row">
        <h2>
          Selamat datang kembali di Sistem Pemesanan UKM Desa Bontolo
        </h2>
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">Nama Lengkap</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Nama Lengkap" name="name">
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label">Nama Pengguna</label>
        <input type="text" class="form-control" id="formGroupExampleInput2" name="username" placeholder="Another input placeholder">
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">Email</label>
        <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Email" name="email">
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
        <input type="password" class="form-control" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput" class="form-label">No Hp</label>
        <input type="text" class="form-control" id="formGroupExampleInput" name="phoneNumber" placeholder="No Hp / Telepon">
      </div>
      <div class="mb-3 mb-3 d-flex flex-column align-items-start">
        <label for="formGroupExampleInput2" class="form-label"> Alamat</label>
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Lengkap" name="address"></textarea>
      </div>
      <div class="d-grid gap-2">
        <button class="btn btn-primary">Daftar</button>
        <div class="d-flex justify-content-between">
          <a href="{{route('choose-role')}}" class="mt-2">Daftar</a>
          <a href="/" class="mt-2">Home</a>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection