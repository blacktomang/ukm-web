@section('title', 'Beranda' )
@extends('layouts.web')
@section('content')
<!-- Start Banner Hero -->

<div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
    <ol class="carousel-indicators">
    @forelse ($web_banners as $key=> $item)
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="{{$key}}" @if($key==0) class="active" @endif></li>
        @empty
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
        <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        @endforelse
    </ol>        

    <div class="carousel-inner">
        @if (count($web_banners)==0)
        <div class="carousel-item  active">
                  <div class="container">
                      <div class="row p-5">
                          <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                              <img class="img-fluid" src="{{asset('template/assets/img/banner_img_02.jpg')}}" alt="">
                          </div>
                          <div class="col-lg-6 mb-0 d-flex align-items-center">
                              <div class="text-align-left align-self-center">
                                  <h1 class="h1 text-success"><b>Dummi</b></h1>
                                  <h3 class="h2">Dummy Sub Judulu</h3>
                                  <p>
                                     Belum ada Data
                                  </p>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          @else
        @foreach ($web_banners as $index_banner => $web_banner)
        <div class="carousel-item @if($index_banner==0) active @endif">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{$web_banner->image}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left align-self-center">
                            <h1 class="h1 text-success"><b>{{$web_banner->title??""}}</b></h1>
                            <h3 class="h2">{{$web_banner->sub_title??""}}</h3>
                            <p>
                               {{$web_banner->description??""}}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
        @endforeach
        @endif
        <!-- <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{asset('template/assets/img/banner_img_02.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Proident occaecat</h1>
                            <h3 class="h2">Aliquip ex ea commodo consequat</h3>
                            <p>
                                You are permitted to use this Zay CSS template for your commercial websites.
                                You are <strong>not permitted</strong> to re-distribute the template ZIP file in any
                                kind of template collection websites.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="carousel-item">
            <div class="container">
                <div class="row p-5">
                    <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                        <img class="img-fluid" src="{{asset('template/assets/img/banner_img_03.jpg')}}" alt="">
                    </div>
                    <div class="col-lg-6 mb-0 d-flex align-items-center">
                        <div class="text-align-left">
                            <h1 class="h1">Repr in voluptate</h1>
                            <h3 class="h2">Ullamco laboris nisi ut </h3>
                            <p>
                                We bring you 100% free CSS templates for your websites.
                                If you wish to support TemplateMo, please make a small contribution via PayPal or tell
                                your friends about our website. Thank you.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
    </div>
    @if (count($web_banners)>1)
    <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="prev">
        <i class="fas fa-chevron-left"></i>
    </a>
    <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel" role="button" data-bs-slide="next">
        <i class="fas fa-chevron-right"></i>
    </a>
    @endif
</div>
<!-- End Banner Hero -->


<!-- Start Categories of The Month -->
<section class="container py-5">
    <div class="row text-center pt-3">
        <div class="col-lg-6 m-auto">
            <h1 class="h1">Penggagas UKM Desa Tombolo</h1>
            {{-- <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloribus perspiciatis
                magni
                dolorem veritatis dolor quisquam molestias sed incidunt voluptate sapiente.
            </p> --}}
        </div>
    </div>
    <div class="row">
        @foreach ($initiators as $initiator)
        <div class="col-12 col-md-4 p-5 mt-3">
            <a href="#"><img src="{{$initiator->photo}}" class="rounded-circle img-fluid border"></a>
            <h5 class="text-center mt-3 mb-3">{{$initiator->name}}</h5>
            <p class="text-center">{{$initiator->quote}}.</p>
        </div>
        @endforeach
    </div>
</section>
<!-- End Categories of The Month -->


<!-- Start Featured Product -->
<section class="bg-light">
    <div class="container py-5">
        <div class="row text-center py-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">Produk UKM</h1>
                <p>
                  Berikut ini adalah produk-produk UKM Desa Tombolo
                </p>
            </div>
        </div>
        <div class="row">
            @foreach ($products as $product)
            <div class="col-12 col-md-4 mb-4">
                <div class="card h-100">
                    <a  href="ukm-product/{{$product->id}}">
                        <img src="{{$product->product_image}}" class="card-img-top" alt="...">
                    </a>
                    <div class="card-body">
                        <ul class="list-unstyled d-flex justify-content-between">
                            <li>
                                @if (is_double($product["rates"]))
                                    @for ($i = 0; $i < $product["rates"]; $i++)
                                        <i class="text-warning fa fa-star"></i>
                                    @endfor
                                    @for ($i = 0; $i < 5 - $product["rates"]; $i++) <i class="fa fa-star"></i>
                                        @endfor
                                @else
                                    @for ($i = 0; $i < 5; $i++) <i class="fa fa-star"></i>
                                    @endfor
                                @endif
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
        <p class="text-center"><a class="btn btn-success" href="/ukm-products">Lihat semua produk</a></p>
    </div>
</section>
@endsection