@section('title', 'Choose Role' )
@extends('layouts.auth')
@section('content')
<div class="d-flex flex-column justify-content-center my-5" style="height: calc(100vh - 4rem);">
  <h2 class="text-center">Pilih tujuan anda mendaftar di Sistem UKM Desa Tombolo</h2>
  {{-- <div class="btn-group-vertical">
    ...
  </div> --}}
  <div class="container w-50 mt-3">
    <form action="{{route('get-role')}}" method="post">
      @csrf
      <div class="card overflow-hidden" onclick="buyer()">
        <div class="card-body row" style="background:white; color:#0093dd ;">
          <div class="col-8">
            <h4>Pembeli</h4>
            <p class="small " style="color: #0093dd;">Dukung UKM Desa Tombolo dengan membeli produk UKM</p>
          </div>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <div class="">
              <i class='bx bxs-cart bx-lg'></i>
            </div>
          </div>
        </div>
      </div>

      <input type="text" name="role" hidden value="buyer">
      <div class="d-grid gap-2">
        <button class="btn btn-primary" type="submit" id="buyer" hidden>haa</button>
      </div>
    </form>
    <form action="{{route('get-role')}}" method="post">
      @csrf
      <div class="card overflow-hidden" onclick="seller()">
        <div class="card-body row" style="background: #0093dd;color: white;">
          <div class="col-8">
            <h4>Penjual</h4>
            <p class="small text-white">Dukung UKM Desa Tombolo dengan memperkenalkan dan memasarkan produk UKM</p>
          </div>
          <div class="col-4 d-flex justify-content-center align-items-center">
            <div class="">
              <i class='bx bxs-dollar-circle bx-lg'></i>
            </div>
          </div>
        </div>
      </div>

      <input type="text" name="role" hidden value="seller">
      <button class="btn btn-primary" id="seller" type="submit" hidden>haa</button>
    </form>

  </div>
</div>
<script>
  function buyer() {
    //  alert('buyer');
    document.getElementById('buyer').click();
  }

  function seller() {
    // alert('seller')
    document.getElementById('seller').click();
  }
</script>
@endsection