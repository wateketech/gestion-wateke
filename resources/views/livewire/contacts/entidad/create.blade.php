
        <div class="card card-body blur shadow-blur mx-4 my-1">
            @include('livewire.contacts.entidad.layouts.address')
            {{-- @livewire('contacts.entidad.layouts.direccion') --}}
        </div>
        <div class="card card-body blur shadow-blur mx-4 my-1">    
            <div class="row">
            @foreach ($emails as $index => $email)
                @php
                    $i = -1; $i++;
                @endphp
                <div class="col-6">
                    <div class="row">
                        <div class="col-4 form-group">
                            <label for="observ" class="form-control-label">Nombre mail *</label>
                            <input list="categories-mail" class="form-control" type="text" placeholder="info"
                                name="observ" id="observ" wire:model="observ">
                            <datalist id="categories-mail">
                                <option>Microsoft</option>
                                <option>Google</option>
                                <option>Yahoo</option>
                                <option>Apple</option>
                            </datalist>
                        </div>
                        <div class="col-6 form-group">
                            <label for="correo" class="form-control-label">Email *</label>
                            <input class="form-control" type="email" placeholder='info@wateke.travel'
                                name="correo" id="correo" wire:model="correo">
                        </div>
                        <div class="col-2 p-0">   
                            @if ($i != 1)
                                <button wire:click="addEmail($index)" type="button" class="btn btn-secondary my-4">-</button>
                            @endif
                            {{-- <button wire:click="addEmail" type="button" class="btn btn-secondary my-4">+</button> --}}
                        </div>       
                    </div>
                </div>
            @endforeach
            </div>       
            {{-- <button wire:click="addEmail" type="button" class="btn btn-secondary my-4">+</button>     --}}
        </div>
        {{-- <div class="card card-body blur shadow-blur mx-4 my-1">
            <div class='row'>
                @for ($i = 0; $i < $c_movil; $i++)
                    @livewire('contacts.entidad.layouts.telefono', key($i*0.1))
                @endfor
            </div>
        </div> --}}
                

