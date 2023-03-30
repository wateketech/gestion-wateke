<div class="card h-100">

    <button class="my-3 p-3 btn btn-success rounded" wire:click="$emitTo('account.management.user-task.user-task', 'viewCreate-user-metric')">
        Asignar Metrica
    </button>

    <div class="card-body p-3">
        <div class="timeline timeline-one-side">

            @foreach ($last_metrics as $lastm)
                <div class="timeline-block mb-3">
                    <span class="timeline-step">
                        <i class="ni ni-bell-55 text-success text-gradient"></i>
                    </span>

                    <div class="timeline-content">
                        <h4 class="text-dark text-sm font-weight-bold mb-0"> {{ $lastm->value}} &nbsp; {{ $lastm->task}}</h4>
                        <p class="text-secondary text-sm font-weight-bold mb-0">{{ $lastm->username}} | {{ $lastm->useremail}}</p>
                        <p class="text-secondary font-weight-bold text-xs mt-1 mb-0">{{ $lastm->time}}</p>
                    </div>
                    
                </div>
            @endforeach
         
        </div>
    </div>

</div>


