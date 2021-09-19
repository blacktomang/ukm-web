@extends('layouts.seller')
@section('title', 'Admin Dashboard' )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Penggagas Ukm</h4>
      <div class="card-header-action">
        <button class="btn btn-primary" id="addInbox">
          <i class="fas fa-plus"></i>
          <span>Tambah Data</span>
        </button>
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tbody>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Quote</th>
              <th>Foto</th>
              <th>Action</th>
            </tr>
            @foreach ($initiators as $key => $initiator)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$initiator->name}}</td>
              <td>{{$initiator->quote}}</td>
              <!-- <td>{{$initiator->photo}}</td> -->
              <td><img src="{{asset($initiator->photo)}}" alt="" srcset="" width="50px" height="30px"></td>
              <td>
                <div class="d-flex justify-content-evenly">
                  <a href="#" onclick="event.preventDefault(); document.getElementById('delete-product').submit();" class="btn btn-danger"><i class="far fa-trash-alt"></i></a>
                  <form id="delete-product" action="{{route('initiators.destroy',$initiator->id)}}" method="POST">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                  </form>
                  <a href="#" onclick="setIndex('{{$initiator->id}}')" class="btn btn-warning" id="editInbox{{$key}}"><i class="far fa-edit"></i></a>
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
        {!!$initiators->links()!!}
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
        <h5 class="modal-title" id="modal-set-resiLabel">Tambah @if(count($initiators)>0)Data Baru @else Data @endif</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{route('initiators.store')}}" method="POST" id="form-add-inbox-data" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="store_id" value="{{$store_data->id??''}}">
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="name">
          </div>
          <div class="form-group col-md-6">
            <label for="">Quote</label>
            <textarea name="quote" id="" cols="30" rows="10" class="form-control"></textarea>
            <!-- <input type="text" class="form-control" name="quote"> -->
          </div>
          <!-- <div class="form-group col-md-6">
            <label for="">Deskripsi Produk</label>
            <input type="text" class="form-control" name="description">
          </div>
          <div class="form-group col-md-6">
            <label for="">Stock</label>
            <input type="number" class="form-control" name="stocks">
          </div> -->
          <div class="form-group col-md-6">
            <label for="">Gambar</label>
            <input type="file" class="form-control-file" name="photo" accept="image">
          </div>
          <div class="form-group col-md-6 bg-primary rounded py-2">
            <span class="text-white  text-bold font-weight-bold mb-0">Pastikan rasio foto 1X1 agar lebih nyaman dilihat</span>
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

<div class="modal fade" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="modal_edit" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal-set-resiLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="" method="POST" id="form-edit-initiator" enctype="multipart/form-data">
        @csrf
        @method("PATCH")
        <div class="modal-body row">
          <div class="form-group col-md-6">
            <label for="">Nama</label>
            <input type="text" class="form-control" name="name" id="name_edit">
          </div>
          <div class="form-group col-md-6">
            <label for="">Quote</label>
            <textarea name="quote" id="quote_edit" cols="30" rows="10" class="form-control"></textarea>
          </div>
          <div class="form-group col-md-6">
            <label for="">Gambar</label>
            <input type="file" class="form-control-file" name="photo" accept="image">
          </div>
          <div class="form-group col-md-6 bg-primary rounded py-2">
            <span class="text-white  text-bold font-weight-bold mb-0">Kosongkan jika tidak ingin mengubah foto</span>
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
  var index = 0;

  function setIndex(id) {
    // index = id;
    // console.log(index);
    var url = "{{route('initiators.show', ":id ")}}";
    url = url.replace(":id", id);
    $.ajax({
      type: 'GET',
      url: url,
      success: function(data) {
        console.log(data);
        $('#modal_edit').modal('show')
        $("#quote_edit").val(data.quote)
        $("#name_edit").val(data.name)
        var formAction = "{{route('initiators.update', ":id")}}";
        formAction = formAction.replace(':id', id);
        $("#form-edit-initiator").attr("action", formAction);
      },
    });
  }
  $('#addInbox').on('click', () => {
    $('#modal_tambah').modal('show')
  });
</script>
@endsection