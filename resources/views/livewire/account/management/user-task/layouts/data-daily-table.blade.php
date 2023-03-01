<div>
    {{-- {{ $days }} qwerqwer --}}
    @extends("layouts.table")

    @section('thead-content')
        <tr>
            @foreach ( $users as $user)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    {{ $user->name }}
                </th>
            @endforeach
            <th></th>
        </tr>
    @endsection


    @section('tbody-content')
        @foreach ( $days as $day)
            @if ($day[1] == 'Saturday' || $day[1] == 'Sunday' )
                <tr style="background-color:rgba(116, 112, 112, 0.16)">
            @else
                <tr>
            @endif

                @foreach ( $users as $user)
                <td class="ps-4">
                    <p class="text-xs font-weight-bold mb-0">
                        metr
                    </p>
                </td>
                @endforeach

                <td class="w-10">
                    {{ $day[0] }} : {{ __($day[1]) }}

                </td>
            </tr>
        @endforeach

    @endsection






    {{-- @section('footer-form')

    @endsection --}}

</div>
