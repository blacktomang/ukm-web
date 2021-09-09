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
          {{-- {{Auth::user()->name}} --}}
        </div>
        <div class="row">
          <div class="card">
            <div class="card-body">
              <div class="pb-3">
                <div class="col">
                  <h5 class="text-primary">Reviews</h5>
                  @php
                  if (Auth::check()) {
                  $isUserComment =false;
                  $isUserRateIt = false;
                  for ($i=0; $i < $count_reviews; $i++) { if (Auth::id()==$reviews[$i]['user_id']) {
                    $isUserComment=true; } } for ($i=0; $i < $count_rates; $i++) { if
                    (Auth::id()==$rates[$i]['user_id']) { $isUserComment=true; } } // contains(Auth::user()->id)
                    }
                    @endphp
                    <div class="col d-grid">
                      @if (!Auth::check())
                      <button type="button" class="btn btn-success btn-lg" name="submit"
                        onclick="window.location.replace('/login')">Login</button>
                      @endif
                      @if (Auth::check() && !$isUserComment && !$isUserRateIt)
                      <form action="{{route('komentReview',$product->id)}}" method="POST">
                        <div class="row">
                          <p class="pt-2 mb-0">
                            <i class="fa fa-star rating-star"></i>
                            <i class="fa fa-star rating-star"></i>
                            <i class="fa fa-star rating-star"></i>
                            <i class="fa fa-star rating-star"></i>
                            <i class="fa fa-star rating-star"></i>
                            <span id="rate-value">0</span>
                          </p>
                          @csrf
                          <input type="hidden" name="rate_value" id="rate-input">
                          {{-- <input type="text" name="review_value">
                      <input type="text" class="form-control " id="formGroupExampleInput2" name="review_value"
                        placeholder="Isikan pendapat anda tentang produk ini" value="">
                    <button type="submit" class="btn btn-success"></button> --}}
                          <div class="input-group mb-3">
                            <input type="text" class="form-control"
                              placeholder="Isikan pendapat anda tentang produk ini"
                              aria-label="Isikan pendapat anda tentang produk ini" aria-describedby="button-addon2" ,
                              name="review_value">
                            <button class="btn btn-outline-success" type="submit" id="button-addon2"><i
                                class="fab fa-telegram-plane"></i></button>
                          </div>
                        </div>
                      </form>
                      @endif
                    </div>
                    @if (!$count_reviews>0)
                    <h6>Belum ada komen</h6>
                    @else
                    <div class="my-2">
                      @foreach ($comments as $comment)
                      <div class="mb-4">
                        <div class="d-flex flex-row align-items-center commented-user">
                          <h5 class="mr-2">{{$comment["user_name"]}}</h5><span
                            style="font-size:.5em; margin:0 .5rem;"><i class="fas fa-circle"></i></span><span
                            class="mb-1 ml-2 small">{{$comment["time"]}}</span>
                        </div>
                        <div class="small"><span>{{$comment["comment"]}}</span></div>
                        @if ($comment["user_id"] == Auth::id())
                        <a href="#" class="btn btn-warning mt-1" data-bs-toggle="modal" data-bs-target="#editModal" onclick="okee()">
                          <i class="far fa-edit "></i>
                        </a>
                        @endif
                      </div>
                      @endforeach
                    </div>
                    @endif
                </div>
              </div>
            </div>
          </div>
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
              <span class="list-inline-item text-dark">Rating 4.8 | {{$count_reviews}} Comments</span>
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
                  <button type="button" class="btn btn-success btn-lg" name="submit" @if (Auth::check()) value="buy"
                    onclick="buy()" @else href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                    @endif>Buy</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ooops!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <p>Login dulu untuk membeli produk</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" onclick="window.location.replace('/login')">Login</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{route('editCommentReview',$product->id)}}" method="POST">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Edit Komen dan Rating</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="row">
              <p class="pt-2 mb-0">
                <i class="fa fa-star rating-star"></i>
                <i class="fa fa-star rating-star"></i>
                <i class="fa fa-star rating-star"></i>
                <i class="fa fa-star rating-star"></i>
                <i class="fa fa-star rating-star"></i>
                <span id="rate-value">0</span>
              </p>
              @csrf
              <input type="hidden" name="rate_value" id="rate-input">
                                {{-- <input type="text" class="form-control " id="formGroupExampleInput2" name="review_value"
                                  placeholder="Isikan pendapat anda tentang produk ini" value=""> --}}
                              {{-- <button type="submit" class="btn btn-success"></button> --}} 
              <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Isikan pendapat anda tentang produk ini"
                  aria-label="Isikan pendapat anda tentang produk ini" aria-describedby="button-addon2" , name="review_value">
                <button class="btn btn-outline-success" type="submit" id="button-addon2"><i
                    class="fab fa-telegram-plane"></i></button>
              </div>
            </div>
          </div>
        </form> 
        </div> 
        <input type="hidden" name="isEdit" id="isEdit">
      </div>
    </div>
</section>
@endsection
@section('script')
<script>
  var star = document.getElementsByClassName('rating-star');
      var rateValue = document.getElementById("rate-value");
      var rateInput = document.getElementById("rate-input");
      star[0].addEventListener("click",function(){
      reset();
      for (let i = 0; i < 1; i++) { if(star[i].classList.contains('text-warning')){ star[i].classList.remove('text-warning')
        }else{ star[i].classList.add('text-warning'); rateValue.innerText=i+1; rateInput.value=i+1; } }});

        star[1].addEventListener("click",function(){ reset(); for (let i=0; i < 2; i++) {
        if(star[i].classList.contains('text-warning')){ star[i].classList.remove('text-warning') }else{
        star[i].classList.add('text-warning'); rateValue.innerText=i+1; rateInput.value=i+1; } }});

        star[2].addEventListener("click",function(){ reset(); for (let i=0; i < 3; i++) {
        if(star[i].classList.contains('text-warning')){ star[i].classList.remove('text-warning') }else{
        star[i].classList.add('text-warning'); rateValue.innerText=i+1; rateInput.value=i+1; } }});

        star[3].addEventListener("click",function(){ reset(); for (let i=0; i < 4; i++) {
        if(star[i].classList.contains('text-warning')){ star[i].classList.remove('text-warning') }else{
        star[i].classList.add('text-warning'); rateValue.innerText=i+1; rateInput.value=i+1; } }});

        star[4].addEventListener("click",function(){ reset(); for (let i=0; i < 5; i++) {
        if(star[i].classList.contains('text-warning')){ star[i].classList.remove('text-warning') }else{
        star[i].classList.add('text-warning'); rateValue.innerText=i+1; rateInput.value=i+1; } }});
         function reset() {
           for (let i=0; i < star.length; i++) 
           { 
             star[i].classList.remove('text-warning');
              } 
            }
</script>

@endsection