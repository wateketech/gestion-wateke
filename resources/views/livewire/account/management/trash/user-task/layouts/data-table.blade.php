<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">

                <div class="d-flex flex-row d-flex justify-content-end">
                    <div class="px-2">
                        <label for="task_names" class="form-control-label">Metrica</label>
                        <select class="form-control" name="task_names" id="task_names"
                            wire:model='task_name'>
                            @foreach ( $task_names as $task_name )
                                <option value="{{ $task_name }}">{{ $task_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="px-2">
                        <label for="tableview" class="form-control-label">Vista</label>
                        <select class="form-control" name="tableview" id="tableview"
                            wire:model="tableview" >
                            @foreach ( $tableviews as $view )
                                <option  value="{{ $view }}">{{ $view }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                </div>

            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">

                        {{-- table content  --}}
                        @if (count($users) != 0)
                            @include("livewire.account.management.user-task.layouts.data-table-$tableview")
                        @endif
                    </table>
                </div>
            </div>
            <div class="card-footer pt-4 pb-0">
                <div class="container">
                    <div class="d-flex justify-content-center mb-4">
                        @if (count($users) != 0)
                            @yield('tfooter-content')
                        @else
                            <div class="d-flex justify-content-center mb-4">No hay nada para mostrar mostrar</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




