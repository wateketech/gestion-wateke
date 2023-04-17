<div>
    @extends("layouts.form")


    @section('header-form')
    <h6 class="mb-2 h5">Programar visitas comerciales</h6>
    @endsection


    @section('body-form')


        <div>
            <form wire:submit.prevent="save" id='metric-form'>

                <div class="mx-3">
                    <div class="row">

                        <div class="col-sm-3 form-group">
                            <label for="agency-visit" class="form-control-label">Agencia *</label>
                            <select class="form-control" name="agency-visit" id="agency-visit"
                                wire:model="agency_visit">
                                @foreach ($agencys as $agency)
                                    <option value="{{$agency->id}}">{{$agency->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-2 form-group">
                            <label for="deaddate-visit" class="form-control-label">Fecha Limite *</label>
                            <input type="datetime-local" class="form-control" name="deaddate-visit" id="deaddate-visit"
                                wire:model="deaddate-visit">
                        </div>

                        <div class="col-sm-3 form-group">
                            <label for="assignedUser-visit" class="form-control-label">Usuario designado *</label>
                            <select class="form-control" name="assignedUser-visit" id="assignedUser-visit"
                                wire:model="assignedUser_visit">
                                @foreach ($users_has_visits as $user)
                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-sm-4 form-group">
                            <label for="about-visit" class="form-control-label">Nota al usuario designado</label>
                            <input class="form-control @error('about-visit')border border-danger rounded-3 @enderror"
                                wire:model.defer="about_visit" name="about-visit" id="about-visit" type="text" placeholder="Mensaje de utilidad al usuario designado">
                                @error('about-visit') <sub class="text-danger">{{ $message }}</sub> @enderror
                        </div>

                    </div>

                </div>

            </form>
        </div>
    @endsection


    @section('footer-form')
        <button type="button" class="btn btn-secondary mx-2" wire:click="refresh">Deshacer</button>
        <button type="button" class="btn btn-success mx-2" wire:click="updateComfirmed">Programar Visita</button>
    @endsection

</div>
