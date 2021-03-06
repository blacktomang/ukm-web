@extends('layouts.seller')
@section('title', 'Admin Dashboard' )
@section('content')
<div class="section-body">
  <div class="card" id="table_data">
    <div class="card-header">
      <h4>User di Website Ukm</h4>
      <div class="card-header-action">
        <input id="search" type="search" placeholder="Cari User" class="form-control">
      </div>
    </div>
    <div class="card-body p-0" >
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tbody>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Nomor Hp</th>
              <th>Alamat</th>
              <th>Role</th>
              <th>Action</th>
            </tr>
            @foreach ($users as $key => $user)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$user->name}}</td>
              <td>{{$user->phoneNumber}}</td>
              <td>{{$user->address}}</td>
              <td>{{$user->roles[0]->name}}</td>
              @php
              $role = $user->hasRole("seller")?"seller":"buyer";
              $functionn = "deleteUser(".$user->id.","."'".$role."'".")";
                 echo"<td> <a href='#' onclick=$functionn class='btn btn-danger'><i class='far fa-trash-alt'></i></a>";
                  
              @endphp

              </td>
            </tr>
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
      {!!$users->links()!!}
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
        <h5 class="modal-title" id="modal-set-resiLabel">Tambah @if(count($users)>0)Data Baru @else Data @endif</h5>
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
            <span class="text-white  text-bold font-weight-bold mb-0">Pastikan rasio foto 800x800 pixels agar lebih nyaman dilihat</span>
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

  $(document).ready(function() {
    $("#search").keyup(function() {
      window.location.search = "q=" + $(this).val();
    });
  });

  $('#addInbox').on('click', () => {
    $('#modal_tambah').modal('show')
  });

  function deleteUser(id, role) {
    const URL_NOW = `{{ request()->url() }}`;
    Swal.fire({
        title: 'Yakin?',
        text: role==="seller"?"Menghapus seller akan menghapus semua produk, dan ukm yang dimiliki seller!":"Anda akan menghapus akun pembeli!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Tidak',
        confirmButtonText: 'Ya!'
      })
      .then((result) => {
        if (result.isConfirmed) {
          $(document).ready(function () {
            $("#table_data").LoadingOverlay('show');
          });
          new Promise((resolve, reject) => {
            var url = `/admin/user/${id}`;
            axios.delete(`${url}`)
              .then(({
                data
              }) => {
                Swal.fire({
                  icon: 'success',
                  title: data.message.head,
                  text: data.message.body
                }).then((result)=>{
                  if (result.isConfirmed) {
                   window.location.replace(location.pathname);
                  }
                })
              })
              .catch(err => {
                let data = err.response.data
                Swal.fire({
                  icon: 'error',
                  title: data.message.head,
                  text: data.message.body
                })
              })
          });
          $(document).ready(function(){
            $("#table_data").LoadingOverlay('hide');
          });
        }
      });
  }
</script>
@endsection