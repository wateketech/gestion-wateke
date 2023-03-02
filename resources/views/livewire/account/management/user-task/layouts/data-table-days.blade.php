
<thead>
    <tr>
        @foreach ( $users as $user)
            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                {{ $user->name }}
            </th>
        @endforeach
        <th></th>
    </tr>
</thead>


<tbody>
    @foreach ( $days as $day)
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
    @endforeach
</tbody>

