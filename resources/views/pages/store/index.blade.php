@section('title', 'Produk UKM' )
@extends('layouts.web')
@section('content')
<section class="container py-5">
  <div class="card p-4">
    <!-- <div class="d-flex align-items-center">
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
    <div></div>
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
     -->
    <div class="accordion open accordion-flush" id="accordionFlushExample">
      <div class="row">
        <div class="h1 text-success text-center"><i class="fas fa-store"></i></div>
        <h5 style="font-weight: 800;" class="text-center">{{$store->store_name}}</h5>
        <div class="row mx-auto">
          <p class="small text-center">
            {{$store->description}}
          </p>
          <div class="col text-center bg-success position-relative py-2 rounded">
            <div class="d-flex justify-content-center">
              <div class="col">
                <h5 style="font-weight: 800;" class="text-center text-white">{{count($products)}}</h5>
                <p class="text-center text-white mb-0">Produk</p>
              </div>
              <div class="col">
                <h5 style="font-weight: 800;" class="text-center text-white">Rating</h5>
                <ul class="list-unstyled d-flex justify-content-center text-center">
                  <li>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-warning fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                    <i class="text-muted fa fa-star"></i>
                  </li>
                  <p class="text-center text-white mb-0 ms-2">({{$review_counts}} Review)</p>
                </ul>
              </div>
              <div class="col">
                <h5 style="font-weight: 800;" class="text-center text-white">{{$owner->email}}</h5>
                <p class="text-center text-white mb-0">Nib</p>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingOne">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
            Dokumentasi / Galeri UKM
          </button>
        </h2>
        <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">
            <div class="row">
                @foreach ($store_images as $index => $store_image)
              
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 position-relative">
                  <img src="{{asset("$store_image->db_address")}}" class="w-100 shadow-1-strong rounded mb-4" alt="" />
                  {{-- <div class="position-absolute" style="top: 0px;right: 0px;">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-product{{$index}}').submit();"
                      class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
              
                  </div> --}}
                </div>
                @endforeach
              </div>
          </div>
        </div>
      </div>
      {{-- <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingTwo">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
            Accordion Item #2
          </button>
        </h2>
        <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the
            <code>.accordion-flush</code> class. This is the second item's accordion body. Let's imagine this being filled
            with some actual content.
          </div>
        </div>
      </div>
      <div class="accordion-item">
        <h2 class="accordion-header" id="flush-headingThree">
          <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
            Accordion Item #3
          </button>
        </h2>
        <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
          <div class="accordion-body">Placeholder content for this accordion, which is intended to demonstrate the
            <code>.accordion-flush</code> class. This is the third item's accordion body. Nothing more exciting happening
            here in terms of content, but just filling up the space to make it look, at least at first glance, a bit more
            representative of how this would look in a real-world application.
          </div>
        </div>
      </div> --}}
    </div>
  </div>
</section>
<section class="container py-5">
  <div class="row text-center pt-5 pb-3">
      <div class="col-lg-6 m-auto">
        <h2 class="h2">UKM Lainnya</h2>
      </div>
    </div>
    <div class="row">
      @foreach ($other_stores as $other_store)
      <div class="col-md-6 col-lg-3 pb-5" style="cursor: pointer"
        onclick="window.location.replace('/store/{{$other_store->id}}')">
        <div class="h-100 py-5 services-icon-wap shadow">
          <div class="h1 text-success text-center"><i class="fas fa-store"></i></div>
          <h2 class="h5 mt-4 text-center" style="text-decoration: none">{{$other_store->store_name}}</h2>
          <p class="p mt-1 text-center">{{$other_store->description}}</p>
        </div>
      </div>
      @endforeach
    </div>
</section>
@endsection