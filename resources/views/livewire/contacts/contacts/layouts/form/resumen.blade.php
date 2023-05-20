    <div class="card-header p-0">

        <div class="d-flex px-2 py-1 justify-content-between">
            <div class="d-flex">
                <div>
                    <img src="../assets/img/team-2.jpg" class="avatar avatar-xxl me-3">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-xl h5">{{$name . ' ' . $middle_name . ' ' . $first_lastname . ' ' . $second_lastname}}</h6>
                    <p class="text-md text-secondary pb-2 mb-0">john@creative-tim.com</p>
                    <hr/>
                    <p class="text-lg pt-2 mb-0">Recursos Humanos &nbsp;|&nbsp; Wateke Travel</p>
                </div>
            </div>
        </div>

    </div>



    <div class="card-body px-0 pt-1">
        <div class="row">
            <div class="col-5 pb-4 pl-11 text-start">

                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color: #3b5998;">
                            <i class="fab fa-facebook-f" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#e4405f;">
                            <i class="fab fa-instagram" style="transform:scale(1.8)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#1da1f2;">
                            <i class="fab fa-twitter" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#0077b5;">
                        <i class="fab fa-linkedin-in" style="transform:scale(1.5)"></i>
                    </a>
                    {{-- <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#000000;">
                        <i class="fab fa-tiktok" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#dbd82c;">
                        <i class="fab fa-snapchat-ghost" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#dd4b39;">
                        <i class="fab fa-google-plus-g" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color: #c4302b;">
                        <i class="fab fa-youtube" style="transform:scale(1.5)"></i>
                    </a>
                    <a href="#" class="d-inline-block icon icon-shape icon-sm shadow text-center border-radius-xl mb-1 hover-scale"
                        style="background-color:#bd081c;">
                        <i class="fab fa-pinterest" style="transform:scale(1.5)"></i>
                    </a> --}}

            </div>
            <div class="col-7 pb-4 px-4 text-end">

                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(236, 198, 25); color:white; cursor:pointer; position:relative;"
                        onmouseover="this.innerHTML='<i class=&quot;fas fa-birthday-cake&quot;></i>&nbsp;Cumpleaños';"
                        onmouseout="this.innerHTML='<i class=&quot;fas fa-birthday-cake&quot;></i>&nbsp;20 septiembre';">
                    <i class="fas fa-birthday-cake"></i>&nbsp;20 septiembre
                </a>
                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(194, 194, 194); color:white; cursor:pointer; position:relative;"
                        onmouseover="this.innerHTML='<i class=&quot;fas fa-pray&quot;></i>&nbsp;Santo';"
                        onmouseout="this.innerHTML='<i class=&quot;fas fa-pray&quot;></i>&nbsp;20 enero';">
                        <i class="fas fa-pray"></i>&nbsp;20 enero
                </a>
                {{-- <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(255, 153, 200); color:white;cursor:pointer; position:relative;"
                    onmouseover="this.innerHTML='<i class=&quot;fas fa-heart&quot;></i>&nbsp;Aniversario';"
                    onmouseout="this.innerHTML='<i class=&quot;fas fa-heart&quot;></i>&nbsp;12 dicimebre';">
                    <i class="fas fa-heart"></i>&nbsp;12 dicimebre
                </a>
                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(73, 162, 232); color:white;cursor:pointer; position:relative;"
                    onmouseover="this.innerHTML='<i class=&quot;fas fa-user-graduate&quot;></i>&nbsp;Graduación';"
                    onmouseout="this.innerHTML='<i class=&quot;fas fa-user-graduate&quot;></i>&nbsp;30 octubre';">
                    <i class="fas fa-user-graduate"></i>
                    &nbsp;30 octubre
                </a>

                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(32, 73, 126); color:white;cursor:pointer; position:relative;"
                    onmouseover="this.innerHTML='<i class=&quot;fas fa-building&quot;></i>&nbsp;Contratado';"
                    onmouseout="this.innerHTML='<i class=&quot;fas fa-building&quot;></i>&nbsp;29 febrero';">
                    <i class="fas fa-building"></i>
                    &nbsp;29 febrero
                </a>
                <a class="d-inline-block text-center border-radius-md me-1 mb-1 px-3 py-1 w-auto hover-scale"
                    style="background-color: rgb(197, 198, 198); color:white;cursor:pointer; position:relative;"
                    onmouseover="this.innerHTML='&nbsp;Personalizado';"
                    onmouseout="this.innerHTML='&nbsp;12 noviembre';">
                    &nbsp;12 noviembre
                </a> --}}
            </div>
        </div>






            {{-- pa las direcciones: --}}
            {{-- <button type="button" class="btn btn-lg btn-danger" data-bs-toggle="popover" title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">Click to toggle popover</button> --}}




    </div>
    <div class="card-body px-0 pt-0">
        <div class="row mx-1">
            <div class="col-md-4 mb-md-0 mb-4">
                <div class="card card-body border card-plain border-radius-lg p-3 d-inline-block w-100 min-height-150 max-height-150">
                    <i class="fas fa-id-card pr-4"> CI</i> 00090120456
                    <br/><i class="fas fa-passport pr-2"> PSP</i> M115602
                    <br/>
                    <br/>NO nos publica
                    <br/>
                    <strong>Notas: </strong>
                        <i class="fas fa-people-arrows pl-5"></i>
                        <i class="fas fa-briefcase px-2"></i>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card card-body border card-plain border-radius-lg p-3 d-inline-block w-100 min-height-150 max-height-150">
                    <strong class="">Dirección: </strong>
                    <p class="card-text"><i class="fas fa-map-marker-alt pl-3 pr-1" title="Casa"></i> 1600 Amphitheatre Parkway, Mountain View, CA</p>
                    <p class="card-text"><i class="fas fa-map-marker-alt pl-3 pr-1" title="Trabajo"></i> 1600 Amphitheatre Parkway, Mountain View, CA</p>

                    {{-- <img class="w-10 me-3 mb-0" src="../assets/img/logos/visa.png" alt="logo">
                    <h6 class="mb-0">
                        ****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;****&nbsp;&nbsp;&nbsp;5248
                    </h6>
                    <i class="fas fa-pencil-alt ms-auto text-dark cursor-pointer"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Card"></i> --}}
                </div>
            </div>
        </div>




        <div class="accordion mt-4 mx-2" id="accordionExample">






            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingPhone">
                    <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapsePhone" aria-expanded="false" aria-controls="collapsePhone">
                        <i class="fas fa-phone"></i>
                        &nbsp; TELÉFONOS
                    </button>
                </h2>
                <div id="collapsePhone" class="accordion-collapse collapse" aria-labelledby="headingPhone">
                    <div class="accordion-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Casa</h6>
                                                    <p class="text-xs text-secondary mb-0">España</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +34 23 345 23 23
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-fax fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Fax</h6>
                                                    <p class="text-xs text-secondary mb-0">España</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +34 23 345 23 23
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-briefcase fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Trabajo</h6>
                                                    <p class="text-xs text-secondary mb-0">España</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +34 23 345 23 23
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-building fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Oficina</h6>
                                                    <p class="text-xs text-secondary mb-0">España</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +34 23 345 23 23
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3 text-primary">
                                                    <i class="fas fa-mobile-alt fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Movil</h6>
                                                    <p class="text-xs text-secondary mb-0">España</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +34 23 345 23 23
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-mobile-alt fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Movil</h6>
                                                    <p class="text-xs text-secondary mb-0">Cuba</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +53 53 54 88 65
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Llamar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingChats">
                    <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseChats" aria-expanded="false" aria-controls="collapseChats">
                        <i class="fas fa-sms"></i>
                        &nbsp; CHATS
                    </button>
                </h2>
                <div id="collapseChats" class="accordion-collapse collapse" aria-labelledby="headingChats">
                    <div class="accordion-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3 text-primary">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Whatsapp</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    +53 54771264
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Chatear
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-briefcase fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Trabajo</h6>
                                                    <p class="text-xs text-secondary mb-0">Skype</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    alberto98poe@gmail.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Chatear
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Telegram</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    albertolicea00
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Chatear
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingEmails">
                    <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseEmails" aria-expanded="false" aria-controls="collapseEmails">
                        {{-- <i class="fas fa-envelope-open-text"></i> --}}
                        <i class="fas fa-envelope"></i>
                        &nbsp; EMAILS
                    </button>
                </h2>
                <div id="collapseEmails" class="accordion-collapse collapse" aria-labelledby="headingEmails">
                    <div class="accordion-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3 text-primary">
                                                    <i class="fas fa-briefcase fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Trabajo</h6>
                                                    <p class="text-xs text-secondary mb-0">Gmail</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    albertolicea00@gmail.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Enviar mail
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>


                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Microsoft</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    licea.alber56@outlook.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Enviar mail
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Apple</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    licea.alber56@icloud.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Enviar mail
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-home fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Yahoo</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    licea.vallejo00@yahoo.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Enviar mail
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingBankAccounts">
                <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBankAcoounts" aria-expanded="false" aria-controls="collapseBankAcoounts">
                    {{-- <i class="fas fa-euro-sign"></i> --}}
                    <i class="fas fa-hand-holding-usd"></i>
                    &nbsp; CUENTAS BANCARIAS
                </button>
                </h2>
                <div id="collapseBankAcoounts" class="accordion-collapse collapse" aria-labelledby="headingBankAccounts">
                    <div class="accordion-body p-0">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <img src="../assets/img/logos/card/mir.png" class="w-25 mb-0 ml-3">

                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">Banco Popular de Ahorro</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-7">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;7852
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs ">Vence: <strong>12/2024</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <img src="../assets/img/logos/card/visa.png" class="w-25 mb-0 ml-3">

                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">Banco Popular de Ahorro</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-7">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;7852
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs ">Vence: <strong>12/2024</strong></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <img src="../assets/img/logos/card/mastercard.png" class="w-25 mb-0 ml-3">

                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">John Michael</h6>
                                                    <p class="text-xs text-secondary mb-0">Banco Popular de Ahorro</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-7">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;&nbsp;7852&nbsp;&nbsp;&nbsp;7852
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <span class="text-secondary text-xs ">Vence: <strong>12/2024</strong></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>



            <div class="accordion-item border border-1 border-radius-sm m-1 p-1">
                <h2 class="accordion-header" id="headingWebs">
                    <button class="accordion-button h6 mb-0 py-1 collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseWebs" aria-expanded="false" aria-controls="collapseWebs">
                        <i class="fas fa-wifi"></i>
                        {{-- <i class="fab fa-internet-explorer"></i> --}}
                        &nbsp; WEBS
                    </button>
                </h2>
                <div id="collapseWebs" class="accordion-collapse collapse" aria-labelledby="headingWebs">
                    <div class="accordion-body">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <tbody>

                                    <tr>
                                        <td>
                                            <div class="d-flex px-0 py-1">
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <i class="fas fa-globe fa-lg"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center pl-3">
                                                    <h6 class="mb-0 text-sm">Personal</h6>
                                                    <p class="text-xs text-secondary mb-0">Blog</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="d-flex flex-column justify-content-center px-3">
                                                <p class="text-md font-weight-bold mb-0" >
                                                    http://albertos-blog.com
                                                </p>
                                            </div>
                                        </td>
                                        <td class="align-middle text-center">
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Visitar
                                            </a>
                                            <a class="btn btn-primary btn-sm text-white me-1 mb-1 px-3 py-1 w-auto">
                                                Copiar
                                            </a>
                                        </td>
                                    </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>




        </div>



    </div>


    <div class="card-footer px-4 pt-1">
        <div class="form-check form-switch">
            <input class="form-check-input" type="checkbox" id="rememberMe" wire:model='is_user_link'>
            <label class="form-check-label fs-6" for="rememberMe"> Convertir en un usuario del sistema</label>
        </div>
        @if ($is_user_link)
            <div class="mt-3 row">
                <div class="col form-group">
                    <label for="user_link_role" class="form-control-label">Rol *</label>
                    <select class="form-control" name="role" id="user_link_role" wire:model='user_link_role'>
                        @foreach ($user_link_roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col form-group">
                    <label for="user_link_email" class="form-control-label">Usuario</label>
                    <input class="@error('user_link_email')border border-danger rounded-3 is-invalid @enderror form-control" type="text"
                        name="user_link_email" id="user_link_email" value="{{ $user_link_email }}" disabled>
                    @error('user_link_email') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col form-group">
                    <label for="user_link_password_public" class="form-control-label">Contraseña *</label>
                    <input class="@error('user_link_password_public')border border-danger rounded-3 is-invalid @enderror form-control"  type="password" aria-label="Password"
                        name="user_link_password_public" id="user_link_password_public" wire:model="user_link_password_public" aria-describedby="password-addon">
                    @error('user_link_password_public') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
                <div class="col form-group">
                    <label for="user_link_password_check" class="form-control-label">Confirmar contraseña *</label>
                    <input class="@error('user_link_password_check')border border-danger rounded-3 is-invalid @enderror form-control" type="password" aria-label="Password"
                        name="user_link_password_check" id="user_link_password_check" wire:model="user_link_password_check" aria-describedby="password-addon">
                    @error('user_link_password_check') <sub class="text-danger">{{ $message }}</sub> @enderror
                </div>
            </div>
        @endif
    </div>

