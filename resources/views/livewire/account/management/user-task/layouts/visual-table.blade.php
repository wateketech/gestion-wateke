<div class="card h-100">
  <div class="card-header pb-0">
    <h6>Metricas Generales</h6>
    <p class="text-sm">
      {{-- <i class="fa fa-arrow-up text-success"></i> --}}
      {{-- <span class="font-weight-bold">4% more</span> in 2023 --}}
    </p>
  </div>
  <div class="card-body p-3">
    <div class="chart">
      {{$prueba}}
      <canvas id="line-chart-metrics" class="chart-canvas" height="300px"></canvas>
    </div>
  </div>
</div>



{{-- @push('scripts') --}}
<script type="text/javascript">
  // Line chart

// alert('hola')

</script>

{{-- @endpush --}}

{{-- Visual Table Metrics --}}
{{-- @section('content')




@endsection --}}


