@section('title', 'Grafik' )
@extends('layouts.seller')
@section('content')
<div class="section-body">
  <div class="card">
   <div id="chart2"></div>
  </div>
</div>

@endsection
@section('script')
 <script data-require="c3.js@0.4.11" data-semver="0.4.11"
  src="https://cdnjs.cloudflare.com/ajax/libs/c3/0.4.11/c3.js"></script>
 <script data-require="d3@3.5.17" data-semver="3.5.17" src="https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.17/d3.js">
</script>
<script src="https://cdn.jsdelivr.net/npm/regression@2.0.1/dist/regression.min.js"></script>
    {{-- <script>
       php_array = <?php echo json_encode($x_y); ?>;
       js_array = [];
       php_array.forEach(element => {
         js_array.push({x:Number(element.x), y:Number(element.y)});
       });
      //  console.log(php_array instanceof Array)
      //  console.log(php_array)
      //  console.log(typeof js_array)
      // console.log(js_array)
      //  ephp_array = php_array;
      // $(window).ready(()=>{
      //   const my_regression = regression.linear(
      //   js_array
      //   );
      //   console.log(my_regression);
      // });
      
    </script> --}}
    <script>
      php_array = @json($x_y);
      var chart = c3.generate({
      bindto: '#chart2',
      data: {
        json:php_array,
        keys:{value:['x','y']}
      },
      axis: {
      y: {
      label: {
      text: "Average grade",
      position: "outer-middle"
      },
      min: 1,
      max: 9
      },
      x: {
      label: {
      text: "Access grade PAU",
      position: "outer-center"
      },
      min: 1,
      max: 10
      }
      },
      size: {
      height: 400,
      width: 800
      },
      zoom: {
      enabled: true
      },
      legend: {
      show: true,
      position: 'inset',
      inset: {
      anchor: 'top-right',
      x: 20,
      y: 300,
      step: 1
      }
      }
      });
      
      setTimeout(() => {
      var points = chart.data()[0].values.map((d) => [d.x, d.value]),
      slopeIntercept = slopeAndIntercept(points),
      fitPoints = chart.data()[0].values.map((d) => slopeIntercept.slope * d.x + slopeIntercept.intercept);
      
      chart.load({
      columns: [
      ['Regression'].concat(fitPoints)
      ],
      type: 'line'
      })
      }, 200);
      
      slopeAndIntercept = function(points) {
      var rV = { },
      N = points.length,
      sumX = 0,
      sumY = 0,
      sumXx = 0,
      sumYy = 0,
      sumXy = 0;
      
      // can't fit with 0 or 1 point
      if (N < 2) { return rV; } for (var i=0; i < N; i++) { var x=points[i][0], y=points[i][1]; sumX +=x; sumY +=y; sumXx +=(x
        * x); sumYy +=(y * y); sumXy +=(x * y); } 
        // calc slope and intercept 
        rV['slope']=((N * sumXy) - (sumX * sumY)) / (N *
        sumXx - (sumX * sumX)); rV['intercept']=(sumY - rV['slope'] * sumX) / N; rV['rSquared']=Math.abs((rV['slope'] * (sumXy
        - (sumX * sumY) / N)) / (sumYy - ((sumY * sumY) / N))); 
        return rV; }
      console.log(php_array)
    </script>
@endsection