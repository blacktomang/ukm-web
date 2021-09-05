@section('title', 'Produk UKM' )
@extends('layouts.web')
@section('content')

<section class="bg-light">
  <div class="container pb-5">
    <div class="row">
      <div class="col-lg-5 mt-5">
        <div class="card mb-3">
          <img class="card-img img-fluid" src="{{asset($product->product_image)}}" alt="{{$product->product_name}}"
            id="product-detail">
        </div>
      </div>
      <!-- col end -->
      <div class="col-lg-7 mt-5">
        <div class="card">
          <div class="card-body">
            <h1 class="h2">{{$product->product_name}}</h1>
            <p class="h3 py-2">{{$product->product_price}}</p>
            <p class="py-2">
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-warning"></i>
              <i class="fa fa-star text-secondary"></i>
              <span class="list-inline-item text-dark">Rating 4.8 | {{$reviews}} Comments</span>
            </p>
            <ul class="list-inline">
              <li class="list-inline-item">
                <h6>UKM:</h6>
              </li>
              <li class="list-inline-item">
                <p class="text-muted"><strong>{{$stores->store_name}}</strong></p>
              </li>
            </ul>

            <h6>Description:</h6>
            <p>{{$product->description}}</p>

            <form>
              <input type="hidden" name="product-title" value="Activewear">
              <div class="row">
                <div class="col-auto">
                  <ul class="list-inline pb-3">
                    <li class="list-inline-item text-right">
                      Quantity
                      <input type="hidden" name="product-quanity" id="product-quanity" value="1">
                    </li>
                    <li class="list-inline-item"><span class="btn btn-success" id="btn-minus">-</span></li>
                    <li class="list-inline-item"><span class="badge bg-secondary" id="var-value">1</span></li>
                    <li class="list-inline-item"><span class="btn btn-success" id="btn-plus">+</span></li>
                  </ul>
                </div>
              </div>
              <div class="row pb-3">
                <div class="col d-grid">
                  <button type="button" class="btn btn-success btn-lg" name="submit" value="buy"
                    onclick="buy()">Buy</button>
                </div>
              </div>
            </form>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
@section('script')
<script>
  function buy() {
        var quantity = document.getElementById('product-quanity').value;
        var contact = "{{$stores->contact}}".replace('0', '62');
        window.location.replace("https://api.whatsapp.com/send/?phone="+contact+"&text=Hai+admin+UKM+{{$stores->store_name}},+saya+ingin+membeli+{{$product->product_name}}+sejumlah+"+quantity);
      }
</script>
@endsection