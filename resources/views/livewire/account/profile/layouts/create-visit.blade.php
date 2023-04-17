
  <div class="col-md-4">
    <!-- Button trigger modal -->
    <button type="button" class="p-3 btn btn-primary rounded" data-bs-toggle="modal" data-bs-target="#ModalWindow">
      nueva Visita Comercial
    </button>

    <!-- Modal -->
    <div class="modal fade" id="ModalWindow" tabindex="-1" role="dialog" aria-labelledby="ModalWindowTitle" aria-hidden="true" data-bs-backdrop="static">
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
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div id="modal-body-visit" class="modal-body">

            <div id="modal-body-visit-init">
                <form>
                    <div class="form-group">
                      <label for="visitAgencys" class="col-form-label h6">Agencia:</label>
                      <select class="form-control" name="visitAgencys" id="visitAgencys">
                          {{-- @foreach ( $visitAgencys as $agency ) --}}
                              {{-- <option value="{{ $agency->id }}">{{ $agency->name }}</option> --}}
                          {{-- @endforeach --}}
                      </select>
                    </div>
                  </form>
            </div>
            <div hidden id="modal-body-visit-start">

            </div>
            <div hidden id="modal-body-visit-end">
                <form>
                    <div class="form-group">
                      <label for="message-text" class="col-form-label h6">Observaciones:</label>
                      <textarea class="form-control" id="message-text"></textarea>
                    </div>
                  </form>
            </div>
          </div>
          <div id="modal-footer-visit"  class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="modal-booton-visit-cancel">Cancelar</button>
            <button type="button" class="btn btn-primary" id="modal-booton-visit-init">Empezar Visita</button>
            <button hidden type="button" class="btn btn-primary" id="modal-booton-visit-start">Terminar Visita</button>
            <button hidden type="button" class="btn btn-primary" id="modal-booton-visit-end">Registrar Visita</button>
          </div>
        </div>
      </div>
    </div>
  </div>


@push('scripts')
<script>

    document.getElementById('modal-booton-visit-init').addEventListener('click', function(){
        document.getElementById('modal-booton-visit-cancel').hidden = true

        document.getElementById('modal-booton-visit-init').hidden = true;
        document.getElementById('modal-body-visit-init').hidden = true;
        document.getElementById('modal-header-visit-init').hidden = true;
        document.getElementById('modal-booton-visit-start').hidden = false;
        document.getElementById('modal-body-visit-start').hidden = false;
        document.getElementById('modal-header-visit-start').hidden = false;
    });

    document.getElementById('modal-booton-visit-start').addEventListener('click', function(){

        document.getElementById('modal-booton-visit-start').hidden = true;
        document.getElementById('modal-body-visit-start').hidden = true;
        document.getElementById('modal-header-visit-start').hidden = true;
        document.getElementById('modal-booton-visit-end').hidden = false;
        document.getElementById('modal-body-visit-end').hidden = false;
        document.getElementById('modal-header-visit-end').hidden = false;

    });


</script>
@endpush
