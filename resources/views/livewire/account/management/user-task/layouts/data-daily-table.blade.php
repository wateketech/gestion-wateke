<div>
    @extends("layouts.table")

    @section('thead-content')
        <tr>
            @forelse ( $users as $user)
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                    {{ $user->name }}
                </th>
            @empty
                <p> nada </p>
            @endforelse
    </tr>
    @endsection


    {{-- @section('tbody-content') --}}
        {{-- Incluir estructura foreach y tas tr-td correspondientes --}}
    {{-- @endsection --}}






    {{-- @section('footer-form')

    @endsection --}}

</div>
