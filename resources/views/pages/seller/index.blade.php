@section('title', 'Atur profil UKM' )
@extends('layouts.auth')
<!-- <div class="container">
  <h2>Atur Profil UKM</h2>
  <form method="post" action="{{url('file')}}" enctype="multipart/form-data">
    @csrf
    <label class="small" for="formGroupExampleInput" class="form-label">Nama Lengkap</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" id="formGroupExampleInput" placeholder="Nama Lengkap" name="name" value="{{old('name')}}">
    @error('name')
    <div class="invalid-feedback">
      {{$message}}
    </div>
    @enderror
<div class="mb-3 mb-3 d-flex flex-column align-items-start">
  <label class="small" for="formGroupExampleInput2" class="form-label">Nama Pengguna</label>
  <input type="text" class="form-control @error('username') is-invalid @enderror" id="formGroupExampleInput2" name="username" placeholder="Another input placeholder" value="{{old('username')}}">
  @error('username')
  <div class="invalid-feedback">
    {{$message}}
  </div>
  @enderror
</div>
<div class="mb-3 mb-3 d-flex flex-column align-items-start">
  <label class="small" for="formGroupExampleInput" class="form-label">(NIB)No Induk Berusaha</label>
  <input type="text" class="form-control @error('nib') is-invalid @enderror" id="formGroupExampleInput" placeholder="NIB" name="email" value="{{old('email')}}">
  @error('email')
  <div class="invalid-feedback">
    {{$message}}
  </div>
  @enderror
</div>
<div class="mb-3 mb-3 d-flex flex-column align-items-start">
  <label class="small" for="formGroupExampleInput2" class="form-label">Kata Sandi</label>
  <input type="password" class="form-control @error('password') is-invalid @enderror" id="formGroupExampleInput2" name="password" placeholder="Kata Sandi">
  @error('password')
  <div class="invalid-feedback">
    {{$message}}
  </div>
  @enderror
</div>
<div class="mb-3 mb-3 d-flex flex-column align-items-start">
  <label class="small" for="formGroupExampleInput" class="form-label">No Hp</label>
  <input type="number" class="form-control @error('phoneNumber') is-invalid @enderror" id="formGroupExampleInput" name="phoneNumber" placeholder="No Hp / Telepon" value="{{old('phoneNumber')}}">
  @error('phoneNumber')
  <div class="invalid-feedback">
    {{$message}}
  </div>
  @enderror
</div>
<div class="mb-3 mb-3 d-flex flex-column align-items-start">
  <label class="small" for="formGroupExampleInput2" class="form-label @error('address') is-invalid @enderror"> Alamat</label>
  <textarea class="form-control @error('address') is-invalid @enderror" id="exampleFormControlTextarea1" rows="3" placeholder="Alamat Lengkap" name="address" value="{{old('address')}}">{{old('address')}}</textarea>
  @error('address')
  <div class="invalid-feedback">
    {{$message}}
  </div>
  @enderror
</div>
<div class="input-group hdtuto control-group lst increment">

  <input type="file" name="filenames[]" class="myfrm form-control">

  <div class="input-group-btn">

    <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>

  </div>

</div>

<div class="clone hide" hidden>

  <div class="hdtuto control-group lst input-group" style="margin-top:10px">

    <input type="file" name="filenames[]" class="myfrm form-control">

    <div class="input-group-btn">

      <button class="btn btn-danger" type="button"><i class="fldemo glyphicon glyphicon-remove"></i> Remove</button>

    </div>

  </div>

</div>

<button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
</form>
</div> -->
@section('content')
<div class="limiter">
  <div class="container-login100" style="background-color: #00599e;">
    <div class="wrap-login100 p-l-85 p-r-85 p-t-55 p-b-55">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Sorry!</strong> There were more problems with your HTML input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>

      @endif
      <form action="{{route('stores.store')}}" method="POST" class="login100-form validate-form flex-sb flex-w" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
        <input type="hidden" name="nib" value="{{Auth::user()->email}}">
        <h5 class="card-title text-center mb-5 fw-light fs-5">
          Atur Profil UKM
        </h5>
        @if(Session::has('errorLo'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{Session('errorLo')}}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <label class="small" for="name">
          Nama UKM<br>(ubah jika nama anda berbeda dengan nama UKM)
        </label>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Name is required">
          <input class="input100" type="text" name="name" value="{{Auth::user()->name}}">
          <span class="focus-input100"></span>
        </div>
        <label class="small" for="contact">
          Kontak<br>(ubah jika kontak anda berbeda dengan kontak UKM)
        </label>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Kontak is required">
          <input class="input100" type="text" name="contact" value="{{Auth::user()->phoneNumber}}">
          <span class="focus-input100"></span>
        </div>
        <label class="small" for="address">
          Alamat<br>(ubah jika alamat anda berbeda dengan lokasi UKM)
        </label>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Address is required">
          <textarea name="address" id="" cols="30" rows="10" class="input100">{{Auth::user()->address}}</textarea>
          <span class="focus-input100"></span>
        </div>
        <label class="small" for="description">
          Deskripsi singkat ukm
        </label>
        <div class="wrap-input100 validate-input m-b-36" data-validate="Description is required">
          <textarea name="description" id="" cols="30" rows="10" class="input100"></textarea>
          <span class="focus-input100"></span>
        </div>
        <label class="small" for="filenames[]">
          foto pelaku usaha / dokumentasi ukm
        </label>
        </span>
        <div class="m-b-36">
<div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="small">
                  Pastikan file anda tidak melebihi 2mb(<a target="_blank" href="https://www.reduceimages.com/">Link compress
                    gambar</a>)</span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
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

        <!-- <div class="flex-sb-m w-full p-b-48">
          <div class="contact100-form-checkbox">
            <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
            <label class="label-checkbox100" for="ckb1">
              Remember me
            </label>
          </div>

          <div>
            <a href="#" class="txt3">
              Forgot Password?
            </a>
          </div>
        </div> -->

        <div class="container-login100-form-btn">
          <button class="login100-form-btn">
            oke
          </button>
        </div>

      </form>
    </div>
  </div>
</div>
@endsection
@section('script')
<script type="text/javascript">
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