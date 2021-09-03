@section('another-style-sheet')
<link rel="stylesheet" href="{{asset('template/assets/css/main.css')}}">
<link rel="stylesheet" href="{{asset('template/assets/css/util.css')}}">
@endsection
@include('slices.header')
@yield('content')
@section('another-sript')
<script src="{{asset('template/assets/js/main.css')}}"></script>
@endsection
@include('slices.footernscript')