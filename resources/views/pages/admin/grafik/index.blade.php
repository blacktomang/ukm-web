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
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs@0.11.2"></script>
<script src="https://cdn.jsdelivr.net/npm/@tensorflow/tfjs-vis@1.0.2/dist/tfjs-vis.umd.min.js"></script>
<script>
  php_array = @json($x_y);
  php_array2 = @json($p);
  const data = php_array.map((item) => item[0]);
  async function learnLinear(epochs) {
    const model = tf.sequential();
    model.add(tf.layers.dense({
      units: 1,
      inputShape: [1]
    }));
    model.compile({
      loss: 'meanSquaredError',
      optimizer: 'sgd'
    });
    const xs = tf.tensor2d(php_array2, [data.length, 1]);
    const ys = tf.tensor2d(data, [data.length, 1]);

    await model.fit(xs, ys, {
      epochs: epochs,
      callbacks: tfvis.show.fitCallbacks({
          name: 'Training Performance'
        },
        ['loss', 'mse'], {
          height: 200,
          callbacks: ['onEpochEnd']
        }
      )
    });

    return data.map((item) => model.predict(tf.tensor2d([item], [1, 1])).dataSync()[0])
  }
</script>
<script>
  async function draw() {
    php_array = @json($x_y);
    colors = php_array.map(() => {
      color = Math.floor(Math.random() * 16777215).toString(16)
      return "#" + color
    });
    //  var global = Chart.defaults.global;
    const predict = await learnLinear(250);
    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: php_array.map((item) => item[1]),
        datasets: [{
          label: 'Total rating dan klik UKM',
          data: predict,
          backgroundColor: colors,
          borderColor: colors,
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
              drawTicks: true,
            }
          },
          y: {
            grid: {
              display: false,
              drawBorder: false,
              // color: function(context) {
              //   if (context.tick.value > 0) {
              //     return Utils.CHART_COLORS.green;
              //   } else if (context.tick.value < 0) {
              //     return Utils.CHART_COLORS.red;
              //   }

              //   return '#000000';
              // },
            },
          }
        }
      }
    });
  }
  draw();
</script>
@endsection