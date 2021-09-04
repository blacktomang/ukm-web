@section('title', 'Produk UKM' )
@extends('layouts.web')
@section('content')

<!-- Start Categories of The Month -->
<section class="container py-5">
  <div class="row text-center py-3">
    <div class="col-lg-6 m-auto">
      <h1 class="h1">Produk UKM</h1>
      <p>
        Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
        Excepteur sint occaecat cupidatat non proident.
      </p>
    </div>
  </div>
  <div class="row">
    @foreach ($products as $product)
    <div class="col-12 col-md-4 mb-4">
      <div class="card h-100">
        <a href="ukm-product/{{$product->id}}">
          <img src="{{$product->product_image}}" class="card-img-top" alt="...">
        </a>
        <div class="card-body">
          <ul class="list-unstyled d-flex justify-content-between">
            <li>
              <i class="text-warning fa fa-star"></i>
              <i class="text-warning fa fa-star"></i>
              <i class="text-warning fa fa-star"></i>
              <i class="text-muted fa fa-star"></i>
              <i class="text-muted fa fa-star"></i>
            </li>
            <li class="text-muted text-right">{{$product->product_price}}</li>
          </ul>
          <a href="shop-single.html" class="h2 text-decoration-none text-dark">{{$product->product_name}}</a>
          <p class="card-text">
            {{$product->description}}
          </p>
          <p class="text-muted">Reviews ({{$product->reviews}})</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <p class="text-center"><a class="btn btn-success">Lihat semua produk</a></p>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<!-- <section class="bg-light">
  <div class="container py-5">
    <div class="row text-center py-3">
      <div class="col-lg-6 m-auto">
        <h1 class="h1">Produk UKM</h1>
        <p>
          Reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.
          Excepteur sint occaecat cupidatat non proident.
        </p>
      </div>
    </div>
    <div class="row">
      @foreach ($products as $product)
      <div class="col-12 col-md-4 mb-4">
        <div class="card h-100">
          <a href="shop-single.html">
            <img src="{{$product->product_image}}" class="card-img-top" alt="...">
          </a>
          <div class="card-body">
            <ul class="list-unstyled d-flex justify-content-between">
              <li>
                <i class="text-warning fa fa-star"></i>
                <i class="text-warning fa fa-star"></i>
                <i class="text-warning fa fa-star"></i>
                <i class="text-muted fa fa-star"></i>
                <i class="text-muted fa fa-star"></i>
              </li>
              <li class="text-muted text-right">{{$product->product_price}}</li>
            </ul>
            <a href="shop-single.html" class="h2 text-decoration-none text-dark">{{$product->product_name}}</a>
            <p class="card-text">
              {{$product->description}}
            </p>
            <p class="text-muted">Reviews ({{$product->reviews}})</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <p class="text-center"><a class="btn btn-success">Lihat semua produk</a></p>
  </div>
</section> -->
@endsection