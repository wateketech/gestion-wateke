<div class="main-content">
<div wire:ignore>




    <div id='menu'>  
        <div class="nav-wrapper position-relative end-0">
            <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                    <li class="nav-item" wire:click="$set('view', 'user')">
                        <a class="nav-link mb-0 px-0 py-1 active " data-bs-toggle="tab" href="javascript:;" role="tab" 
                            aria-controls="overview" aria-selected="true">
                            <span class="ms-1">Usuarios</span>
                        </a>
                    </li>
                    <li class="nav-item" wire:click="$set('view', 'task')">
                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab"
                            aria-controls="teams" aria-selected="false">
                            <span class="ms-1">Tareas</span>
                        </a>
                    </li>
                    <li class="nav-item" wire:click="$set('view', 'user-task')">
                        <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab"
                            aria-controls="dashboard" aria-selected="false">
                            <span class="ms-1">Asignacion de Tareas</span>
                        </a>
                    </li>
            </ul>
        </div>
    </div>
    

</div>


    {{-- <div class="alert alert-secondary mx-4" role="alert">
        <span class="text-white"><strong>Add, Edit, Delete features are not functional!</strong> This is a
            <strong>PRO</strong> feature!
            Click <strong><a href="https://www.creative-tim.com/live/soft-ui-dashboard-pro-laravel" target="_blank"
                    class="text-white">here</a></strong>
            to see the PRO
            product!</span>
    </div> --}}


    {{-- SECCIONES DE LA PAGINA  --}}
    <div class="my-2">
        @if($view === 'user')
            @livewire("account.management.user.user")
        @elseif($view === 'task')
            @livewire("account.management.task.task")
        @elseif($view === 'user-task')
            @livewire("account.management.user-task.user-task")
        @endif
    </div>

    @stack('user-management-scripts')
</div>
