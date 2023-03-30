<div>
    @extends("layouts.form")


    @section('header-form')
        <h6 class="mb-2 h5">Asignar métricas a usuario </h6>
    @endsection


    @section('body-form')
        @if (count($tasks) == 0)
            <div class="container">
                <div class="d-flex justify-content-center mb-4">
                    <p class="h3"> necesitas metricas</p>
                </div>
            </div>
        @elseif (count($users) == 0)
            <div class="container">
                <div class="d-flex justify-content-center mb-4">
                    <p class="h3"> necesitas usuarios</p>
                </div>
            </div>
        @else
                <form wire:submit.prevent="save" id='user-metric-form'>

                    <div class="m-3">
                        <div class="row">
                            <div class="col-3 form-group">
                                <label for="user" class="form-control-label">Usuario *</label>
                                <select class="form-control" name="user" id="user"
                                wire:model="user_id">
                                    @foreach ($users as $user)
                                        <option value={{ $user->id }}>{{ $user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-3 form-group">
                                <label for="task" class="form-control-label">Metrica *</label>
                                <select class="form-control" name="task" id="task"
                                wire:model="task_id">
                                    @foreach ($tasks as $task)
                                        <option value={{ $task->id }}>{{ $task->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-3 form-group">
                                <label for="value" class="form-control-label">Valor *</label>
                                <input class="@error('value')border border-danger rounded-3 @enderror form-control" type="text" placeholder="30"
                                    wire:model="value" name="value" id="value">
                                @error('value')
                                    <sub class="text-danger">{{ $message }}</sub>
                                @enderror
                            </div>

                            <div class="col-3 form-group">
                                <label for="manually_time" class="form-control-label">Tiempo *</label>
                                <input class="@error('manually_time')border border-danger rounded-3 @enderror form-control" type="datetime-local"
                                    wire:model='manually_time' name="manually_time" id="manually_time">
                                @error('manually_time')
                                    <sub class="text-danger">{{ $message }}</sub>
                                @enderror
                            </div>

                        </div>
                    </div>


                </form>
        @endif
    @endsection
 

    @section('footer-form')
            <button class="btn btn-secondary mx-2" wire:click="refresh" >Deshacer</button>
            <button class="btn btn-success mx-2" form='user-metric-form'>Asignar Métrica</button>
    @endsection

</div>
