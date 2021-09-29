@section('title', 'About' )
@extends('layouts.web')
@section('content')
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
<section class="bg-success py-5">
  <div class="container">
    <div class="row align-items-center py-5">
      <div class="col-md-8 text-white">
        <h1>About Us</h1>
        <p>
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
          tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
          quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </p>
      </div>
      <div class="col-md-4">
        <img src="{{asset('logo.png')}}" alt="About Hero" height="150px" width="150px">
      </div>
    </div>
  </div>
</section>
<!-- Close Banner -->

<!-- Start Section -->
<section class="container py-5">
  <div class="row text-center pt-5 pb-3">
    <div class="col-lg-6 m-auto">
      <h1 class="h1">UKM Desa Tombolo</h1>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
        Lorem ipsum dolor sit amet.
      </p>
    </div>
  </div>
  <div class="row">
    @foreach ($stores as $store)
      <div class="col-md-6 col-lg-3 pb-5" style="cursor: pointer" onclick="window.location.replace('/store/{{$store->id}}')">
        <div class="h-100 py-5 services-icon-wap shadow">
          <div class="h1 text-success text-center"><i class="fas fa-store"></i></div>
          <h2 class="h5 mt-4 text-center" style="text-decoration: none">{{$store->store_name}}</h2>
          <p class="p mt-1 text-center" >{{$store->description}}</p>
        </div>
      </div>
    @endforeach
  </div>
</section>
@endsection