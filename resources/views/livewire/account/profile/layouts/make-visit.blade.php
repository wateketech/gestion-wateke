
  <div class="col-md-4">
    <!-- Button trigger modal -->
    <button type="button" class="p-3 btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#ModalWindow">
      nueva Visita Comercial
    </button>

    <!-- Modal -->
    <div wire:ignore class="modal fade" id="ModalWindow" tabindex="-1" role="dialog" aria-labelledby="ModalWindowTitle" aria-hidden="true" data-bs-backdrop="static">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div class="modal-title" id="modal-header-visit">
                <div id="modal-header-visit-init">
                    <h5 class="h3"><i class="far fa-calendar-check"></i> Nueva visita comercial</h5>
                    <sub class="font-weight-normal">NOTA: una vez inicie la visita se le bloquea la pantalla hasta que termine</sub>
                </div>
                <div hidden id="modal-header-visit-start">
                    <h5 class="h3"><i class="fas fa-handshake"></i> Visita comercial en curso</h5>
                    <sub class="font-weight-normal">NOTA: hasta finalizada la visita la pantalla permanecera bloquea</sub>
                </div>
                <div hidden id="modal-header-visit-end">
                    <h5 class="h3"><i class="fas fa-glass-cheers"></i> Visita comercial terminada</h5>
                    <sub class="font-weight-normal">NOTA: </sub>
                </div>
            </div>
          </div>
          <div id="modal-body-visit" class="modal-body">
            <div id="modal-body-visit-init">
                <form>
                    <div class="form-group">
                      <label for="visitAgencys" class="col-form-label h6">Agencia:</label>
                      <select class="form-control" name="visitAgencys" id="visitAgencys" wire:model="visitSelected">
                          @foreach ( $visitAgencys as $agency )
                            @php
                            $deadlineDate = new DateTime($agency->deaddate);
                            $today = new DateTime();
                            $interval = $deadlineDate->diff($today);
                            $daysLeft = $interval->format('%a');
                          @endphp
                          @if ($daysLeft < 5)
                            <option value="{{ $agency->id }}" class="text-danger">{{ $agency->name }} {{ date('d-m-Y', strtotime($agency->deaddate)) }}</option>
                          @elseif ($daysLeft < 10)
                            <option value="{{ $agency->id }}" class="text-warning">{{ $agency->name }} {{ date('d-m-Y', strtotime($agency->deaddate)) }}</option>
                          @else
                            <option value="{{ $agency->id }}">{{ $agency->name }} {{ date('d-m-Y', strtotime($agency->deaddate)) }}</option>
                          @endif

                          @endforeach
                      </select>
                    </div>
                    <div>
                      @foreach ( $visitAgencys as $agency )
                        <span class="visitAgencys-note" hidden id="{{$agency->id}}">
                          <p> Hacer visita antes del
                            @php
                                $deadlineDate = new DateTime($agency->deaddate);
                                $today = new DateTime();
                                $interval = $deadlineDate->diff($today);
                                $daysLeft = $interval->format('%a');
                            @endphp
                            @if ($daysLeft < 5)
                              <strong class="text-danger">{{ date('d-m-Y', strtotime($agency->deaddate)) }} </strong>
                            @elseif ($daysLeft < 10)
                              <strong class="text-warning">{{ date('d-m-Y', strtotime($agency->deaddate)) }} </strong>
                            @else
                              <strong>{{ date('d-m-Y', strtotime($agency->deaddate)) }} </strong>
                            @endif
                          </p>
                          <p class="mt-1"> <strong>Nota personal:</strong> {{ $agency->about }} </p>
                        </span>
                      @endforeach
                    </div>
                </form>
            </div>
            <div hidden id="modal-body-visit-start">
              <img src="../assets/img/bolasCargandoLineal.gif" class="mx-auto h-10 mb-1">
              @foreach ( $visitAgencys as $agency )
                <span class="visitAgencys-note-start" hidden id="{{$agency->id}}">
                  <strong>Observaciones a tener en cuenta:</strong><br/> {{ $agency->about }}
                </span>
              @endforeach
            </div>
            <div hidden id="modal-body-visit-end">
                <form id="maked-visit" wire:submit.prevent="save">
                  <div class="form-group">
                    <label for="message-text" class="col-form-label h6">Observaciones: *</label>
                    <textarea class="form-control @error('about')border border-danger rounded-3 @enderror" id="about-visit" wire:model="about"></textarea>
                    <sub class="text-danger" id="about-required"></sub>
                    @error('about')<sub class="text-danger" id="about-required">{{ $message }}</sub> @enderror
                  </div>
                </form>
            </div>
          </div>
          <div id="modal-footer-visit"  class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modal-booton-visit-cancel">Cancelar</button>
            <button type="button" class="btn btn-primary" id="modal-booton-visit-init">Empezar Visita</button>
            <button hidden type="button" class="btn btn-primary" id="modal-booton-visit-start">Terminar Visita</button>
            <button hidden type="button" class="btn btn-primary" id="modal-booton-visit-end" form="maked-visit">Registrar Visita</button>
          </div>
        </div>
      </div>
    </div>
  </div>


@push('scripts')
<script>


    // Selected agency
    document.querySelectorAll('.visitAgencys-note')[0].hidden = false;
    document.querySelectorAll('.visitAgencys-note-start')[0].hidden = false;
    document.getElementById('visitAgencys').addEventListener('change', () => {
      let id = document.getElementById('visitAgencys').value;
      Array.prototype.forEach.call(document.querySelectorAll('.visitAgencys-note'), (span) => {
        if (span.id != id) span.hidden = true ;
        else span.hidden = false;
      });
      Array.prototype.forEach.call(document.querySelectorAll('.visitAgencys-note-start'), (span) => {
        if (span.id != id) span.hidden = true ;
        else span.hidden = false;
      });
    });


    // Evitar el cierre si la tecla presionada es la tecla "Escape"
    // document.getElementById('ModalWindow').addEventListener('keydown', function(event) {
    //     event.preventDefault();
    //     modal.style.display = "block";
    // });
    // document.getElementById('ModalWindow').addEventListener('keyup', function(event) {
    //     event.stopPropagation();
    //     modal.style.display = "block";
    // });


    // Flujo de programacion
    document.getElementById('modal-booton-visit-init').addEventListener('click', function(){
        document.getElementById('modal-booton-visit-cancel').hidden = true

        // arreglar bien eswto y coger el token de la api de google maps
        navigator.geolocation.getCurrentPosition(function(position) {
          const latitude = position.coords.latitude;
          const longitude = position.coords.longitude;
          console.log(latitude, longitude);
          Livewire.emit('locationGeted', latitude, longitude);
        });
        Livewire.emit('start');
        document.getElementById('modal-booton-visit-init').hidden = true;
        document.getElementById('modal-body-visit-init').hidden = true;
        document.getElementById('modal-header-visit-init').hidden = true;
        document.getElementById('modal-booton-visit-start').hidden = false;
        document.getElementById('modal-body-visit-start').hidden = false;
        document.getElementById('modal-header-visit-start').hidden = false;
    });

    document.getElementById('modal-booton-visit-start').addEventListener('click', function(){

        Livewire.emit('end');
        document.getElementById('modal-booton-visit-start').hidden = true;
        document.getElementById('modal-body-visit-start').hidden = true;
        document.getElementById('modal-header-visit-start').hidden = true;
        document.getElementById('modal-booton-visit-end').hidden = false;
        document.getElementById('modal-body-visit-end').hidden = false;
        document.getElementById('modal-header-visit-end').hidden = false;

    });

    document.getElementById('modal-booton-visit-end').addEventListener('click', () => {

      if (document.getElementById('about-visit').value == '' || document.getElementById('about-visit').value.length == 0){
        document.getElementById('about-required').innerHTML = 'Campo Oblitgatorio';
      }
      else{
        document.getElementById('about-required').innerHTML = '';
        Livewire.emit('save');

        document.getElementById('modal-body-visit-start').hidden = false;
        document.getElementById('modal-booton-visit-end').hidden = true;
        document.getElementById('modal-body-visit-end').hidden = true;
        Array.prototype.forEach.call(document.querySelectorAll('.visitAgencys-note-start'), (span) => {
          span.hidden = true;
        });

      }
    });

</script>
@endpush
