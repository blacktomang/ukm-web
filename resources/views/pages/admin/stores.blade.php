@extends('layouts.seller')
@section('title', 'Admin Dashboard' )
@section('content')
<div class="section-body">
  <div class="card">
    <div class="card-header">
      <h4>Ukm  yang terdaftar</h4>
      <div class="card-header-action">
        <input id="search" type="search" placeholder="Cari UKM" class="form-control">
      </div>
    </div>
    <div class="card-body p-0">
      <div class="table-responsive">
        <table class="table table-striped table-md">
          <tbody>
            <tr>
              <th>No</th>
              <th>Nama Ukm</th>
              <th>Nomor Hp</th>
              <th>Alamat</th>
              <th>Total Produk</th>
              <th>Owner</th>
            </tr>
            @foreach ($stores as $key => $store)
            <tr>
              <td>{{$key+1}}</td>
              <td>{{$store->store_name}}</td>
              <td>{{$store->contact}}</td>
              <td>{{$store->address}}</td>
              <td>{{count($store->products)}}</td>
              <td>{{$store->owner->name}}</td>
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
      {!!$stores->links()!!}
    </div>
  </div>
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
</script>
@endsection