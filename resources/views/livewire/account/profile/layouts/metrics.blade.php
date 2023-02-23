<div class="card">
    <div class="card-header pb-0">
      <h6>Mis metricas</h6>
      <p class="text-sm">
        <i class="fa fa-arrow-up text-success"></i>
        <span class="font-weight-bold">4% more</span> in 2023
      </p>
    </div>
    <div class="card-body p-3">
      <div class="chart">
        <canvas id="line-chart" class="chart-canvas" height="300px"></canvas>
      </div>
    </div>
  </div>


@push('scripts')
<script src="../../assets/js/plugins/chartjs.min.js"></script>



<script type="text/javascript">
  // Line chart




  var ctx1 = document.getElementById("line-chart").getContext("2d");

  new Chart(ctx1, {
    type: "line",
    data: {
      labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
      datasets: [
        {!! html_entity_decode($dataset) !!}
    //   {
    //       label: "Valor Promedio",
    //       tension: 0.4,
    //       borderWidth: 0,
    //       pointRadius: 2,
    //       pointBackgroundColor: "#e3316e",
    //       borderColor: "#e3316e",
    //       borderWidth: 3,
    //       backgroundColor: 'transparent',
    //       data: [50, 50, 300, 220, 500, 250, 400, 230, 500],
    //       maxBarThickness: 6
    //     },
    //     {
    //       label: "Referral",
    //       tension: 0.4,
    //       borderWidth: 0,
    //       pointRadius: 2,
    //       pointBackgroundColor: "#3A416F",
    //       borderColor: "#3A416F",
    //       borderWidth: 3,
    //       backgroundColor: 'transparent',
    //       data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
    //       maxBarThickness: 6
    //     },
    //     {
    //       label: "Direct",
    //       tension: 0.4,
    //       borderWidth: 0,
    //       pointRadius: 2,
    //       pointBackgroundColor: "#17c1e8",
    //       borderColor: "#17c1e8",
    //       borderWidth: 3,
    //       backgroundColor: 'transparent',
    //       data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
    //       maxBarThickness: 6
    //     },
      ],




    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: {
          display: false,
        }
      },
      interaction: {
        intersect: false,
        mode: 'index',
      },
      scales: {
        y: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: false,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            padding: 10,
            color: '#b2b9bf',
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
        x: {
          grid: {
            drawBorder: false,
            display: true,
            drawOnChartArea: true,
            drawTicks: true,
            borderDash: [5, 5]
          },
          ticks: {
            display: true,
            color: '#b2b9bf',
            padding: 10,
            font: {
              size: 11,
              family: "Open Sans",
              style: 'normal',
              lineHeight: 2
            },
          }
        },
      },
    },
  });
</script>

@endpush
