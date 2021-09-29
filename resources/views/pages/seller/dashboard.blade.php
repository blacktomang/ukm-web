@extends('layouts.seller')
@hasrole('admin')
@section('title', 'Admin Dashboard' )
@endhasrole
@hasrole('seller')
@section('title', 'Seller Dashboard' )
@endhasrole
@section('content')
<div class="section-body">
  <h2 class="section-title">Selamat datang di @hasrole('seller') Seller @endhasrole @hasrole('admin') Admin @endhasrole Panel UKM TOMBOLO</h2>
  <p class="section-lead">Anda login sebagai {{Auth::user()->name}}!</p>
  <div class="card">
    <div class="card-header">
      <h4>Ringkasan Data </h4>
    </div>
    <div class="card-body d-flex justify-content-around">
      <div class="d-flex align-items-center ">
        <div class="rounded-circle bg-primary  p-2"><i style="font-size: 25px;" class="fas fa-inbox text-white"></i>
        </div>
        <div class="d-flex flex-column justify-content-start ml-2">
          <!-- <div> -->
          <p class="lead pb-0 mb-0 font-weight-bold text-primary">{{$products??'0'}}</p>
          <!-- </div> -->
          <div>Produk</div>
        </div>
      </div>
      @hasrole('admin')
      <div class="d-flex align-items-center ">
        <div class="rounded-circle bg-primary p-2">
          <i style="font-size: 25px;" class="fas fa-users text-white"></i>
        </div>
        <div class="d-flex flex-column justify-content-start ml-2">
          <div>
            <p class="lead pb-0 mb-0 font-weight-bold text-primary">{{$users??'0'}}</p>
          </div>
          <div>User</div>
        </div>
      </div>
      <div class="d-flex align-items-center ">
        <div class="rounded-circle bg-primary p-2">
          <i style="font-size: 25px;" class="fas fa-store text-white"></i>
        </div>
        <div class="d-flex flex-column justify-content-start ml-2">
          <div>
            <p class="lead pb-0 mb-0 font-weight-bold text-primary">{{$stores??'0'}}</p>
          </div>
          <div>Ukm</div>
        </div>
      </div>
      @else
      @endhasrole
    </div>
  </div>
</div>
@endsection
@section('script')
{{-- <script>
  console.log("{{$time}}");
var oke = moment("{{$time}}").fromNow(); // 10 years ago
$('#time').text(oke);
</script> --}}
@endsection