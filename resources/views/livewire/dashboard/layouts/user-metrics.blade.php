<div class="row">
    <div class="col-12">
        <div class="card my-4">
            <div class="card-header pb-0">
                <h1 class="text-start text-xl font-weight-bold opacity-9" >Resumen de metricas por usuario</h1>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        {{-- table content  --}}
                        @if (count($users) != 0)
                            <thead>
                                <col>
                                    <colgroup span="1"></colgroup>
                                    <colgroup span="2"></colgroup>
                                <tr>
                                    <th rowspan="2"></th>
                                    {{-- <th rowspan="2" class="text-center text-x opacity-7">Metricas</th> --}}
                                    @foreach ( $users as $user)
                                        <th colspan="2" scope="colgroup" class="text-center text-uppercase text-xs font-weight-bolder opacity-9">
                                            {{ $user->name }}
                                        </th>
                                    @endforeach
                                </tr>
                                <tr>
                                    @foreach ( $users as $user)
                                        <th class="text-uppercase text-end text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Hoy</th>
                                        <th class="text-uppercase text-start text-secondary text-xxs font-weight-bolder opacity-7" scope="col">Acum</th>
                                    @endforeach
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ( $metrics as $metric)
                                    <tr>
                                        <td class="text-sm text-end">{{ $metric->name }}  :</td>
                                        @foreach ( $users as $user)

                                            {{-- SACAR LOS VALORES DE HOY Y ACTUAL DE LAS METRICAS DE ESTE MES DADO (PARAMETRO) UN USUARIO --}}
                                            {{-- UN METODO PARA GET TODAYVALUE Y OTRO PARA GETACUMVALUE --}}
                                            <td class="text-xs text-end" scope="col">29</td>
                                            <td class="text-xs text-start" scope="col">109</td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>


    {{-- @foreach ( $days as $day)
        @if ($day[1] == 'Saturday' || $day[1] == 'Sunday' )
            <tr style="background-color:rgba(116, 112, 112, 0.16)">
        @else
            <tr>
        @endif

            @foreach ( $users as $user)
            <td class="ps-4">
                <p class="text-xs font-weight-bold mb-0">
                    @if ($day[1] == 'Saturday' || $day[1] == 'Sunday' )
                        @if (count($this->getMetric($day[0], $user->email)) == 0)
                            <p>0</p>
                        @else
                            <p> {{ $this->getMetric($day[0], $user->email)[0]['value'] }} </p>
                        @endif
                    @else
                        @if (count($this->getMetric($day[0], $user->email)) == 0)
                            <p class = "text-danger">0</p>
                        @elseif ($this->getMetric($day[0], $user->email)[0]['value'] < $average )
                            <p class = "text-danger"> {{ $this->getMetric($day[0], $user->email)[0]['value'] }} </p>
                        @elseif ($this->getMetric($day[0], $user->email)[0]['value'] == $average)
                            <p class = "text-warning"> {{ $this->getMetric($day[0], $user->email)[0]['value'] }} </p>
                        @elseif ($this->getMetric($day[0], $user->email)[0]['value'] > $average)
                            <p class = "text-success"> {{ $this->getMetric($day[0], $user->email)[0]['value'] }} </p>
                        @endif
                    @endif

            </td>
            @endforeach

            <td class="w-10">
                {{ $day[0] }} : {{ __($day[1]) }}

            </td>
        </tr>
    @endforeach --}}
                            {{-- </tbody> --}}


                        @endif
                    </table>
                </div>
            </div>
            <div class="card-footer pt-4 pb-0">
                <div class="container">
                    <div class="d-flex justify-content-center mb-4">
                        @if (count($users) != 0)
                            {{-- footer --}}
                        @else
                            <div class="d-flex justify-content-center mb-4">No hay nada para mostrar mostrar</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




