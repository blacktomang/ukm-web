@section('title', 'Produk UKM' )
@extends('layouts.web')
@section('content')
<section class="container py-5">
  <div class="card p-4 d-flex flex-row justify-content-between">
    <div class="d-flex align-items-center">
      <div>
        <div class="h1 text-success text-center"><i class="fas fa-store"></i></div>
      </div>
      <div class="mx-4">
        <h5 style="font-weight: 800;">{{$store->store_name}}</h5>
        <div class="d-flex" style="color:rgba(112, 112, 112, 0.96);">
          <p class="mb-0 text-dark" style="font-weight: 800;">{{$store->description}}</p>
          <div class="d-flex mx-4">
            <span style="color:rgba(112, 112, 112, 0.96);">
              <i class="fas fa-map-marker-alt" style="fill: blue;"></i>
            </span>
            <p class="mx-2 text-dark" style="font-weight: 800;">{{$store->address}}</p>
          </div>
        </div>
      </div>
    </div>
    <div class="d-flex align-items-center">

      <div class="mx-4">
        <div class="d-flex align-items-center">
          <span style="color:rgba(112, 112, 112, 0.96);">
            <i class="fas fa-map-marker-alt" style="fill: blue;"></i>
          </span>
        </div>
        <p class="mx-2 text-dark" style="font-weight: 800;">{{$store->address}}</p>
        <div class="d-flex" style="color:rgba(112, 112, 112, 0.96);">
          <p class="mb-0 text-dark" style="font-weight: 800;">{{$store->description}}</p>
          <div class="d-flex mx-4">
            <span style="color:rgba(112, 112, 112, 0.96);">
              <i class="fas fa-map-marker-alt" style="fill: blue;"></i>
            </span>
            <p class="mx-2 text-dark" style="font-weight: 800;">{{$store->address}}</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection