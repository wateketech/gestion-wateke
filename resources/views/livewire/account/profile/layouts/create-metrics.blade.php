<div id='createView-metrics'>
    @if($isVisible)

    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6 class="mb-2 h5">Asignar métricas a mi usuario </h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">

                    @if (count($tasks) == 0)
                        <div class="container">
                            <div class="d-flex justify-content-center mb-4">
                                <p class="h3"> necesitas metricas</p>
                            </div>
                        </div>
                    @else
                        <form wire:submit.prevent="save" id='user-metric-form'>

                            <div class="m-3">
                                <div class="row">

                                    <div class="col-3 form-group">
                                        <label for="task" class="form-control-label">Metrica *</label>
                                        <select class="form-control" name="task" id="task"
                                        wire:model="task_id">
                                            @foreach ($tasks as $task)
                                                <option value={{ $task->id }}>{{ $task->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="value" class="form-control-label">Valor *</label>
                                        <input class="@error('value')border border-danger rounded-3 @enderror form-control" type="number" placeholder="30"
                                            wire:model="value" name="value" id="value">
                                        @error('value')
                                            <sub class="text-danger">{{ $message }}</sub>
                                        @enderror
                                    </div>

                                    <div class="col-2 form-group">
                                        <label for="manually_time" class="form-control-label">Tiempo *</label>
                                        <input class="@error('manually_time')border border-danger rounded-3 @enderror form-control" type="datetime-local"
                                            wire:model='manually_time' name="manually_time" id="manually_time">
                                        @error('manually_time')
                                            <sub class="text-danger">{{ $message }}</sub>
                                        @enderror
                                    </div>

                                    <div class="col-5 form-group">
                                        <label for="about" class="form-control-label">Observaciones</label>
                                        <textarea class="@error('about')border border-danger rounded-3 @enderror form-control" placeholder="Notas acerca de la métrica ..."
                                            wire:model.defer='about' name="about" id="about">
                                        </textarea>
                                        @error('about')
                                            <sub class="text-danger">{{ $message }}</sub>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                        </form>
                    @endif


                </div>
                <div class="card-footer pt-4 pb-0">
                    <div class="container">
                        <div class="d-flex justify-content-center mb-4">
                            <button class="btn btn-secondary mx-2" wire:click="$set('isVisible', false)">Deshacer</button>
                            <button class="btn btn-success mx-2" form='user-metric-form'>Asignar Métrica</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    @endif
 </div>
