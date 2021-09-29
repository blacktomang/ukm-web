@extends('layouts.seller')
@section('title', "Edit $product->product_name Dashboard" )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Edit Produk</h4>
    </div>
    <div class="card-body p-0">
      <form action="{{route('product.update', $product->id)}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="store_id" value="{{$product->store_id}}">
        {{-- <input type="text" class="form-control" name="user_id" value="{{Auth::id()}}" hidden>
        <input type="text" class="form-control" name="inbox_origin" value="{{Auth::user()->name}}" hidden> --}}
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" value="{{$product->product_name}}" name="product_name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Harga</label>
            <input type="text" class="form-control" value="{{$product->product_price}}" name="product_price">
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
    {{-- <div class="card-footer text-right" modal-part>
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
    </div> --}}
  </div>
</div>
</div>
@endsection
{{-- @section('modal')
<div class="modal fade" id="modal_tambah" tabindex="-1" role="dialog" aria-labelledby="modal_tambah" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-set-resiLabel">Tambah @if(count($products)>0)Product Baru @else Product @endif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

    </div>
  </div>
</div>
@endsection --}}
@section('script')
<script>
  $('#addInbox').on('click', () => {
    $('#modal_tambah').modal('show')
  });
</script>
@endsection