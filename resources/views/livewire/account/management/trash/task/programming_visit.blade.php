<div>
    @if (count($agencys) == 0)
        <div class="alert bg-info alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text text-white"><strong>Nota: Necesita agencias para programarle una visita comercial. </strong> <a class="cursor-pointer" href="{{ route('crear-agencia-basic') }}" target="_blank"><i> ir a la creacion de agencias express</i></a></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @elseif (count($users_has_visits) == 0)
        <div class="alert bg-info alert-dismissible fade show" role="alert">
            <span class="alert-icon"><i class="ni ni-like-2"></i></span>
            <span class="alert-text text-white"><strong>Nota: Necesita usuaios a los cuales asignarle la visita. </strong> <i class="cursor-pointer" wire:click="$set('view', 'edit')"> ir a editar las visita </i></span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close" wire:click="refresh">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @else
        @extends("layouts.form")
        @section('header-form')
            <h6 class="mb-2 h5">Programar visitas comerciales</h6>
        @endsection


        @section('body-form')


            <div>
                <form wire:submit.prevent="programming_visit" id='metric-form'>

                    <div class="mx-3">
                        <div class="row">

                            <div class="col-sm-3 form-group">
                                <label for="agency-visit" class="form-control-label">Agencia *</label>
                                <select class="form-control @error('entity_id')border border-danger rounded-3 @enderror" name="agency-visit" id="agency-visit"
                                    wire:model="entity_id">
                                    @foreach ($agencys as $agency)
                                        <option value="{{$agency->id}}">{{$agency->name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-sm-2 form-group">
                                <label for="deaddate-visit" class="form-control-label">Fecha Limite *</label>
                                <input type="datetime-local" class="form-control @error('entity_id')border border-danger rounded-3 @enderror @error('deaddate_visit')border border-danger rounded-3 @enderror" name="deaddate-visit" id="deaddate-visit"
                                    wire:model="deaddate_visit">
                                    @error('deaddate_visit') <sub class="text-danger">{{ $message }}</sub> @enderror
                            </div>

                            <div class="col-sm-3 form-group">
                                <label for="assignedUser-visit" class="form-control-label">Usuario designado *</label>
                                <select class="form-control @error('entity_id')border border-danger rounded-3 @enderror @error('assignedUser_visit')border border-danger rounded-3 @enderror" name="assignedUser-visit" id="assignedUser-visit"
                                    wire:model="assignedUser_visit">
                                    @foreach ($users_has_visits as $user)
                                        <option value="{{$user['id']}}">{{$user['name']}}</option>
                                    @endforeach
                                    @error('assignedUser_visit') <sub class="text-danger">{{ $message }}</sub> @enderror
                                </select>
                            </div>

                            <div class="col-sm-4 form-group">
                                <label for="about-visit" class="form-control-label">Nota al usuario designado</label>
                                <input class="form-control @error('about-visit')border border-danger rounded-3 @enderror"
                                    wire:model.defer="about_visit" name="about-visit" id="about-visit" type="text" placeholder="Mensaje de utilidad al usuario designado">
                                    @error('about_visit') <sub class="text-danger">{{ $message }}</sub> @enderror
                            </div>
                            @error('entity_id') <sub class="text-danger">{{ $message }}</sub> @enderror
                        </div>

                    </div>

                </form>
            </div>
        @endsection


        @section('footer-form')
            <button type="button" class="btn btn-secondary mx-2" >Deshacer</button>
            <button type="submit" class="btn btn-success mx-2" wire:click="programming_visit">Programar Visita</button>
        @endsection
    @endif
</div>
