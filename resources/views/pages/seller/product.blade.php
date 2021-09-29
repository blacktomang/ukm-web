@extends('layouts.seller')
@section('title', 'Seller Dashboard' )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Data Produk</h4>
      <div class="card-header-action">
        <button class="btn btn-primary" id="addInbox">
          <i class="fas fa-plus"></i>
          <span>Tambah Produk</span>
        </button>
      </div>
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
              <th>Stok</th>
              <th>Gambar Produk</th>
              <th>Rate</th>
              <th>Aksi</th>
            </tr>
            @foreach ($products as $key => $product)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$product->product_name}}</td>
              <td>{{$product->product_price}}</td>
              <td>{{$product->description}}</td>
              <td>{{$product->stocks}}</td>
              <td><img src="{{$product->product_image}}" alt="" srcset="" width="50px" height="30px"></td>
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
                <div class="d-flex justify-content-evenly">
                  <a href="#" onclick="event.preventDefault(); document.getElementById('delete-product').submit();" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                  <form id="delete-product" action="{{route('product.destroy',$product->id)}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form>
                  <a href="{{route('product.edit', $product->id)}}" class="btn btn-warning" id="editInbox{{$key}}"><i class="far fa-edit"></i></a>
                </div>
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
@section('modal')
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="modal_tambah" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-set-resiLabel">Tambah @if(count($products)>0)Product Baru @else Product @endif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('product.store')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="store_id" value="{{$store_data->id}}">
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="product_name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Harga</label>
            <input type="number" class="form-control" name="product_price">
          </div>
          <div class="form-group col-md-6">
            <label for="">Deskripsi Produk</label>
            <input type="text" class="form-control" name="description">
          </div>
          <div class="form-group col-md-6">
            <label for="">Stock</label>
            <input type="number" class="form-control" name="stocks">
          </div>
          <div class="form-group col-md-12">
            <label for="">Gambar</label>
            <input type="file" class="form-control-file" name="product_image" accept="image">
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script>
  $('#addInbox').on('click', () => {
    $('#modal_tambah').modal('show')
  });
</script>
@endsection