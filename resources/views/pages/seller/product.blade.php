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
              <th>Gambar Produk</th>
              <th>Aksi</th>
            </tr>
            @foreach ($products as $key => $product)
            <tr>
                  <td>{{$key+1}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_price}}</td>
                  <td><img src="{{$product->product_image}}" alt="" srcset="" width="50px" height="30px"></td>
                  <td>
                    <a href="#" class="btn btn-success" id="detailInbox{{$key}}">Detail</a>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('delete-product').submit();" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                    <form id="delete-product" action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: none;">
                      @method('DELETE')
                      @csrf
                    </form>
                    {{-- modal_edit{{$key}} --}}
                    <a href="#" class="btn btn-warning" id="editInbox{{$key}}"><i class="far fa-edit"></i></a>
                    {{-- <button onclick="alert('modal_edit{{$key}}');
                    document.getElementById('modal_edit{{$key}}').classList.toggle('show')"><i class="far fa-edit"></i></button> --}}
                  </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
    <div class="card-footer text-right" modal-part>
      <nav class="d-inline-block">
        <ul class="pagination mb-0">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
          </li>
          <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
          <li class="page-item">
            <a class="page-link" href="#">2</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
          </li>
        </ul>
      </nav>
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
      <form action="
      {{route('product.store')}}
      "
       method="POST" 
      id="form-add-inbox-data" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="store_id" value="{{$store_data->id}}">
        {{-- <input type="text" class="form-control" name="user_id" value="{{Auth::id()}}" hidden>
        <input type="text" class="form-control" name="inbox_origin" value="{{Auth::user()->name}}" hidden> --}}
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="product_name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Harga</label>
            <input type="text" class="form-control" name="product_price">
          </div>
          <div class="form-group col-md-12">
            <label for="">Gambar</label>
          <input type="file" class="form-control-file" name="product_image" accept="image">
          </div>
          {{-- <div class="form-group col-md-6">
            <label for="">Perihal</label>
            <input type="text" class="form-control" name="regarding">
          </div>
          <div class="form-group col-md-6">
            <label for="">Tanggal Surat Diterima</label>
            <input type="date" class="form-control" name="entry_date">
          </div>
          <div class="form-group col-md-6">
            <label for="">Example file input</label>
            <input type="file" class="form-control-file" name="uploadfile">
          </div>
          <div class="form-group col-md-12">
            <label for="">Notes</label>
            <textarea class="form-control" name="notes"></textarea>
          </div> --}}
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