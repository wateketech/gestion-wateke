<div class="card h-100">
    <div class="card-header pb-0">
        <h6>Metricas Generales de 
            <select name="users" id="users" wire:model='selected_user'>
                @foreach ( $users as $user )
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
            en el mes de 
            <select name="months" id="months" wire:model='selected_month'>
                @foreach ( $months as $month )
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            </select>
        </h6>
    </div>
    <div wire:ignore class="card-body p-3">
        <canvas wire:init='build_user_metrics' wire:ignore id="line-chart-metrics" class="chart-canvas" height="300px"></canvas>
    </div>
</div>

