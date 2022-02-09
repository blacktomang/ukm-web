@section('title', 'Grafik' )
@extends('layouts.web')
@section('content')
<section class="container py-5">
  <div class="card p-4">
  {{-- <div class="card"> --}}
    <div class="card-header">
      <h4>Data Rating dan Klik UKM</h4>
    </div>
    <div class="card-body">
      <canvas id="myChart" width="400" height="100"></canvas>
    </div>
  </div>
</div>
</section>
@endsection
@section('script')

 {{-- <script data-require="c3.js@0.4.11" data-semver="0.4.11"
  src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
 <script data-require="d3@3.5.17" data-semver="3.5.17" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js">
</script> --}}
    <script>
      // $(window).ready(()=>{

     
       php_array = @json($x_y);
       colors = php_array.map(()=>{
         color = Math.floor(Math.random()*16777215).toString(16)
        return "#"+color
      });
      //  var global = Chart.defaults.global;
       var ctx = document.getElementById('myChart').getContext('2d');
      var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
      labels: php_array.map((item)=>item[1]),
      datasets: [{
      label: 'Total rating dan klik UKM',
      data: php_array.map((item)=>item[0]),
      backgroundColor: colors,
      borderColor: colors
      ,
      borderWidth: 1
      }]
      },
      options: {
      scales: {
      x: {
        grid: {
          display: false,
          drawBorder: true,
          drawOnChartArea: true,
          drawTicks: true
        }
      },
      y: {
        grid: {
        display:false,
          drawBorder: false
        },
      }
      }
      }
      });
      // });
    </script>
@endsection