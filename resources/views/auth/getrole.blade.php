@section('title', 'Choose Role' )
@extends('layouts.auth')
@section('main-content')
<div class="d-flex flex-column justify-content-center h-100 my-5">
  <h2 class="text-center">Pilih tujuan anda mendaftar di Sistem UKM Desa Tombolo</h2>
  {{-- <div class="btn-group-vertical">
    ...
  </div> --}}
  <div class="container w-50 mt-3">
    <form action="{{route('get-role')}}" method="post">
      @csrf
      <div class="card overflow-hidden" onclick="buyer()">
        <div class="card-body row">
          <div class="col-8">
            <h4>Pembeli</h4>
            <p class="small">Dukung UKM Desa Tombolo dengan membeli produk UKM</p>
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
        <div class="card-body row">
          <div class="col-8">
            <h4>Penjual</h4>
            <p class="small">Dukung UKM Desa Tombolo dengan memperkenalkan dan memasarkan produk UKM</p>
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