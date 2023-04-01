<div class="card">
    <div class="card-header pb-0">
        <h6>Mis Metricas en el mes de 
            <select name="months" id="months" wire:model='selected_month'>
                @foreach ( $months as $month )
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </h6>
        {{-- <p class="text-sm"> --}}
        {{-- <i class="fa fa-arrow-up text-success"></i> --}}
        {{-- <span class="font-weight-bold">4% more</span> in 2023 --}}
        {{-- </p> --}}
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
window.ctx1 = new Chart(document.getElementById("line-chart").getContext("2d"), {
  type: "line",
  data: {
    labels: [ {!! html_entity_decode($days) !!} ],
    datasets: [
      {!! html_entity_decode($dataset) !!}
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

window.addEventListener('update-profile-metrics', function($event){
    let chart = window.ctx1;
    chart.data.labels = [];
    chart.data.datasets = [];
    chart.update();

    chart.data.labels = eval('[' + $event.detail.days + ']');
    chart.data.datasets = eval('[' + $event.detail.dataset + ']');
    chart.update();
});

</script>

@endpush
