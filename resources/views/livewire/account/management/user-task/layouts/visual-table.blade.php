<div class="card h-100">
    <div class="card-header pb-0">
        <h6>Metricas Generales de 
            <select name="users" id="users" wire:model='selected_user'>
                @foreach ( $users as $user )
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            en el mes de 
            <select name="users" id="users" wire:model='selected_month'>
                {{-- @foreach ( $users as $user ) --}}
                    <option value="">Enero</option>
                    <option value="">Febrero</option>
                    {{-- <option value="{{ $user->id }}">{{ $user->name }}</option> --}}
                {{-- @endforeach --}}
            </select>
        </h6>
    </div>
    <div class="card-body p-3">
        <canvas wire:init='build_user_metrics' wire:ignore id="line-chart-metrics" class="chart-canvas" height="300px"></canvas>
    </div>
</div>

