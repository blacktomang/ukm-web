@extends('layouts.seller')
@section('title', 'Seller Dashboard' )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Data Produk</h4>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tbody>
            <tr>
              <th>No</th>
              <th>Nama Produk</th>
              <th>Harga</th>
              <th>Deskripsi</th>
               <th>Nama Ukm</th>
              <th>Gambar Produk</th>
              <th>Rate</th>
            </tr>
            @foreach ($products as $key => $product)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$product->product_name}}</td>
              <td>{{$product->stores->store_name}}</td> 
              <td>{{$product->product_price}}</td>
              <td>{{$product->description}}</td>
              <td><img src="{{asset($product->product_image)}}" alt="..." width="50px" height="30px"></td>
              <td>
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
                  </li>
                </ul>
              </td>
              <td>
                
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
<div class="card-footer text-right" modal-part>
    <div class="card-footer">
      {!!$products->links()!!}
    </div>
  </div>
  </div>
</div>
</div>
@endsection
