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
              @if (is_double($product["rates"]))
              @for ($i = 0; $i < $product["rates"]; $i++) <i class="text-warning fa fa-star"></i>
                @endfor
                @for ($i = 0; $i < 5 - $product["rates"]; $i++) <i class="fa fa-star"></i>
                  @endfor
                  @else
                  @for ($i = 0; $i < 5; $i++) <i class="fa fa-star"></i>
                    @endfor
                    @endif
                    {{-- <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-warning fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i>
                                <i class="text-muted fa fa-star"></i> --}}
            </li>
            <li class="text-muted text-right">{{$product->product_price}}</li>
          </ul>
          <a @if (Auth::check()) href="ukm-product/{{$product->id}}" @else href="#" data-bs-toggle="modal" data-bs-target="#exampleModal" @endif class="h2 text-decoration-none text-dark">{{$product->product_name}}</a>
          <p class="card-text">
            {{$product->description}}
          </p>
          <p class="text-muted">Reviews ({{$product->reviews}})</p>
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <!-- <p class="text-center"><a class="btn btn-success">Lihat semua produk</a></p> -->
</section>

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ooops!</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Login dulu untuk melihat detail produk</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-success" onclick="window.location.replace('/login')">Login</button>
      </div>
    </div>
  </div>
</div>
@endsection