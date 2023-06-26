<div class="card-header p-3">

    <div class="d-flex px-2 py-1 justify-content-between">

        <div class="d-flex flex-column justify-content-center fs-3">
            {{ count($contacts) }} contactos seleccionados
        </div>

        <div class="d-flex justify-content-top">

                @if (count($contacts_emails) != 0)
                    <a class="icon icon-shape icon-md shadow text-center border-radius-50 me-2" style="background-color: rgb(0, 153, 255)"
                        href='mailto:{{ $this->getEmails() }}'>
                            <i class="fas fa-envelope"></i>
                    </a>
                @else
                    <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0"
                        href='javascript:void(0)'><i class="fas fa-envelope"></i></div>
                @endif


                {{-- Funcion para exportar los datos de los contactos seleccionados a csv --}}
                <div class="icon icon-shape icon-md shadow text-center border-radius-50 me-2 disabled" style="background-color: #c0c0c0" href='javascript:void(0)'><i class="fas fa-download"></i></div>


        </div>


    </div>
</div>


<div class="card-body px-2 p-3">

    <div class="avatar-group mx-2">
        @foreach ($contacts as $contact)
            <a href="javascript:void(0)" class="avatar avatar-xxl" data-bs-toggle="tooltip" data-bs-placement="bottom"
                title="{{$contact['name'] . ' ' . $contact['middle_name'] . ' ' . $contact['first_lastname'] . ' ' . $contact['second_lastname'] }}" style="border-radius: 20%;">
                <img alt="imagen perfil" style="border-radius: 20%;"
                    src="{{ (!empty($contact['pics'])) ? 'data:image/jpeg;base64,' . base64_encode(file_get_contents(storage_path($contact['pics'][0]['store'] . $contact['pics'][0]['name'])))
                    : '../assets/img/illustrations/contact-profile-2.png' }}">
            </a>
        @endforeach
    </div>


    <div class="accordion mt-4 mx-2" id="accordionInfoContacts">




        @if (count($contacts_emails) != 0)

            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingPhone">
                    <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="false" aria-controls="collapsePhone">
                        <i class="fas fa-envelope"></i>
                        &nbsp; PLANTILLAS DE CORREOS
                    </button>
                </h2>
                <div id="collapsePhone" class="accordion-collapse collapse" aria-labelledby="headingPhone">
                    <div class="accordion-body">
                        <div>
                            <div class="text-center">
                                @for ($i = 0; $i < 15; $i++)
                                    <a class="btn btn-outline-primary border-2 btn-lx p-0 m-1" href="javascript:void(0)">
                                        <div class="d-flex py-2 px-3" title="nombre de la plantilla">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-primary text-sm">Plantilla {{ $i }}</h6>
                                                <p class="text-xs text-secondary mb-0">Bla bla</p>
                                            </div>
                                        </div>
                                    </a>
                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif







    </div>




</div>
