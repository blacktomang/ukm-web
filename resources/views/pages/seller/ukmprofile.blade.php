@extends('layouts.seller')
@section('title', "Edit $store->store_name Dashboard" )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Edit Profil UKM</h4>
    </div>
    <div class="card-body p-0">
      <form action="{{route('stores.update', $store->id)}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
        @method('PATCH')
        @csrf
        <input type="hidden" name="nib" value="{{Auth::user()->email}}">
        <input type="hidden" name="store_id" value="{{$store->id}}">
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" value="{{$store->store_name}}" name="store_name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Deskripsi</label>
            <input type="text" class="form-control" value="{{$store->description}}" name="description">
          </div>
          <div class="form-group col-md-6">
            <label for="">Alamat</label>
            <textarea name="address" class="form-control" id="" cols="30" rows="10">{{$store->address}}</textarea>
          </div>

          <div class="form-group col-md-6">
            <label for="">Kontak</label>
            <input type="text" class="form-control" value="{{$store->contact}}" name="contact">
          </div>
          <div class="form-group col-md-12">
            <label for="">Tambah foto baru</label>
            <div class="m-b-36">
              <div class="alert alert-danger alert-dismissible fade show d-flex justify-content-between" role="alert">
                <span>
                  Pastikan file anda tidak melebihi 2mb(<a target="_blank" href="https://www.reduceimages.com/">Link compress gambar</a>)</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">X</button>
              </div>
              <div class="input-group hdtuto control-group lst increment mb-2">

                <input type="file" name="filenames[]" class="myfrm form-control">

                <div class="input-group-btn">

                  <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>

                </div>

              </div>

              <div class="clone hide mb-2" hidden>

                <div class="hdtuto control-group lst input-group" style="margin-top:10px">

                  <input type="file" name="filenames[]" class="myfrm form-control">

                  <div class="input-group-btn">

                    <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>

                  </div>

                </div>

              </div>
            </div>
          </div>
          <div class="row">
            @foreach ($store_images as $index => $store_image)

            <div class="col-lg-4 col-md-6 mb-4 mb-lg-0 position-relative">
              <img src="{{asset("$store_image->db_address")}}" class="w-100 shadow-1-strong rounded mb-4" alt="" />
              <div class="position-absolute" style="top: 0px;right: 0px;">
                <a href="#" onclick="event.preventDefault(); document.getElementById('delete-product{{$index}}').submit();" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>

              </div>
            </div>
            @endforeach
          </div>
        </div>
        <div class="modal-footer">
          {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> --}}
          <button type="submit" class="btn btn-primary">Submit</button>
        </div>
      </form>
    </div>
  </div>
</div>
@foreach ($store_images as $index =>$store_image)
<form id="delete-product{{$index}}" action="{{route('stores-image.destroy',$store_image->id)}}" method="POST" hidden>
  <input type="hidden" name="_method" value="DELETE">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
</form>
@endforeach
@endsection

@section('script')
<script>
  $('#addInbox').on('click', () => {
    $('#modal_tambah').modal('show')
  });



  var items = $(".hdtuto").length;
  $(document).ready(function() {

    $(".btn-success").click(function() {
      var lsthmtl = $(".clone").html();
      $(".increment").after(lsthmtl);

    });

    $("body").on("click", ".btn-danger", function() {
      $(this).parents(".hdtuto").remove();
    });

  });
</script>
@endsection