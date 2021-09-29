@section('title', 'Register' )
@extends('layouts.auth')
@section('content')
<div class="col container auth-container w-100" style="min-height: 90vh">
  <div class="col-sm-9 col-md-7 col-lg-6 mx-auto">
    <div class="card border-0 shadow rounded-3 my-5">
      <div class="card-body p-4 p-sm-5">
        <h2 class="card-title text-center mb-5 fw-light fs-5">
          Selamat Data di Sistem Pemesanan UKM Desa Bontolo
        </h2>
        <form action="{{route('register.store')}}" method="POST" class="d-flex align-items-center text-center">
          @csrf
          <div class="col">
            <div class="row">
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
            <input type="text" name="role" value="{{$role}}" hidden>
            <div class="mb-3 mb-3 d-flex flex-column align-items-start">
              @if ($role=='seller')
              <label for="formGroupExampleInput" class="form-label">(NIB)No Induk Berusaha</label>
              <input type="text" class="form-control @error('nib') is-invalid @enderror" id="formGroupExampleInput" placeholder="NIB" name="email" value="{{old('email')}}">
              @error('nib')
              <div class="invalid-feedback">
                {{$message}}
              </div>
              @enderror
            </div>
            @else
            <label for="formGroupExampleInput" class="form-label">Email</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="formGroupExampleInput" placeholder="Email" name="email" value="{{old('email')}}">
            @error('email')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          @endif
          <div class="mb-3 mb-3 d-flex flex-column align-items-start">
            <label for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
            @error('password')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="mb-3 mb-3 d-flex flex-column align-items-start">
            <label for="formGroupExampleInput" class="form-label">No Hp</label>
            <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror" id="formGroupExampleInput" name="phoneNumber" placeholder="No Hp / Telepon" value="{{old('phoneNumber')}}">
            @error('phoneNumber')
            <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
          </div>
          <div class="mb-3 mb-3 d-flex flex-column align-items-start">
            <label for="formGroupExampleInput2" class="form-label @error('address') is-invalid @enderror"> Alamat</label>
            <textarea class="form-control @error('address') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Lengkap" name="address" value="{{old('address')}}">{{old('address')}}</textarea>
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
        </form>
      </div>
    </div>
  </div>
</div>
</div>
@endsection